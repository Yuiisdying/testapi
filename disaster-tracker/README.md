# 🌍 Disaster Tracker - Real-Time Earthquake & Natural Disaster Monitor

A lightweight, Laravel-like disaster tracking system that monitors earthquakes and natural disasters in real-time using multiple APIs for cross-verification with intelligent deduplication.

## Features

✅ **Multi-API Integration**
- USGS Earthquake Hazards Program (magnitude 4.5+)
- European-Mediterranean Seismic Centre (magnitude 4.0+)
- IRIS Seismic Network (magnitude 4.5+)

✅ **Smart Deduplication**
- 10km radius + 1 hour time window
- Prevents duplicate events from appearing multiple times
- Haversine formula for accurate distance calculation

✅ **Automatic Data Retention**
- Configurable event expiration (1-7 days, default 7)
- Automatic cleanup of old events during sync
- Keeps database lean and optimized
- Prevents unbounded growth on 24/7 monitoring

✅ **Real-Time Map**
- Interactive Leaflet.js map with OpenStreetMap
- Color-coded markers by disaster type and severity
- Live filtering by disaster category
- Detailed popup information for each event

✅ **Live Dashboard**
- Statistics by disaster type
- Real-time event counts
- Last update timestamp
- One-click manual sync

✅ **Lightweight Architecture**
- No Composer dependency
- Custom PHP MVC-like structure
- Configuration-driven setup (.env)
- Single-instance database connection

## Quick Start

### 1. Database Setup

Run the database initialization script:

```bash
cd c:\xampp\htdocs\tugas\disaster-tracker
C:\xampp\php\php.exe database/setup.php
```

This creates the `disasters` table with all necessary indexes.

### 2. Open the Map

Navigate to the map interface in your browser:

```
http://localhost/tugas/disaster-tracker/public/map.html
```

### 3. View API Endpoints

Available REST endpoints:

- **GET /api/disasters** - Get all disasters (up to 250)
- **GET /api/disasters/type/:type** - Filter by type (earthquake, tsunami, flood, storm, volcano)
- **GET /api/sync** - Trigger immediate sync from all APIs
- **GET /api/stats** - Get statistics by disaster type

Example:
```bash
curl http://localhost/tugas/disaster-tracker/public/api/disasters
```

## Configuration

Edit `.env` file to customize:

```env
# Database
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=tugas

# API Endpoints
USGS_API=https://earthquake.usgs.gov/fdsnws/event/1/query
EMSC_API=https://www.seismicportal.eu/fdsnws/event/1/query
IRIS_API=https://service.iris.edu/fdsnws/event/1/query

# Deduplication Settings
DEDUP_RADIUS_KM=10
DEDUP_TIME_HOURS=1

# Data Retention (days to keep events)
DATA_RETENTION_DAYS=7

# Polling Interval (in seconds)
POLL_INTERVAL_SECONDS=300
```

## Project Structure

```
disaster-tracker/
├── .env                          # Configuration file
├── bootstrap/
│   └── app.php                   # Application bootstrap
├── app/
│   ├── Router.php                # Request routing
│   ├── Database.php              # Database connection (singleton)
│   ├── Controllers/
│   │   └── DisasterController.php # API endpoints
│   ├── Models/
│   │   └── Disaster.php          # Data model with queries
│   └── Services/
│       └── DisasterSyncService.php # API sync logic
├── database/
│   ├── migrations/
│   │   └── 001_create_disasters_table.sql
│   └── setup.php                 # Database initialization script
├── public/
│   ├── index.php                 # API entry point
│   ├── map.html                  # Map interface
│   ├── css/
│   │   └── style.css             # Map styles
│   └── js/
│       └── map.js                # Map functionality
└── views/                        # Future template views
```

## How It Works

### Data Flow

```
API Sources (USGS, EMSC, IRIS)
    ↓
DisasterSyncService (API integration & transformation)
    ↓
Disaster Model (Deduplication check via haversine formula)
    ↓
Database (disasters table)
    ↓
REST API (DisasterController)
    ↓
Frontend (Leaflet.js Map)
```

### Deduplication Algorithm

When syncing disasters:
1. Fetch from all 3 APIs
2. For each disaster, check if duplicate exists:
   - Query `getNearby()` for events within 10km radius
   - Check if any occurred within last 1 hour
   - If match found, skip insertion (avoid duplicate)
3. Insert only new/unique disasters
4. Calculate severity based on magnitude:
   - **Critical**: M ≥ 6.5 (red)
   - **Severe**: M ≥ 6.0 (orange)
   - **Moderate**: M < 6.0 (yellow)

## API Response Examples

### GET /api/disasters
```json
{
  "status": "success",
  "count": 5,
  "data": [
    {
      "id": 1,
      "type": "earthquake",
      "location": "32 km S of Tobelo, Indonesia",
      "lat": "-1.8506",
      "lng": "127.4834",
      "magnitude": "5.3",
      "depth": "10.245",
      "severity": "moderate",
      "description": "Depth: 10.2 km",
      "source": "USGS",
      "created_at": "2024-04-05 12:34:56",
      "updated_at": "2024-04-05 12:34:56"
    }
  ],
  "timestamp": "2024-04-05 13:45:23"
}
```

### GET /api/stats
```json
{
  "status": "success",
  "stats": {
    "earthquakes": 42,
    "tsunamis": 3,
    "floods": 1,
    "storms": 0,
    "volcanoes": 0,
    "total": 46
  },
  "timestamp": "2024-04-05 13:45:23"
}
```

### GET /api/sync
```json
{
  "status": "success",
  "message": "Disaster sync completed",
  "results": {
    "earthquakes": 2,
    "tsunamis": 0,
    "floods": 0,
    "storms": 1,
    "volcanoes": 0,
    "deleted": 5,
    "errors": []
  },
  "timestamp": "2024-04-05 13:47:15"
}
```
The `deleted` field shows how many events were automatically cleaned up based on the `DATA_RETENTION_DAYS` setting.

## Polling Behavior

- **Frontend**: Polls `/api/disasters` every 5 minutes (configurable via POLL_INTERVAL_SECONDS)
- **Manual Sync**: Click "🔄 Sync Now" button to trigger immediate update
- **Status**: Shows last update time relative to current time

## Severity Scale

For earthquakes on Richter Scale:

| Magnitude | Severity | Color | Impact |
|-----------|----------|-------|--------|
| ≥ 6.5 | Critical | 🔴 Red | Severe damage |
| 6.0 - 6.4 | Severe | 🟠 Orange | Significant damage |
| < 6.0 | Moderate | 🟡 Yellow | Minor to moderate |

## Troubleshooting

### Database Connection Error
- Ensure MySQL/MariaDB is running (XAMPP control panel)
- Check `.env` credentials match your setup
- Verify `tugas` database exists

### Map Not Loading
- Check browser console for JavaScript errors
- Verify Leaflet.js CDN is accessible
- Ensure `/api/disasters` returns valid JSON

### No Data Appearing
- Click "🔄 Sync Now" to trigger API sync
- Check API endpoints are accessible:
  - USGS: `https://earthquake.usgs.gov/fdsnws/event/1/query`
  - EMSC: `https://www.seismicportal.eu/fdsnws/event/1/query`
  - IRIS: `https://service.iris.edu/fdsnws/event/1/query`

### Performance
- Map handles up to 250 events smoothly
- Increase DEDUP_RADIUS_KM or DEDUP_TIME_HOURS to be stricter with deduplication
- Adjust POLL_INTERVAL_SECONDS for more/less frequent updates

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Mapping**: Leaflet.js 1.9.4
- **Base Map**: OpenStreetMap tiles
- **Data Sources**: USGS, EMSC, IRIS seismic networks

## Future Enhancements

- [ ] Historical event tracking and archiving
- [ ] User alerts based on magnitude thresholds
- [ ] Push notifications for critical events
- [ ] Data export to CSV/JSON
- [ ] Custom date range queries
- [ ] Advanced filtering (by country, magnitude range)
- [ ] Heat maps for disaster concentration areas
- [ ] API key management for higher request limits
- [ ] Activity logging and audit trails
- [ ] Admin dashboard

## License

This project is open source and available for educational and monitoring purposes.

## Contact

For issues, questions, or suggestions, please reach out!

---

**Last Updated**: April 6, 2026
**Status**: Active Development and Monitoring
