<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/events">Main Bareng</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $data['event']->title; ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <h1 class="display-5"><?php echo $data['event']->title; ?></h1>
            <p class="lead">
                <span class="badge bg-primary"><?php echo $data['event']->sport_type; ?></span>
                <span class="badge bg-info text-dark"><?php echo $data['event']->skill_level; ?></span>
            </p>

            <hr>

            <h4>Tentang Mabar</h4>
            <p><?php echo nl2br($data['event']->description); // nl2br untuk menjaga format baris baru 
                ?></p>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body">
                    <?php if ($data['event']->cost_per_person <= 0): ?>
                        <h4 class="text-success">Gratis</h4>
                    <?php else: ?>
                        <h4>Rp <?php echo number_format($data['event']->cost_per_person, 0, ',', '.'); ?></h4>
                    <?php endif; ?>

                    <p class="text-muted">
                        <?php $sisa_slot = $data['event']->max_participants - $data['participant_count']; ?>
                        Tersisa <?php echo $sisa_slot; ?> slot dari <?php echo $data['event']->max_participants; ?>
                    </p>

                    <div class="d-grid">
                        <?php if (!isLoggedIn()): ?>
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-primary btn-lg">Login untuk Bergabung</a>

                        <?php elseif ($data['user_participation_status'] == 'pending'): ?>
                            <button class="btn btn-secondary btn-lg" disabled>Permintaan Terkirim</button>

                        <?php elseif ($data['user_participation_status'] == 'approved'): ?>
                            <button class="btn btn-success btn-lg" disabled>Anda Sudah Bergabung</button>

                        <?php elseif ($data['user_participation_status'] == 'rejected'): ?>
                            <button class="btn btn-danger btn-lg" disabled>Permintaan Ditolak</button>

                        <?php else: ?>
                            <form action="<?php echo URLROOT; ?>/events/join/<?php echo $data['event']->id; ?>" method="post">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Ajukan Permintaan Gabung</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <hr>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-calendar-event me-2"></i>
                            <strong>Waktu & Tanggal</strong><br>
                            <?php echo date('D, d M Y', strtotime($data['event']->event_date)); ?>, <?php echo date('H:i', strtotime($data['event']->start_time)); ?>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            <strong>Lapangan</strong><br>
                            <?php echo $data['event']->venue_name ?? 'Lokasi belum ditentukan'; ?>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    Penyelenggara: <?php echo $data['event']->creator_name ?? 'Admin'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>