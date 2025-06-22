<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manajemen Main Bareng</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?php echo URLROOT; ?>/admins/addMainBareng" class="btn btn-sm btn-success">
            <i class="bi bi-plus-lg"></i> Tambah Event Baru
        </a>
    </div>
</div>

<?php flash('event_message'); ?>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul Event</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Dibuat Oleh</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['events'])) : ?>
                <?php foreach ($data['events'] as $index => $event) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $event->title; ?></td>
                        <td><?php echo date('d M Y', strtotime($event->event_date)); ?></td>
                        <td><?php echo $event->venue_name; ?></td>
                        <td><?php echo $event->creator_name; ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/admins/manageEvent/<?php echo $event->id; ?>" class="btn btn-info btn-sm text-white"><i class="bi bi-people-fill"></i> Kelola Peserta</a>

                            <a href="<?php echo URLROOT; ?>/admins/editMainBareng/<?php echo $event->id; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="<?php echo URLROOT; ?>/admins/deleteMainBareng/<?php echo $event->id; ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada event yang dibuat.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>