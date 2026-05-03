const API_BASE = '/tugas/disaster-tracker/public/api';
const POLL_INTERVAL = 5 * 60 * 1000; // 5 minutes (from .env)

let map;
let markers = {};
let disasters = [];
let currentFilter = 'all';
let lastSyncTime = null;

// Color mapping for disaster types and severity
const typeColors = {
    earthquake: { critical: '#d32f2f', severe: '#f57c00', moderate: '#ffa726' },
    tsunami: { critical: '#0066ff', severe: '#1976d2', moderate: '#42a5f5' },
    flood: { critical: '#1565c0', severe: '#1976d2', moderate: '#42a5f5' },
    storm: { critical: '#ff6f00', severe: '#fb8c00', moderate: '#ffb74d' },
    volcano: { critical: '#9c27b0', severe: '#ab47bc', moderate: '#ce93d8' }
};

const typeEmojis = {
    earthquake: '🌊',
    tsunami: '🌀',
    flood: '💧',
    storm: '⛈️',
    volcano: '🌋'
};

function initMap() {
    map = L.map('map').setView([20, 0], 3);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    setupEventListeners();
    loadDisasters();
    
    // Poll for updates
    setInterval(loadDisasters, POLL_INTERVAL);
}

function setupEventListeners() {
    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.dataset.type;
            updateMarkersDisplay();
        });
    });

    // Set "All" as default active
    document.querySelector('[data-type="all"]').classList.add('active');

    // Sync button
    document.getElementById('sync-btn').addEventListener('click', syncNow);
}

function getSeverityColor(magnitude, type = 'earthquake') {
    let severity;
    if (magnitude >= 6.5) severity = 'critical';
    else if (magnitude >= 6.0) severity = 'severe';
    else severity = 'moderate';
    
    const colorMap = typeColors[type] || typeColors.earthquake;
    return colorMap[severity];
}

function createMarker(disaster) {
    const color = getSeverityColor(disaster.magnitude, disaster.type);
    const emoji = typeEmojis[disaster.type] || '📍';
    
    // Create custom icon with emoji
    const icon = L.divIcon({
        html: `<div style="
            background: ${color};
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            border: 2px solid white;
            cursor: pointer;
        ">${emoji}</div>`,
        className: 'disaster-marker',
        iconSize: [32, 32],
        popupAnchor: [0, -16]
    });

    const marker = L.marker([disaster.lat, disaster.lng], { icon }).addTo(map);
    
    // Popup content
    const popup = `
        <div style="font-size: 13px; min-width: 250px;">
            <div style="font-weight: bold; color: ${color}; margin-bottom: 5px;">
                ${emoji} ${disaster.type.toUpperCase()}
            </div>
            <div><strong>Location:</strong> ${disaster.location || `${disaster.lat.toFixed(2)}, ${disaster.lng.toFixed(2)}`}</div>
            <div><strong>Magnitude:</strong> ${disaster.magnitude}</div>
            <div><strong>Severity:</strong> <span style="color: ${color};">${disaster.severity}</span></div>
            <div><strong>Source:</strong> ${disaster.source}</div>
            <div><strong>Time:</strong> ${formatTime(disaster.created_at)}</div>
            <div style="margin-top: 8px; font-size: 12px; color: #666;">${disaster.description}</div>
        </div>
    `;
    
    marker.bindPopup(popup);
    
    markers[disaster.id] = { marker, disaster };
}

function loadDisasters() {
    updateStatus('Loading data...', true);
    
    fetch(`${API_BASE}/disasters`)
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                disasters = data.data || [];
                
                // Clear existing markers
                Object.values(markers).forEach(({ marker }) => {
                    map.removeLayer(marker);
                });
                markers = {};
                
                // Create new markers
                disasters.forEach(disaster => {
                    createMarker(disaster);
                });
                
                updateStats();
                updateMarkersDisplay();
                lastSyncTime = new Date();
                updateStatus('Data loaded successfully', false);
            }
        })
        .catch(err => {
            updateStatus('Error loading data', false);
            console.error('Load error:', err);
        });
}

function syncNow() {
    const btn = document.getElementById('sync-btn');
    btn.classList.add('syncing');
    btn.disabled = true;
    btn.textContent = '⏳ Syncing...';
    
    fetch(`${API_BASE}/sync`)
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                updateStatus('Sync complete! Reloading...', true);
                setTimeout(loadDisasters, 500);
            }
        })
        .catch(err => {
            console.error('Sync error:', err);
            updateStatus('Sync failed', false);
        })
        .finally(() => {
            btn.classList.remove('syncing');
            btn.disabled = false;
            btn.textContent = '🔄 Sync Now';
        });
}

function updateStats() {
    const stats = {
        earthquake: 0,
        tsunami: 0,
        flood: 0,
        storm: 0,
        volcano: 0
    };
    
    disasters.forEach(d => {
        if (stats.hasOwnProperty(d.type)) {
            stats[d.type]++;
        }
    });
    
    document.getElementById('count-earthquakes').textContent = stats.earthquake;
    document.getElementById('count-tsunamis').textContent = stats.tsunami;
    document.getElementById('count-floods').textContent = stats.flood;
    document.getElementById('count-storms').textContent = stats.storm;
    document.getElementById('count-volcanoes').textContent = stats.volcano;
}

function updateMarkersDisplay() {
    Object.values(markers).forEach(({ marker, disaster }) => {
        if (currentFilter === 'all' || disaster.type === currentFilter) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
        } else {
            marker.setOpacity(0.2);
            marker.setZIndexOffset(0);
        }
    });
}

function updateStatus(message, isLoading) {
    const statusEl = document.getElementById('status-text');
    const loadingSpan = statusEl.querySelector('.loading');
    
    if (isLoading) {
        statusEl.innerHTML = `<span class="loading"></span> ${message}`;
    } else {
        statusEl.textContent = message;
    }
    
    if (lastSyncTime) {
        const elapsed = Math.floor((new Date() - lastSyncTime) / 1000);
        let timeStr;
        
        if (elapsed < 60) timeStr = 'just now';
        else if (elapsed < 120) timeStr = '1 minute ago';
        else if (elapsed < 3600) timeStr = Math.floor(elapsed / 60) + ' minutes ago';
        else timeStr = Math.floor(elapsed / 3600) + ' hours ago';
        
        document.getElementById('last-update').textContent = `Last update: ${timeStr}`;
    }
}

function formatTime(dateStr) {
    const date = new Date(dateStr);
    const now = new Date();
    const diff = now - date;
    
    if (diff < 60000) return 'Just now';
    if (diff < 3600000) return Math.floor(diff / 60000) + ' min ago';
    if (diff < 86400000) return Math.floor(diff / 3600000) + ' hours ago';
    
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
}

// Initialize map when page loads
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMap);
} else {
    initMap();
}
