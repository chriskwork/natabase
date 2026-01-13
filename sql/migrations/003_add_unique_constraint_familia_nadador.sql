-- Migration 003: Add UNIQUE constraint to familia_nadador table
-- Purpose: Prevent duplicate guardian-swimmer links
-- Date: 2026-01-13

-- Add UNIQUE constraint on (id_usuario, id_nadador) pair
ALTER TABLE familia_nadador
ADD UNIQUE KEY unique_usuario_nadador (id_usuario, id_nadador);

-- This prevents the same guardian from being linked to the same swimmer multiple times
-- Example: If guardian (id_usuario=2) is already linked to swimmer (id_nadador=5),
--          attempting to insert the same pair again will fail with a duplicate key error
