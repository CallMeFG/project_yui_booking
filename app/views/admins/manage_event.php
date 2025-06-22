<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<h1 class="h2 mb-4">Kelola Event: <?php echo $data['event']->title; ?></h1>

<div class="card">
    <div class="card-header">
        Daftar Pendaftar
    </div>
    <div class="card-body">
        <?php flash('participant_message'); ?>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pendaftar</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['participants'])): ?>
                    <?php foreach ($data['participants'] as $index => $participant): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $participant->full_name; ?></td>
                            <td>
                                <span class="badge bg-<?php
                                                        if ($participant->status == 'approved') echo 'success';
                                                        elseif ($participant->status == 'pending') echo 'warning';
                                                        else echo 'danger';
                                                        ?>"><?php echo ucfirst($participant->status); ?></span>
                            </td>
                            <td class="text-center">
                                <?php if ($participant->status == 'pending'): ?>
                                    <form action="<?php echo URLROOT; ?>/admins/updateParticipantStatus" method="post" class="d-inline">
                                        <input type="hidden" name="participant_id" value="<?php echo $participant->id; ?>">
                                        <input type="hidden" name="event_id" value="<?php echo $data['event']->id; ?>">
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="<?php echo URLROOT; ?>/admins/updateParticipantStatus" method="post" class="d-inline">
                                        <input type="hidden" name="participant_id" value="<?php echo $participant->id; ?>">
                                        <input type="hidden" name="event_id" value="<?php echo $data['event']->id; ?>">
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada pendaftar untuk event ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php require APPROOT . '/views/admins/includes/footer.php'; ?>