 -- Crear base de datos
CREATE DATABASE product_registry;
USE product_registry;

-- Tabla de bodegas
CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Tabla de sucursales
CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    warehouse_id INT NOT NULL,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
);

-- Tabla de monedas
CREATE TABLE currencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    symbol VARCHAR(5) NOT NULL
);a-- Crear base de datos
CREATE DATABASE product_registry;
USE product_registry;

-- Tabla de bodegas
CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Tabla de sucursales
CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    warehouse_id INT NOT NULL,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id)
);

-- Tabla de monedas
CREATE TABLE currencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    symbol VARCHAR(5) NOT NULL
);

-- Tabla de materiales
CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Tabla de productos
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(15) UNIQUE NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    warehouse_id INT NOT NULL,
    branch_id INT NOT NULL,
    currency_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id),
    FOREIGN KEY (branch_id) REFERENCES branches(id),
    FOREIGN KEY (currency_id) REFERENCES currencies(id)
);

-- Tabla intermedia para materiales de productos
CREATE TABLE product_materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    material_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES materials(id)
);

-- Insertar datos de ejemplo en Warehouses
INSERT INTO warehouses (name) VALUES 
('Bodega Central'),
('Bodega Norte'),
('Bodega Sur'),
('Bodega Oriente'),
('Bodega Poniente');

-- Insertar datos de ejemplo en Branches (cada una ligada a su warehouse correspondiente)
INSERT INTO branches (name, warehouse_id) VALUES 
('Sucursal Centro 1', 1),
('Sucursal Centro 2', 1),
('Sucursal Norte A', 2),
('Sucursal Norte B', 2),
('Sucursal Sur A', 3),
('Sucursal Sur B', 3),
('Sucursal Oriente', 4),
('Sucursal Poniente', 5);

-- Insertar datos de ejemplo en Currencies
INSERT INTO currencies (name, symbol) VALUES 
('Peso Chileno', 'CLP'),
('Dólar', 'USD'),
('Euro', 'EUR');

-- Insertar datos de ejemplo en Materials
INSERT INTO materials (name) VALUES 
('Plástico'),
('Metal'),
('Madera'),
('Vidrio'),
('Textil');


-- Tabla de materiales
CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Tabla de productos
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(15) UNIQUE NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    warehouse_id INT NOT NULL,
    branch_id INT NOT NULL,
    currency_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id),
    FOREIGN KEY (branch_id) REFERENCES branches(id),
    FOREIGN KEY (currency_id) REFERENCES currencies(id)
);

-- Tabla intermedia para materiales de productos
CREATE TABLE product_materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    material_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES materials(id)
);

-- Insertar datos de ejemplo en Warehouses
INSERT INTO warehouses (name) VALUES 
('Bodega Central'),
('Bodega Norte'),
('Bodega Sur'),
('Bodega Oriente'),
('Bodega Poniente');

-- Insertar datos de ejemplo en Branches (cada una ligada a su warehouse correspondiente)
INSERT INTO branches (name, warehouse_id) VALUES 
('Sucursal Centro 1', 1),
('Sucursal Centro 2', 1),
('Sucursal Norte A', 2),
('Sucursal Norte B', 2),
('Sucursal Sur A', 3),
('Sucursal Sur B', 3),
('Sucursal Oriente', 4),
('Sucursal Poniente', 5);

-- Insertar datos de ejemplo en Currencies
INSERT INTO currencies (name, symbol) VALUES 
('Peso Chileno', 'CLP'),
('Dólar', 'USD'),
('Euro', 'EUR'),

-- Insertar datos de ejemplo en Materials
INSERT INTO materials (name) VALUES 
('Plástico'),
('Metal'),
('Madera'),
('Vidrio'),
('Textil'),
