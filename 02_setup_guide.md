# Task 2: Project Setup Guide — Student Attendance Tracker
> Laravel + MySQL | Windows & Linux

---

## Prerequisites Overview

| Tool | Version Required | Purpose |
|---|---|---|
| PHP | 8.2+ | Laravel runtime |
| Composer | 2.x | PHP dependency manager |
| MySQL | 8.0+ | Database |
| Node.js + npm | 18+ | Compiling Tailwind/Bootstrap assets |
| Git | Any | Version control (required by grading rubric) |
| Laravel | Latest Stable | Application framework |

---

# WINDOWS SETUP GUIDE

---

## Step 1: Install PHP via XAMPP

```bash
# Option A: Using XAMPP (Recommended for beginners on Windows)
# 1. Download XAMPP from: https://www.apachefriends.org/
# 2. Install to C:\xampp (default path — do NOT change this)
# 3. Start Apache and MySQL from the XAMPP Control Panel

# Verify PHP is installed and accessible from terminal:
php -v
# Expected output: PHP 8.2.x (cli) ...

# If 'php' is not recognized, add PHP to your Windows PATH:
# Control Panel → System → Advanced System Settings
# → Environment Variables → System Variables → Path
# → New → Add: C:\xampp\php
```

```bash
# Option B: Using Laragon (Cleaner alternative for Windows)
# Download from: https://laragon.org/download/
# Laragon auto-configures PHP, MySQL, and Composer in one installer
# No manual PATH configuration needed
```

---

## Step 2: Install Composer (Windows)

```bash
# Download Composer installer from: https://getcomposer.org/Composer-Setup.exe
# Run the installer — it auto-detects your PHP path
# After install, verify with:
composer --version
# Expected output: Composer version 2.x.x
```

---

## Step 3: Install Node.js (Windows)

```bash
# Download LTS version from: https://nodejs.org/
# Run the .msi installer with default settings

# Verify installation:
node -v    # Expected: v18.x.x or higher
npm -v     # Expected: 9.x.x or higher
```

---

## Step 4: Install MySQL (Windows)

```bash
# If using XAMPP: MySQL is already installed
# Start MySQL from XAMPP Control Panel → MySQL → Start

# If using Laragon: MySQL is already included

# Verify MySQL is running:
# Open XAMPP Control Panel and confirm MySQL shows "Running"

# Access MySQL via terminal (optional):
mysql -u root -p
# Default XAMPP root password is empty — just press Enter
```

---

## Step 5: Create Laravel Project (Windows)

```bash
# Open Command Prompt or Windows Terminal as Administrator
# Navigate to your projects folder:
cd C:\xampp\htdocs
# OR if using Laragon:
cd C:\laragon\www

# Create a new Laravel project using Composer:
composer create-project laravel/laravel attendance-tracker
# This downloads Laravel and all dependencies into a folder called 'attendance-tracker'
# This may take 2–5 minutes depending on your internet connection

# Navigate into the project directory:
cd attendance-tracker
```

---

## Step 6: Install Laravel Breeze (Windows)

```bash
# Install Laravel Breeze package (required by spec: "Laravel Breeze authentication")
composer require laravel/breeze --dev
# --dev flag: Breeze is only needed during development, not in production

# Scaffold Breeze with Blade templating (matches the spec: "Blade templates")
php artisan breeze:install blade
# This generates: Login, Register, Password Reset pages + AuthenticatedLayout

# Install Node.js dependencies for asset compilation:
npm install
# This reads package.json and downloads all required npm packages

# Compile CSS and JavaScript assets:
npm run dev
# Compiles Tailwind CSS and JavaScript into public/build/
# Keep this terminal open during development for hot-reloading
```

---

## Step 7: Configure `.env` File (Windows)

```bash
# Copy the example environment file:
copy .env.example .env
# .env.example is a template; .env is your actual config (never commit .env to Git)

# Generate the application encryption key:
php artisan key:generate
# Sets APP_KEY in .env — required for session encryption and CSRF tokens

# Open .env in Notepad or VS Code and update database settings:
notepad .env
```

```env
# .env — Database Configuration Block
# Change these values to match your local MySQL setup

APP_NAME="Student Attendance Tracker"  # Displayed in browser title and emails
APP_ENV=local                           # Environment: local | staging | production
APP_DEBUG=true                          # Show detailed errors (set to false in production)
APP_URL=http://localhost:8000           # Your local dev URL

DB_CONNECTION=mysql                     # Database driver — must be 'mysql' per project spec
DB_HOST=127.0.0.1                      # MySQL server address (localhost)
DB_PORT=3306                           # MySQL default port
DB_DATABASE=attendance_tracker          # Name of the database you will create in Step 8
DB_USERNAME=root                        # MySQL username (XAMPP default: root)
DB_PASSWORD=                            # MySQL password (XAMPP default: empty — leave blank)
```

---

## Step 8: Create Database (Windows)

```bash
# Option A: Using XAMPP phpMyAdmin (GUI — easiest)
# 1. Open browser → http://localhost/phpmyadmin
# 2. Click "New" in left sidebar
# 3. Database name: attendance_tracker
# 4. Collation: utf8mb4_unicode_ci
# 5. Click "Create"

# Option B: Using MySQL Terminal
mysql -u root -p
# Press Enter when prompted for password (XAMPP default is empty)

CREATE DATABASE attendance_tracker CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
# utf8mb4 supports full Unicode including emojis — best practice for modern apps
EXIT;
```

---

## Step 9: Run Migrations and Seeders (Windows)

```bash
# Run all migration files to create tables:
php artisan migrate
# This creates: users, password_reset_tokens, sessions, students, attendances tables

# Run seeders to populate sample data:
php artisan db:seed
# Seeds the demo teacher account and 10 sample students (defined in DatabaseSeeder.php)

# COMBINED COMMAND — fresh install with seed data:
php artisan migrate:fresh --seed
# WARNING: migrate:fresh DROPS ALL TABLES first — only use during development
```

---

## Step 10: Start Development Server (Windows)

```bash
# Start Laravel's built-in development server:
php artisan serve
# Server starts at: http://127.0.0.1:8000
# Keep this terminal open while developing

# In a SECOND terminal window, start Vite for asset watching:
npm run dev
# Watches for CSS/JS changes and recompiles automatically
```

---
---

# LINUX SETUP GUIDE (Ubuntu / Debian)

---

## Step 1: Update System & Install PHP (Linux)

```bash
# Update package lists to get latest versions:
sudo apt update && sudo apt upgrade -y
# sudo apt update — refreshes package index
# sudo apt upgrade -y — applies all pending system updates

# Add the Ondrej PHP PPA (repository with latest PHP versions):
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Install PHP 8.2 with all Laravel-required extensions:
sudo apt install -y php8.2 php8.2-cli php8.2-mbstring php8.2-xml \
  php8.2-bcmath php8.2-curl php8.2-mysql php8.2-zip php8.2-tokenizer
# php8.2-mbstring — required for string manipulation in Laravel
# php8.2-xml — required for XML parsing (Composer dependency resolution)
# php8.2-mysql — PDO MySQL driver for database connection
# php8.2-zip — required for unzipping packages during Composer install

# Verify PHP installation:
php -v
# Expected: PHP 8.2.x (cli)
```

---

## Step 2: Install Composer (Linux)

```bash
# Download Composer installer script:
curl -sS https://getcomposer.org/installer -o composer-setup.php

# Run the installer (installs Composer globally):
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
# --install-dir: where to place the composer binary
# --filename: name of the executable

# Verify Composer installation:
composer --version
# Expected: Composer version 2.x.x

# Clean up installer file:
rm composer-setup.php
```

---

## Step 3: Install Node.js via NVM (Linux)

```bash
# NVM (Node Version Manager) is the recommended way to install Node.js on Linux
# It allows switching between Node.js versions easily

# Download and run the NVM install script:
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.4/install.sh | bash

# Reload shell configuration to activate NVM:
source ~/.bashrc
# OR if using Zsh:
source ~/.zshrc

# Install the LTS version of Node.js:
nvm install --lts
# --lts installs the Long-Term Support version (most stable)

# Verify installation:
node -v    # Expected: v18.x.x or higher
npm -v     # Expected: 9.x.x or higher
```

---

## Step 4: Install and Configure MySQL (Linux)

```bash
# Install MySQL Server:
sudo apt install -y mysql-server

# Start MySQL service and enable it on system boot:
sudo systemctl start mysql
sudo systemctl enable mysql
# systemctl start — starts the service now
# systemctl enable — auto-starts on every system reboot

# Run the security hardening script:
sudo mysql_secure_installation
# Follow the prompts:
# - Set root password: YES (set a strong password)
# - Remove anonymous users: YES
# - Disallow root login remotely: YES
# - Remove test database: YES
# - Reload privilege tables: YES

# Verify MySQL is running:
sudo systemctl status mysql
# Expected: Active: active (running)
```

---

## Step 5: Create Laravel Project (Linux)

```bash
# Navigate to your web projects directory:
cd ~/projects
# OR: mkdir ~/projects && cd ~/projects (if folder doesn't exist)

# Create new Laravel project:
composer create-project laravel/laravel attendance-tracker
# Downloads Laravel framework and all Composer dependencies

# Enter the project directory:
cd attendance-tracker

# Set correct file permissions for Laravel storage and cache:
sudo chown -R $USER:www-data storage bootstrap/cache
# $USER — your Linux username
# www-data — the web server group

chmod -R 775 storage bootstrap/cache
# 775 = owner and group can read/write/execute; others can read/execute
# Required for Laravel to write logs, sessions, and compiled views
```

---

## Step 6: Install Laravel Breeze (Linux)

```bash
# Install Breeze via Composer:
composer require laravel/breeze --dev

# Scaffold Breeze with Blade (matches spec requirement):
php artisan breeze:install blade
# Generates Auth views (Login, Register), routes, and controllers

# Install npm dependencies:
npm install

# Build and watch assets during development:
npm run dev
```

---

## Step 7: Configure `.env` File (Linux)

```bash
# Copy example environment file:
cp .env.example .env
# cp — Linux copy command (equivalent to Windows 'copy')

# Generate application encryption key:
php artisan key:generate

# Open .env with your preferred editor:
nano .env
# OR: code .env (VS Code)  |  vim .env  |  gedit .env
```

```env
# .env — Linux Database Configuration
# Match these to your MySQL setup from Step 4

APP_NAME="Student Attendance Tracker"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=attendance_tracker
DB_USERNAME=root                  # Or a dedicated MySQL user (see trade-offs below)
DB_PASSWORD=your_mysql_password   # The password you set in mysql_secure_installation
```

---

## Step 8: Create Database (Linux)

```bash
# Log in to MySQL as root:
mysql -u root -p
# Enter the password you set during mysql_secure_installation

# Create the database with proper character encoding:
CREATE DATABASE attendance_tracker CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
# utf8mb4_unicode_ci — handles full Unicode (emojis, special characters)

# OPTIONAL BUT RECOMMENDED: Create a dedicated app user (better security):
CREATE USER 'attendance_user'@'localhost' IDENTIFIED BY 'StrongPassword123!';
# Creates a MySQL user that only has access to this one database

GRANT ALL PRIVILEGES ON attendance_tracker.* TO 'attendance_user'@'localhost';
# GRANT ALL — gives full access to the attendance_tracker database only

FLUSH PRIVILEGES;
# Reloads MySQL privilege tables so changes take effect immediately

EXIT;

# If using dedicated user, update .env:
# DB_USERNAME=attendance_user
# DB_PASSWORD=StrongPassword123!
```

---

## Step 9: Run Migrations and Seeders (Linux)

```bash
# Run all migration files:
php artisan migrate
# Creates all tables defined in database/migrations/

# Seed the database with sample data:
php artisan db:seed

# OR combined fresh migration + seed:
php artisan migrate:fresh --seed
# WARNING: Drops all tables first — for development use only
```

---

## Step 10: Start Development Server (Linux)

```bash
# Terminal 1 — Start Laravel Dev Server:
php artisan serve
# Available at: http://127.0.0.1:8000

# Terminal 2 — Start Vite Asset Watcher:
npm run dev
# Compiles Tailwind CSS/JS and watches for changes
```

---

## Additional Configuration (Both OS)

### Git Initialization (Required by Grading Rubric)

```bash
# Initialize Git repository in your project folder:
git init

# Create .gitignore (Laravel already provides this — verify it includes):
# .env                ← CRITICAL: Never commit credentials to Git
# /vendor             ← Composer dependencies (restored via 'composer install')
# /node_modules       ← npm packages (restored via 'npm install')
# /public/build       ← Compiled assets (regenerated via 'npm run build')

# Stage all files:
git add .

# Initial commit:
git commit -m "Initial commit: Laravel Attendance Tracker setup"

# Link to your GitHub repository:
git remote add origin https://github.com/YOUR_USERNAME/attendance-tracker.git

# Push to GitHub:
git push -u origin main
```

### VS Code Recommended Extensions

```
# Install these VS Code extensions for Laravel development:
- PHP Intelephense         — PHP code intelligence and autocomplete
- Laravel Blade Snippets   — Blade template syntax highlighting
- Laravel Artisan          — Run artisan commands from VS Code
- MySQL / Database Client  — View and query your database
- Tailwind CSS IntelliSense — Autocomplete for Tailwind classes
- GitLens                  — Enhanced Git integration
```

---

## Troubleshooting Reference

| Error | Cause | Solution |
|---|---|---|
| `SQLSTATE[HY000] [2002]` | MySQL not running | Start MySQL (XAMPP Control Panel / `sudo systemctl start mysql`) |
| `Class 'PDO' not found` | MySQL PHP extension missing | Enable `extension=pdo_mysql` in `php.ini` |
| `php artisan` not found | Not in project directory | Run `cd attendance-tracker` first |
| `npm run dev` fails | Node.js not installed | Install Node.js LTS version |
| `key:generate` fails | `.env` file missing | Run `cp .env.example .env` first |
| `Permission denied` (Linux) | Wrong folder ownership | Run `chmod -R 775 storage bootstrap/cache` |
| `Vite manifest not found` | Assets not compiled | Run `npm run build` (production) or `npm run dev` |

---

*Setup Guide for Gordon College BSCS Backend Development — A.Y. 2025-2026*
