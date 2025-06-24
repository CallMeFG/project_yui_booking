<?php require APPROOT . '/views/dashboard/header.php'; ?>

<h1 class="h2">Dashboard</h1>
<p>Selamat datang kembali, <strong><?php echo $_SESSION['user_name']; ?></strong>!</p>

<hr>

<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <a href="<?php echo URLROOT; ?>/venues" class="btn btn-primary btn-lg w-100 p-4 d-flex align-items-center justify-content-center">
            <i class="bi bi-plus-circle-fill me-2"></i> Booking Lapangan Baru
        </a>
    </div>
    <div class="col-md-6 mb-3">
        <a href="<?php echo URLROOT; ?>/events" class="btn btn-info btn-lg w-100 p-4 d-flex align-items-center justify-content-center text-dark">
            <i class="bi bi-search me-2"></i> Cari & Gabung Event
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Booking Akan Datang</div>
            <div class="card-body">
                <h5 class="card-title">2</h5>
                <p class="card-text">Anda memiliki 2 booking yang dijadwalkan.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header text-dark">Event Akan Datang</div>
            <div class="card-body text-dark">
                <h5 class="card-title">1</h5>
                <p class="card-text">Anda terdaftar dalam 1 event main bareng.</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/dashboard/footer.php'; ?>