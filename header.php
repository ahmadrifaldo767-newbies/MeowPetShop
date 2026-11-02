<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow PetShop Kucing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .product-img { height: 200px; object-fit: cover; width: 100%; }
    
    html, body { 
        height: 100%; 
        margin: 0; 
    }
    body { 
        display: flex; 
        flex-direction: column; 
    }
    .content-wrapper { 
        flex: 1; 
    }

    .card { transition: all 0.3s ease-in-out; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }

    /* Efek Transisi Halus */
    body, .card, .navbar, footer, .bg-white, .bg-light {
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* PENGATURAN KUSTOM DARK MODE  */
    [data-bs-theme="dark"] body {
        background-color: #121212 !important;
        color: #e0e0e0 !important;
    }
    
    [data-bs-theme="dark"] .bg-white, 
    [data-bs-theme="dark"] .bg-light {
        background-color: #1e1e1e !important;
        color: #f8f9fa !important;
        border-color: #2c2c2c !important;
    }

    [data-bs-theme="dark"] .card {
        background-color: #1e1e1e !important;
        color: #f8f9fa !important;
        border: 1px solid #2c2c2c !important;
    }

    [data-bs-theme="dark"] .card-title, 
    [data-bs-theme="dark"] h1, 
    [data-bs-theme="dark"] h2, 
    [data-bs-theme="dark"] h3, 
    [data-bs-theme="dark"] h4,
    [data-bs-theme="dark"] h5 {
        color: #ffffff !important;
    }

    [data-bs-theme="dark"] .text-muted {
        color: #a0a0a0 !important;
    }

    [data-bs-theme="dark"] .table {
        color: #f8f9fa !important;
        border-color: #373b3e !important;
    }
    
    [data-bs-theme="dark"] .table-striped > tbody > tr:nth-of-type(odd) > * {
        color: #f8f9fa !important;
        background-color: #1a1a1a !important;
    }

    [data-bs-theme="dark"] .form-control, 
    [data-bs-theme="dark"] .form-select {
        background-color: #2b2b2b !important;
        color: #ffffff !important;
        border-color: #444 !important;
    }

    [data-bs-theme="dark"] .form-control::placeholder {
        color: #888 !important;
    }

    /* PENYESUAIAN KHUSUS TOMBOL SAAT MODE GELAP */
    [data-bs-theme="dark"] .btn-outline-dark {
        color: #f8f9fa !important;
        border-color: #f8f9fa !important;
    }
    [data-bs-theme="dark"] .btn-outline-dark:hover {
        background-color: #f8f9fa !important;
        color: #000000 !important;
    }

    [data-bs-theme="dark"] .card-footer .btn-outline-warning,
    [data-bs-theme="dark"] .btn-outline-warning {
        color: #ffc107 !important;
        border-color: #ffc107 !important;
    }
    [data-bs-theme="dark"] .card-footer .btn-outline-warning:hover {
        background-color: #ffc107 !important;
        color: #000000 !important;
    }

    /* Penyesuaian otomatis background menu saat Mode Gelap aktif */
    [data-bs-theme="dark"] .navbar-nav .nav-link.bg-white {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #f8f9fa !important;
    }
    [data-bs-theme="dark"] .navbar-nav .nav-link.bg-white:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
    }

    /* background tombol kapsul menu menjadi hitam saat mode gelap */
    [data-bs-theme="dark"] .navbar-nav .nav-link,
    [data-bs-theme="dark"] .navbar-nav .nav-link.bg-white {
        background-color: #1a1a1a !important;
        color: #ffffff !important;
        border-color: #333333 !important;
    }

    [data-bs-theme="dark"] .navbar-nav .nav-link:hover {
        background-color: #333333 !important;
        color: #ffc107 !important;
    }
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow-sm sticky-top py-3">
    <div class="container px-3">
        
        <!-- Logo Toko Di kiri -->
        <a class="navbar-brand text-dark fw-bold fs-4 d-flex align-items-center gap-2" href="index.php">
            <img src="uploads/kucing.png" alt="Logo" style="height: 40px; width: auto;" class="rounded"> Meow PetShop
        </a>

        <!-- Tombol Toggler untuk HP/Mobile -->
        <button class="navbar-toggler border-0 shadow-none text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            
            <!-- Menu Kiri/Tengah -->
            <ul class="navbar-nav align-lg-items-center gap-2">
        <li class="nav-item">
        <a class="nav-link text-dark fw-semibold px-3 py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block transition-all" href="index.php?page=home">
            <i class="bi bi-house-door me-1"></i> Beranda
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark fw-semibold px-3 py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block transition-all" href="index.php?page=products">
            <i class="bi bi-grid me-1"></i> Produk
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-dark fw-semibold px-3 navbar-link py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block transition-all" href="index.php?page=about">
            <i class="bi bi-info-circle me-1"></i> Tentang Kami
        </a>
    </li>
</ul>
            
            <!-- Menu Kanan (Tombol Tema & Admin/Logout) -->
            <ul class="navbar-nav align-lg-items-center gap-2 ms-lg-3 mt-3 mt-lg-0 list-unstyled mb-0">
                <li class="nav-item d-flex align-items-center me-2">
                    <button class="btn btn-sm btn-outline-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;" id="btn-switch-theme" title="Ubah Tema">
                        <i class="bi bi-sun-fill fs-6" id="theme-icon"></i>
                    </button>
                </li>

                <?php if(isset($_SESSION['admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold px-3 py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block" href="index.php?page=admin">
                            <i class="bi bi-speedometer2 text-primary me-1"></i> Dashboard Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-bold px-3 py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block" href="index.php?action=logout">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold px-3 py-2 rounded-pill bg-white bg-opacity-50 shadow-sm d-inline-block" href="index.php?page=login">
                            <i class="bi bi-person-lock me-1"></i> Login Admin
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>

<!-- KONTEN UTAMA -->
<div class="container mt-4 mb-5 content-wrapper">