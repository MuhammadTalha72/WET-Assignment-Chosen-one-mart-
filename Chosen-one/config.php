<?php
session_start();

$host = 'localhost';
$dbname = 'chosen_one_mart';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Green & White Theme
function getThemeStyles() {
    return '
        <style>
            .bg-com { background-color: #4CAF50; } /* Green */
            .text-com { color: #4CAF50; }
            .btn-com { 
                background-color: #4CAF50; 
                color: white;
                border: none;
            }
            .btn-com:hover { background-color: #45a049; }
            .navbar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
            .product-card { transition: transform 0.3s; }
            .product-card:hover { transform: translateY(-5px); }
            .footer { background-color: #f8f9fa; padding: 20px 0; }
        </style>
    ';
}
?>