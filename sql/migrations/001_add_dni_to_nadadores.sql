-- ============================================
-- Migration: Add DNI column to nadadores table
-- File: 001_add_dni_to_nadadores.sql
-- Date: 2026-01-13
-- Description: Add Spanish national ID (DNI) as unique identifier
-- ============================================

USE natacion_club;

-- Step 1: Add column (NULL allowed initially)
ALTER TABLE nadadores
ADD COLUMN dni VARCHAR(20) UNIQUE
AFTER apellidos;

-- Step 2: Populate with temporary values for existing records
-- Format: PENDING-XXX where XXX is the padded swimmer ID
UPDATE nadadores
SET dni = CONCAT('PENDING-', LPAD(id_nadador, 3, '0'))
WHERE dni IS NULL;

-- Step 3: Make it NOT NULL after populating existing data
ALTER TABLE nadadores
MODIFY COLUMN dni VARCHAR(20) NOT NULL UNIQUE;

-- Step 4: Add index for performance
CREATE INDEX idx_nadadores_dni ON nadadores(dni);

-- ============================================
-- Verification queries
-- ============================================

-- Check table structure
DESCRIBE nadadores;

-- Verify all swimmers have DNI
SELECT id_nadador, nombre, apellidos, dni FROM nadadores;

-- Verify uniqueness (should return 0 rows)
SELECT dni, COUNT(*)
FROM nadadores
GROUP BY dni
HAVING COUNT(*) > 1;

-- ============================================
-- Notes for future use
-- ============================================
--
-- Spanish DNI format: 8 digits + 1 letter (e.g., "12345678Z")
-- Validation regex: ^[0-9]{8}[A-Z]$
--
-- To update temporary DNI values to real ones:
-- UPDATE nadadores SET dni = '12345678Z' WHERE id_nadador = 1;
--
