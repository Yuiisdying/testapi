// Browser Console Debug Script
// Copy and paste this into the browser console to debug

console.log("=== BIODIVERSITY MAP DEBUG ===\n");

// Check if instance exists
if (window.biodiversityMapInstance) {
    const map = window.biodiversityMapInstance;
    console.log("✓ BiodiversityMap instance found");
    
    // Check data
    console.log("\n=== DATA STATUS ===");
    console.log("Animals loaded:", map.animals ? map.animals.length : "NO");
    console.log("Regions loaded:", map.regions ? map.regions.length : "NO");
    
    if (map.animals && map.animals.length > 0) {
        console.log("\nFirst animal structure:");
        console.log("  Name:", map.animals[0].name);
        console.log("  Has species_type:", !!map.animals[0].species_type);
        console.log("  Has regions:", !!map.animals[0].regions);
        console.log("  Regions count:", map.animals[0].regions ? map.animals[0].regions.length : 0);
        console.log("Full first animal:", map.animals[0]);
    }
    
    // Check tab elements
    console.log("\n=== TAB ELEMENTS ===");
    const animalGrid = document.querySelector('#tab-animals .animals-grid');
    const regionGrid = document.querySelector('#tab-regions .regions-grid');
    const statsWrapper = document.querySelector('#tab-stats .stats-wrapper');
    const learnWrapper = document.querySelector('#tab-learn .learn-wrapper');
    
    console.log("Animals grid found:", !!animalGrid);
    if (animalGrid) console.log("  Children count:", animalGrid.children.length);
    
    console.log("Regions grid found:", !!regionGrid);
    if (regionGrid) console.log("  Children count:", regionGrid.children.length);
    
    console.log("Stats wrapper found:", !!statsWrapper);
    if (statsWrapper) console.log("  Inner HTML length:", statsWrapper.innerHTML.length);
    
    console.log("Learn wrapper found:", !!learnWrapper);
    if (learnWrapper) console.log("  Inner HTML length:", learnWrapper.innerHTML.length);
    
    // Check tab navigation
    console.log("\n=== TAB NAVIGATION ===");
    const tabBtns = document.querySelectorAll('.tab-btn');
    console.log("Tab buttons found:", tabBtns.length);
    tabBtns.forEach((btn, idx) => {
        console.log(`  ${idx}: ${btn.dataset.tab} - Active: ${btn.classList.contains('active')}`);
    });
    
    // Try to manually populate if empty
    console.log("\n=== ATTEMPTING MANUAL POPULATION ===");
    if (animalGrid && animalGrid.children.length === 0 && map.animals.length > 0) {
        console.log("Animals grid is empty, attempting to populate...");
        map.populateAnimalsTab();
        console.log("✓ populateAnimalsTab() called");
        console.log("  Grid children after:", animalGrid.children.length);
    }
    
    if (regionGrid && regionGrid.children.length === 0 && map.regions.length > 0) {
        console.log("Regions grid is empty, attempting to populate...");
        map.populateRegionsTab();
        console.log("✓ populateRegionsTab() called");
        console.log("  Grid children after:", regionGrid.children.length);
    }
    
} else {
    console.log("❌ BiodiversityMap instance NOT found");
    console.log("Available global objects:", Object.keys(window).filter(k => k.includes('bio') || k.includes('map') || k.includes('Animal')));
}

console.log("\n=== DEBUG COMPLETE ===");
