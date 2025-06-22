<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manajemen User</h1>
</div>

<?php flash('user_message'); ?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">No. Telepon</th>
                <th scope="col">Peran (Role)</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $index => $user) : ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $user->full_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone_number; ?></td>
                    <td>
                        <?php
                        // Logika baru untuk warna badge status
                        $roleClass = 'bg-secondary'; // Default untuk customer
                        if ($user->role == 'admin') {
                            $roleClass = 'bg-danger';
                        } elseif ($user->role == 'staff') {
                            $roleClass = 'bg-info'; // Warna baru untuk staff
                        }
                        ?>
                        <span class="badge <?php echo $roleClass; ?>">
                            <?php echo $user->role; ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($user->id != $_SESSION['user_id']): ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ubah Peran
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="<?php echo URLROOT; ?>/admins/updateUserRole" method="post" class="dropdown-item p-0">
                                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                            <input type="hidden" name="role" value="admin">
                                            <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">Jadikan Admin</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="<?php echo URLROOT; ?>/admins/updateUserRole" method="post" class="dropdown-item p-0">
                                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                            <input type="hidden" name="role" value="staff">
                                            <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">Jadikan Staff</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="<?php echo URLROOT; ?>/admins/updateUserRole" method="post" class="dropdown-item p-0">
                                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                                            <input type="hidden" name="role" value="customer">
                                            <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start">Jadikan Customer</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <form action="<?php echo URLROOT; ?>/admins/deleteUser/<?php echo $user->id; ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        <?php else: ?>
                            (Akun Anda)
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>