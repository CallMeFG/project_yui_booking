<?php require APPROOT . '/views/includes/header.php'; ?>

<a href="<?php echo URLROOT; ?>" class="btn btn-light mb-3"><i class="fa fa-backward"></i> Kembali ke Daftar</a>
<br>
<h1 class="mb-3"><?php echo $data['venue']->name; ?></h1>

<div class="row">
    <div class="col-md-8">
        <img src="https://via.placeholder.com/800x400.png?text=Foto+<?php echo urlencode($data['venue']->name); ?>" class="img-fluid rounded mb-4" alt="Foto Venue">
        <h3>Deskripsi</h3>
        <p><?php echo $data['venue']->description; ?></p>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p class="card-text">Alamat: <?php echo $data['venue']->address; ?></p>
                <p class="card-text">Jam: <?php echo date('H:i', strtotime($data['venue']->opening_hour)); ?> - <?php echo date('H:i', strtotime($data['venue']->closing_hour)); ?></p>
                <p class="fs-5 fw-bold text-success">Rp <?php echo number_format($data['venue']->price_per_hour, 0, ',', '.'); ?> / jam</p>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card">
    <div class="card-header">
        <h3>Pilih Jadwal & Booking</h3>
    </div>
    <div class="card-body">
        <form id="date-form" method="GET">
            <div class="form-group mb-3">
                <label for="booking_date">Pilih Tanggal:</label>
                <input type="date" id="booking_date" name="booking_date" class="form-control" value="<?php echo $data['selected_date']; ?>">
            </div>
        </form>

        <div class="list-group">
            <?php foreach ($data['time_slots'] as $slot): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa fa-clock-o"></i> Jam <?php echo date('H:i', strtotime($slot['start_time'])); ?> - <?php echo date('H:i', strtotime($slot['end_time'])); ?>
                    </div>
                    <div>
                        <?php if ($slot['status'] == 'Tersedia'): ?>
                            <span class="badge bg-success">Tersedia</span>
                            <a href="<?php echo URLROOT; ?>/bookings/add/<?php echo $data['venue']->id; ?>/<?php echo $data['selected_date']; ?>/<?php echo $slot['start_time']; ?>" class="btn btn-primary btn-sm ms-2">Booking</a>
                        <?php else: ?>
                            <span class="badge bg-danger">Dipesan</span>
                            <button class="btn btn-secondary btn-sm ms-2" disabled>Booking</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('booking_date').addEventListener('change', function() {
        var selectedDate = this.value;
        var venueId = <?php echo $data['venue']->id; ?>;
        // Redirect ke URL baru dengan tanggal yang dipilih
        window.location.href = '<?php echo URLROOT; ?>/venues/show/' + venueId + '/' + selectedDate;
    });
</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>