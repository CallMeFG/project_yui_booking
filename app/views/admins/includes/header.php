<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> | YUI BOOKING Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            padding: 20px;
            background-color: #1E1E1E;
        }
        .sidebar .nav-link {
            color: #A0A0A0;
            border-radius: .25rem;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #FFFFFF;
            background-color: #8B0000;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #FFFFFF;
            color: #212529;
            min-height: 100vh;
        }
        .card {
            background-color: #FFFFFF;
            border-color: #dee2e6;
        }
        /* --- Perbaikan untuk Dropdown di dalam Tabel Responsif --- */
        .table-responsive .dropdown,
        .table-responsive .btn-group {
            position: static;
        }
    </style>
</head>

<body>
    <?php
    // Logika untuk menentukan URL mana yang sedang aktif
    $current_url = $_GET['url'] ?? '';
    ?>
    <div class="sidebar">
        <h3 class="text-white mb-4">YUI ADMIN</h3>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="<?php echo URLROOT; ?>/admins" class="nav-link <?php echo (strpos($current_url, 'admins/index') !== false || $current_url == 'admins') ? 'active' : ''; ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?php echo URLROOT; ?>/admins/venues" class="nav-link <?php echo (strpos($current_url, 'admins/venues') !== false) ? 'active' : ''; ?>">
                    <i class="bi bi-card-list"></i> Manajemen Lapangan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?php echo URLROOT; ?>/admins/bookings" class="nav-link <?php echo (strpos($current_url, 'admins/bookings') !== false) ? 'active' : ''; ?>">
                    <i class="bi bi-calendar-check"></i> Manajemen Booking
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="<?php echo URLROOT; ?>/admins/mainBareng" class="nav-link <?php echo (strpos($current_url, 'admins/mainBareng') !== false) ? 'active' : ''; ?>">
                    <i class="bi bi-dribbble"></i> Manajemen Main Bareng
                </a>
            </li>

            <?php // ================== PERUBAHAN DI SINI ================== 
            ?>
            <?php // Hanya tampilkan menu ini jika peran pengguna adalah 'admin' 
            ?>
            <?php if ($_SESSION['user_role'] == 'admin') : ?>
                <li class="nav-item mb-2">
                    <a href="<?php echo URLROOT; ?>/admins/users" class="nav-link <?php echo (strpos($current_url, 'admins/users') !== false) ? 'active' : ''; ?>">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
            <?php endif; ?>
            <?php // ================== AKHIR DARI PERUBAHAN ================== 
            ?>

            <hr class="text-secondary">
            <li class="nav-item mb-2">
                <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
    <main class="main-content">