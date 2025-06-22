<?php
class Events extends Controller
{
    private $eventModel;

    public function __construct()
    {
        // Muat Event model
        $this->eventModel = $this->model('Event');
    }

    public function index()
    {
        // Ambil nilai filter dan sort dari URL, berikan nilai default jika tidak ada
        $filters = [
            'sport_type'  => $_GET['sport_type'] ?? '',
            'skill_level' => $_GET['skill_level'] ?? '',
            'event_date'  => $_GET['event_date'] ?? '',
            'sort'        => $_GET['sort'] ?? 'date_asc' // Default sort: tanggal terdekat
        ];

        // Panggil method BARU dari model untuk mengambil data yang sudah difilter
        $events = $this->eventModel->getFilteredEvents($filters);

        $data = [
            'title' => 'Main Bareng',
            'events' => $events
        ];

        // Muat view dengan data yang sudah difilter dan diurutkan
        $this->view('events/index', $data);
    }
    public function show($id)
    {
        $event = $this->eventModel->getEventById($id);
        $participantCount = $this->eventModel->getParticipantCount($id);

        // Cek status partisipasi user yang sedang login
        $userParticipationStatus = false;
        if (isLoggedIn()) {
            $userParticipationStatus = $this->eventModel->getUserParticipationStatus($id, $_SESSION['user_id']);
        }

        $data = [
            'title' => $event->title,
            'event' => $event,
            'participant_count' => $participantCount,
            'user_participation_status' => $userParticipationStatus
        ];

        $this->view('events/show', $data);
    }
    // Method BARU untuk memproses permintaan bergabung
    public function join($event_id)
    {
        // Pastikan user sudah login
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Pastikan ini adalah request POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];

            // Cek apakah user sudah pernah join/request sebelumnya
            if ($this->eventModel->getUserParticipationStatus($event_id, $user_id)) {
                flash('event_message', 'Anda sudah pernah mengajukan permintaan untuk event ini.', 'alert alert-warning');
                redirect('events/show/' . $event_id);
            } else {
                // Jika belum, proses permintaan
                if ($this->eventModel->requestToJoin($event_id, $user_id)) {
                    flash('event_message', 'Permintaan bergabung berhasil dikirim. Tunggu persetujuan dari Admin.');
                    redirect('events/show/' . $event_id);
                } else {
                    die('Terjadi kesalahan.');
                }
            }
        } else {
            redirect('events');
        }
    }
    
}
