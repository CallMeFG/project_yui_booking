<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="hero-contact text-center">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Punya pertanyaan atau masukan? Kami siap membantu Anda.</p>
    </div>
</div>


<div class="container my-5">
    <div class="row">
    
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="mb-4">Informasi Kontak</h3>
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-geo-alt-fill fs-4 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-0">Alamat</h5>
                            <p class="text-muted">Jl. Jenderal Sudirman No. 123, Pekanbaru, Riau</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-envelope-fill fs-4 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-0">Email</h5>
                            <p class="text-muted">contact@yuibooking.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <i class="bi bi-telephone-fill fs-4 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-0">Telepon</h5>
                            <p class="text-muted">+62 812 3456 7890</p>
                        </div>
                    </div>

                    <h4 class="mb-3 mt-5">Lokasi Kami</h4>
                    <div class="map-responsive shadow">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15986.389591463138!2d101.43933554035677!3d0.5094248950682249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac1a27c30e51%3A0x211g491b82b3a391!2sPekanbaru%2C%20Kota%20Pekanbaru%2C%20Riau!5e0!3m2!1sid!2sid!4v1672825946153!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="mb-4">Kirim Pesan</h3>

                    <?php flash('contact_success'); ?>

                    <form action="<?php echo URLROOT; ?>/pages/contact" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control <?php echo (!empty($data['subject_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="subject" value="<?php echo $data['subject']; ?>">
                            <span class="invalid-feedback"><?php echo $data['subject_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control <?php echo (!empty($data['message_err'])) ? 'is-invalid' : ''; ?>" id="message" name="message" rows="5"><?php echo $data['message']; ?></textarea>
                            <span class="invalid-feedback"><?php echo $data['message_err']; ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>