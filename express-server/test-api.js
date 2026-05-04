const http = require('http');

function getAPI(endpoint) {
  http.get(`http://localhost:5000${endpoint}`, (res) => {
    let data = '';
    
    res.on('data', chunk => {
      data += chunk;
    });
    
    res.on('end', () => {
      const parsed = JSON.parse(data);
      console.log(`\n✓ ${endpoint}:`);
      console.log(`  Total items: ${Array.isArray(parsed) ? parsed.length : 'N/A'}`);
      console.log(`  First item:\n`, JSON.stringify(parsed[0] || parsed, null, 2));
    });
  }).on('error', (err) => {
    console.error(`✗ Error on ${endpoint}:`, err.message);
  });
}

console.log(' Testing Express API endpoints...\n');

getAPI('/');
getAPI('/api/users');
getAPI('/api/posts');
getAPI('/api/products');
