<?php
class Booking
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Fungsi untuk menambahkan booking baru ke database
    public function addBooking($data)
    {
        $this->db->query('INSERT INTO bookings (customer_id, venue_id, booking_date, start_time, end_time, total_price, status) VALUES (:customer_id, :venue_id, :booking_date, :start_time, :end_time, :total_price, :status)');

        // Bind semua values
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':venue_id', $data['venue_id']);
        $this->db->bind(':booking_date', $data['booking_date']);
        $this->db->bind(':start_time', $data['start_time']);
        $this->db->bind(':end_time', $data['end_time']);
        $this->db->bind(':total_price', $data['total_price']);
        $this->db->bind(':status', 'Berhasil'); // Default status saat booking dibuat

        // Eksekusi
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method baru untuk mengambil semua booking dengan data lengkap
    public function getAllBookings()
    {
        $this->db->query('SELECT
                            bookings.id,
                            bookings.booking_date,
                            bookings.start_time,
                            bookings.status,
                            users.full_name AS customer_name,
                            venues.name AS venue_name
                        FROM bookings
                        JOIN users ON bookings.customer_id = users.id
                        JOIN venues ON bookings.venue_id = venues.id
                        ORDER BY bookings.booking_date DESC, bookings.start_time DESC');

        $results = $this->db->resultSet();
        return $results;
    }
    public function updateBookingStatus($id, $status)
    {
        $this->db->query('UPDATE bookings SET status = :status WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
