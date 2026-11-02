<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <h2 class="fw-bold">Dashboard Admin</h2>
    <a href="index.php?page=admin_categories" class="btn btn-dark fw-bold shadow-sm">Atur Kategori</a>
</div>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'add_success'): ?>
    <div class="alert alert-success fw-bold shadow-sm"><i class="bi bi-check-circle"></i> Produk baru berhasil diunggah!</div>
<?php endif; ?>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'update_success'): ?>
    <div class="alert alert-success fw-bold shadow-sm"><i class="bi bi-check-circle"></i> Produk berhasil diperbarui!</div>
<?php endif; ?>

<div class="card mb-5 shadow-sm border-0" data-aos="fade-up">
    <div class="card-header bg-warning text-dark fw-bold fs-5">
        <i class="bi bi-box-seam"></i> Tambah Produk Baru
    </div>
    <div class="card-body bg-light">
        <form action="index.php?page=admin" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Produk *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kategori *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Pilih Kategori...</option>
                        <?php
                        $cats = $conn->query("SELECT * FROM categories");
                        while($c = $cats->fetch_assoc()):
                        ?>
                            <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Harga (Rp) *</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Status Stok *</label>
                    <select name="status" class="form-select">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Upload Foto (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Deskripsi Lengkap (Ukuran, bahan, dll)</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" name="tambah_produk" class="btn btn-primary fw-bold px-4 shadow-sm">Simpan Produk</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0" data-aos="fade-up" data-aos-delay="100">
    <div class="card-header bg-dark text-white fw-bold fs-5">Daftar Produk yang Dijual</div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-secondary">
                <tr>
                    <th class="ps-3">Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = $conn->query("SELECT products.*, categories.name as cat_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY id DESC");
                if($products->num_rows > 0):
                    while($row = $products->fetch_assoc()):
                ?>
                <tr>
                    <td class="ps-3">
                        <?php if(!empty($row['image'])): ?>
                            <img src="uploads/<?= $row['image'] ?>" width="60" height="60" class="rounded shadow-sm" style="object-fit:cover;">
                        <?php else: ?>
                            <span class="badge bg-secondary">Kosong</span>
                        <?php endif; ?>
                    </td>
                    <td class="fw-bold"><?= $row['name'] ?></td>
                    <td><?= $row['cat_name'] ?></td>
                    <td class="text-danger fw-bold">Rp <?= number_format($row['price'],0,',','.') ?></td>
                    <td>
                        <?= $row['status'] == 'tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Habis</span>' ?>
                    </td>
                    <td class="text-center">
                        <a href="index.php?page=edit_product&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a href="index.php?action=delete_product&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin ingin menghapus produk ini?');"><i class="bi bi-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada produk. Silakan tambah di atas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>