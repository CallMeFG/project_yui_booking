<?php
// Mulai session
session_start();

// Fungsi untuk membuat session user setelah login
function createUserSession($user)
{
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->full_name;
    $_SESSION['user_role'] = $user->role; // <-- TAMBAHKAN BARIS INI
}

// Fungsi untuk mengecek apakah user sudah login
function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}
// Flash message helper
// TAMPILKAN DI VIEW: echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}