<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manajemen Lapangan</h1>
    <?php flash('venue_message'); ?>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?php echo URLROOT; ?>/admins/addVenue" class="btn btn-sm btn-success">
            <i class="bi bi-plus-lg"></i> Tambah Lapangan
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Lapangan</th>
                <th scope="col">Jenis Olahraga</th>
                <th scope="col">Harga / Jam</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['venues'] as $index => $venue) : ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $venue->name; ?></td>
                    <td><?php echo $venue->sport_type; ?></td>
                    <td>Rp <?php echo number_format($venue->price_per_hour, 0, ',', '.'); ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/admins/editVenue/<?php echo $venue->id; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                        <form action="<?php echo URLROOT; ?>/admins/deleteVenue/<?php echo $venue->id; ?>" method="post" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>