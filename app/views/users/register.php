<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="auth-page-bg d-flex align-items-center py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-5 offset-md-5 offset-lg-7">

                <div class="form-auth-card">
                    <h2>Buat Akun Baru</h2>
                    <p class="text-muted">Silakan isi form di bawah ini untuk mendaftar.</p>

                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <?php flash('register_fail'); ?>

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap: <sup>*</sup></label>
                            <input type="text" name="full_name" class="form-control <?php echo (!empty($data['full_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['full_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['full_name_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email: <sup>*</sup></label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Ponsel:</label>
                            <input type="text" name="phone_number" class="form-control <?php echo (!empty($data['phone_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone_number']; ?>">
                            <span class="invalid-feedback"><?php echo $data['phone_number_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password: <sup>*</sup></label>
                            <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <div class="progress mt-2 progress-password">
                                <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password: <sup>*</sup></label>
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light">Sudah punya akun? Login</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength-bar');

        passwordInput.addEventListener('keyup', function() {
            const password = passwordInput.value;
            let strength = 0;

            // Cek kriteria kekuatan password
            if (password.length >= 8) strength += 1; // Minimal 8 karakter
            if (password.match(/[a-z]/)) strength += 1; // Huruf kecil
            if (password.match(/[A-Z]/)) strength += 1; // Huruf besar
            if (password.match(/[0-9]/)) strength += 1; // Angka
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1; // Simbol

            // Update progress bar
            let strengthPercentage = (strength / 5) * 100;
            strengthBar.style.width = strengthPercentage + '%';
            strengthBar.setAttribute('aria-valuenow', strengthPercentage);

            // Update warna bar
            strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
            if (strengthPercentage <= 40) {
                strengthBar.classList.add('bg-danger');
            } else if (strengthPercentage <= 80) {
                strengthBar.classList.add('bg-warning');
            } else {
                strengthBar.classList.add('bg-success');
            }
        });
    });
</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>