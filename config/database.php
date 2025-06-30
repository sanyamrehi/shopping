<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shopping_cart');

// First connect without database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db(DB_NAME);
    
    // Create products table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // Insert sample products if table is empty
    $sql = "SELECT COUNT(*) FROM products";
    $result = $conn->query($sql);
    if ($result->fetch_array()[0] == 0) {
        $products = [
            ['Laptop', 'High-performance gaming laptop', 1299.99],
            ['Smartphone', 'Latest model smartphone', 799.99],
            ['Tablet', '10-inch tablet with 128GB storage', 499.99],
            ['Headphones', 'Wireless noise-cancelling headphones', 299.99],
            ['Smart Watch', 'Fitness tracker with heart rate monitor', 199.99]
        ];
        
        foreach ($products as $product) {
            $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $product[0], $product[1], $product[2]);
            $stmt->execute();
        }
    }
} else {
    die("Error creating database: " . $conn->error);
}
?>
