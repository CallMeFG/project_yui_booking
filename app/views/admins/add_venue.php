<?php require APPROOT . '/views/admins/includes/header.php'; ?>

<h1 class="h2 mb-4">Tambah Lapangan Baru</h1>

<div class="card">
    <div class="card-body">
        <form action="<?php echo URLROOT; ?>/admins/addVenue" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lapangan</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="mb-3">
                <label for="sport_type" class="form-label">Jenis Olahraga</label>
                <input type="text" name="sport_type" class="form-control" value="<?php echo $data['sport_type']; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea name="address" class="form-control"><?php echo $data['address']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control"><?php echo $data['description']; ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="price_per_hour" class="form-label">Harga / Jam</label>
                    <input type="number" name="price_per_hour" class="form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price_per_hour']; ?>">
                    <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="opening_hour" class="form-label">Jam Buka</label>
                    <input type="time" name="opening_hour" class="form-control" value="<?php echo $data['opening_hour']; ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="closing_hour" class="form-label">Jam Tutup</label>
                    <input type="time" name="closing_hour" class="form-control" value="<?php echo $data['closing_hour']; ?>">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan Lapangan</button>
            <a href="<?php echo URLROOT; ?>/admins/venues" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/admins/includes/footer.php'; ?>