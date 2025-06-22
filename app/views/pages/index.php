<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="hero-section">
    <div class="container">
        <h1 class="display-4">BOOKING LAPANGAN ONLINE TERBAIK</h1>
        <p class="lead">Platform all-in-one untuk sewa lapangan, cari lawan sparring, atau cari kawan main bareng.</p>
    </div>
</div>

<div class="container mt-5">
    <?php flash('booking_success'); ?>

    <section class="text-center py-5">
        <h2 class="mb-5">Booking Mudah Dalam 3 Langkah</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="bi bi-search display-6 text-primary mb-3"></i>
                    <h5 class="mb-3">1. Cari Lapangan</h5>
                    <p class="text-muted">Temukan lapangan olahraga favorit Anda berdasarkan lokasi dan jenis olahraga.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="bi bi-calendar-check display-6 text-primary mb-3"></i>
                    <h5 class="mb-3">2. Pilih Jadwal</h5>
                    <p class="text-muted">Lihat ketersediaan jadwal secara real-time dan pilih waktu yang Anda inginkan.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <i class="bi bi-credit-card display-6 text-primary mb-3"></i>
                    <h5 class="mb-3">3. Bayar & Main</h5>
                    <p class="text-muted">Lakukan pembayaran dengan aman dan dapatkan konfirmasi instan untuk bermain.</p>
                </div>
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section class="mb-5">
        <h2 class="text-center">Sewa Lapangan</h2>
        <p class="text-center text-muted mb-4">Pilih dari ratusan lapangan berkualitas yang tersedia.</p>
        <div class="row">
            <?php if (!empty($data['venues'])) : ?>
                <?php foreach ($data['venues'] as $venue) : ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/400x250.png?text=<?php echo urlencode($venue->name); ?>" class="card-img-top" alt="<?php echo $venue->name; ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $venue->name; ?></h5>
                                <p class="card-text text-muted"><?php echo $venue->sport_type; ?></p>
                                <div class="mt-auto">
                                    <a href="<?php echo URLROOT; ?>/venues/show/<?php echo $venue->id; ?>" class="btn btn-primary w-100">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Belum ada lapangan yang tersedia.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo URLROOT; ?>/venues" class="btn btn-outline-primary">Lihat Semua Lapangan</a>
        </div>
    </section>

    <hr class="my-5">

    <section class="mb-5">
        <h2 class="text-center">Main Bareng</h2>
        <p class="text-center text-muted mb-4">Tidak punya teman main? Gabung saja dengan event yang ada!</p>
        <div class="row justify-content-center">
            <?php if (!empty($data['events'])) : ?>
                <?php $limitedEvents = array_slice($data['events'], 0, 2); ?>
                <?php foreach ($limitedEvents as $event) : ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $event->title; ?></h5>
                                <p class="card-text">
                                    <small class="text-muted"><?php echo $event->sport_type; ?> - <?php echo $event->skill_level; ?></small>
                                </p>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="bi bi-calendar-event me-2"></i><?php echo date('D, d M Y', strtotime($event->event_date)); ?></li>
                                    <li><i class="bi bi-geo-alt me-2"></i><?php echo $event->venue_name; ?></li>
                                </ul>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="<?php echo URLROOT; ?>/events/show/<?php echo $event->id; ?>" class="btn btn-primary w-100">Lihat Detail & Gabung</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Belum ada event yang tersedia.</p>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo URLROOT; ?>/events" class="btn btn-outline-primary">Lihat Semua Event</a>
        </div>
    </section>

    <hr class="my-5">

    <section class="py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Tentang YUI BOOKING</h2>
                <p class="lead text-muted">YUI BOOKING adalah platform komunitas olahraga yang memudahkan Anda untuk menyalurkan hobi dan menjaga kebugaran.</p>
                <p class="text-muted">Kami berdedikasi untuk menghubungkan para pegiat olahraga dengan fasilitas terbaik serta komunitas yang positif. Misi kami adalah membuat olahraga lebih mudah diakses dan menyenangkan bagi semua orang di Pekanbaru. Temukan lapangan, acara, dan teman bermain di satu tempat.</p>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1551649219-3c8734a717b6?q=80&w=1770" class="img-fluid rounded shadow" alt="Tim olahraga sedang berdiskusi">
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section class="py-5 bg-light mb-5">
        <div class=" container">
        <h2 class="text-center mb-5">Apa Kata Mereka?</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>"Booking lapangan badminton lewat YUI BOOKING gampang banget! Nggak perlu telepon-telepon lagi, semua jadwal kelihatan jelas. Mantap!"</p>
                        </blockquote>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <img src="https://i.pravatar.cc/150?img=1" alt="User Testimonial" class="testimonial-img me-3">
                        <div>
                            <h6 class="mb-0">Budi Santoso</h6>
                            <small class="text-muted">Pemain Badminton</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card testimonial-card h-100">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>"Fitur 'Main Bareng' sangat membantu saya yang baru pindah ke Pekanbaru. Jadi punya banyak teman futsal baru. Terima kasih YUI BOOKING!"</p>
                        </blockquote>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <img src="https://i.pravatar.cc/150?img=2" alt="User Testimonial" class="testimonial-img me-3">
                        <div>
                            <h6 class="mb-0">Citra Lestari</h6>
                            <small class="text-muted">Pengguna Aktif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>

</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>