<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = $conn->query("SELECT * FROM products WHERE id = $id");
if ($result->num_rows == 0) {
    echo "<div class='alert alert-danger'>Produk tidak ditemukan.</div>";
    exit;
}
$p = $result->fetch_assoc();
?>

<div class="row justify-content-center" data-aos="fade-up">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark fw-bold fs-5 d-flex justify-content-between align-items-center">
                <span><i class="bi bi-pencil-square"></i> Edit Produk</span>
                <a href="index.php?page=admin" class="btn btn-sm btn-outline-dark fw-bold">Kembali</a>
            </div>
            <div class="card-body bg-light p-4">
                <form action="index.php?page=admin" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Produk *</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($p['name']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori *</label>
                            <select name="category_id" class="form-select" required>
                                <?php
                                $cats = $conn->query("SELECT * FROM categories");
                                while($c = $cats->fetch_assoc()):
                                    $selected = ($c['id'] == $p['category_id']) ? 'selected' : '';
                                ?>
                                    <option value="<?= $c['id'] ?>" <?= $selected ?>><?= $c['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Harga (Rp) *</label>
                            <input type="number" name="price" class="form-control" value="<?= $p['price'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status Stok *</label>
                            <select name="status" class="form-select">
                                <option value="tersedia" <?= ($p['status'] == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                <option value="habis" <?= ($p['status'] == 'habis') ? 'selected' : '' ?>>Habis</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Lengkap *</label>
                        <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($p['description']) ?></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" name="update_produk" class="btn btn-warning fw-bold px-4 shadow-sm text-dark">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>