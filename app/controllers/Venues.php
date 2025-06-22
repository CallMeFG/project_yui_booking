<?php
class Venues extends Controller
{
    private $venueModel;

    public function __construct()
    {
        $this->venueModel = $this->model('Venue');
    }
    public function index()
    {
        // Ambil nilai filter dan sort dari URL (via GET), berikan nilai default jika tidak ada
        $filters = [
            'sport_type' => $_GET['sport_type'] ?? '',
            'sort'       => $_GET['sort'] ?? 'default'
        ];

        // Panggil method BARU dari model untuk mengambil data yang sudah difilter
        $venues = $this->venueModel->getFilteredVenues($filters);

        $data = [
            'title' => 'Sewa Lapangan',
            'venues' => $venues
        ];

        // Muat view dengan data yang sudah difilter dan diurutkan
        $this->view('venues/index', $data);
    }
    // Method show sekarang menerima ID dan tanggal (opsional)
    public function show($id, $date = null)
    {
        // Jika tidak ada tanggal dari URL, gunakan tanggal hari ini
        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        // 1. Ambil data detail venue
        $venue = $this->venueModel->getVenueById($id);

        // 2. Ambil semua slot yang sudah di-booking untuk tanggal tersebut
        $booked_slots = $this->venueModel->getBookingsForDate($id, $date);
        
        // 3. Generate semua kemungkinan slot waktu dari jam buka s/d jam tutup
        $all_slots = [];
        $start_time = strtotime($venue->opening_hour);
        $end_time = strtotime($venue->closing_hour);

        // Loop per jam dari jam buka sampai 1 jam sebelum jam tutup
        while ($start_time < $end_time) {
            $slot_start = date('H:i:s', $start_time);

            // Cek status slot: jika ada di array $booked_slots, maka statusnya 'Dipesan'
            $status = in_array($slot_start, $booked_slots) ? 'Dipesan' : 'Tersedia';

            // Masukkan ke array jadwal
            $all_slots[] = [
                'start_time' => $slot_start,
                'end_time' => date('H:i:s', strtotime('+1 hour', $start_time)),
                'status' => $status
            ];

            // Maju ke jam berikutnya
            $start_time = strtotime('+1 hour', $start_time);
        }

        // 4. Siapkan semua data untuk dikirim ke view
        $data = [
            'venue' => $venue,
            'selected_date' => $date,
            'time_slots' => $all_slots // Kirim data jadwal yang sudah diproses
        ];

        $this->view('venues/show', $data);
    }
}
