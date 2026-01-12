-- ============================================
-- Natacion Club Database Schema
-- 파일: schema.sql
-- 설명: 테이블 생성 스크립트
-- ============================================

-- 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS natacion_club
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE natacion_club;

-- 기존 테이블 삭제 (순서 중요: 외래키 의존성 역순)
DROP TABLE IF EXISTS resultados;
DROP TABLE IF EXISTS tiempos_minimos;
DROP TABLE IF EXISTS pagos;
DROP TABLE IF EXISTS familia_nadador;
DROP TABLE IF EXISTS nadadores;
DROP TABLE IF EXISTS competiciones;
DROP TABLE IF EXISTS pruebas;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;

-- ============================================
-- 테이블 생성
-- ============================================

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
-- 인덱스 생성 (성능 최적화)
-- ============================================

CREATE INDEX idx_nadadores_categoria ON nadadores(id_categoria);
CREATE INDEX idx_nadadores_fecha_nacimiento ON nadadores(fecha_nacimiento);
CREATE INDEX idx_pagos_nadador ON pagos(id_nadador);
CREATE INDEX idx_pagos_mes ON pagos(mes_pagado);
CREATE INDEX idx_resultados_nadador ON resultados(id_nadador);
CREATE INDEX idx_resultados_competicion ON resultados(id_competicion);
CREATE INDEX idx_competiciones_fecha ON competiciones(fecha);
