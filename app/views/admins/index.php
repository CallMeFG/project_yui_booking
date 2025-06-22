<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<h1 class="h2">Dashboard</h1>
<p>Selamat datang di area admin, <?php echo $_SESSION['user_name']; ?>.</p>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <h5 class="card-title">Total Lapangan</h5>
                <p class="card-text fs-4">5</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Booking Bulan Ini</h5>
                <p class="card-text fs-4">20</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>