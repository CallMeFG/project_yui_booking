<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h2>Konfirmasi Booking Anda</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Detail Pesanan:</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Nama Lapangan:</b> <?php echo $data['venue']->name; ?></li>
                        <li class="list-group-item"><b>Tanggal:</b> <?php echo date('d F Y', strtotime($data['booking_date'])); ?></li>
                        <li class="list-group-item"><b>Waktu:</b> Jam <?php echo date('H:i', strtotime($data['start_time'])); ?> - <?php echo date('H:i', strtotime($data['end_time'])); ?></li>
                        <li class="list-group-item"><b>Harga Sewa:</b> Rp <?php echo number_format($data['venue']->price_per_hour, 0, ',', '.'); ?></li>
                    </ul>

                    <p class="mt-4">Pastikan semua data pesanan Anda sudah benar sebelum melanjutkan.</p>

                    <form action="<?php echo URLROOT; ?>/bookings/create" method="post">
                        <input type="hidden" name="venue_id" value="<?php echo $data['venue']->id; ?>">
                        <input type="hidden" name="booking_date" value="<?php echo $data['booking_date']; ?>">
                        <input type="hidden" name="start_time" value="<?php echo $data['start_time']; ?>">
                        <input type="hidden" name="end_time" value="<?php echo $data['end_time']; ?>">
                        <input type="hidden" name="total_price" value="<?php echo $data['venue']->price_per_hour; ?>">

                        <input type="submit" value="Konfirmasi & Pesan Sekarang" class="btn btn-success w-100">
                        <a href="<?php echo URLROOT; ?>/venues/show/<?php echo $data['venue']->id; ?>/<?php echo $data['booking_date']; ?>" class="btn btn-secondary w-100 mt-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>