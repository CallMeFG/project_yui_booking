<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] . ' | ' . SITENAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dashboard.css">
</head>

<body>

    <nav class="sidebar bg-dark">
        <div class="sidebar-sticky">
            <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-light">
                <span>YUI BOOKING</span>
            </h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($data['title'] == 'Dashboard') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/dashboard">
                        <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($data['title'] == 'Riwayat Sewa Lapangan') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/dashboard/bookings">
                        <i class="bi bi-calendar-check-fill"></i> Riwayat Sewa Lapangan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($data['title'] == 'Riwayat Main Bareng') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/dashboard/events">
                        <i class="bi bi-people-fill"></i> Riwayat Main Bareng
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Akun</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">
                        <i class="bi bi-globe"></i> Kembali ke Situs Utama
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="main-content">