<?php
session_start();
require 'koneksi.php';

// === PROSES LOGIKA SUBMIT FORM ===
if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = true;
            header("Location: index.php?page=admin");
            exit;
        } else {
            $error_login = "Password salah!";
        }
    } else {
        $error_login = "Username tidak ditemukan!";
    }
}

// Proses Update/Edit Kategori
if (isset($_POST['update_kategori']) && isset($_SESSION['admin'])) {
    $id = (int)$_POST['category_id'];
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("UPDATE categories SET name='$name' WHERE id=$id");
    header("Location: index.php?page=admin_categories&msg=update_success");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_POST['tambah_produk']) && isset($_SESSION['admin'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $category_id = (int)$_POST['category_id'];
    $price = (float)$_POST['price'];
    $desc = $conn->real_escape_string($_POST['description']);
    $status = $_POST['status'];
    $img = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $img);
    }
    $conn->query("INSERT INTO products (category_id, name, description, price, image, status) VALUES ('$category_id', '$name', '$desc', '$price', '$img', '$status')");
    header("Location: index.php?page=admin&msg=add_success");
    exit;
}

// Proses Edit/Update Produk
if (isset($_POST['update_produk']) && isset($_SESSION['admin'])) {
    $id = (int)$_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $category_id = (int)$_POST['category_id'];
    $price = (float)$_POST['price'];
    $desc = $conn->real_escape_string($_POST['description']);
    $status = $_POST['status'];

    // Cek apakah user mengupload foto baru
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $img);
        
        // Update dengan foto baru
        $conn->query("UPDATE products SET category_id='$category_id', name='$name', description='$desc', price='$price', image='$img', status='$status' WHERE id=$id");
    } else {
        // Update tanpa mengubah foto lama
        $conn->query("UPDATE products SET category_id='$category_id', name='$name', description='$desc', price='$price', status='$status' WHERE id=$id");
    }
    
    header("Location: index.php?page=admin&msg=update_success");
    exit;
}

if (isset($_POST['tambah_kategori']) && isset($_SESSION['admin'])) {
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("INSERT INTO categories (name) VALUES ('$name')");
    header("Location: index.php?page=admin_categories");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete_product' && isset($_SESSION['admin'])) {
    $conn->query("DELETE FROM products WHERE id = " . (int)$_GET['id']);
    header("Location: index.php?page=admin");
    exit;
}

// === ROUTING HALAMAN ===
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Proteksi Halaman Admin
if ($page == 'login' && isset($_SESSION['admin'])) { header("Location: index.php?page=admin"); exit; }
if (($page == 'admin' || $page == 'admin_categories') && !isset($_SESSION['admin'])) { header("Location: index.php?page=login"); exit; }

// === MEMANGGIL TAMPILAN HTML (VIEWS) ===
include 'views/header.php'; // Panggil bagian atas web

// Panggil bagian tengah web sesuai halaman yang direquest
if (file_exists("views/{$page}.php")) {
    include "views/{$page}.php";
} else {
    include "views/404.php";
}

include 'views/footer.php'; // Panggil bagian bawah web
?>