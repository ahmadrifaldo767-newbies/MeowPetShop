<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$nomor_whatsapp = "6285766609064"; // nomor WA

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$conn->query("CREATE DATABASE IF NOT EXISTS db_petshop");
$conn->select_db("db_petshop");

// Buat Tabel
$conn->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL)");
$conn->query("CREATE TABLE IF NOT EXISTS categories (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL)");
$conn->query("CREATE TABLE IF NOT EXISTS products (id INT AUTO_INCREMENT PRIMARY KEY, category_id INT, name VARCHAR(150) NOT NULL, description TEXT, price DECIMAL(10,2) NOT NULL, image VARCHAR(255), status ENUM('tersedia', 'habis') DEFAULT 'tersedia', FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE)");

// Insert Data Default
if($conn->query("SELECT id FROM users LIMIT 1")->num_rows == 0) {
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, password) VALUES ('admin', '$password')");
}
if($conn->query("SELECT id FROM categories LIMIT 1")->num_rows == 0) {
    $conn->query("INSERT INTO categories (name) VALUES ('Makanan Kucing'), ('Mainan dan Aksesoris'), ('Pasir dan Kebersihan')");
}
if (!file_exists('uploads')) mkdir('uploads', 0777, true);
?>