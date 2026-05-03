<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indonesian Biodiversity Map</title>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/biodiversity-map.css') }}">
</head>
<body>
    <div class="container">
        <!-- Splash Screen -->
        <div id="splashScreen" class="splash-screen">
            <div class="splash-content">
                <div class="splash-logo">🌍</div>
                <h1 class="splash-title">Indonesian Biodiversity Map</h1>
                <p class="splash-subtitle">Discover 241+ species across Indonesia & SE Asia</p>
                
                <div class="splash-loading">
                    <div class="splash-bar">
                        <div class="splash-progress"></div>
                    </div>
                    <p id="splashText" class="splash-text">Loading... 🦁</p>
                </div>
                
                <div class="splash-facts">
                    <p id="splashFact" class="splash-fact"></p>
                </div>
                
                <button id="skipSplash" class="splash-skip">Skip →</button>
            </div>
        </div>

        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <h1>🌍 Indonesian Biodiversity Explorer</h1>
                <p>Discover 178 iconic species across Indonesia</p>
            </div>
            <div class="header-controls">
                <button id="darkModeToggle" class="btn-icon" title="Toggle Dark Mode">🌙</button>
            </div>
        </header>

        <!-- Tab Navigation -->
        <nav class="tab-navigation">
            <button class="tab-btn active" data-tab="map">🗺️ Map</button>
            <button class="tab-btn" data-tab="animals">🦁 Animals</button>
            <button class="tab-btn" data-tab="regions">🌍 Regions</button>
            <button class="tab-btn" data-tab="stats">📊 Stats</button>
            <button class="tab-btn" data-tab="learn">📚 Learn</button>
        </nav>

        <div class="main-content">
            <!-- MAP TAB -->
            <div class="tab-content active" id="tab-map">
                <aside class="sidebar">
                    <div class="sidebar-section">
                        <h3>Search Animals</h3>
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="Search by name or species..."
                            class="search-input"
                        >
                    </div>

                    <div class="sidebar-section">
                        <h3>Filter by Type</h3>
                        <div id="speciesTypeFilter" class="filter-group">
                            <label><input type="checkbox" value="all" checked> All Types</label>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <h3>Conservation Status</h3>
                        <div id="conservationFilter" class="filter-group">
                            <!-- Populated by JS -->
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <h3>Region</h3>
                        <select id="regionFilter" class="region-select">
                            <option value="">All Regions</option>
                        </select>
                    </div>

                    <div class="sidebar-section">
                        <h3>Legend</h3>
                        <div class="legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #28a745;"></div>
                                <span>Least Concern</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #ffc107;"></div>
                                <span>Vulnerable</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #fd7e14;"></div>
                                <span>Endangered</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #dc3545;"></div>
                                <span>Critically Endangered</span>
                            </div>
                        </div>
                    </div>

                    <button id="resetFilters" class="btn-reset">Reset Filters</button>
                </aside>

                <div class="map-wrapper">
                    <div id="map"></div>
                    <div id="loadingSpinner" class="loading-spinner">
                        <div class="spinner"></div>
                        <p id="loadingText">Loading Indonesian biodiversity data...</p>
                        <p id="loadingCount" style="font-size: 12px; color: #666;"></p>
                    </div>
                </div>
            </div>

            <!-- ANIMALS TAB -->
            <div class="tab-content" id="tab-animals">
                <div class="animals-container">
                    <div class="animals-grid">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- REGIONS TAB -->
            <div class="tab-content" id="tab-regions">
                <div class="regions-container">
                    <div class="regions-grid">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- STATS TAB -->
            <div class="tab-content" id="tab-stats">
                <div class="stats-container">
                    <div class="stats-wrapper">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- LEARN TAB -->
            <div class="tab-content" id="tab-learn">
                <div class="learn-container">
                    <div class="learn-wrapper">
                        <!-- Populated by JS -->
                    </div>
                </div>
            </div>

            <!-- Details Panel (shared across all tabs) -->
            <div id="detailsPanel" class="details-panel hidden">
                <button class="close-btn" id="closeDetails">&times;</button>
                <div class="details-content">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
    
    <!-- Leaflet MarkerCluster CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/biodiversity-map.js') }}"></script>
</body>
</html>
