CREATE DATABASE IF NOT EXISTS mfumo_wa_kusambaza_chakula;
USE mfumo_wa_kusambaza_chakula;

-- Customers
CREATE TABLE IF NOT EXISTS customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Menu items
CREATE TABLE IF NOT EXISTS menu_items (
    menu_item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT NOT NULL,
    icon VARCHAR(10) NULL
);

-- Orders
CREATE TABLE IF NOT EXISTS orders (
    order_id BIGINT PRIMARY KEY,
    customer_id INT NOT NULL,
    total INT NOT NULL,
    status ENUM('pending', 'confirmed', 'delivered') NOT NULL DEFAULT 'pending',
    order_date DATETIME NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

-- Order items
CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT NOT NULL,
    menu_item_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(menu_item_id)
);

-- Seed customers
INSERT INTO customers (name, phone, address) VALUES
('Amina Hassan', '0712345678', 'Mtaa wa Jangwani, Dar es Salaam'),
('Joseph Mwakyembe', '0723456789', 'Mtaa wa Mwenge, Dar es Salaam'),
('Rashida Omar', '0734567890', 'Mtaa wa Kariakoo, Dar es Salaam'),
('Moses John', '0745678901', 'Mtaa wa Sinza, Dar es Salaam'),
('Fatuma Seleman', '0756789012', 'Mtaa wa Temeke, Dar es Salaam');

-- Seed menu items
INSERT INTO menu_items (name, price, icon) VALUES
('Wali Na Maharage', 1500, ''),
('Ugali Na Dagaa', 1000, ''),
('Nyama Choma', 2000, ''),
('Biriyani', 8000, ''),
('Pilau', 3000, ''),
('Samaki Wa Kukaanga', 2000, ''),
('Chai Na Mandazi', 1000, ''),
('Chipsi Mayai', 3000, ''),
('Vitumbua', 3000, ''),
('Mshikaki', 1000, ''),
('Zenzero', 1000, ''),
('Maji Safi', 1000, '');

-- Seed orders (10 orders)
INSERT INTO orders (order_id, customer_id, total, status, order_date) VALUES
(1720000001, 1, 4000, 'delivered', '2026-05-28 12:15:00'),
(1720000002, 2, 5000, 'confirmed', '2026-05-28 12:45:00'),
(1720000003, 3, 12000, 'pending', '2026-05-28 13:05:00'),
(1720000004, 4, 8000, 'delivered', '2026-05-28 14:25:00'),
(1720000005, 5, 5000, 'confirmed', '2026-05-28 15:00:00'),
(1720000006, 1, 7000, 'pending', '2026-05-29 10:20:00'),
(1720000007, 2, 2000, 'delivered', '2026-05-29 11:10:00'),
(1720000008, 3, 2000, 'confirmed', '2026-05-29 12:30:00'),
(1720000009, 4, 4500, 'pending', '2026-05-29 13:50:00'),
(1720000010, 5, 10000, 'delivered', '2026-05-29 14:40:00');

-- Seed order items
INSERT INTO order_items (order_id, menu_item_id, quantity, unit_price) VALUES
(1720000001, 1, 2, 1500),
(1720000001, 7, 1, 1000),
(1720000002, 3, 1, 2000),
(1720000002, 5, 1, 3000),
(1720000003, 4, 1, 8000),
(1720000003, 12, 4, 1000),
(1720000004, 6, 1, 2000),
(1720000004, 8, 2, 3000),
(1720000005, 11, 5, 1000),
(1720000006, 3, 1, 2000),
(1720000006, 9, 1, 3000),
(1720000006, 12, 2, 1000),
(1720000007, 2, 2, 1000),
(1720000008, 10, 2, 1000),
(1720000009, 1, 1, 1500),
(1720000009, 5, 1, 3000),
(1720000010, 4, 1, 8000),
(1720000010, 6, 1, 2000);
