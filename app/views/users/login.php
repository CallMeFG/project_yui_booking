<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="auth-page-bg d-flex align-items-center py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-5 offset-md-5 offset-lg-7">

                <div class="form-auth-card">
                    <h2 class="fw-bold">Login</h2>
                    <p class="text-muted mb-4">Selamat datang kembali! Silakan masuk ke akun Anda.</p>

                    <?php flash('register_success'); ?>
                    <?php flash('login_fail'); ?>

                    <form action="<?php echo URLROOT; ?>/users/login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password: <sup>*</sup></label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>

                        <div class="d-grid gap-2 mt-4">
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