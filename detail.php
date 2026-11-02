<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$res = $conn->query("SELECT products.*, categories.name as cat_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.id = $id");
if($res->num_rows == 0): echo "<div class='alert alert-danger'>Produk tidak ditemukan.</div>"; else:
    $row = $res->fetch_assoc();
    $imgSrc = empty($row['image']) ? "https://placehold.co/400x300?text=Foto+Menyusul" : "uploads/".$row['image'];
    $pesanWA = "Halo Admin Meow PetShop! Saya tertarik dengan produk ini:%0A%0A*Nama:* ".$row['name']."%0A*Harga:* Rp ".number_format($row['price'], 0, ',', '.')."%0A%0AApakah masih bisa dipesan?";
?>
<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="index.php?page=products" class="text-warning fw-bold text-decoration-none">Katalog</a></li><li class="breadcrumb-item active"><?= $row['name'] ?></li></ol></nav>
<div class="card shadow-sm border-0 bg-light p-3" data-aos="zoom-in">
    <div class="row g-0">
        <div class="col-md-5 text-center">
            <img src="<?= $imgSrc ?>" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
        </div>
        <div class="col-md-7 ps-md-4 mt-3 mt-md-0">
            <span class="badge bg-secondary mb-2"><?= $row['cat_name'] ?></span>
            <h2 class="card-title fw-bold"><?= $row['name'] ?></h2>
            <h3 class="text-danger fw-bold my-3">Rp <?= number_format($row['price'], 0, ',', '.') ?></h3>
            <p><strong>Status: </strong> <?= $row['status'] == 'tersedia' ? '<span class="badge bg-success">Tersedia</span>' : '<span class="badge bg-danger">Habis</span>' ?></p>
            <h5 class="mt-4 fw-bold border-bottom pb-2">Deskripsi Produk</h5>
            <p style="white-space: pre-wrap;"><?= htmlspecialchars($row['description']) ?></p>
            <div class="mt-4 pt-3 border-top">
                <?php if($row['status'] == 'tersedia'): ?>
                    <a href="https://wa.me/<?= $nomor_whatsapp ?>?text=<?= $pesanWA ?>" target="_blank" class="btn btn-success btn-lg shadow-sm"><i class="bi bi-whatsapp"></i> Beli via WhatsApp</a>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg shadow-sm" disabled>Stok Habis</button>
                <?php endif; ?>
                <a href="index.php?page=products" class="btn btn-outline-dark btn-lg ms-2">Kembali</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>