<?php
class User
{
    private $db;

    public function __construct()
    {
        // Inisialisasi koneksi database
        $this->db = new Database;
    }

    // Cari user berdasarkan email. Email harus unik.
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Cek jika email sudah ada
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Daftarkan user baru
    public function register($data)
    {
        // Query untuk insert data user baru
        $this->db->query('INSERT INTO users (full_name, email, phone_number, password, role) VALUES (:full_name, :email, :phone_number, :password, :role)');

        // Bind values dari data
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', 'customer'); // Default role untuk registrasi adalah customer

        // Eksekusi query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function login($email, $password)
    {
        // Cari user berdasarkan email
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            // Jika user ditemukan, verifikasi password
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                // Password cocok, kembalikan data user
                return $row;
            } else {
                // Password tidak cocok
                return false;
            }
        } else {
            // User tidak ditemukan
            return false;
        }
    }
    // Method baru untuk mengambil semua pengguna
    public function getAllUsers()
    {
        // Kita tidak mengambil password untuk keamanan
        $this->db->query('SELECT id, full_name, email, phone_number, role FROM users ORDER BY full_name ASC');

        $results = $this->db->resultSet();
        return $results;
    }
    // Method baru untuk mengubah peran user
    public function updateUserRole($id, $role)
    {
        $this->db->query('UPDATE users SET role = :role WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':role', $role);

        return $this->db->execute();
    }

    // Method baru untuk menghapus user
    public function deleteUser($id)
    {
        // PENTING: Di aplikasi nyata, menghapus user yang punya data terkait (booking, event) akan gagal
        // karena foreign key constraint. Biasanya user hanya di-nonaktifkan, bukan dihapus.
        // Untuk proyek ini, kita akan buat fungsi hapus langsung.
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}
