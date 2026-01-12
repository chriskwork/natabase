-- ============================================
-- Migration: Add tipo_pago column to pagos table
-- File: 002_add_tipo_pago_to_pagos.sql
-- Date: 2026-01-13
-- Description: Add payment type (annual/monthly/one-time)
-- ============================================

USE natacion_club;

-- Step 1: Add column with default value
ALTER TABLE pagos
ADD COLUMN tipo_pago ENUM('anual', 'mensual', 'unico') NOT NULL DEFAULT 'mensual'
AFTER cantidad;

-- Step 2: Update existing records (all default to mensual)
-- This step is technically unnecessary due to DEFAULT, but included for clarity
UPDATE pagos
SET tipo_pago = 'mensual'
WHERE tipo_pago = 'mensual';  -- No-op, but documents intent

-- ============================================
-- Verification queries
-- ============================================

-- Check table structure
DESCRIBE pagos;

-- Verify all payments have tipo_pago
SELECT id_pago, id_nadador, cantidad, tipo_pago, mes_pagado FROM pagos;

-- Check distinct payment types
SELECT DISTINCT tipo_pago FROM pagos;

-- Count by payment type
SELECT tipo_pago, COUNT(*) as total
FROM pagos
GROUP BY tipo_pago;

-- ============================================
-- Business Logic Documentation
-- ============================================
--
-- Payment Types:
-- 1. 'mensual' (Monthly): Standard 50.00 EUR, updates ultimo_mes_pagado by +1 month
-- 2. 'anual' (Annual): ~500.00 EUR, updates ultimo_mes_pagado by +12 months
-- 3. 'unico' (One-time): Variable amount, may NOT update ultimo_mes_pagado
--
-- Example transaction with tipo_pago:
--
-- BEGIN;
--   INSERT INTO pagos (id_nadador, fecha_pago, cantidad, tipo_pago, mes_pagado)
--   VALUES (1, '2026-02-01', 500.00, 'anual', '2026-02');
--
--   UPDATE nadadores
--   SET ultimo_mes_pagado = DATE_FORMAT(
--       DATE_ADD(STR_TO_DATE('2026-02-01', '%Y-%m-%d'), INTERVAL 12 MONTH),
--       '%Y-%m'
--   )
--   WHERE id_nadador = 1;
-- COMMIT;
--
