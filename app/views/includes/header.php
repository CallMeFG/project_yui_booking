<?php
// Helper to get the current URL path for active link detection
$current_url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="<?php echo URLROOT; ?>">YUI BOOKING</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        // Mendapatkan base path dari URLROOT, contoh: /yui_booking
                        $base_path = parse_url(URLROOT, PHP_URL_PATH);
                        // Halaman Home aktif jika URL saat ini sama dengan base path atau base path dengan slash
                        $is_home = ($current_url == $base_path || $current_url == $base_path . '/');
                        ?>
                        <a class="nav-link <?php echo ($is_home) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($current_url, '/venues') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/venues">Sewa Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($current_url, '/events') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/events">Main Bareng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($current_url, '/pages/about') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/pages/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (strpos($current_url, '/pages/contact') !== false) ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/pages/contact">Kontak</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <?php if (isLoggedIn()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['user_name']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <li><a class="dropdown-item" href=" <?php echo URLROOT; ?>/dashboard">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>