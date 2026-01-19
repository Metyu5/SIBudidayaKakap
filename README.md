# 🚀 SI Kakap — Sistem Informasi Tambak Kakap Putih

[![PHP](https://img.shields.io/badge/PHP-✓-8892BF?logo=php&style=flat-square)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-✓-00758F?logo=mysql&style=flat-square)](https://www.mysql.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-✓-38B2AC?logo=tailwindcss&style=flat-square)](https://tailwindcss.com/)
[![Node.js](https://img.shields.io/badge/Node.js-Required-339933?logo=node.js&style=flat-square)](https://nodejs.org/)
[![npm](https://img.shields.io/badge/npm-Required-CB3837?logo=npm&style=flat-square)](https://www.npmjs.com/)

<img align="right" alt="php" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="36"/>
<img align="right" alt="mysql" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="36"/>
<img align="right" alt="tailwindcss" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-plain.svg" width="36"/>

## ✨ Description
SI Kakap is a PHP-based web application for managing and monitoring tambak (sea cage) operations for budidaya Kakap Putih. The project provides role-based dashboards and a responsive UI built with Tailwind CSS and progressive UI libraries.

## ✅ Features
- Role-based authentication and routing (administrator, pimpinan, teknisi)
- Separate dashboard sections for each role (admin, pimpinan, teknisi)
- Responsive UI using Tailwind CSS
- Frontend enhancements with Alpine.js, AOS, and SweetAlert2
- Server-side PHP with MySQL database connection

## 🛠 Tech Stack
- PHP (server-side)
- MySQL (database)
- Tailwind CSS (styling)
- Node.js & npm (build tooling for Tailwind)
- Alpine.js (lightweight interactivity)
- AOS (scroll animations)
- SweetAlert2 (alerts)

## ⚙️ Installation
1. Clone the repository:
   git clone https://github.com/Metyu5/SIBudidayaKakap.git
2. Install Node dependencies (for Tailwind CLI):
   npm install
3. Build/watch Tailwind (optional for development):
   npm run dev
4. Configure database connection:
   - Edit `config/koneksi.php` to set your MySQL credentials and database name.
5. Serve the application with a PHP server (example):
   php -S localhost:8000
6. Open `http://localhost:8000` in your browser.

Note: This project expects a `users` table (used by `auth/proses_login.php`). Create user records and set the `kategori` field to one of: `administrator`, `pimpinan`, or `teknisi`.

## ▶️ Usage
- Visit the app entry at `index.php`.
- Log in using an account in the `users` table.
- After login, users are redirected to the role-specific dashboard:
  - Administrator → `admin/dashboard.php`
  - Pimpinan → `pimpinan/dashboard.php`
  - Teknisi → `teknisi/dashboard.php`

## 📂 Project Structure
- index.php — Public landing / login
- logout.php — Logout handler
- auth/
  - proses_login.php — Login processing and role routing
- config/
  - koneksi.php — Database connection file (edit for your environment)
- admin/ — Administrator pages and shared components (header, sidebar, topnav, pages)
- pimpinan/ — Pimpinan dashboard and pages
- teknisi/ — Teknisi dashboard and pages
- src/
  - input.css — Tailwind input
  - output.css — Generated Tailwind CSS
- assets/ — Shared images and front-end assets
- package.json — Tailwind build script

## 🖼️ Screenshots
(Screenshots not included)  
Add screenshots to the `assets` folder and update this README with example images if desired.

## 📄 License
This repository does not contain a LICENSE file. Add a license to make reuse terms explicit.

---
If you need help wiring the database schema or creating initial user records, add SQL schema or sample data and I can help generate an importable script.
