<?php
class Dashboard extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login untuk mengakses semua method di controller ini
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Muat model yang diperlukan (jika sudah ada)
        // $this->bookingModel = $this->model('Booking');
        // $this->eventModel = $this->model('Event');
    }

    // Halaman utama dashboard
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
            // Nantinya Anda akan mengambil data ringkasan dari model
        ];
        $this->view('dashboard/index', $data);
    }

    // Halaman riwayat booking
    public function bookings()
    {
        // Nantinya, ambil data dari $this->bookingModel->getBookingsByUser($_SESSION['user_id']);
        $data = [
            'title' => 'Riwayat Sewa Lapangan',
            'bookings' => [] // Kirim array kosong untuk sekarang
        ];
        $this->view('dashboard/bookings', $data);
    }

    // Halaman riwayat event
    public function events()
    {
        // Nantinya, ambil data dari $this->eventModel->getEventsByUser($_SESSION['user_id']);
        $data = [
            'title' => 'Riwayat Main Bareng',
            'events' => [] // Kirim array kosong untuk sekarang
        ];
        $this->view('dashboard/events', $data);
    }
}
