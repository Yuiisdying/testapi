/* ============================================
   Indonesian Biodiversity Map - JavaScript
   ============================================ */

const FUN_FACTS = [
    "🦁 Sumatran tigers have unique stripe patterns like fingerprints!",
    "🐘 Sumatran elephants are smaller than African ones and swim underwater!",
    "🦜 Some parrots can live 50-80 years - longer than humans!",
    "🐠 Some fish can change gender based on social needs!",
    "🦕 The Komodo dragon is the largest living lizard - 3 meters long!",
    "🦘 Cuscus are tree-dwelling marsupials found in Papua!",
    "🦑 Giant squids can grow up to 12 meters long!",
    "🐢 Sea turtles navigate using Earth's magnetic field!",
    "🦅 Philippine eagles hunt flying lemurs and flying snakes!",
    "🐍 King cobras are the world's longest venomous snakes!",
    "🦈 Whale sharks are the largest fish but eat tiny plankton!",
    "🐬 Dolphins use echolocation to 'see' underwater!",
    "🦞 Mantis shrimp can see colors humans can't even imagine!",
    "🦗 Insects make up 80% of all animal species!",
    "🌳 Rainforests cover 6% of Earth but host 50% of species!",
    "🦎 Chameleons can move their eyes independently of each other!",
    "🦇 Some bats navigate using echolocation while others use smell!",
    "🐦 The Arctic tern has the longest migration of any bird!",
    "🐿️ Squirrels can't taste sweetness but are obsessed with sugar!",
    "🦌 Deer can see behind them without turning their heads!",
    "🐙 Octopuses have three hearts and blue blood!",
    "🦦 Sea otters hold hands while sleeping so they don't drift apart!",
    "🦅 Eagles can see 4-8 times better than humans!",
    "🐢 Some turtles can hold their breath for up to 7 hours!",
    "🦁 A lion's roar can be heard from 5 miles away!",
    "🦜 Parrots are basically tiny dinosaurs with attitude!",
    "🐻 Bears can run up to 35 mph - faster than Usain Bolt!",
    "🦌 Moose are the tallest deer species - up to 7 feet tall!",
    "🦊 A fox's tail helps it balance and communicates with other foxes!",
    "🐺 Wolves howl to gather the pack, not at the moon!",
    "🦝 Raccoons wash their food but can't taste sweetness like squirrels!",
    "🦆 Ducks have waterproof feathers and built-in cushioning!",
    "🦚 Peacocks perform elaborate dances to attract mates!",
    "🦩 Flamingos are pink because of what they eat!",
    "🦅 Owls can rotate their heads 270 degrees!",
    "🦜 Corvids (crows, ravens) are among the smartest animals!",
    "🦎 Some lizards can literally drop their tails when threatened!",
    "🐍 Snakes smell with their tongues!",
    "🐢 Tortoises can live over 100 years!",
    "🦑 Squid have specialized light organs for deep-sea communication!",
    "🦐 Shrimp can punch with the force of a .22 caliber bullet!",
    "🦀 Crabs walk sideways to move faster!",
    "🦞 Lobsters taste with their legs!",
    "🐙 Octopuses can squeeze through incredibly tiny spaces!",
    "🐠 Clownfish are born male and can change to female!",
    "🦈 Sharks have been around longer than dinosaurs!",
    "🐳 Blue whales are the largest animals ever to exist!",
    "🐋 Whales sing complex songs that travel across oceans!",
    "🐬 Dolphins have names for each other!",
    "🦭 Seals can dive incredibly deep on a single breath!",
    "🦦 Otters hold rocks as tools to crack open shellfish!",
    "🦘 Kangaroos can jump 30 feet in a single bound!",
    "🐨 Koalas spend 22 hours sleeping in trees!",
    "🦎 Iguanas have a third eye on top of their heads!",
    "🐢 Some sea turtles migrate 12,000 miles annually!",
    "🦗 Crickets chirp by rubbing their wings together!",
    "🐛 Caterpillars have more bones than humans!",
    "🦋 Butterflies taste with their feet!",
    "🐝 Bees waggle-dance to communicate locations!",
    "🐞 Ladybugs are actually beetles and eat hundreds of aphids!",
    "🦟 Mosquitoes have been around for 100 million years!",
    "🪰 Flies have taste buds on their feet!",
    "🕷️ Spiders have blue blood due to copper content!",
    "🦂 Scorpions glow under ultraviolet light!",
    "🐢 Indonesian island of Komodo is named after the dragons living there!",
    "🌴 The rainforests produce 20% of the world's oxygen!",
    "🦁 Indonesia has the most species of birds in the world!",
    "🐘 Elephants mourn their dead like humans do!",
    "🦜 Some birds can remember thousands of hiding spots!",
    "🌊 The ocean covers 71% of Earth but we've only explored 5%!",
    "🦑 Bioluminescence is nature's way of glowing in the dark!",
    "🦀 Hermit crabs switch shells as they grow!",
    "🪼 Jellyfish have existed for over 500 million years!",
    "🐚 Snails can have shells of incredible colors and patterns!",
    "🦐 Krill are tiny but feed the largest animals on Earth!",
    "🌺 Many animals depend on flowers for survival!",
    "🪴 Plants and animals have coevolved for millions of years!",
    "🦝 Some animals are nocturnal to avoid heat and predators!",
    "🦗 Most animals migrate seasonally for better resources!",
    "🌙 The moon's gravity affects tides and animal behavior!",
    "⚡ Animals have evolved for millions of years through natural selection!",
    "🥚 Egg diversity is incredible - some are microscopic, some huge!",
    "👶 Baby animals go through various stages of development!",
    "💪 Evolution has optimized animals for their specific habitats!",
    "🏆 Biodiversity is essential for ecosystem stability!",
    "🌍 Every species plays a role in the food chain!",
    "💚 Conservation efforts are critical for endangered species!",
    "🤝 Humans depend on animals for food, medicine, and more!",
    "🔬 Scientists discover new species every single day!",
    "🚀 Technology helps us study animals in new ways!",
    "📚 The more we learn, the more we realize how little we know!",
    "🎨 Nature's designs inspire human innovation and art!",
    "🌈 Biodiversity creates the beauty we see in nature!",
    "💎 Each animal species is priceless and irreplaceable!",
    "🛡️ Protecting habitats protects entire ecosystems!",
    "🌱 The future depends on our choices today!",
    "✨ Ain't writing more facts 🥀",
];

class BiodiversityMap {
    constructor() {
        this.map = null;
        this.regionMarkers = {}; // One marker per region
        this.animalsByRegion = {}; // Animals grouped by region
        this.animals = [];
        this.regions = [];
        this.filters = {
            search: '',
            speciesType: [],
            conservationStatus: [],
            region: ''
        };
        this.currentPage = 1;
        this.isLoadingMore = false;
        this.hasMorePages = false;
        this.factIndex = 0;
        this.displayTimeout = null;
        this.showSplashScreen();
        this.init();
    }

    showSplashScreen() {
        const splash = document.getElementById('splashScreen');
        const factEl = document.getElementById('splashFact');
        
        if (splash && factEl) {
            splash.classList.remove('hidden');
            
            // Show rotating facts
            this.rotateFacts();
            const factInterval = setInterval(() => {
                this.rotateFacts();
            }, 3000);
            
            // Store interval ID to clear later
            this.factInterval = factInterval;
            
            // Skip button
            const skipBtn = document.getElementById('skipSplash');
            if (skipBtn) {
                skipBtn.addEventListener('click', () => {
                    console.log('⏭️ Skipping splash screen');
                    this.hideSplashScreen();
                });
            }
        }
    }

    rotateFacts() {
        const factEl = document.getElementById('splashFact');
        if (factEl) {
            // Pick a completely random fact
            const randomIndex = Math.floor(Math.random() * FUN_FACTS.length);
            factEl.textContent = FUN_FACTS[randomIndex];
        }
    }

    hideSplashScreen() {
        const splash = document.getElementById('splashScreen');
        if (splash) {
            splash.classList.add('hidden');
        }
        
        // Also hide the loading spinner if it exists
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.add('hidden');
        }
        
        if (this.factInterval) {
            clearInterval(this.factInterval);
        }
    }

    async init() {
        try {
            console.log('🚀 Starting initialization...');
            
            // Initialize map
            this.initMap();
            console.log('✓ Map initialized');
            
            // Load data
            await this.loadRegions();
            console.log('✓ Regions loaded');
            
            await this.loadSpeciesTypes();
            console.log('✓ Species types loaded');
            
            await this.loadConservationStatuses();
            console.log('✓ Conservation statuses loaded');
            
            await this.loadAnimals();
            console.log('✓ Animals loaded');
            
            // Setup event listeners
            this.setupEventListeners();
            console.log('✓ Event listeners setup');
            
            // Pre-populate Animals and Regions tabs
            this.populateAnimalsTab();
            this.populateRegionsTab();
            
            // Mark these tabs as loaded
            const animalsTab = document.getElementById('tab-animals');
            const regionsTab = document.getElementById('tab-regions');
            if (animalsTab) animalsTab.dataset.loaded = 'true';
            if (regionsTab) regionsTab.dataset.loaded = 'true';
            
            console.log('✓ Tabs pre-populated');
            
            // Hide splash screen after loading
            setTimeout(() => {
                this.hideSplashScreen();
                console.log('✓ Splash screen hidden');
            }, 500);
            
            console.log('✓✓✓ Map fully initialized!');
        } catch (error) {
            console.error('✗ Error initializing map:', error);
            console.error('Stack:', error.stack);
            this.hideSplashScreen();
        }
    }

    showLoading(text = 'Loading...') {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.remove('hidden');
            const loadingText = document.getElementById('loadingText');
            if (loadingText) loadingText.textContent = text;
        }
    }

    hideLoading() {
        const spinner = document.getElementById('loadingSpinner');
        if (spinner) {
            spinner.classList.add('hidden');
        }
    }

    updateLoadingCount(current, total) {
        const countEl = document.getElementById('loadingCount');
        if (countEl) {
            countEl.textContent = `${current.toLocaleString()} / ${total.toLocaleString()} species loaded`;
        }
    }

    initMap() {
        // Center of Indonesia
        const center = [-2.5, 113.5];
        
        this.map = L.map('map').setView(center, 5);
        
        // Add base layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19,
            maxNativeZoom: 18
        }).addTo(this.map);
        
        // Region aggregation layer - one pin per region showing species count
    }

    async loadRegions() {
        try {
            const response = await fetch('/api/biodiversity/regions');
            this.regions = await response.json();
            this.populateRegionFilter();
        } catch (error) {
            console.error('Error loading regions:', error);
        }
    }

    async loadSpeciesTypes() {
        try {
            const response = await fetch('/api/biodiversity/species-types');
            const types = await response.json();
            this.populateSpeciesTypeFilter(types);
        } catch (error) {
            console.error('Error loading species types:', error);
        }
    }

    async loadConservationStatuses() {
        try {
            const response = await fetch('/api/biodiversity/conservation-statuses');
            const statuses = await response.json();
            this.populateConservationFilter(statuses);
        } catch (error) {
            console.error('Error loading conservation statuses:', error);
        }
    }

    async loadAnimals() {
        try {
            this.showLoading('Loading Indonesian biodiversity data...');
            
            // First, try to load with pagination to get total count
            let allAnimals = [];
            let page = 1;
            const perPage = 500;
            let totalCount = 0;
            let loadedCount = 0;

            try {
                // Try paginated load first
                const firstResponse = await fetch(`/api/biodiversity/animals?paginate=true&per_page=${perPage}&page=1`);
                const firstData = await firstResponse.json();
                
                if (firstData.total !== undefined) {
                    totalCount = firstData.total;
                    allAnimals = firstData.data || [];
                    loadedCount = allAnimals.length;
                    this.updateLoadingCount(loadedCount, totalCount);

                    // Load remaining pages if there are more
                    const totalPages = Math.ceil(totalCount / perPage);
                    for (let p = 2; p <= totalPages; p++) {
                        this.updateLoadingCount(loadedCount, totalCount);
                        const response = await fetch(`/api/biodiversity/animals?paginate=true&per_page=${perPage}&page=${p}`);
                        const data = await response.json();
                        const pageAnimals = data.data || [];
                        allAnimals = allAnimals.concat(pageAnimals);
                        loadedCount = allAnimals.length;
                        
                        // Add a small delay to avoid hammering the server
                        await new Promise(resolve => setTimeout(resolve, 50));
                    }
                    
                    this.updateLoadingCount(loadedCount, totalCount);
                }
            } catch (paginationError) {
                console.log('ℹ️ Pagination not supported, loading all animals at once');
                // Fall back to loading all at once
                const response = await fetch('/api/biodiversity/animals');
                const data = await response.json();
                allAnimals = Array.isArray(data.data) ? data.data : [];
            }

            this.animals = allAnimals;
            console.log('✓ Loaded', this.animals.length, 'animals');
            this.displayAnimals();
        } catch (error) {
            console.error('❌ Error loading animals:', error);
        }
    }

    displayAnimals() {
        // Clear existing region markers
        Object.values(this.regionMarkers).forEach(marker => {
            if (marker) this.map.removeLayer(marker);
        });
        this.regionMarkers = {};
        this.animalsByRegion = {};

        // Filter animals
        const filtered = this.filterAnimals();
        console.log('📍 Displaying', filtered.length, 'animals');

        // Group animals by region
        filtered.forEach(animal => {
            if (!animal.regions || !Array.isArray(animal.regions)) {
                return;
            }
            
            animal.regions.forEach(region => {
                if (region && region.latitude && region.longitude) {
                    if (!this.animalsByRegion[region.id]) {
                        this.animalsByRegion[region.id] = {
                            region: region,
                            animals: []
                        };
                    }
                    this.animalsByRegion[region.id].animals.push(animal);
                }
            });
        });

        // Create one marker per region
        Object.values(this.animalsByRegion).forEach(data => {
            const region = data.region;
            const animals = data.animals;
            const count = animals.length;

            // Determine marker size and color based on count
            let size = 30;
            let color = '#4CAF50';
            if (count > 50) {
                size = 50;
                color = '#FF5722';
            } else if (count > 30) {
                size = 45;
                color = '#FF9800';
            } else if (count > 10) {
                size = 40;
                color = '#FFC107';
            }

            const markerIcon = L.divIcon({
                className: 'region-marker',
                html: `<div style="background-color: ${color}; width: ${size}px; height: ${size}px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; border: 3px solid white; box-shadow: 0 2px 12px rgba(0,0,0,0.4); cursor: pointer; font-size: ${size/2}px;">
                    ${count}
                </div>`,
                iconSize: [size, size],
                iconAnchor: [size/2, size/2],
                popupAnchor: [0, -size/2]
            });

            const marker = L.marker(
                [parseFloat(region.latitude), parseFloat(region.longitude)],
                { icon: markerIcon }
            );

            // Store animals reference on marker
            marker.regionData = { region, animals };
            
            // Click to show region animals list
            marker.on('click', () => {
                this.showRegionAnimals(region, animals);
            });
            
            marker.addTo(this.map);
            this.regionMarkers[region.id] = marker;
        });

        console.log('✓ Created', Object.keys(this.regionMarkers).length, 'region markers');
    }

    debouncedDisplayAnimals() {
        if (this.displayTimeout) {
            clearTimeout(this.displayTimeout);
        }
        
        this.displayTimeout = setTimeout(() => {
            this.displayAnimals();
        }, 300);
    }

    createMarker(coords, animal, color) {
        const markerIcon = L.divIcon({
            className: 'marker-icon-custom',
            html: `<div style="background-color: ${color}; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); cursor: pointer;">
                ${animal.species_type.icon || '🦁'}
            </div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 15],
            popupAnchor: [0, -15]
        });

        const marker = L.marker(coords, { icon: markerIcon });
        
        // Store reference to this for closure
        const self = this;
        const animalData = animal;
        
        // Bind click event
        marker.on('click', function(e) {
            console.log('🖱️ Marker clicked for:', animalData.name);
            self.showAnimalDetails(animalData);
        });

        return marker;
    }

    filterAnimals() {
        return this.animals.filter(animal => {
            // Search filter
            if (this.filters.search) {
                const search = this.filters.search.toLowerCase();
                if (!animal.name.toLowerCase().includes(search) &&
                    !animal.scientific_name?.toLowerCase().includes(search) &&
                    !animal.common_name?.toLowerCase().includes(search)) {
                    return false;
                }
            }

            // Species type filter
            if (this.filters.speciesType.length > 0 &&
                !this.filters.speciesType.includes(animal.species_type_id)) {
                return false;
            }

            // Conservation status filter
            if (this.filters.conservationStatus.length > 0 &&
                !this.filters.conservationStatus.includes(animal.conservation_status_id)) {
                return false;
            }

            // Region filter
            if (this.filters.region) {
                const hasRegion = animal.regions.some(r => r.id == this.filters.region);
                if (!hasRegion) return false;
            }

            return true;
        });
    }

    showAnimalDetails(animal) {
        console.log('📝 showAnimalDetails called for:', animal.name);
        
        const panel = document.getElementById('detailsPanel');
        const content = panel.querySelector('.details-content');

        if (!panel) {
            console.error('❌ Details panel not found!');
            return;
        }
        
        if (!content) {
            console.error('❌ Details content not found!');
            return;
        }

        // Build status badge with color
        const statusColor = this.getStatusColor(animal.conservation_status_id);
        
        content.innerHTML = `
            <div class="animal-header">
                <div class="animal-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; height: 180px; border-radius: 8px; margin-bottom: 1rem;">
                    ${animal.species_type.icon || '🦁'}
                </div>
                <h2 class="animal-name">${animal.name}</h2>
                <p class="animal-scientific">${animal.scientific_name || 'Scientific name not available'}</p>
                <span class="animal-status" style="background-color: ${statusColor}; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; display: inline-block; font-size: 0.8rem; font-weight: 600;">
                    ${animal.conservation_status.name}
                </span>
            </div>

            <div class="details-section">
                <h4>Description</h4>
                <p>${animal.description}</p>
            </div>

            <div class="details-section">
                <h4>Classification</h4>
                <div class="details-badges">
                    <div class="badge">${animal.species_type.name}</div>
                </div>
            </div>

            <div class="details-section">
                <h4>Habitat</h4>
                <p>${animal.habitat || 'Not specified'}</p>
            </div>

            <div class="details-section">
                <h4>Diet</h4>
                <p>${animal.diet || 'Not specified'}</p>
            </div>

            ${animal.estimated_population ? `
            <div class="details-section">
                <h4>Estimated Population</h4>
                <p>${animal.estimated_population.toLocaleString()}</p>
            </div>
            ` : ''}

            <div class="details-section">
                <h4>Found In</h4>
                <ul class="regions-list">
                    ${animal.regions.map(r => `<li>${r.name}</li>`).join('')}
                </ul>
            </div>
        `;

        // Remove hidden class to show panel
        panel.classList.remove('hidden');
        console.log('✓ Panel displayed');
    }

    showRegionAnimals(region, animals) {
        console.log('🗺️ showRegionAnimals called for:', region.name, 'with', animals.length, 'animals');
        
        const panel = document.getElementById('detailsPanel');
        const content = panel.querySelector('.details-content');

        if (!panel || !content) {
            console.error('❌ Details panel not found!');
            return;
        }

        // Build animals list sorted by name
        const sortedAnimals = [...animals].sort((a, b) => a.name.localeCompare(b.name));
        const animalsList = sortedAnimals.map(animal => {
            const statusColor = this.getStatusColor(animal.conservation_status_id);
            return `
                <div style="padding: 0.8rem; border-bottom: 1px solid #eee; cursor: pointer; transition: background 0.2s;" 
                     onmouseover="this.style.background='#f5f5f5'" 
                     onmouseout="this.style.background='transparent'"
                     onclick="biodiversityMapInstance.showAnimalDetails({...${JSON.stringify(animal).replace(/"/g, '&quot;')}, species_type: ${JSON.stringify(animal.species_type).replace(/"/g, '&quot;')}, conservation_status: ${JSON.stringify(animal.conservation_status).replace(/"/g, '&quot;')}, regions: ${JSON.stringify(animal.regions).replace(/"/g, '&quot;')}})">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="font-size: 1.5rem;">${animal.species_type.icon || '🦁'}</div>
                        <div style="flex: 1;">
                            <strong>${animal.name}</strong><br>
                            <em style="color: #666; font-size: 0.9rem;">${animal.scientific_name}</em>
                        </div>
                        <span style="background-color: ${statusColor}; color: white; padding: 0.3rem 0.6rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                            ${animal.conservation_status.name}
                        </span>
                    </div>
                </div>
            `;
        }).join('');

        content.innerHTML = `
            <div class="animal-header">
                <h2 style="color: #333; margin-bottom: 0.5rem;">📍 ${region.name}</h2>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">
                    <strong>${animals.length}</strong> species in this region
                </p>
            </div>

            <div style="max-height: 600px; overflow-y: auto; border: 1px solid #eee; border-radius: 8px; margin-top: 1rem;">
                ${animalsList}
            </div>

            <div style="margin-top: 1rem; padding: 1rem; background: #f9f9f9; border-radius: 8px; font-size: 0.9rem; color: #666;">
                💡 Click any animal to see detailed information
            </div>
        `;

        // Store instance for onclick handler
        window.biodiversityMapInstance = this;

        panel.classList.remove('hidden');
        console.log('✓ Region animals panel displayed');
    }

    getStatusColor(statusId) {
        const colorMap = {
            1: '#28a745', // Least Concern
            2: '#ffc107', // Vulnerable
            3: '#fd7e14', // Endangered
            4: '#dc3545', // Critically Endangered
            5: '#6c757d'  // Extinct in the Wild
        };
        return colorMap[statusId] || '#95a5a6';
    }

    populateRegionFilter() {
        const select = document.getElementById('regionFilter');
        this.regions.forEach(region => {
            const option = document.createElement('option');
            option.value = region.id;
            option.textContent = region.name;
            select.appendChild(option);
        });
    }

    populateSpeciesTypeFilter(types) {
        const container = document.getElementById('speciesTypeFilter');
        container.innerHTML = '<label><input type="checkbox" value="all" checked> All Types</label>';
        
        types.forEach(type => {
            const label = document.createElement('label');
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.value = type.id;
            checkbox.dataset.typeName = type.name;
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(` ${type.icon || ''} ${type.name}`));
            container.appendChild(label);
        });
    }

    populateConservationFilter(statuses) {
        const container = document.getElementById('conservationFilter');
        statuses.forEach(status => {
            const label = document.createElement('label');
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.value = status.id;
            checkbox.dataset.statusName = status.name;
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(` ${status.name}`));
            container.appendChild(label);
        });
    }

    setupEventListeners() {
        // Dark mode toggle
        const darkModeBtn = document.getElementById('darkModeToggle');
        if (darkModeBtn) {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                darkModeBtn.textContent = '☀️';
            }
            
            darkModeBtn.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                localStorage.setItem('darkMode', isDark);
                darkModeBtn.textContent = isDark ? '☀️' : '🌙';
            });
        }

        // Compare tool
        const compareBtn = document.getElementById('compareToolBtn');
        if (compareBtn) {
            compareBtn.addEventListener('click', () => {
                const panel = document.getElementById('comparePanel');
                if (panel) {
                    panel.classList.remove('hidden');
                    this.loadRegionsForComparison();
                }
            });
        }

        // Close compare panel
        const closeCompareBtn = document.getElementById('closeCompare');
        if (closeCompareBtn) {
            closeCompareBtn.addEventListener('click', () => {
                const panel = document.getElementById('comparePanel');
                if (panel) {
                    panel.classList.add('hidden');
                }
            });
        }

        // Compare button handler
        const compareSubmitBtn = document.getElementById('compareBtn');
        if (compareSubmitBtn) {
            compareSubmitBtn.addEventListener('click', () => {
                const region1 = document.getElementById('compareRegion1').value;
                const region2 = document.getElementById('compareRegion2').value;
                if (region1 && region2 && region1 !== region2) {
                    this.compareRegions(region1, region2);
                } else {
                    alert('Please select two different regions to compare');
                }
            });
        }

        // Search
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filters.search = e.target.value;
                this.debouncedDisplayAnimals();
                
                // If search term exists, find and show the first matching animal
                if (e.target.value.trim().length > 0) {
                    const searchTerm = e.target.value.toLowerCase();
                    const matchingAnimal = this.animals.find(animal => 
                        animal.name.toLowerCase().includes(searchTerm) ||
                        animal.scientific_name?.toLowerCase().includes(searchTerm) ||
                        animal.common_name?.toLowerCase().includes(searchTerm)
                    );
                    
                    if (matchingAnimal) {
                        setTimeout(() => {
                            this.showAnimalDetails(matchingAnimal);
                        }, 350); // Wait for debounce to complete
                    }
                }
            });
        }

        // Species type filter
        const speciesFilter = document.getElementById('speciesTypeFilter');
        if (speciesFilter) {
            speciesFilter.addEventListener('change', (e) => {
                const typeCheckboxes = Array.from(document.querySelectorAll('#speciesTypeFilter input[type="checkbox"]:not([value="all"])'));
                const allCheckbox = document.querySelector('#speciesTypeFilter input[value="all"]');
                
                if (e.target.value === 'all') {
                    typeCheckboxes.forEach(cb => cb.checked = !allCheckbox.checked);
                    this.filters.speciesType = [];
                } else {
                    allCheckbox.checked = false;
                    const checked = Array.from(document.querySelectorAll('#speciesTypeFilter input[type="checkbox"]:checked:not([value="all"])')).map(cb => parseInt(cb.value));
                    this.filters.speciesType = checked;
                }
                this.debouncedDisplayAnimals();
            });
        }

        // Conservation status filter
        const conservationFilter = document.getElementById('conservationFilter');
        if (conservationFilter) {
            conservationFilter.addEventListener('change', (e) => {
                const checked = Array.from(document.querySelectorAll('#conservationFilter input[type="checkbox"]:checked')).map(cb => parseInt(cb.value));
                this.filters.conservationStatus = checked;
                this.debouncedDisplayAnimals();
            });
        }

        // Region filter
        const regionFilter = document.getElementById('regionFilter');
        if (regionFilter) {
            regionFilter.addEventListener('change', (e) => {
                this.filters.region = e.target.value;
                this.debouncedDisplayAnimals();
            });
        }

        // Close details panel button
        const closeBtn = document.getElementById('closeDetails');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                const panel = document.getElementById('detailsPanel');
                if (panel) {
                    panel.classList.add('hidden');
                    console.log('✓ Details panel closed');
                }
            });
        }

        // Reset filters button
        const resetBtn = document.getElementById('resetFilters');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                this.filters = {
                    search: '',
                    speciesType: [],
                    conservationStatus: [],
                    region: ''
                };
                
                if (searchInput) searchInput.value = '';
                document.querySelectorAll('#speciesTypeFilter input[value="all"]').forEach(cb => cb.checked = true);
                document.querySelectorAll('#speciesTypeFilter input:not([value="all"])').forEach(cb => cb.checked = false);
                document.querySelectorAll('#conservationFilter input').forEach(cb => cb.checked = false);
                if (regionFilter) regionFilter.value = '';
                
                this.displayAnimals();
            });
        }

        // Tab switching functionality
        this.setupTabSwitching();
    }

    setupTabSwitching() {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Get the tab name from data attribute
                const tabName = btn.dataset.tab;
                
                // Remove active class from all buttons and contents
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                btn.classList.add('active');
                const tabContent = document.getElementById(`tab-${tabName}`);
                if (tabContent) {
                    tabContent.classList.add('active');
                    
                    console.log(`📑 Switched to tab: ${tabName}`);
                    
                    // Load content for specific tabs if not already loaded
                    if (tabName === 'animals' && !tabContent.dataset.loaded) {
                        this.populateAnimalsTab();
                        tabContent.dataset.loaded = 'true';
                    } else if (tabName === 'regions' && !tabContent.dataset.loaded) {
                        this.populateRegionsTab();
                        tabContent.dataset.loaded = 'true';
                    } else if (tabName === 'stats' && !tabContent.dataset.loaded) {
                        this.populateStatsTab();
                        tabContent.dataset.loaded = 'true';
                    } else if (tabName === 'learn' && !tabContent.dataset.loaded) {
                        this.populateLearnTab();
                        tabContent.dataset.loaded = 'true';
                    }
                    
                    // Trigger map resize on map tab
                    if (tabName === 'map' && this.map) {
                        setTimeout(() => {
                            this.map.invalidateSize();
                        }, 100);
                    }
                }
            });
        });

        // Set first tab as active by default
        if (tabBtns.length > 0) {
            tabBtns[0].classList.add('active');
        }
        if (tabContents.length > 0) {
            tabContents[0].classList.add('active');
        }
    }

    populateAnimalsTab() {
        const container = document.querySelector('#tab-animals .animals-grid');
        if (!container || !this.animals || this.animals.length === 0) {
            console.warn('❌ Cannot populate animals: container, animals, or data missing');
            console.warn('  Container:', !!container);
            console.warn('  Animals:', this.animals ? this.animals.length : 'null');
            return;
        }

        console.log('📝 Starting populateAnimalsTab...');
        
        // Filter animals using current filters
        const filtered = this.filterAnimals();
        console.log('  Filtered animals:', filtered.length);
        
        container.innerHTML = filtered.map((animal, idx) => `
            <div class="animal-card" data-animal-index="${idx}" data-animal-id="${animal.id}">
                <div class="animal-card-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                    ${animal.species_type.icon || '🦁'}
                </div>
                <div class="animal-card-content">
                    <div class="animal-card-name">${animal.name}</div>
                    <div class="animal-card-type">${animal.species_type.name}</div>
                </div>
            </div>
        `).join('');

        console.log('  Cards rendered:', container.children.length);

        // Add event listeners to animal cards
        container.querySelectorAll('.animal-card').forEach((card, idx) => {
            card.addEventListener('click', () => {
                const animal = filtered[idx];
                this.showAnimalDetails(animal);
            });
        });

        // Store instance for global access
        window.biodiversityMapInstance = this;
        
        console.log(`✓ Populated Animals tab with ${filtered.length} animals`);
    }

    populateRegionsTab() {
        const container = document.querySelector('#tab-regions .regions-grid');
        if (!container || !this.regions || this.regions.length === 0) {
            console.warn('❌ Cannot populate regions: container, regions, or data missing');
            console.warn('  Container:', !!container);
            console.warn('  Regions:', this.regions ? this.regions.length : 'null');
            return;
        }

        console.log('📝 Starting populateRegionsTab...');

        container.innerHTML = this.regions.map((region, idx) => {
            // Count species in this region
            const speciesInRegion = this.animals.filter(animal => 
                animal.regions && animal.regions.some(r => r.id === region.id)
            ).length;

            return `
                <div class="region-card" data-region-index="${idx}" data-region-id="${region.id}">
                    <div class="region-card-icon">📍</div>
                    <div class="region-card-name">${region.name}</div>
                    <div class="region-stats">
                        <div class="region-stat">
                            <span class="region-stat-label">Species:</span>
                            <span class="region-stat-value">${speciesInRegion}</span>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        console.log('  Cards rendered:', container.children.length);

        // Add event listeners to region cards
        container.querySelectorAll('.region-card').forEach((card, idx) => {
            card.addEventListener('click', () => {
                const region = this.regions[idx];
                this.switchToMapAndShowRegion(region.id);
            });
        });

        // Store instance for global access
        window.biodiversityMapInstance = this;
        
        console.log(`✓ Populated Regions tab with ${this.regions.length} regions`);
    }

    populateStatsTab() {
        const container = document.querySelector('#tab-stats .stats-wrapper');
        if (!container || !this.animals || this.animals.length === 0) return;

        // Calculate statistics
        const stats = this.calculateStatistics();
        
        container.innerHTML = `
            <div class="stats-header">
                <h2>🌿 Biodiversity Statistics</h2>
                <p>Indonesian wildlife in numbers</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">${stats.totalSpecies}</div>
                    <div class="stat-label">Total Species</div>
                </div>
                <div class="stat-card stat-mammals">
                    <div class="stat-value">${stats.mammals}</div>
                    <div class="stat-label">Mammals</div>
                </div>
                <div class="stat-card stat-birds">
                    <div class="stat-value">${stats.birds}</div>
                    <div class="stat-label">Birds</div>
                </div>
                <div class="stat-card stat-reptiles">
                    <div class="stat-value">${stats.reptiles}</div>
                    <div class="stat-label">Reptiles</div>
                </div>
                <div class="stat-card stat-amphibians">
                    <div class="stat-value">${stats.amphibians}</div>
                    <div class="stat-label">Amphibians</div>
                </div>
                <div class="stat-card stat-fish">
                    <div class="stat-value">${stats.fish}</div>
                    <div class="stat-label">Fish</div>
                </div>
                <div class="stat-card stat-insects">
                    <div class="stat-value">${stats.insects}</div>
                    <div class="stat-label">Insects</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">${stats.regions}</div>
                    <div class="stat-label">Regions</div>
                </div>
            </div>

            <div class="conservation-section">
                <h3>🛡️ Conservation Status</h3>
                <div class="conservation-items">
                    <div class="conservation-item">
                        <div class="conservation-dot" style="background-color: #28a745;"></div>
                        <div class="conservation-text">
                            <strong>${stats.conservationStatus[1] || 0}</strong> Least Concern
                        </div>
                    </div>
                    <div class="conservation-item">
                        <div class="conservation-dot" style="background-color: #ffc107;"></div>
                        <div class="conservation-text">
                            <strong>${stats.conservationStatus[2] || 0}</strong> Vulnerable
                        </div>
                    </div>
                    <div class="conservation-item">
                        <div class="conservation-dot" style="background-color: #fd7e14;"></div>
                        <div class="conservation-text">
                            <strong>${stats.conservationStatus[3] || 0}</strong> Endangered
                        </div>
                    </div>
                    <div class="conservation-item">
                        <div class="conservation-dot" style="background-color: #dc3545;"></div>
                        <div class="conservation-text">
                            <strong>${stats.conservationStatus[4] || 0}</strong> Critically Endangered
                        </div>
                    </div>
                </div>
            </div>
        `;

        console.log(`✓ Populated Stats tab`);
    }

    populateLearnTab() {
        const container = document.querySelector('#tab-learn .learn-wrapper');
        if (!container) return;

        container.innerHTML = `
            <div class="learn-section">
                <h3>🌏 Indonesia's Biodiversity</h3>
                <p>
                    Indonesia is one of the world's most biodiverse countries, with incredible variety in its wildlife. 
                    Spanning from Sumatra to Papua, Indonesia contains unique ecosystems and endemic species found nowhere else on Earth.
                </p>
                <ul>
                    <li>Home to 10% of the world's species</li>
                    <li>Over 1,700 bird species</li>
                    <li>More than 600 types of coral</li>
                    <li>Unique megafauna like orangutans and Komodo dragons</li>
                </ul>
            </div>

            <div class="learn-section">
                <h3>🌳 Ecosystem Zones</h3>
                <p>
                    Indonesia's biodiversity varies greatly by region, from tropical rainforests to coral reefs:
                </p>
                <ul>
                    <li><strong>Rainforests:</strong> Dense jungles home to primates, elephants, and rare birds</li>
                    <li><strong>Coral Reefs:</strong> The Coral Triangle contains the world's most biodiverse marine ecosystems</li>
                    <li><strong>Volcanic Mountains:</strong> Unique alpine species adapted to high elevations</li>
                    <li><strong>Wetlands:</strong> Critical habitats for migratory birds and water species</li>
                </ul>
            </div>

            <div class="fun-fact" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="fun-fact-icon">💡</div>
                <div class="fun-fact-text">
                    <strong>Fun Fact:</strong> Indonesia's orangutans share about 97% of their DNA with humans! 
                    The name "orangutan" means "person of the forest" in Malay and Indonesian.
                </div>
            </div>

            <div class="learn-section">
                <h3>⚠️ Conservation Challenges</h3>
                <p>
                    Many Indonesian species face serious threats:
                </p>
                <ul>
                    <li>Habitat loss due to deforestation and agriculture</li>
                    <li>Climate change affecting ecosystems</li>
                    <li>Poaching and illegal wildlife trade</li>
                    <li>Pollution affecting marine and freshwater environments</li>
                    <li>Human-wildlife conflict in expanding areas</li>
                </ul>
            </div>

            <div class="fun-fact" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="fun-fact-icon">🌿</div>
                <div class="fun-fact-text">
                    <strong>What You Can Do:</strong> Support conservation organizations, reduce plastic use, 
                    learn about endangered species, and spread awareness about Indonesia's incredible wildlife!
                </div>
            </div>

            <div class="learn-section">
                <h3>📚 Learn More</h3>
                <p>
                    Click on the "Map" tab to explore specific regions and learn about individual species. 
                    Use the Animals tab to browse our complete collection of Indonesian wildlife.
                </p>
            </div>
        `;

        console.log(`✓ Populated Learn tab`);
    }

    calculateStatistics() {
        const stats = {
            totalSpecies: this.animals.length,
            regions: this.regions.length,
            mammals: 0,
            birds: 0,
            reptiles: 0,
            amphibians: 0,
            fish: 0,
            insects: 0,
            conservationStatus: {}
        };

        this.animals.forEach(animal => {
            // Count by species type
            switch(animal.species_type_id) {
                case 1: stats.mammals++; break;
                case 2: stats.birds++; break;
                case 3: stats.reptiles++; break;
                case 4: stats.amphibians++; break;
                case 5: stats.fish++; break;
                case 6: stats.fish++; break;
                case 7: stats.insects++; break;
            }

            // Count by conservation status
            const statusId = animal.conservation_status_id;
            stats.conservationStatus[statusId] = (stats.conservationStatus[statusId] || 0) + 1;
        });

        return stats;
    }

    switchToMapAndShowRegion(regionId) {
        // Switch to Map tab
        const mapTab = document.querySelector('[data-tab="map"]');
        if (mapTab) {
            mapTab.click();
        }

        // Find and highlight the region marker
        setTimeout(() => {
            const marker = this.regionMarkers[regionId];
            if (marker) {
                marker.openPopup();
                // Center map on marker
                this.map.setView(marker.getLatLng(), 8);
            }
        }, 300);
    }

    loadRegionsForComparison() {
        const select1 = document.getElementById('compareRegion1');
        const select2 = document.getElementById('compareRegion2');
        
        if (!select1 || !select2) return;

        select1.innerHTML = '<option value="">Select Region 1</option>';
        select2.innerHTML = '<option value="">Select Region 2</option>';
        
        this.regions.forEach(region => {
            const option1 = document.createElement('option');
            option1.value = region.id;
            option1.textContent = region.name;
            select1.appendChild(option1);
            
            const option2 = document.createElement('option');
            option2.value = region.id;
            option2.textContent = region.name;
            select2.appendChild(option2);
        });
    }

    async compareRegions(region1Id, region2Id) {
        try {
            const response = await fetch('/api/biodiversity/compare', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    region_ids: [parseInt(region1Id), parseInt(region2Id)]
                })
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                console.error('API Error:', data);
                throw new Error(data.message || 'Comparison failed');
            }
            
            console.log('Compare response:', data);
            this.displayComparisonResults(data);
        } catch (error) {
            console.error('Error comparing regions:', error);
            alert('Error: ' + error.message);
        }
    }

    displayComparisonResults(data) {
        const resultsDiv = document.getElementById('compareResults');
        if (!resultsDiv) return;

        const regions = data.regions;
        const diff = data.difference;

        let html = '<div style="display: flex; flex-direction: column; gap: 1rem;">';
        
        regions.forEach(region => {
            const threatLevel = region.endangered >= 10 ? 'threat-high' : 
                               region.endangered >= 5 ? 'threat-medium' : 'threat-low';
            
            html += `
                <div class="compare-card">
                    <h4>${region.name}</h4>
                    <div class="compare-stat">
                        <span class="compare-stat-label">Total Species:</span>
                        <span class="compare-stat-value">${region.total_species}</span>
                    </div>
                    <div class="compare-stat">
                        <span class="compare-stat-label">Critically Endangered:</span>
                        <span class="compare-stat-value threat-high">${region.critically_endangered}</span>
                    </div>
                    <div class="compare-stat">
                        <span class="compare-stat-label">Endangered/Vulnerable:</span>
                        <span class="compare-stat-value ${threatLevel}">${region.endangered}</span>
                    </div>
                    <div class="compare-stat">
                        <span class="compare-stat-label">Avg. Population:</span>
                        <span class="compare-stat-value">${region.avg_population.toLocaleString()}</span>
                    </div>
                    <div class="compare-stat">
                        <span class="compare-stat-label">Population Trend:</span>
                        <span class="compare-stat-value">
                            📈 ${region.increasing_species} | 
                            ➡️ ${region.stable_species} | 
                            📉 ${region.declining_species}
                        </span>
                    </div>
                    ${region.top_species && region.top_species.length > 0 ? `
                    <div style="margin-top: 0.8rem; padding-top: 0.8rem; border-top: 1px solid #e0e0e0;">
                        <p style="font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;">Top Species:</p>
                        ${region.top_species.map(s => `<p style="font-size: 0.85rem; margin: 0.2rem 0;">• ${s.name} (${s.population.toLocaleString()})</p>`).join('')}
                    </div>
                    ` : ''}
                </div>
            `;
        });

        html += `
            <div class="compare-diff">
                <p><strong>Comparison Summary:</strong></p>
                <p>Species Difference: <strong>${Math.abs(diff.species_diff)}</strong> (${diff.species_diff > 0 ? '📈' : '📉'})</p>
                <p>Threat Level Difference: <strong>${Math.abs(diff.threat_level_diff)}</strong> species (${diff.threat_level_diff > 0 ? 'More endangered' : 'Less endangered'})</p>
            </div>
        </div>`;

        resultsDiv.innerHTML = html;
        resultsDiv.classList.remove('hidden');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 Initializing Indonesian Biodiversity Map...');
    new BiodiversityMap();
});
