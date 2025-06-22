<?php
class Bookings extends Controller
{
    private $bookingModel;
    private $venueModel;

    public function __construct()
    {
        // Muat kedua model yang kita butuhkan
        $this->bookingModel = $this->model('Booking');
        $this->venueModel = $this->model('Venue');
    }

    // Method untuk menampilkan halaman konfirmasi booking
    public function add($venue_id, $date, $start_time)
    {
        // PENTING: Cek apakah user sudah login. Jika belum, tendang ke halaman login.
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Ambil data detail venue berdasarkan ID
        $venue = $this->venueModel->getVenueById($venue_id);

        // Siapkan data untuk dikirim ke view konfirmasi
        $data = [
            'venue' => $venue,
            'booking_date' => $date,
            'start_time' => $start_time,
            // Hitung jam selesai (jam mulai + 1 jam)
            'end_time' => date('H:i:s', strtotime('+1 hour', strtotime($start_time)))
        ];

        $this->view('bookings/add', $data);
    }
    public function create()
    {
        // Pastikan ini adalah request POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Siapkan data dari form (termasuk hidden input)
            $data = [
                'customer_id' => $_SESSION['user_id'], // Ambil ID user yang sedang login
                'venue_id' => $_POST['venue_id'],
                'booking_date' => $_POST['booking_date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'total_price' => $_POST['total_price']
            ];

            // Panggil model untuk menyimpan booking
            if ($this->bookingModel->addBooking($data)) {
                // Jika berhasil, set flash message dan redirect ke halaman utama
                flash('booking_success', 'Booking Anda Berhasil Dibuat!');
                redirect('');
            } else {
                die('Terjadi Kesalahan Saat Menyimpan Booking.');
            }
        } else {
            // Jika diakses langsung tanpa POST, redirect ke halaman utama
            redirect('');
        }
    }
}
    