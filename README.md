<div align="center">

# ðŸš¨ Bencana â€” Disaster Early Warning & Incident Response Portal

### *Real-Time Disaster Mitigation, Shelter Management, & Disaster Tracking Platform*

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

---

</div>

## ðŸ“Œ About Bencana

**Bencana** is a web-based **Disaster Incident Tracking and Emergency Mitigation System** designed for disaster management agencies (BPBD), field officers, and citizens. It streamlines real-time disaster reporting, maps affected areas, tracks evacuation shelter capacities, and manages relief goods logistics.

---

## âœ¨ Key Features

### ðŸ“¡ 1. Real-Time Incident Reporting & Mapping
- Interactive disaster map showing floods, landslides, earthquakes, and fires.
- Citizen incident submission with GPS coordinates, photos, and severity level.
- Verification workflow for field coordinators before public alert publication.

### â›º 2. Evacuation Shelter Management
- Directory of active evacuation shelters with real-time capacity monitoring.
- Track evacuee numbers categorized by age, gender, and medical needs.
- Map directions and contact numbers for local emergency coordinators.

### ðŸ“¦ 3. Relief Logistics & Supplies Inventory
- Warehouse inventory tracking for food rations, medicine, blankets, and clean water.
- Aid distribution logs per shelter to prevent supply shortages.
- Donation request and distribution transparency portal.

---

## ðŸ› ï¸ Technology Stack

| Layer | Technologies |
| :--- | :--- |
| **Backend** | PHP 8.2+ / Laravel 10.x |
| **Frontend** | Tailwind CSS, Blade Templating, Alpine.js |
| **Database** | MySQL / MariaDB |
| **Mapping Engine** | Leaflet.js / OpenStreetMap API |

---

## ðŸ“‚ Repository Structure

`
bencana/
â”œâ”€â”€ app/
â”‚   â”œâ”€â”€ Http/Controllers/  # Incident, Shelter & Logistics Controllers
â”‚   â””â”€â”€ Models/            # DisasterEvent, Shelter, Logistics Models
â”œâ”€â”€ database/
â”‚   â”œâ”€â”€ migrations/        # Tables for Incidents, Shelters & Supplies
â”‚   â””â”€â”€ seeders/           # Initial Regional Data Seeders
â”œâ”€â”€ resources/
â”‚   â”œâ”€â”€ views/             # Responsive Public & Admin Dashboards
â”‚   â””â”€â”€ js/                # Map Rendering Scripts
â””â”€â”€ routes/web.php         # Public Incident Routes & BPBD Admin Portal
`

---

## ðŸš€ Installation & Setup

`ash
# 1. Clone Repository
git clone https://github.com/raphlv/bencana.git
cd bencana

# 2. Install PHP & Node Dependencies
composer install
npm install && npm run build

# 3. Environment & Database Setup
cp .env.example .env
php artisan key:generate

# Configure DB_DATABASE=bencana_db in .env
php artisan migrate --seed
php artisan storage:link

# 4. Run App
php artisan serve
`

---

## ðŸ“ License & Author

Distributed under the **MIT License**.

ðŸ‘¤ **Author**: [Pangeran Ryan Pahlevi](https://github.com/raphlv)  
âœ‰ï¸ **Email**: [pangeranryan080504@gmail.com](mailto:pangeranryan080504@gmail.com)  

---
<div align="center">
  <sub>Automated Sync Enabled for Contribution Tracking | Last Updated: 2026-08-18 14:37:04</sub>
</div>
