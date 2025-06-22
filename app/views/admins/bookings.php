<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manajemen Booking</h1>
</div>

<?php flash('booking_message'); // Tempat untuk menampilkan notifikasi 
?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam</th>
                <th scope="col">Customer</th>
                <th scope="col">Lapangan</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['bookings'] as $index => $booking) : ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo date('d M Y', strtotime($booking->booking_date)); ?></td>
                    <td><?php echo date('H:i', strtotime($booking->start_time)); ?></td>
                    <td><?php echo $booking->customer_name; ?></td>
                    <td><?php echo $booking->venue_name; ?></td>
                    <td>
                        <?php
                        // Logika untuk warna badge status
                        $statusClass = 'bg-success'; // Default untuk 'Berhasil'
                        if ($booking->status == 'Selesai') {
                            $statusClass = 'bg-secondary';
                        } elseif ($booking->status == 'Dibatalkan') {
                            $statusClass = 'bg-danger';
                        }
                        ?>
                        <span class="badge <?php echo $statusClass; ?>"><?php echo $booking->status; ?></span>
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $booking->id; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                Ubah Status
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton<?php echo $booking->id; ?>">
                                <li>
                                    <form action="<?php echo URLROOT; ?>/admins/updateBookingStatus" method="post" class="dropdown-item p-0">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking->id; ?>">
                                        <input type="hidden" name="status" value="Berhasil">
                                        <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">Berhasil</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="<?php echo URLROOT; ?>/admins/updateBookingStatus" method="post" class="dropdown-item p-0">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking->id; ?>">
                                        <input type="hidden" name="status" value="Selesai">
                                        <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">Selesai</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="<?php echo URLROOT; ?>/admins/updateBookingStatus" method="post" class="dropdown-item p-0">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking->id; ?>">
                                        <input type="hidden" name="status" value="Dibatalkan">
                                        <button type="submit" class="btn btn-link text-decoration-none text-danger w-100 text-start">Dibatalkan</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>