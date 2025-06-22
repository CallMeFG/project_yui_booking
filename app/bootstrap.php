<?php
// Setel zona waktu default aplikasi ke WIB
date_default_timezone_set('Asia/Jakarta');

// Muat file Config
require_once 'config/config.php';

// Muat Helper
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Autoloader yang lebih pintar untuk Core, Controllers, dan Models
spl_autoload_register(function ($className) {
    // Daftar direktori tempat class mungkin berada
    $dirs = ['core', 'controllers', 'models'];

    foreach ($dirs as $dir) {
        // Bentuk path file yang lengkap dan benar
        $file = __DIR__ . '/' . $dir . '/' . $className . '.php';

        // Cek jika file ada di direktori ini, lalu muat
        if (file_exists($file)) {
            require_once $file;
            return; // Hentikan pencarian jika sudah ketemu
        }
    }
});
