# 🏊 Natación Club - Swimming Club Management System

A comprehensive swimming club management system built with PHP, MySQL, and MVC architecture.

## 📋 Project Overview

**Tech Stack:**
- Backend: PHP 8.0+ with PDO
- Database: MySQL 5.7+ / MariaDB 10.3+
- Frontend: HTML5, Tailwind CSS
- Architecture: MVC (Model-View-Controller) Pattern

**Key Features:**
- Swimmer management with Spanish DNI validation
- Payment tracking with multiple payment types (annual, monthly, one-time)
- Competition and results management
- Category auto-calculation based on age
- Role-based access control (Coach, Family, Swimmer)
- Transaction-based payment processing

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.0 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Apache/Nginx web server
- Composer (optional, for dependency management)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/natabase.git
   cd natabase
   ```

2. **Create database**
   ```bash
   mysql -u root -p
   ```
   ```sql
   CREATE DATABASE natacion_club CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE natacion_club;
   ```

3. **Import schema**
   ```bash
   mysql -u root -p natacion_club < sql/schema.sql
   ```

4. **Import initial data (optional)**
   ```bash
   mysql -u root -p natacion_club < sql/seed.sql
   ```

5. **Configure database connection**

   Edit `config/database.php` with your database credentials:
   ```php
   $host = 'localhost';
   $dbname = 'natacion_club';
   $user = 'your_username';
   $pass = 'your_password';
   ```

6. **Set up web server**

   Point your web server document root to the `public/` directory.

   **Apache** (`.htaccess` example):
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php?request=$1 [QSA,L]
   ```

7. **Access the application**

   Open your browser and navigate to:
   ```
   http://localhost/natabase/public/
   ```

---

## 📁 Project Structure

```
natabase/
├── config/
│   └── database.php              # PDO database connection (singleton)
├── models/
│   ├── Database.php              # Base database class
│   ├── Usuario.php               # User model
│   ├── Nadador.php               # Swimmer model (with DNI validation)
│   ├── Categoria.php             # Category model
│   ├── Pago.php                  # Payment model (with tipo_pago)
│   ├── Competicion.php           # Competition model
│   └── Resultado.php             # Result model
├── controllers/
│   ├── AuthController.php        # Authentication (login/logout)
│   ├── NadadoresController.php   # Swimmer CRUD
│   ├── PagosController.php       # Payment CRUD (with transactions)
│   ├── CompeticionesController.php
│   └── ReportesController.php    # Reports with complex JOINs
├── views/
│   ├── layouts/
│   │   ├── header.php            # Common header
│   │   ├── footer.php            # Common footer
│   │   └── navbar.php            # Navigation (role-based)
│   ├── auth/
│   ├── nadadores/
│   ├── pagos/
│   ├── competiciones/
│   └── reportes/
├── public/
│   ├── index.php                 # Front Controller (ENTRY POINT)
│   ├── assets/
│   │   ├── css/                  # Stylesheets (Tailwind CSS)
│   │   └── js/                   # JavaScript files
│   └── .htaccess                 # URL rewriting
├── includes/
│   ├── auth.php                  # Authentication helpers
│   └── functions.php             # Common functions
├── sql/
│   ├── schema.sql                # Database schema (with DNI, tipo_pago)
│   ├── seed.sql                  # Initial test data
│   ├── migrations/
│   │   ├── 001_add_dni_to_nadadores.sql
│   │   └── 002_add_tipo_pago_to_pagos.sql
│   └── database_schema.md        # Schema documentation
├── logo.png
├── natacion_club_project.md      # Project specification
├── project_plan.md               # Development plan
├── code_style.md                 # OOP/MVC coding standards
└── README.md                     # This file
```

---

## 🗄️ Database Schema

### Tables

1. **usuarios** - User accounts (entrenador, familia, nadador)
2. **categorias** - Age categories (Pre-Benjamín to Máster)
3. **nadadores** - Swimmers (**with DNI column**)
4. **familia_nadador** - Family-swimmer relationships
5. **pruebas** - Swimming events (50m Libre, 100m Espalda, etc.)
6. **competiciones** - Competitions
7. **pagos** - Payments (**with tipo_pago column**)
8. **tiempos_minimos** - Minimum times (federation standards)
9. **resultados** - Competition results

### Key Database Features

- **DNI (Spanish National ID)**: UNIQUE column in `nadadores` table
  - Format: 8 digits + 1 letter (e.g., "12345678Z")
  - Validated with checksum algorithm

- **tipo_pago (Payment Type)**: ENUM in `pagos` table
  - `anual`: Annual payment (12 months, ~500 EUR)
  - `mensual`: Monthly payment (1 month, 50 EUR)
  - `unico`: One-time payment (variable amount)

- **Transaction Processing**: Payment insertion updates `ultimo_mes_pagado`
  - `mensual`: +1 month
  - `anual`: +12 months
  - `unico`: No update

---

## 🔐 Default Credentials

**Coach Account:**
- Email: `entrenador@natacion.com`
- Password: `password`

**Family Account:**
- Email: `familia@natacion.com`
- Password: `password`

**Swimmer Account:**
- Email: `nadador@natacion.com`
- Password: `password`

⚠️ **Change these credentials in production!**

---

## 🧪 Running Migrations

If you have an existing database, run these migrations to add the new columns:

```bash
# Add DNI column to nadadores
mysql -u root -p natacion_club < sql/migrations/001_add_dni_to_nadadores.sql

# Add tipo_pago column to pagos
mysql -u root -p natacion_club < sql/migrations/002_add_tipo_pago_to_pagos.sql
```

---

## 👨‍💻 Development

### Coding Standards

This project follows **PSR-12** PHP coding standards and **OOP/MVC** principles. See [code_style.md](code_style.md) for detailed guidelines.

**Key Principles:**
- All database queries use **PDO prepared statements**
- All user output is **escaped** with `htmlspecialchars()`
- **CSRF tokens** on all forms
- **Password hashing** with `password_hash()`
- **Transaction management** for payment processing

### Adding a New Feature

1. Create Model in `models/` (database interaction)
2. Create Controller in `controllers/` (business logic)
3. Create Views in `views/` (HTML templates)
4. Update routing in `public/index.php`
5. Test thoroughly

---

## 📊 Key Business Logic

### 1. DNI Validation

Spanish DNI format: `12345678Z`
- 8 digits + 1 uppercase letter
- Letter calculated using modulo 23
- Must be UNIQUE in database

### 2. Category Auto-Calculation

Based on swimmer's birth date:
- Pre-Benjamín: 0-8 years
- Benjamín: 9-10 years
- Alevín: 11-12 years
- Infantil: 13-14 years
- Junior: 15-18 years
- Absoluto: 19-24 years
- Máster: 25-99 years

### 3. Payment Transaction Flow

```
BEGIN TRANSACTION
  → INSERT INTO pagos (id_nadador, fecha_pago, cantidad, tipo_pago, mes_pagado)
  → IF tipo_pago != 'unico':
      UPDATE nadadores.ultimo_mes_pagado
        (add 1 month for mensual, 12 months for anual)
  → COMMIT or ROLLBACK on error
END TRANSACTION
```

---

## 🔒 Security Features

- **SQL Injection Prevention**: All queries use PDO prepared statements
- **XSS Prevention**: All outputs escaped with `htmlspecialchars()`
- **CSRF Protection**: Tokens on all POST forms
- **Password Security**: BCrypt hashing via `password_hash()`
- **Session Security**: `httponly`, `secure`, `samesite` cookies
- **Role-Based Access Control**: Entrenador, Familia, Nadador roles

---

## 📝 Documentation

- [natacion_club_project.md](natacion_club_project.md) - Complete project specification
- [project_plan.md](project_plan.md) - 8-phase development plan
- [code_style.md](code_style.md) - OOP/MVC coding standards
- [sql/database_schema.md](sql/database_schema.md) - Database schema documentation

---

## 🛠️ Troubleshooting

### Database Connection Errors

1. Check database credentials in `config/database.php`
2. Verify MySQL/MariaDB is running
3. Ensure database `natacion_club` exists
4. Check user has proper permissions

### Migration Errors

1. Ensure you run schema.sql before seed.sql
2. For existing databases, run migrations in order:
   - `001_add_dni_to_nadadores.sql`
   - `002_add_tipo_pago_to_pagos.sql`

### Permission Errors

1. Ensure web server has read/write access to project directory
2. Check `.htaccess` is enabled (Apache: `AllowOverride All`)

---

## 📄 License

This project is licensed under the MIT License.

---

## 👥 Contributors

- **Your Name** - Initial work

---

## 📞 Support

For issues or questions, please open an issue on GitHub.

---

*Last Updated: 2026-01-13*
*Version: 1.0 (with DNI and tipo_pago features)*
