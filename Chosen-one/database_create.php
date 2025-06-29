<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'chosen_one_mart';

try {
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Products table (Groceries)
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    category VARCHAR(50)
);

-- Sample grocery products
INSERT INTO products (name, price, description, image, category) VALUES
('Fresh Apples', 2.99, 'Organic, crisp and sweet', 'apples.jpg', 'Fruits'),
('Whole Wheat Bread', 3.49, 'High-fiber, freshly baked', 'bread.jpg', 'Bakery'),
('Organic Milk', 4.99, '1L, hormone-free', 'milk.jpg', 'Dairy'),
('Free-Range Eggs', 5.49, '12 large eggs', 'eggs.jpg', 'Dairy'),
('Tomatoes', 1.99, 'Vine-ripened, per lb', 'tomatoes.jpg', 'Vegetables'),
('Chicken Breast', 7.99, 'Boneless, skinless, per lb', 'chicken.jpg', 'Meat'),
('Basmati Rice', 8.99, '5kg, premium quality', 'rice.jpg', 'Grains'),
('Olive Oil', 9.99, 'Extra virgin, 500ml', 'olive-oil.jpg', 'Pantry');

-- Cart items table
CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
)";
    $pdo->exec($sql);
    echo "All things are set up successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
