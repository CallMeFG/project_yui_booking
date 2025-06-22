<?php
class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'phone_number' => trim($_POST['phone_number']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'full_name_err' => '',
                'email_err' => '',
                'phone_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if (empty($data['full_name'])) {
                $data['full_name_err'] = 'Nama lengkap wajib diisi';
            } else {
                if (!preg_match('/^[a-zA-Z\s]*$/', $data['full_name'])) {
                    $data['full_name_err'] = 'Nama lengkap hanya boleh mengandung huruf dan spasi';
                }
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Email wajib diisi';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email sudah terdaftar';
                }
            }

            if (!empty($data['phone_number'])) {
                if (!preg_match('/^[0-9]{10,15}$/', $data['phone_number'])) {
                    $data['phone_number_err'] = 'Format nomor telepon tidak valid, harap masukkan 10-15 digit angka';
                }
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Password wajib diisi';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password minimal harus 6 karakter';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Konfirmasi password wajib diisi';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Password tidak cocok';
                }
            }

            if (empty($data['full_name_err']) && empty($data['email_err']) && empty($data['phone_number_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    die('Terjadi kesalahan.');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'full_name' => '',
                'email' => '',
                'phone_number' => '',
                'password' => '',
                'confirm_password' => '',
                'full_name_err' => '',
                'email_err' => '',
                'phone_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Email wajib diisi';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Password wajib diisi';
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
                // User ditemukan
            } else {
                $data['email_err'] = 'Kombinasi email dan password salah';
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    createUserSession($loggedInUser);

                    // =================== PERUBAHAN ADA DI BARIS INI ===================
                    // Cek apakah peran adalah 'admin' ATAU 'staff'
                    if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'staff') {
                        redirect('admins'); // Arahkan admin dan staff ke dashboard
                    } else {
                        redirect(''); // Arahkan customer ke halaman utama
                    }
                    // =================== AKHIR DARI PERUBAHAN ===================

                } else {
                    $data['password_err'] = 'Kombinasi email dan password salah';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];
            $this->view('users/login', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('users/login');
    }
}
