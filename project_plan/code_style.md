# Natación Club - Code Style Guide

## 📋 Overview

This project follows **OOP (Object-Oriented Programming)** and **MVC (Model-View-Controller)** architectural pattern.

**Core Principles:**
- PSR-12 PHP coding standards
- Single Responsibility Principle
- DRY (Don't Repeat Yourself)
- Secure by default (PDO, prepared statements, password hashing)

---

## 🏗️ MVC Architecture

### Directory Structure

```
natabase/
├── models/          # Business logic & database interaction
├── controllers/     # Request handling & routing
├── views/           # HTML templates
├── config/          # Configuration files
├── includes/        # Helper functions
└── public/          # Entry point (index.php)
```

### Data Flow

```
User Request
    ↓
public/index.php (Front Controller)
    ↓
Controller (e.g., NadadoresController)
    ↓
Model (e.g., Nadador)
    ↓
Database (PDO)
    ↓
Controller processes data
    ↓
View (HTML template)
    ↓
Response to User
```

---

## 📦 Models

### Purpose
- Represent database tables as PHP classes
- Handle CRUD operations
- Contain business logic
- Validate data (e.g., DNI validation)

### Naming Convention
- Singular, PascalCase: `Nadador`, `Pago`, `Competicion`
- File name matches class name: `Nadador.php`

### Key Responsibilities
- DNI validation for swimmers
- Category auto-calculation based on birth date
- Payment type handling (anual, mensual, unico)
- Data hydration from database rows

---

## 🎮 Controllers

### Purpose
- Handle HTTP requests
- Validate user input
- Call model methods
- Load views
- **Manage transactions** (critical for pagos)

### Naming Convention
- Plural, PascalCase, suffix "Controller": `NadadoresController`, `PagosController`
- File name matches class name: `NadadoresController.php`

### Payment Controller Responsibilities
- Handle tipo_pago business logic
- Execute payment transactions:
  1. INSERT INTO pagos
  2. UPDATE nadadores.ultimo_mes_pagado (based on tipo_pago)
  3. COMMIT or ROLLBACK

---

## 🎨 Views

### Purpose
- Display HTML templates
- Use data provided by controllers
- Include layouts for consistency
- NO business logic

### Structure

```
views/
├── layouts/
│   ├── header.php     # <html>, <head>, navbar
│   ├── footer.php     # </body>, </html>, scripts
│   └── navbar.php     # Navigation menu (role-based)
├── nadadores/
│   ├── index.php      # List (with DNI column)
│   ├── create.php     # Form (DNI input required)
│   ├── edit.php       # Form
│   └── show.php       # Detail
└── pagos/
    ├── index.php      # List (with tipo_pago column)
    ├── create.php     # Form (tipo_pago radio buttons)
    └── morosos.php    # Delinquent swimmers list
```

---

## 🔒 Security Best Practices

### 1. SQL Injection Prevention

**ALWAYS use prepared statements:**

```php
// ✅ CORRECT
$stmt = $pdo->prepare("SELECT * FROM nadadores WHERE dni = ?");
$stmt->execute([$dni]);

// ❌ WRONG - SQL Injection vulnerability!
$query = "SELECT * FROM nadadores WHERE dni = '$dni'";
$result = $pdo->query($query);
```

### 2. XSS Prevention

**Always escape output:**

```php
// ✅ CORRECT
echo htmlspecialchars($nadador['nombre'], ENT_QUOTES, 'UTF-8');

// ❌ WRONG - XSS vulnerability!
echo $nadador['nombre'];
```

### 3. CSRF Protection

```php
// Generate token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// In form
<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

// Validate on submit
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token inválido');
}
```

### 4. Password Hashing

```php
// Hash on registration
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Verify on login
if (password_verify($password, $hashed)) {
    // Login successful
}
```

### 5. DNI Uniqueness Check

```php
// Before INSERT
$stmt = $pdo->prepare("SELECT COUNT(*) FROM nadadores WHERE dni = ?");
$stmt->execute([$dni]);
if ($stmt->fetchColumn() > 0) {
    throw new Exception('DNI ya existe');
}
```

---

## 📝 PHP Coding Standards (PSR-12)

### Indentation
- Use 4 spaces (no tabs)

### Braces
- Opening brace on same line for classes/methods
- Closing brace on its own line

```php
class Nadador {
    public function create() {
        if ($condition) {
            // code
        }
    }
}
```

### Naming Conventions

| Type | Convention | Example |
|------|------------|---------|
| Class | PascalCase | `Nadador`, `PagosController` |
| Method | camelCase | `create()`, `getAll()`, `validateDNI()` |
| Variable | camelCase | `$idNadador`, `$fechaNacimiento`, `$tipoPago` |
| Constant | UPPER_SNAKE_CASE | `MAX_ATTEMPTS`, `DNI_PATTERN` |

### Comments

```php
/**
 * Calculate swimmer category based on birth date
 *
 * @param string $fecha_nacimiento Birth date in Y-m-d format
 * @return int|null Category ID or null if not found
 */
private function calculateCategory($fecha_nacimiento) {
    // Implementation...
}
```

---

## 💰 Payment Transaction Pattern

### CRITICAL: Always use transactions for pagos

```php
$pdo->beginTransaction();
try {
    // 1. Insert payment record
    $stmt = $pdo->prepare("
        INSERT INTO pagos (id_nadador, fecha_pago, cantidad, tipo_pago, mes_pagado)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$id_nadador, $fecha_pago, $cantidad, $tipo_pago, $mes_pagado]);

    // 2. Update ultimo_mes_pagado (only for anual/mensual, NOT unico)
    if ($tipo_pago !== 'unico') {
        $months_to_add = ($tipo_pago === 'anual') ? 12 : 1;

        $stmt = $pdo->prepare("
            UPDATE nadadores
            SET ultimo_mes_pagado = DATE_FORMAT(
                DATE_ADD(STR_TO_DATE(CONCAT(?, '-01'), '%Y-%m-%d'), INTERVAL ? MONTH),
                '%Y-%m'
            )
            WHERE id_nadador = ?
        ");
        $stmt->execute([$mes_pagado, $months_to_add, $id_nadador]);
    }

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Payment transaction error: " . $e->getMessage());
    throw $e;
}
```

### tipo_pago Business Logic

| tipo_pago | Amount | Months Added | Updates ultimo_mes_pagado |
|-----------|--------|--------------|---------------------------|
| mensual   | 50 EUR | 1            | ✅ YES                    |
| anual     | ~500 EUR | 12         | ✅ YES                    |
| unico     | variable | 0          | ❌ NO                     |

---

## 🆔 DNI Validation

### Spanish DNI Format

- **Format**: 8 digits + 1 uppercase letter (e.g., "12345678Z")
- **Letter Calculation**: Based on modulo 23 of the number

### Validation Function

```php
function validateDNI($dni) {
    // Format check: 8 digits + 1 uppercase letter
    if (!preg_match('/^[0-9]{8}[A-Z]$/i', $dni)) {
        return false;
    }

    // Letter calculation check
    $number = intval(substr($dni, 0, 8));
    $letter = strtoupper(substr($dni, 8, 1));
    $validLetters = 'TRWAGMYFPDXBNJZSQVHLCKE';

    return $letter === $validLetters[$number % 23];
}
```

### Usage in Model

```php
class Nadador {
    public function setDni($dni) {
        if (!$this->validateDNI($dni)) {
            throw new InvalidArgumentException('DNI inválido. Formato: 12345678Z');
        }

        // Check uniqueness
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM nadadores WHERE dni = ? AND id_nadador != ?");
        $stmt->execute([$dni, $this->id_nadador ?? 0]);

        if ($stmt->fetchColumn() > 0) {
            throw new InvalidArgumentException('DNI ya existe en el sistema');
        }

        $this->dni = strtoupper($dni);
    }
}
```

---

## 🧪 Error Handling

### Development vs Production

```php
// config/database.php

if (getenv('ENV') === 'development') {
    // Show all errors
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
    // Log errors, don't display
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', '/path/to/error.log');
}
```

### Try-Catch Blocks

```php
try {
    $nadador = new Nadador($pdo);
    $nadador->setDni($dni);
    $nadador->create();
} catch (InvalidArgumentException $e) {
    // User input error (e.g., invalid DNI)
    $_SESSION['errors'] = [$e->getMessage()];
    header('Location: /nadadores/create');
} catch (PDOException $e) {
    // Database error (e.g., duplicate DNI)
    error_log("Database error: " . $e->getMessage());
    $_SESSION['errors'] = ['Error de base de datos. Contacta al administrador.'];
    header('Location: /nadadores/create');
} catch (Exception $e) {
    // Generic error
    error_log("Unexpected error: " . $e->getMessage());
    $_SESSION['errors'] = ['Error inesperado. Inténtalo de nuevo.'];
    header('Location: /nadadores/create');
}
```

---

## 📐 Database Query Guidelines

### Category Auto-Calculation

```php
function calculateCategory($fecha_nacimiento) {
    $edad = date('Y') - date('Y', strtotime($fecha_nacimiento));

    $stmt = $this->pdo->prepare("
        SELECT id_categoria
        FROM categorias
        WHERE :edad BETWEEN edad_minima AND edad_maxima
        LIMIT 1
    ");
    $stmt->execute(['edad' => $edad]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['id_categoria'] : null;
}
```

### Delinquent Swimmers Query

```php
$stmt = $pdo->prepare("
    SELECT n.*,
           COALESCE(n.ultimo_mes_pagado, 'NUNCA') as ultimo_pago,
           TIMESTAMPDIFF(MONTH,
               STR_TO_DATE(CONCAT(n.ultimo_mes_pagado, '-01'), '%Y-%m-%d'),
               CURDATE()) as meses_sin_pagar
    FROM nadadores n
    WHERE n.ultimo_mes_pagado IS NULL
       OR n.ultimo_mes_pagado < DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m')
    ORDER BY meses_sin_pagar DESC
");
```

---

## 📚 File Organization

### Models (models/)
- `Database.php` - Base database connection class
- `Nadador.php` - Swimmer model (DNI validation, category calculation)
- `Pago.php` - Payment model (tipo_pago handling)
- `Competicion.php` - Competition model
- `Resultado.php` - Result model

### Controllers (controllers/)
- `AuthController.php` - Login/logout
- `NadadoresController.php` - Swimmer CRUD with DNI validation
- `PagosController.php` - Payment CRUD with transactions
- `CompeticionesController.php` - Competition management
- `ReportesController.php` - Complex JOIN queries for reports

### Views (views/)
- `layouts/` - Common layout components
- `nadadores/` - Swimmer views (create form includes DNI input)
- `pagos/` - Payment views (create form includes tipo_pago selector)
- `competiciones/` - Competition views
- `reportes/` - Report views

---

## 🔧 Configuration

### Database Connection (config/database.php)

```php
<?php
// Singleton pattern for PDO connection

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = getenv('DB_HOST') ?: 'localhost';
        $dbname = getenv('DB_NAME') ?: 'natacion_club';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            die('Error de conexión a la base de datos');
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
```

---

## ✅ Checklist Before Committing

- [ ] All database queries use prepared statements
- [ ] All user outputs are escaped with `htmlspecialchars()`
- [ ] CSRF tokens validated on all POST forms
- [ ] DNI validation applied on swimmer creation/update
- [ ] Payment transactions properly wrapped in BEGIN/COMMIT/ROLLBACK
- [ ] tipo_pago business logic correctly implemented
- [ ] Category auto-calculation working correctly
- [ ] Error handling with try-catch blocks
- [ ] Code follows PSR-12 standards
- [ ] No sensitive data (passwords, tokens) in code
- [ ] Comments added for complex logic

---

## 📚 Additional Resources

- [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)
- [PHP The Right Way](https://phptherightway.com/)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PDO Tutorial](https://phpdelusions.net/pdo)

---

*Document created: 2026-01-13*
*Project: Natación Club Management System*
*Version: 1.0 (with DNI and tipo_pago)*
