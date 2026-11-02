<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <h2 class="fw-bold">Kelola Kategori</h2>
    <a href="index.php?page=admin" class="btn btn-outline-dark fw-bold shadow-sm">Kembali ke Produk</a>
</div>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'add_success'): ?>
    <div class="alert alert-success fw-bold shadow-sm">Kategori baru berhasil ditambahkan!</div>
<?php endif; ?>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'update_success'): ?>
    <div class="alert alert-success fw-bold shadow-sm">Kategori berhasil diperbarui!</div>
<?php endif; ?>

<?php
// Cek apakah sedang dalam mode edit
$edit_mode = false;
$edit_data = ['id' => '', 'name' => ''];
if (isset($_GET['action']) && $_GET['action'] == 'edit_category') {
    $edit_id = (int)$_GET['id'];
    $res_edit = $conn->query("SELECT * FROM categories WHERE id = $edit_id");
    if ($res_edit->num_rows > 0) {
        $edit_mode = true;
        $edit_data = $res_edit->fetch_assoc();
    }
}
?>

<div class="row">
    <!-- FORM TAMBAH / EDIT KATEGORI -->
    <div class="col-md-5 mb-4" data-aos="fade-right">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning fw-bold text-dark fs-5">
                <?= $edit_mode ? 'Edit Kategori' : 'Tambah Kategori' ?>
            </div>
            <div class="card-body bg-light">
                <form action="index.php?page=admin_categories" method="POST">
                    <?php if ($edit_mode): ?>
                        <input type="hidden" name="category_id" value="<?= $edit_data['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold"><?= $edit_mode ? 'Nama Kategori' : 'Nama Kategori Baru' ?></label>
                        <input type="text" name="category_name" class="form-control" required value="<?= htmlspecialchars($edit_data['name']) ?>" placeholder="Contoh: Obat Kucing">
                    </div>

                    <?php if ($edit_mode): ?>
                        <button type="submit" name="update_kategori" class="btn btn-success w-100 fw-bold shadow-sm mb-2">Simpan Perubahan</button>
                        <a href="index.php?page=admin_categories" class="btn btn-outline-secondary w-100 fw-bold shadow-sm">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah_kategori" class="btn btn-primary w-100 fw-bold shadow-sm">Simpan Kategori</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- TABEL DAFTAR KATEGORI -->
    <div class="col-md-7" data-aos="fade-left">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white fw-bold fs-5">Daftar Kategori</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th class="ps-4">No ID</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cats = $conn->query("SELECT * FROM categories ORDER BY id ASC");
                        if($cats->num_rows > 0):
                            while($c = $cats->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="ps-4 fw-bold"><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['name']) ?></td>
                            <td class="text-center">
                                <a href="index.php?page=admin_categories&action=edit_category&id=<?= $c['id'] ?>" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr><td colspan="3" class="text-center py-3 text-muted">Belum ada kategori.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>