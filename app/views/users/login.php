<?php require APPROOT . '/views/includes/header.php'; ?>


<div class="auth-page-bg d-flex align-items-center py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-5 offset-md-5 offset-lg-7">
                <!-- ✅ Batasi lebar form agar sama dengan register -->
                <div class="form-auth-card">
                    <h2 class="mb-4 fw-bold">Login</h2>
                    <p class="mb-4">Silakan isi form di bawah untuk masuk.</p>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: *</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password: *</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light">Belum punya akun? Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>