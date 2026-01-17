# Natacion Club - Database Schema

## 데이터베이스 생성 및 테이블 스키마

이 문서는 `natacion_club` 데이터베이스의 테이블 생성 쿼리를 포함합니다.

---

## 1. 데이터베이스 생성

```sql
-- 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS natacion_club
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE natacion_club;
```

---

## 2. 테이블 생성 쿼리

### 2.1 usuarios (사용자)

```sql
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('entrenador', 'familia', 'nadador') NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.2 categorias (카테고리)

```sql
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    edad_minima INT NOT NULL,
    edad_maxima INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.3 nadadores (선수)

```sql
CREATE TABLE nadadores (
    id_nadador INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,  -- Spanish National ID
    fecha_nacimiento DATE NOT NULL,
    id_categoria INT,
    email VARCHAR(150),
    telefono VARCHAR(20),
    ultimo_mes_pagado VARCHAR(7),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**DNI Format**: 8 digits + 1 uppercase letter (e.g., "12345678Z")

### 2.4 familia_nadador (가족-선수 관계)

```sql
CREATE TABLE familia_nadador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_nadador INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.5 pruebas (종목)

```sql
CREATE TABLE pruebas (
    id_prueba INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.6 competiciones (대회)

```sql
CREATE TABLE competiciones (
    id_competicion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    fecha DATE NOT NULL,
    lugar VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.7 pagos (납부)

```sql
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_nadador INT NOT NULL,
    fecha_pago DATE NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    tipo_pago ENUM('anual', 'mensual', 'unico') NOT NULL DEFAULT 'mensual',
    mes_pagado VARCHAR(7) NOT NULL,
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**tipo_pago Options**:

- `anual`: Annual subscription (12 months, ~500 EUR)
- `mensual`: Monthly payment (1 month, 50 EUR)
- `unico`: One-time payment (variable amount, for events/equipment)

### 2.8 tiempos_minimos (최소 기록 - 연맹 기준)

```sql
CREATE TABLE tiempos_minimos (
    id_tiempo_minimo INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    id_prueba INT NOT NULL,
    tiempo_minimo DECIMAL(8,2) NOT NULL,
    UNIQUE KEY unique_categoria_prueba (id_categoria, id_prueba),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_prueba) REFERENCES pruebas(id_prueba) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### 2.9 resultados (대회 기록)

```sql
CREATE TABLE resultados (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_nadador INT NOT NULL,
    id_competicion INT NOT NULL,
    id_prueba INT NOT NULL,
    tiempo DECIMAL(8,2) NOT NULL,
    UNIQUE KEY unique_nadador_competicion_prueba (id_nadador, id_competicion, id_prueba),
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_competicion) REFERENCES competiciones(id_competicion) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_prueba) REFERENCES pruebas(id_prueba) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 3. 초기 데이터 삽입 (Seed Data)

### 3.1 카테고리 초기 데이터 (2026년 기준)

```sql
INSERT INTO categorias (nombre, edad_minima, edad_maxima) VALUES
('Pre-Benjamin', 0, 8),
('Benjamin', 9, 10),
('Alevin', 11, 12),
('Infantil', 13, 14),
('Junior', 15, 18),
('Absoluto', 19, 24),
('Master', 25, 99);
```

### 3.2 종목 초기 데이터

```sql
INSERT INTO pruebas (nombre) VALUES
('50m Libre'),
('100m Libre'),
('200m Libre'),
('400m Libre'),
('50m Espalda'),
('100m Espalda'),
('200m Espalda'),
('50m Braza'),
('100m Braza'),
('200m Braza'),
('50m Mariposa'),
('100m Mariposa'),
('200m Mariposa'),
('200m Estilos'),
('400m Estilos');
```

### 3.3 테스트용 코치 계정

```sql
-- 비밀번호: 'admin123' (PHP password_hash로 생성 필요)
-- 아래는 예시이며, 실제 사용 시 PHP에서 password_hash('admin123', PASSWORD_DEFAULT)로 생성한 값 사용
INSERT INTO usuarios (email, password, rol, nombre) VALUES
('entrenador@natacion.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'entrenador', 'Coach Admin');
```

---

## 4. 전체 스키마 스크립트 (한 번에 실행)

```sql
-- ============================================
-- Natacion Club Database Schema
-- ============================================

-- 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS natacion_club
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE natacion_club;

-- 기존 테이블 삭제 (개발 환경에서만 사용)
DROP TABLE IF EXISTS resultados;
DROP TABLE IF EXISTS tiempos_minimos;
DROP TABLE IF EXISTS pagos;
DROP TABLE IF EXISTS familia_nadador;
DROP TABLE IF EXISTS nadadores;
DROP TABLE IF EXISTS competiciones;
DROP TABLE IF EXISTS pruebas;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;

-- 1. usuarios (사용자)
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('entrenador', 'familia', 'nadador') NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. categorias (카테고리)
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    edad_minima INT NOT NULL,
    edad_maxima INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. nadadores (선수)
CREATE TABLE nadadores (
    id_nadador INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT NULL,
    id_categoria INT,
    email VARCHAR(150),
    telefono VARCHAR(20),
    ultimo_mes_pagado VARCHAR(7),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. familia_nadador (가족-선수 관계)
CREATE TABLE familia_nadador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_nadador INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. pruebas (종목)
CREATE TABLE pruebas (
    id_prueba INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. competiciones (대회)
CREATE TABLE competiciones (
    id_competicion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    fecha DATE NOT NULL,
    lugar VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. pagos (납부)
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_nadador INT NOT NULL,
    fecha_pago DATE NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    tipo_pago ENUM('anual', 'mensual', 'unico') NOT NULL DEFAULT 'mensual',
    mes_pagado VARCHAR(7) NOT NULL,
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. tiempos_minimos (최소 기록)
CREATE TABLE tiempos_minimos (
    id_tiempo_minimo INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    id_prueba INT NOT NULL,
    tiempo_minimo DECIMAL(8,2) NOT NULL,
    UNIQUE KEY unique_categoria_prueba (id_categoria, id_prueba),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_prueba) REFERENCES pruebas(id_prueba) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. resultados (대회 기록)
CREATE TABLE resultados (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_nadador INT NOT NULL,
    id_competicion INT NOT NULL,
    id_prueba INT NOT NULL,
    tiempo DECIMAL(8,2) NOT NULL,
    UNIQUE KEY unique_nadador_competicion_prueba (id_nadador, id_competicion, id_prueba),
    FOREIGN KEY (id_nadador) REFERENCES nadadores(id_nadador) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_competicion) REFERENCES competiciones(id_competicion) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_prueba) REFERENCES pruebas(id_prueba) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 초기 데이터 삽입
-- ============================================

-- 카테고리 데이터
INSERT INTO categorias (nombre, edad_minima, edad_maxima) VALUES
('Pre-Benjamin', 0, 8),
('Benjamin', 9, 10),
('Alevin', 11, 12),
('Infantil', 13, 14),
('Junior', 15, 18),
('Absoluto', 19, 24),
('Master', 25, 99);

-- 종목 데이터
INSERT INTO pruebas (nombre) VALUES
('50m Libre'),
('100m Libre'),
('200m Libre'),
('400m Libre'),
('50m Espalda'),
('100m Espalda'),
('200m Espalda'),
('50m Braza'),
('100m Braza'),
('200m Braza'),
('50m Mariposa'),
('100m Mariposa'),
('200m Mariposa'),
('200m Estilos'),
('400m Estilos');

-- 테스트용 코치 계정 (비밀번호: password)
INSERT INTO usuarios (email, password, rol, nombre) VALUES
('entrenador@natacion.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'entrenador', 'Coach Admin');
```

---

## 5. 인덱스 추가 (성능 최적화)

```sql
-- 자주 사용되는 검색 조건에 대한 인덱스
CREATE INDEX idx_nadadores_categoria ON nadadores(id_categoria);
CREATE INDEX idx_nadadores_fecha_nacimiento ON nadadores(fecha_nacimiento);
CREATE INDEX idx_nadadores_dni ON nadadores(dni);  -- DNI 검색 최적화
CREATE INDEX idx_pagos_nadador ON pagos(id_nadador);
CREATE INDEX idx_pagos_mes ON pagos(mes_pagado);
CREATE INDEX idx_resultados_nadador ON resultados(id_nadador);
CREATE INDEX idx_resultados_competicion ON resultados(id_competicion);
CREATE INDEX idx_competiciones_fecha ON competiciones(fecha);
```

---

## 6. 참고 사항

### 시간 형식

- `DECIMAL(8,2)` 사용 (초 단위)
- 예시: 25.34초 → `25.34`, 1분 30.50초 → `90.50`

### 외래 키 동작

- `ON DELETE CASCADE`: 부모 레코드 삭제 시 자식 레코드도 삭제
- `ON DELETE SET NULL`: 부모 레코드 삭제 시 자식의 FK를 NULL로 설정
- `ON UPDATE CASCADE`: 부모 PK 변경 시 자식 FK도 자동 변경

### 문자셋

- `utf8mb4`: 이모지 포함 모든 유니코드 지원
- `utf8mb4_unicode_ci`: 대소문자 구분 없는 정렬

---

## 7. 마이그레이션 (Migration)

기존 데이터베이스가 있는 경우, 다음 마이그레이션 스크립트를 실행:

- **001_add_dni_to_nadadores.sql**: DNI 컬럼 추가
- **002_add_tipo_pago_to_pagos.sql**: tipo_pago 컬럼 추가

마이그레이션 파일 위치: `sql/migrations/`

---

_문서 생성일: 2026-01-12_
_최종 수정일: 2026-01-13_ (DNI, tipo_pago 추가)
