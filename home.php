<!-- BANNER / HERO SECTION -->
<div class="p-5 text-center bg-body rounded-4 mb-5 border shadow-sm" data-aos="zoom-in">
    <h1 class="mb-3 fw-bold text-dark">Temukan Kebutuhan Kucing Kesayanganmu!</h1>
    <p class="text-muted mb-4">Cari makanan, mainan, pasir, dan berbagai perlengkapan anabul berkualitas.</p>
    <form action="index.php" method="GET" class="d-flex justify-content-center mx-auto" style="max-width: 600px;">
        <input type="hidden" name="page" value="products">
        <input type="text" name="search" class="form-control form-control-lg me-2 shadow-sm" placeholder="Cari produk atau aksesoris..." required>
        <button type="submit" class="btn btn-warning btn-lg fw-bold px-4 shadow-sm text-dark">Cari</button>
    </form>
</div>

<!-- SECTION PRODUK TERBARU -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Produk Terbaru</h3>
        <a href="index.php?page=products" class="btn btn-outline-dark fw-bold btn-sm shadow-sm">Lihat Semua Katalog</a>
    </div>

    <div class="row">
        <?php
        $res = $conn->query("SELECT products.*, categories.name as cat_name FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC LIMIT 6");
        if($res->num_rows > 0):
            while($row = $res->fetch_assoc()):
                $imgSrc = empty($row['image']) ? "https://placehold.co/400x300?text=Foto+Menyusul" : "uploads/".$row['image'];
        ?>
        <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 shadow-sm border-0 bg-white rounded-3 overflow-hidden">
                <img src="<?= $imgSrc ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($row['name']) ?>">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-secondary mb-2 align-self-start"><?= $row['cat_name'] ?></span>
                    <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($row['name']) ?></h5>
                    <h6 class="text-danger fw-bold mb-3">Rp <?= number_format($row['price'], 0, ',', '.') ?></h6>
                    <p class="card-text small mt-auto mb-2">
                        Status: <?= $row['status'] == 'tersedia' ? '<span class="text-success fw-bold">Tersedia</span>' : '<span class="text-danger fw-bold">Habis</span>' ?>
                    </p>
                </div>
                <div class="card-footer bg-white border-top-0 pb-3 pt-0">
                    <a href="index.php?page=detail&id=<?= $row['id'] ?>" class="btn btn-outline-warning text-dark fw-bold w-100 shadow-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
            <div class='col-12'><div class="alert alert-secondary text-center shadow-sm">Belum ada produk saat ini.</div></div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4" data-aos="fade-up">
        <a href="index.php?page=products" class="btn btn-warning fw-bold px-5 py-3 shadow-sm text-dark fs-5 rounded-pill">Lihat Produk Lainnya</a>
    </div>
</div>