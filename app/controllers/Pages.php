<?php
class Pages extends Controller
{
    private $venueModel;
    private $eventModel; // Tambahkan properti ini

    public function __construct()
    {
        $this->venueModel = $this->model('Venue');
        $this->eventModel = $this->model('Event'); // Muat Event Model
    }

    public function index()
    {
        // Ambil 2 venue terbaru
        $latestVenues = $this->venueModel->getLatestVenues();
        // Ambil 2 event terbaru
        $latestEvents = $this->eventModel->getAllEvents(); // Kita gunakan fungsi yang ada, karena sudah diurutkan dari terbaru

        $data = [
            'title' => 'YUI BOOKING',
            'venues' => $latestVenues,
            'events' => $latestEvents // Kirim data event ke view
        ];

        $this->view('pages/index', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'Tentang Kami',
            'description' => 'YUI BOOKING adalah platform terbaik untuk semua kebutuhan olahraga Anda.'
        ];

        $this->view('pages/about', $data);
    }
    public function contact()
    {
        // Cek jika ada request POST (form disubmit)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses Form

            // Sanitasi data POST
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Hubungi Kami',
                'name' => htmlspecialchars(trim($_POST['name'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'subject' => htmlspecialchars(trim($_POST['subject'])),
                'message' => htmlspecialchars(trim($_POST['message'])),
                'name_err' => '',
                'email_err' => '',
                'subject_err' => '',
                'message_err' => ''
            ];

            // Validasi (sederhana, hanya cek kosong)
            if (empty($data['name'])) {
                $data['name_err'] = 'Nama tidak boleh kosong';
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Email tidak boleh kosong';
            }
            if (empty($data['subject'])) {
                $data['subject_err'] = 'Subjek tidak boleh kosong';
            }
            if (empty($data['message'])) {
                $data['message_err'] = 'Pesan tidak boleh kosong';
            }

            // Cek jika tidak ada error
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['subject_err']) && empty($data['message_err'])) {
                // Validasi Lolos (Tidak ada logic kirim email)

                // Buat notifikasi flash message dan redirect
                flash('contact_success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
                redirect('pages/contact');
            } else {
                // Ada error, muat view dengan error
                $this->view('pages/contact', $data);
            }
        } else {
            // Jika bukan request POST, tampilkan halaman seperti biasa
            $data = [
                'title' => 'Hubungi Kami',
                'name' => '',
                'email' => '',
                'subject' => '',
                'message' => '',
                'name_err' => '',
                'email_err' => '',
                'subject_err' => '',
                'message_err' => ''
            ];

            $this->view('pages/contact', $data);
        }
    }
}
