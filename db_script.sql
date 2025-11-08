CREATE DATABASE IF NOT EXISTS pasteleria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pasteleria;

CREATE TABLE IF NOT EXISTS pasteles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NULL,
  preparado_por VARCHAR(255) NULL,
  fecha_creacion DATE NULL,
  fecha_vencimiento DATE NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS ingredientes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT NULL,
  fecha_ingreso DATE NULL,
  fecha_vencimiento DATE NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS pastel_ingrediente (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  pastel_id INT UNSIGNED NOT NULL,
  ingrediente_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY pastel_ingrediente_unique (pastel_id, ingrediente_id),
  CONSTRAINT fk_pastel FOREIGN KEY (pastel_id) REFERENCES pasteles(id) ON DELETE CASCADE,
  CONSTRAINT fk_ingrediente FOREIGN KEY (ingrediente_id) REFERENCES ingredientes(id) ON DELETE CASCADE
);

INSERT INTO pasteles (nombre, descripcion, preparado_por, fecha_creacion, fecha_vencimiento, created_at, updated_at)
VALUES
  ('Pastel de Chocolate', 'Pastel esponjoso con cobertura de chocolate.', 'Chef Ana', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), NOW(), NOW()),
  ('Pastel de Vainilla', 'Clásico pastel de vainilla con crema.', 'Chef Juan', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 5 DAY), NOW(), NOW());

INSERT INTO ingredientes (nombre, descripcion, fecha_ingreso, fecha_vencimiento, created_at, updated_at)
VALUES
  ('Harina', 'Harina de trigo blanca.', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 180 DAY), NOW(), NOW()),
  ('Azúcar', 'Azúcar refinada.', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 365 DAY), NOW(), NOW()),
  ('Chocolate', 'Tableta de chocolate oscuro.', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 90 DAY), NOW(), NOW()),
  ('Vainilla', 'Esencia de vainilla.', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 180 DAY), NOW(), NOW());

INSERT INTO pastel_ingrediente (pastel_id, ingrediente_id, created_at, updated_at)
VALUES
  (1, 1, NOW(), NOW()),
  (1, 2, NOW(), NOW()),
  (1, 3, NOW(), NOW()),
  (2, 1, NOW(), NOW()),
  (2, 2, NOW(), NOW()),
  (2, 4, NOW(), NOW());
