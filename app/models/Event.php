<?php
class Event
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function addEvent($data)
    {
        $this->db->query('INSERT INTO events (title, sport_type, skill_level, description, venue_id, event_date, start_time, end_time, max_participants, cost_per_person, creator_id) VALUES (:title, :sport_type, :skill_level, :description, :venue_id, :event_date, :start_time, :end_time, :max_participants, :cost_per_person, :creator_id)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':sport_type', $data['sport_type']);
        $this->db->bind(':skill_level', $data['skill_level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':venue_id', $data['venue_id']);
        $this->db->bind(':event_date', $data['event_date']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        $this->db->bind(':max_participants', $data['max_participants']);
        $this->db->bind(':cost_per_person', $data['cost_per_person']);
        $this->db->bind(':creator_id', $data['creator_id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllEvents()
    {
        $this->db->query('SELECT
                            events.*,
                            venues.name as venue_name,
                            users.full_name as creator_name
                        FROM events
                        LEFT JOIN venues ON events.venue_id = venues.id
                        LEFT JOIN users ON events.creator_id = users.id
                        ORDER BY events.event_date DESC');

        $results = $this->db->resultSet();
        return $results;
    }
    public function getEventById($id)
    {
        // Tambahkan JOIN untuk mengambil nama venue dan nama pembuat
        $this->db->query('SELECT
                            events.*,
                            venues.name as venue_name,
                            users.full_name as creator_name
                        FROM events
                        LEFT JOIN venues ON events.venue_id = venues.id
                        LEFT JOIN users ON events.creator_id = users.id
                        WHERE events.id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    // Method baru untuk mengupdate data event
    public function updateEvent($data)
    {
        $this->db->query('UPDATE events SET title = :title, sport_type = :sport_type, skill_level = :skill_level, description = :description, venue_id = :venue_id, event_date = :event_date, start_time = :start_time, end_time = :end_time, max_participants = :max_participants, cost_per_person = :cost_per_person WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        // ... (bind semua field lainnya seperti di addEvent) ...
        $this->db->bind(':sport_type', $data['sport_type']);
        $this->db->bind(':skill_level', $data['skill_level']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':venue_id', $data['venue_id']);
        $this->db->bind(':event_date', $data['event_date']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        $this->db->bind(':max_participants', $data['max_participants']);
        $this->db->bind(':cost_per_person', $data['cost_per_person']);

        // Execute
        return $this->db->execute();
    }

    // Method baru untuk menghapus event
    public function deleteEvent($id)
    {
        // PENTING: Idealnya, kita harus hapus dulu semua partisipan di tabel `event_participants` yang merujuk ke event ini.
        // Untuk sekarang, kita asumsikan belum ada partisipan.
        $this->db->query('DELETE FROM events WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    public function getParticipantCount($event_id)
    {
        $this->db->query('SELECT COUNT(*) as count FROM event_participants WHERE event_id = :event_id AND status = :status');
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':status', 'approved');
        $row = $this->db->single();
        return $row->count;
    }
    // Cek status partisipasi seorang user di sebuah event
    public function getUserParticipationStatus($event_id, $user_id)
    {
        $this->db->query('SELECT status FROM event_participants WHERE event_id = :event_id AND user_id = :user_id');
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();

        if ($row) {
            return $row->status; // Mengembalikan 'pending', 'approved', atau 'rejected'
        } else {
            return false; // User belum pernah join/request
        }
    }

    // Masukkan permintaan bergabung baru
    public function requestToJoin($event_id, $user_id)
    {
        $this->db->query('INSERT INTO event_participants (event_id, user_id, status) VALUES (:event_id, :user_id, :status)');
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', 'pending'); // Status awal selalu 'pending'

        return $this->db->execute();
    }

    // Mengambil semua data partisipan untuk sebuah event
    public function getParticipantsByEventId($event_id)
    {
        $this->db->query('SELECT
                        event_participants.id,
                        event_participants.status,
                        users.full_name
                    FROM event_participants
                    JOIN users ON event_participants.user_id = users.id
                    WHERE event_participants.event_id = :event_id');
        $this->db->bind(':event_id', $event_id);
        return $this->db->resultSet();
    }

    // Mengupdate status seorang partisipan (approve/reject)
    public function updateParticipantStatus($participant_id, $status)
    {
        $this->db->query('UPDATE event_participants SET status = :status WHERE id = :id');
        $this->db->bind(':id', $participant_id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
    public function getFilteredEvents($filters)
    {
        // Query SQL dasar dari getAllEvents untuk mendapatkan semua data yang diperlukan
        $sql = "SELECT
                    events.*,
                    venues.name as venue_name,
                    users.full_name as creator_name
                FROM events
                LEFT JOIN venues ON events.venue_id = venues.id
                LEFT JOIN users ON events.creator_id = users.id
                WHERE 1=1";

        // Menambahkan filter jika ada nilainya
        if (!empty($filters['sport_type'])) {
            $sql .= " AND events.sport_type = :sport_type";
        }
        if (!empty($filters['skill_level'])) {
            $sql .= " AND events.skill_level = :skill_level";
        }
        // Perhatikan: Filter tanggal mungkin perlu penyesuaian jika formatnya berbeda
        if (!empty($filters['event_date'])) {
            $sql .= " AND events.event_date = :event_date";
        }

        // Menambahkan pengurutan (sort)
        switch ($filters['sort']) {
            case 'date_desc':
                $sql .= " ORDER BY events.event_date DESC, events.start_time DESC";
                break;
            case 'cost_asc':
                $sql .= " ORDER BY events.cost_per_person ASC";
                break;
            case 'cost_desc':
                $sql .= " ORDER BY events.cost_per_person DESC";
                break;
            case 'date_asc':
            default:
                // Default sort adalah tanggal terdekat
                $sql .= " ORDER BY events.event_date ASC, events.start_time ASC";
                break;
        }

        $this->db->query($sql);

        // Bind values untuk filter jika ada
        if (!empty($filters['sport_type'])) {
            $this->db->bind(':sport_type', $filters['sport_type']);
        }
        if (!empty($filters['skill_level'])) {
            $this->db->bind(':skill_level', $filters['skill_level']);
        }
        if (!empty($filters['event_date'])) {
            $this->db->bind(':event_date', $filters['event_date']);
        }

        $results = $this->db->resultSet();
        return $results;
    }
}
