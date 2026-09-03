<div align="center">

# Bencana GIS - Urban Flood and Rainfall Early Warning System

### *Geospatial Disaster Monitoring, Hydrology Telemetry, and Emergency Alerts*

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Leaflet](https://img.shields.io/badge/Leaflet-1.9-199900?style=for-the-badge&logo=leaflet&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

---

</div>

## About The Project

A Geographic Information System (GIS) disaster monitoring application developed for municipal telemetry pos. Monitors rainfall levels, water gate thresholds (Siaga 1, 2, 3, 4), and plots spatial risk heatmaps on interactive Leaflet maps.

---

## Key Features

- Real-Time Hydrology Telemetry: Logs water gate levels and hourly rainfall sensors across pos observation stations.
- Early Warning Threshold Matrix: Color-coded alert triggers for Normal, Siaga 3, Siaga 2, and Siaga 1 conditions.
- Interactive Spatial Heatmap: Leaflet GIS mapping with coordinate marker clustering and flood risk boundary polygons.
- Data Export Module: Generate and export telemetry history into Excel/CSV for municipal disaster agency analysis.

---

## Technology Stack

- Backend: Laravel 10 (PHP 8.2)
- Database: MySQL with spatial geometry columns
- GIS Mapping: Leaflet.js and OpenStreetMap
- Styling: Tailwind CSS

---

## Getting Started

`ash
git clone https://github.com/raphlv/bencana.git
cd bencana
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
`

---

## Developer and Maintainer
Pangeran Ryan Pahlevi - https://pangeranryan.vercel.app

<!-- Last updated: 2026-09-03 09:00:06 -->
