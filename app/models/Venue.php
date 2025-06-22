<?php
class Venue
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Fungsi untuk mengambil semua data venue
    public function getVenues()
    {
        $this->db->query('SELECT * FROM venues ORDER BY name ASC');
        $results = $this->db->resultSet();
        return $results;
    }
    public function getVenueById($id)
    {
        $this->db->query('SELECT * FROM venues WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }
    public function addVenue($data)
    {
        $this->db->query('INSERT INTO venues (name, sport_type, address, description, price_per_hour, opening_hour, closing_hour) VALUES (:name, :sport_type, :address, :description, :price_per_hour, :opening_hour, :closing_hour)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':sport_type', $data['sport_type']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price_per_hour', $data['price_per_hour']);
        $this->db->bind(':opening_hour', $data['opening_hour']);
        $this->db->bind(':closing_hour', $data['closing_hour']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateVenue($data)
    {
        $this->db->query('UPDATE venues SET name = :name, sport_type = :sport_type, address = :address, description = :description, price_per_hour = :price_per_hour, opening_hour = :opening_hour, closing_hour = :closing_hour WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':sport_type', $data['sport_type']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price_per_hour', $data['price_per_hour']);
        $this->db->bind(':opening_hour', $data['opening_hour']);
        $this->db->bind(':closing_hour', $data['closing_hour']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteVenue($id)
    {
        $this->db->query('DELETE FROM venues WHERE id = :id');
        // Bind id
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getBookingsForDate($venue_id, $date)
    {
        $this->db->query('SELECT start_time FROM bookings WHERE venue_id = :venue_id AND booking_date = :date');
        $this->db->bind(':venue_id', $venue_id);
        $this->db->bind(':date', $date);

        $results = $this->db->resultSet();

        // Kita hanya butuh array berisi start_time, bukan object
        $booked_slots = [];
        foreach ($results as $result) {
            $booked_slots[] = $result->start_time;
        }
        return $booked_slots;
    }
    public function getLatestVenues($limit = 2)
    {
        $this->db->query('SELECT * FROM venues ORDER BY id DESC LIMIT :limit');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);

        $results = $this->db->resultSet();
        return $results;
    }
    public function getFilteredVenues($filters)
    {
        // Query SQL dasar
        $sql = "SELECT * FROM venues WHERE 1=1";

        // Menambahkan filter berdasarkan jenis olahraga jika dipilih
        if (!empty($filters['sport_type'])) {
            $sql .= " AND sport_type = :sport_type";
        }

        // Menambahkan pengurutan (sort)
        switch ($filters['sort']) {
            case 'price_asc':
                $sql .= " ORDER BY price_per_hour ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY price_per_hour DESC";
                break;
            case 'name_asc':
                $sql .= " ORDER BY name ASC";
                break;
            case 'name_desc':
                $sql .= " ORDER BY name DESC";
                break;
            default:
                // Default sort
                $sql .= " ORDER BY id DESC";
                break;
        }

        $this->db->query($sql);

        // Bind value untuk filter jenis olahraga jika ada
        if (!empty($filters['sport_type'])) {
            $this->db->bind(':sport_type', $filters['sport_type']);
        }

        $results = $this->db->resultSet();
        return $results;
    }
}
