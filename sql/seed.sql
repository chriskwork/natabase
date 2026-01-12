-- ============================================
-- Natacion Club Seed Data
-- 파일: seed.sql
-- 설명: 초기 데이터 삽입 스크립트
-- ============================================

USE natacion_club;

-- ============================================
-- 카테고리 데이터 (2026년 기준)
-- ============================================

INSERT INTO categorias (nombre, edad_minima, edad_maxima) VALUES
('Pre-Benjamin', 0, 8),
('Benjamin', 9, 10),
('Alevin', 11, 12),
('Infantil', 13, 14),
('Junior', 15, 18),
('Absoluto', 19, 24),
('Master', 25, 99);

-- ============================================
-- 종목 데이터
-- ============================================

INSERT INTO pruebas (nombre) VALUES
('50m Libre'),
('100m Libre'),
('200m Libre'),
('400m Libre'),
('800m Libre'),
('1500m Libre'),
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

-- ============================================
-- 테스트용 사용자 계정
-- 비밀번호: 'password' (PHP password_hash 생성)
-- ============================================

INSERT INTO usuarios (email, password, rol, nombre) VALUES
('entrenador@natacion.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'entrenador', 'Carlos Garcia'),
('familia@natacion.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'familia', 'Maria Lopez'),
('nadador@natacion.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nadador', 'Pablo Martinez');

-- ============================================
-- 테스트용 선수 데이터
-- ============================================

INSERT INTO nadadores (id_usuario, nombre, apellidos, dni, fecha_nacimiento, id_categoria, email, telefono) VALUES
(3, 'Pablo', 'Martinez Ruiz', '12345678A', '2010-05-15', 3, 'pablo@email.com', '612345678'),
(NULL, 'Ana', 'Garcia Lopez', '23456789B', '2012-08-22', 2, 'ana@email.com', '623456789'),
(NULL, 'Luis', 'Fernandez Diaz', '34567890C', '2008-03-10', 4, 'luis@email.com', '634567890'),
(NULL, 'Sofia', 'Rodriguez Perez', '45678901D', '2011-11-30', 3, 'sofia@email.com', '645678901'),
(NULL, 'Miguel', 'Sanchez Torres', '56789012E', '2006-07-18', 5, 'miguel@email.com', '656789012');

-- ============================================
-- 가족-선수 관계 데이터
-- ============================================

INSERT INTO familia_nadador (id_usuario, id_nadador) VALUES
(2, 1),  -- Maria Lopez -> Pablo Martinez
(2, 2);  -- Maria Lopez -> Ana Garcia

-- ============================================
-- 테스트용 대회 데이터
-- ============================================

INSERT INTO competiciones (nombre, fecha, lugar) VALUES
('Campeonato Regional de Invierno', '2026-02-15', 'Piscina Municipal de Valencia'),
('Copa de Primavera', '2026-04-20', 'Centro Deportivo Madrid'),
('Campeonato Nacional Juvenil', '2026-06-10', 'Complejo Olimpico Barcelona'),
('Trofeo de Verano', '2026-07-25', 'Piscina Olimpica Sevilla');

-- ============================================
-- 테스트용 대회 기록 데이터
-- ============================================

INSERT INTO resultados (id_nadador, id_competicion, id_prueba, tiempo) VALUES
-- Pablo Martinez - 대회 1
(1, 1, 1, 32.45),   -- 50m Libre
(1, 1, 7, 38.20),   -- 50m Espalda
-- Ana Garcia - 대회 1
(2, 1, 1, 35.80),   -- 50m Libre
(2, 1, 10, 45.60),  -- 50m Braza
-- Luis Fernandez - 대회 1
(3, 1, 1, 28.90),   -- 50m Libre
(3, 1, 2, 62.30),   -- 100m Libre
-- Pablo Martinez - 대회 2
(1, 2, 1, 31.80),   -- 50m Libre (개선)
(1, 2, 2, 70.50);   -- 100m Libre

-- ============================================
-- 테스트용 납부 데이터
-- ============================================

INSERT INTO pagos (id_nadador, fecha_pago, cantidad, tipo_pago, mes_pagado) VALUES
(1, '2026-01-05', 50.00, 'mensual', '2026-01'),
(2, '2026-01-05', 50.00, 'mensual', '2026-01'),
(3, '2026-01-10', 500.00, 'anual', '2026-01'),
(4, '2026-01-08', 50.00, 'mensual', '2026-01'),
(5, '2026-01-12', 50.00, 'mensual', '2026-01');

-- 선수 테이블의 ultimo_mes_pagado 업데이트
UPDATE nadadores SET ultimo_mes_pagado = '2026-01' WHERE id_nadador IN (1, 2, 3, 4, 5);

-- ============================================
-- 최소 기록 데이터 (예시 - Alevin 카테고리)
-- ============================================

INSERT INTO tiempos_minimos (id_categoria, id_prueba, tiempo_minimo) VALUES
-- Alevin (카테고리 3)
(3, 1, 30.00),   -- 50m Libre
(3, 2, 65.00),   -- 100m Libre
(3, 7, 35.00),   -- 50m Espalda
(3, 10, 40.00),  -- 50m Braza
(3, 13, 38.00),  -- 50m Mariposa
-- Infantil (카테고리 4)
(4, 1, 27.00),   -- 50m Libre
(4, 2, 58.00),   -- 100m Libre
(4, 3, 130.00),  -- 200m Libre
(4, 7, 32.00),   -- 50m Espalda
(4, 10, 36.00);  -- 50m Braza
