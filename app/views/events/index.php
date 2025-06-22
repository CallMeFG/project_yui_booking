<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="hero-main-bareng text-center">
    <div class="container">
        <h1>Main Bareng</h1>
        <p>Temukan teman bermain baru dan gabung dalam event olahraga yang seru!</p>
    </div>
</div>

<div class="container my-5">
    <div class="d-grid gap-2 mb-4">
        <a href="<?php echo URLROOT; ?>/events/add" class="btn btn-primary btn-lg">Buat Event Baru</a>
    </div>

    <div class="card filter-card p-3 mb-4">
        <form action="<?php echo URLROOT; ?>/events" method="GET">
            <div class="row g-3 align-items-center">
                <div class="col-md-3">
                    <label for="sport_type" class="form-label fw-bold">Jenis Olahraga</label>
                    <select name="sport_type" id="sport_type" class="form-select">
                        <option value="">Semua</option>
                        <option value="Futsal">Futsal</option>
                        <option value="Badminton">Badminton</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="skill_level" class="form-label fw-bold">Tingkat Keahlian</label>
                    <select name="skill_level" id="skill_level" class="form-select">
                        <option value="">Semua</option>
                        <option value="newbie-beginner">Newbie-Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="sort" class="form-label fw-bold">Urutkan</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="date_asc">Tanggal Terdekat</option>
                        <option value="date_desc">Tanggal Terjauh</option>
                        <option value="cost_asc">Biaya Terendah</option>
                        <option value="cost_desc">Biaya Tertinggi</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mb-4">
        <p class="text-muted">Menampilkan <?php echo count($data['events']); ?> event tersedia.</p>
    </div>

    <div class="row">
        <?php if (!empty($data['events'])) : ?>
            <?php foreach ($data['events'] as $event) : ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $event->title; ?></h5>
                            <p class="card-text">
                                <span class="badge bg-secondary"><?php echo $event->sport_type; ?></span>
                                <span class="badge bg-info text-dark"><?php echo $event->skill_level; ?></span>
                            </p>
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-1"><i class="bi bi-calendar-event me-2"></i><?php echo date('D, d M Y', strtotime($event->event_date)); ?></li>
                                <li class="mb-1"><i class="bi bi-clock me-2"></i><?php echo date('H:i', strtotime($event->start_time)); ?> - <?php echo date('H:i', strtotime($event->end_time)); ?></li>
                                <li class="mb-1"><i class="bi bi-geo-alt me-2"></i><?php echo $event->venue_name; ?></li>
                                <li class="mb-1"><i class="bi bi-cash me-2"></i>
                                    <?php if ($event->cost_per_person > 0) : ?>
                                        Rp <?php echo number_format($event->cost_per_person, 0, ',', '.'); ?> / orang
                                    <?php else : ?>
                                        Gratis
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-primary w-100">Lihat Detail & Gabung</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col">
                <p class="text-center">Tidak ada event yang sesuai dengan kriteria Anda.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>