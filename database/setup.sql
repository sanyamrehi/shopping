CREATE DATABASE IF NOT EXISTS shopping_cart;
USE shopping_cart;

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, description, price) VALUES
('Laptop', 'High-performance gaming laptop', 1299.99),
('Smartphone', 'Latest model smartphone', 799.99),
('Tablet', '10-inch tablet with 128GB storage', 499.99),
('Headphones', 'Wireless noise-cancelling headphones', 299.99),
('Smart Watch', 'Fitness tracker with heart rate monitor', 199.99);
