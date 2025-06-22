<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="hero-sewa-lapangan text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">Sewa Lapangan</h1>
        <p class="fs-4">Temukan dan booking lapangan olahraga favoritmu di Pekanbaru!</p>
    </div>
</div>

<div class="container my-5">
    <div class="card filter-card p-3 mb-4">
        <form action="<?php echo URLROOT; ?>/venues" method="GET">
            <div class="row g-3 align-items-center">

                <div class="col-md-4">
                    <label for="sport_type" class="form-label fw-bold">Jenis Olahraga</label>
                    <select name="sport_type" id="sport_type" class="form-select">
                        <option value="">Semua</option>
                        <option value="Futsal" <?php echo (isset($_GET['sport_type']) && $_GET['sport_type'] == 'Futsal') ? 'selected' : ''; ?>>Futsal</option>
                        <option value="Badminton" <?php echo (isset($_GET['sport_type']) && $_GET['sport_type'] == 'Badminton') ? 'selected' : ''; ?>>Badminton</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sort" class="form-label fw-bold">Urutkan</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="default" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'default') ? 'selected' : ''; ?>>Default</option>
                        <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Harga Terendah</option>
                        <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Harga Tertinggi</option>
                        <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') ? 'selected' : ''; ?>>Nama A-Z</option>
                        <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') ? 'selected' : ''; ?>>Nama Z-A</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                </div>

            </div>
        </form>
    </div>

    <div class="mb-4">
        <p class="text-muted">Menampilkan <?php echo count($data['venues']); ?> venue tersedia.</p>
    </div>

    <div class="row">
        <?php if (!empty($data['venues'])) : ?>
            <?php foreach ($data['venues'] as $venue) : ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="https://via.placeholder.com/400x250.png?text=<?php echo urlencode($venue->name); ?>" class="card-img-top" alt="<?php echo $venue->name; ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $venue->name; ?></h5>
                            <p class="card-text text-muted"><?php echo $venue->sport_type; ?></p>
                            <p class="card-text fw-bold">Rp <?php echo number_format($venue->price_per_hour, 0, ',', '.'); ?> / jam</p>
                            <div class="mt-auto">
                                <a href="<?php echo URLROOT; ?>/venues/show/<?php echo $venue->id; ?>" class="btn btn-primary w-100">Lihat Detail & Jadwal</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Tidak ada lapangan yang sesuai dengan kriteria Anda.</p>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>