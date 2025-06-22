<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<h1 class="h2 mb-4">Buat Event Main Bareng Baru</h1>

<div class="card">
    <div class="card-body">
        <form action="<?php echo URLROOT; ?>/admins/addMainBareng" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Event</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['event_title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sport_type" class="form-label">Jenis Olahraga</label>
                    <input type="text" name="sport_type" class="form-control" value="<?php echo $data['sport_type']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="skill_level" class="form-label">Level Keahlian</label>
                    <input type="text" name="skill_level" class="form-control" value="<?php echo $data['skill_level']; ?>" placeholder="Contoh: Newbie - Beginner">
                </div>
            </div>

            <div class="mb-3">
                <label for="venue_id" class="form-label">Pilih Lapangan</label>
                <select name="venue_id" class="form-select">
                    <option selected>Pilih salah satu...</option>
                    <?php foreach ($data['venues'] as $venue): ?>
                        <option value="<?php echo $venue->id; ?>"><?php echo $venue->name; ?> (<?php echo $venue->sport_type; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="event_date" class="form-label">Tanggal Event</label>
                    <input type="date" name="event_date" class="form-control" value="<?php echo $data['event_date']; ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="start_time" class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control" value="<?php echo $data['start_time']; ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_time" class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control" value="<?php echo $data['end_time']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="max_participants" class="form-label">Maksimal Peserta</label>
                    <input type="number" name="max_participants" class="form-control" value="<?php echo $data['max_participants']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cost_per_person" class="form-label">Biaya per Orang (Rp)</label>
                    <input type="number" name="cost_per_person" class="form-control" value="<?php echo $data['cost_per_person']; ?>" placeholder="Isi 0 jika gratis">
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi / Aturan Main</label>
                <textarea name="description" class="form-control" rows="5"><?php echo $data['description']; ?></textarea>
            </div>

            <hr>
            <button type="submit" class="btn btn-success">Simpan Event</button>
            <a href="<?php echo URLROOT; ?>/admins/mainBareng" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>