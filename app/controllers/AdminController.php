<?php
// Controller dasar untuk semua halaman di area admin
class AdminController extends Controller
{
    public function __construct()
    {
        // Cek apakah user sudah login DAN apakah perannya adalah admin
        if (!isLoggedIn() || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'staff')) {
            // Jika tidak, tendang keluar ke halaman utama
            redirect('');
        }
    }
}
