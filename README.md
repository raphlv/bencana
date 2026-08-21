<div align="center">

# Bencana - Disaster Early Warning and Incident Response Portal

### *Real-Time Hazard Tracking, Shelter Management, and Mitigation Platform*

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

---

</div>

## Overview

Bencana is a web-based Disaster Incident Tracking and Emergency Mitigation System designed for disaster management agencies (BPBD), field officers, and citizens. It streamlines real-time disaster reporting, maps affected areas, tracks evacuation shelter capacities, and manages relief goods logistics.

---

## Key Features

### 1. Real-Time Incident Reporting and Mapping
- Interactive disaster map showing floods, landslides, earthquakes, and fires.
- Citizen incident submission with GPS coordinates, photos, and severity level.
- Verification workflow for field coordinators before public alert publication.

### 2. Evacuation Shelter Management
- Directory of active evacuation shelters with real-time capacity monitoring.
- Track evacuee numbers categorized by age, gender, and medical needs.
- Map directions and contact numbers for local emergency coordinators.

### 3. Relief Logistics and Supplies Inventory
- Warehouse inventory tracking for food rations, medicine, blankets, and clean water.
- Aid distribution logs per shelter to prevent supply shortages.
- Donation request and distribution transparency portal.

---

## Technology Stack

| Layer | Technologies |
| :--- | :--- |
| **Backend** | PHP 8.2+ / Laravel 10.x |
| **Frontend** | Tailwind CSS, Blade Templating, Alpine.js |
| **Database** | MySQL / MariaDB |
| **Mapping Engine** | Leaflet.js / OpenStreetMap API |

---

## Repository Structure

`
bencana/
Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ app/
Ã¢â€â€š   Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ Http/Controllers/  # Incident, Shelter and Logistics Controllers
Ã¢â€â€š   Ã¢â€â€Ã¢â€â‚¬Ã¢â€â‚¬ Models/            # DisasterEvent, Shelter, Logistics Models
Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ database/
Ã¢â€â€š   Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ migrations/        # Tables for Incidents, Shelters and Supplies
Ã¢â€â€š   Ã¢â€â€Ã¢â€â‚¬Ã¢â€â‚¬ seeders/           # Initial Regional Data Seeders
Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ resources/
Ã¢â€â€š   Ã¢â€Å“Ã¢â€â‚¬Ã¢â€â‚¬ views/             # Responsive Public and Admin Dashboards
Ã¢â€â€š   Ã¢â€â€Ã¢â€â‚¬Ã¢â€â‚¬ js/                # Map Rendering Scripts
Ã¢â€â€Ã¢â€â‚¬Ã¢â€â‚¬ routes/web.php         # Public Incident Routes and BPBD Admin Portal
`

---

## Installation and Setup

`ash
# 1. Clone Repository
git clone https://github.com/raphlv/bencana.git
cd bencana

# 2. Install PHP and Node Dependencies
composer install
npm install && npm run build

# 3. Environment and Database Setup
cp .env.example .env
php artisan key:generate

# Configure DB_DATABASE=bencana_db in .env
php artisan migrate --seed
php artisan storage:link

# 4. Run App
php artisan serve
`

---

## License and Author

Distributed under the MIT License.

Author: Pangeran Ryan Pahlevi (https://github.com/raphlv)  
Email: pangeranryan080504@gmail.com  

---
<div align="center">
  <sub>Automated Sync Enabled for Contribution Tracking | Last Updated: 2026-08-18 14:40:47</sub>
</div>

<!-- Last updated: 2026-08-21 09:00:04 -->
