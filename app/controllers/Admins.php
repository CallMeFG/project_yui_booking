<?php
// Controller ini akan meng-extend AdminController, bukan Controller biasa
class Admins extends AdminController
{
    private $venueModel; // Tambahkan properti untuk venue model
    private $bookingModel; // Tambahkan properti untuk booking model
    private $eventModel; // Tambahkan properti ini
    private $userModel; // Tambahkan properti ini


    public function __construct()
    {
        parent::__construct();
        // Muat Venue Model agar bisa kita gunakan di controller ini
        $this->venueModel = $this->model('Venue');
        $this->bookingModel = $this->model('Booking'); // Muat Booking Model
        $this->eventModel = $this->model('Event'); // Muat Event Model
        $this->userModel = $this->model('User'); // Muat User Model
    }

    // Halaman utama dashboard admin
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin'
        ];
        $this->view('admins/index', $data);
    }

    // Method baru untuk halaman manajemen lapangan
    public function venues()
    {
        $venues = $this->venueModel->getVenues();
        $data = ['title' => 'Manajemen Lapangan', 'venues' => $venues];
        $this->view('admins/venues', $data);
    }
    public function addVenue()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Tambah Lapangan Baru',
                'name' => trim($_POST['name']),
                'sport_type' => trim($_POST['sport_type']),
                'address' => trim($_POST['address']),
                'description' => trim($_POST['description']),
                'price_per_hour' => trim($_POST['price_per_hour']),
                'opening_hour' => trim($_POST['opening_hour']),
                'closing_hour' => trim($_POST['closing_hour']),
                'name_err' => '',
                'price_err' => ''
            ];

            // Validasi data (contoh sederhana)
            if (empty($data['name'])) {
                $data['name_err'] = 'Nama lapangan tidak boleh kosong';
            }
            if (empty($data['price_per_hour'])) {
                $data['price_err'] = 'Harga tidak boleh kosong';
            }

            // Jika tidak ada error
            if (empty($data['name_err']) && empty($data['price_err'])) {
                // Panggil model untuk menyimpan data
                if ($this->venueModel->addVenue($data)) {
                    flash('venue_message', 'Lapangan baru berhasil ditambahkan');
                    redirect('admins/venues');
                } else {
                    die('Terjadi kesalahan.');
                }
            } else {
                // Jika ada error, tampilkan kembali form dengan errornya
                $this->view('admins/add_venue', $data);
            }
        } else {
            // Tampilkan form kosong
            $data = [
                'title' => 'Tambah Lapangan Baru',
                'name' => '',
                'sport_type' => '',
                'address' => '',
                'description' => '',
                'price_per_hour' => '',
                'opening_hour' => '',
                'closing_hour' => '',
                'name_err' => '',
                'price_err' => ''
            ];
            $this->view('admins/add_venue', $data);
        }
    }
    public function editVenue($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses update form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'sport_type' => trim($_POST['sport_type']),
                'address' => trim($_POST['address']),
                'description' => trim($_POST['description']),
                'price_per_hour' => trim($_POST['price_per_hour']),
                'opening_hour' => trim($_POST['opening_hour']),
                'closing_hour' => trim($_POST['closing_hour']),
                'name_err' => '',
                'price_err' => ''
            ];

            // Validasi data
            if (empty($data['name'])) {
                $data['name_err'] = 'Nama lapangan tidak boleh kosong';
            }
            if (empty($data['price_per_hour'])) {
                $data['price_err'] = 'Harga tidak boleh kosong';
            }

            // Jika tidak ada error
            if (empty($data['name_err']) && empty($data['price_err'])) {
                if ($this->venueModel->updateVenue($data)) {
                    flash('venue_message', 'Data lapangan berhasil diupdate');
                    redirect('admins/venues');
                } else {
                    die('Terjadi kesalahan.');
                }
            } else {
                // Jika ada error, tampilkan kembali form dengan errornya
                $this->view('admins/edit_venue', $data);
            }
        } else {
            // Tampilkan form dengan data yang sudah ada
            $venue = $this->venueModel->getVenueById($id);
            $data = [
                'title' => 'Edit Lapangan',
                'id' => $id,
                'name' => $venue->name,
                'sport_type' => $venue->sport_type,
                'address' => $venue->address,
                'description' => $venue->description,
                'price_per_hour' => $venue->price_per_hour,
                'opening_hour' => $venue->opening_hour,
                'closing_hour' => $venue->closing_hour,
                'name_err' => '',
                'price_err' => ''
            ];
            $this->view('admins/edit_venue', $data);
        }
    }
    public function deleteVenue($id)
    {
        // Pastikan ini adalah request POST untuk keamanan
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Panggil method di model untuk menghapus venue
            if ($this->venueModel->deleteVenue($id)) {
                flash('venue_message', 'Lapangan berhasil dihapus');
                redirect('admins/venues');
            } else {
                die('Terjadi kesalahan saat menghapus data.');
            }
        } else {
            // Jika diakses dengan GET, tendang balik
            redirect('admins/venues');
        }
    }
    // Method baru untuk halaman manajemen booking
    public function bookings()
    {
        $bookings = $this->bookingModel->getAllBookings();
        $data = ['title' => 'Manajemen Booking', 'bookings' => $bookings];
        $this->view('admins/bookings', $data);
    }
    public function updateBookingStatus()
    {
        // Pastikan ini adalah request POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form (booking_id dan status baru)
            $id = $_POST['booking_id'];
            $status = $_POST['status'];

            // Panggil model untuk update status
            if ($this->bookingModel->updateBookingStatus($id, $status)) {
                flash('booking_message', 'Status booking berhasil diupdate');
                redirect('admins/bookings');
            } else {
                die('Terjadi kesalahan.');
            }
        } else {
            redirect('admins/bookings');
        }
    }
    public function mainBareng()
    {
        $events = $this->eventModel->getAllEvents();
        $data = ['title' => 'Manajemen Main Bareng', 'events' => $events];
        $this->view('admins/main_bareng', $data);
    }
    public function addMainBareng()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses form
            $data = [
                'title' => trim($_POST['title']),
                'sport_type' => trim($_POST['sport_type']),
                'skill_level' => trim($_POST['skill_level']),
                'venue_id' => $_POST['venue_id'],
                'event_date' => $_POST['event_date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'max_participants' => trim($_POST['max_participants']),
                'cost_per_person' => trim($_POST['cost_per_person']),
                'description' => trim($_POST['description']),
                'creator_id' => $_SESSION['user_id'], // Ambil ID admin yang sedang login
                'venues' => [], // Untuk diisi lagi jika ada error
                'title_err' => ''
            ];

            // Validasi (contoh sederhana, bisa Anda kembangkan)
            if (empty($data['title'])) {
                $data['title_err'] = 'Judul event tidak boleh kosong';
            }

            // Jika tidak ada error
            if (empty($data['title_err'])) {
                if ($this->eventModel->addEvent($data)) {
                    flash('event_message', 'Event Main Bareng baru berhasil ditambahkan');
                    redirect('admins/mainBareng');
                } else {
                    die('Terjadi kesalahan.');
                }
            } else {
                // Jika ada error, ambil lagi data venue untuk ditampilkan di form
                $data['venues'] = $this->venueModel->getVenues();
                $this->view('admins/add_main_bareng', $data);
            }
        } else {
            // Tampilkan form kosong
            $venues = $this->venueModel->getVenues();
            $data = [
                'title' => 'Buat Event Main Bareng Baru',
                'venues' => $venues,
                'event_title' => '',
                'sport_type' => '',
                'skill_level' => '',
                'venue_id' => '',
                'event_date' => '',
                'start_time' => '',
                'end_time' => '',
                'max_participants' => '',
                'cost_per_person' => '',
                'description' => '',
                'title_err' => ''
            ];
            $this->view('admins/add_main_bareng', $data);
        }
    }
    public function editMainBareng($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses update form
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'sport_type' => trim($_POST['sport_type']),
                'skill_level' => trim($_POST['skill_level']),
                'venue_id' => $_POST['venue_id'],
                'event_date' => $_POST['event_date'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'max_participants' => trim($_POST['max_participants']),
                'cost_per_person' => trim($_POST['cost_per_person']),
                'description' => trim($_POST['description']),
                'title_err' => ''
            ];

            // Validasi
            if (empty($data['title'])) {
                $data['title_err'] = 'Judul tidak boleh kosong';
            }

            if (empty($data['title_err'])) {
                if ($this->eventModel->updateEvent($data)) {
                    flash('event_message', 'Event berhasil diupdate');
                    redirect('admins/mainBareng');
                } else {
                    die('Terjadi kesalahan.');
                }
            } else {
                // Jika ada error, kirim kembali data venue untuk dropdown
                $data['venues'] = $this->venueModel->getVenues();
                $this->view('admins/edit_main_bareng', $data);
            }
        } else {
            // Tampilkan form dengan data yang sudah ada dari database
            $event = $this->eventModel->getEventById($id);
            $venues = $this->venueModel->getVenues();

            $data = [
                'title' => 'Edit Event',
                'id' => $id,
                'venues' => $venues,
                'event_title' => $event->title, // Nama variabel ini untuk judul halaman
                'sport_type' => $event->sport_type,
                'skill_level' => $event->skill_level,
                'venue_id' => $event->venue_id,
                'event_date' => $event->event_date,
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'max_participants' => $event->max_participants,
                'cost_per_person' => $event->cost_per_person,
                'description' => $event->description,
                'title_err' => ''
            ];
            $this->view('admins/edit_main_bareng', $data);
        }
    }

    public function deleteMainBareng($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->eventModel->deleteEvent($id)) {
                flash('event_message', 'Event berhasil dihapus');
                redirect('admins/mainBareng');
            } else {
                die('Terjadi kesalahan.');
            }
        } else {
            redirect('admins/mainBareng');
        }
    }
    // Halaman untuk mengelola satu event (melihat pendaftar, dll)
    public function manageEvent($id)
    {
        $event = $this->eventModel->getEventById($id);
        $participants = $this->eventModel->getParticipantsByEventId($id);

        $data = [
            'title' => 'Kelola Event: ' . $event->title,
            'event' => $event,
            'participants' => $participants
        ];

        $this->view('admins/manage_event', $data);
    }

    // Method untuk memproses aksi approve/reject
    public function updateParticipantStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $participant_id = $_POST['participant_id'];
            $event_id = $_POST['event_id'];
            $status = $_POST['status'];

            if ($this->eventModel->updateParticipantStatus($participant_id, $status)) {
                flash('participant_message', 'Status peserta berhasil diupdate.');
                redirect('admins/manageEvent/' . $event_id);
            } else {
                die('Terjadi kesalahan.');
            }
        } else {
            redirect('admins/mainBareng');
        }
    }
    // Method baru untuk halaman manajemen user
    public function users()
    {
        // Ambil semua data pengguna dari model
        $users = $this->userModel->getAllUsers();

        $data = [
            'title' => 'Manajemen User',
            'users' => $users
        ];

        $this->view('admins/users', $data);
    }
    public function updateUserRole()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['user_id'];
            $role = $_POST['role'];

            if ($this->userModel->updateUserRole($id, $role)) {
                flash('user_message', 'Peran pengguna berhasil diupdate.');
                redirect('admins/users');
            } else {
                die('Terjadi kesalahan.');
            }
        } else {
            redirect('admins/users');
        }
    }

    public function deleteUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Pastikan admin tidak menghapus dirinya sendiri
            if ($id == $_SESSION['user_id']) {
                flash('user_message', 'Anda tidak bisa menghapus akun Anda sendiri.', 'alert alert-danger');
                redirect('admins/users');
            }

            if ($this->userModel->deleteUser($id)) {
                flash('user_message', 'Pengguna berhasil dihapus.');
                redirect('admins/users');
            } else {
                flash('user_message', 'Gagal menghapus pengguna. Kemungkinan pengguna ini memiliki data booking atau event terkait.', 'alert alert-danger');
                redirect('admins/users');
            }
        } else {
            redirect('admins/users');
        }
    }
}
