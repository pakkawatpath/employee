# employee

A PHP-based web application designed to manage IT equipment, serial numbers, contracts, folders, and associated user data. Built for internal use in organizations to streamline asset tracking and documentation.

## 🔧 Features

- Add/edit/delete equipment records and serial numbers
- Manage contract details and link them to hardware
- Upload and organize documents in folders
- Assign users to specific contracts or assets
- Export/download user or asset data

## 🛠️ Technologies Used

- PHP
- MySQL
- HTML/CSS
- JavaScript
- Bootstrap
- SweetAlert2

## 📁 File Overview

- `add*.php` – Scripts for adding data (equipment, contracts, users, folders)
- `delete.php`, `download.php`, `downuser.php` – For managing downloads and deletions
- `db.php` – Database connection
- `composer.json` – PHP package dependencies (if applicable)

## 🚀 Getting Started

1. Clone or download this repository
2. Import the MySQL database (SQL file not included here)
3. Update `db.php` with your local database configuration
4. Run the application via localhost (e.g., XAMPP)

