<?php require APPROOT . '/views/dashboard/header.php'; ?>

<h1 class="h2">Riwayat Sewa Lapangan</h1>
<p>Berikut adalah semua riwayat booking lapangan yang pernah Anda lakukan.</p>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID Booking</th>
                <th>Nama Lapangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>BK-001</td>
                <td>Garuda Futsal</td>
                <td>2025-07-15</td>
                <td>19:00</td>
                <td><span class="badge bg-success">Selesai</span></td>
            </tr>
            <tr>
                <td>BK-002</td>
                <td>Riau Badminton Center</td>
                <td>2025-07-20</td>
                <td>10:00</td>
                <td><span class="badge bg-primary">Akan Datang</span></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/dashboard/footer.php'; ?>