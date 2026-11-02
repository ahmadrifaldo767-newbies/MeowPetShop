<?php
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$cat_filter = isset($_GET['category']) ? (int)$_GET['category'] : '';

$q = "SELECT products.*, categories.name as cat_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE 1=1";
if ($search != '') {
    $q .= " AND products.name LIKE '%$search%'";
}
if ($cat_filter != '') {
    $q .= " AND products.category_id = $cat_filter";
}
$q .= " ORDER BY products.id DESC";
$products = $conn->query($q);
?>

<h2 class="mb-4 fw-bold" data-aos="fade-right">Katalog Produk</h2>
<div class="row mb-4" data-aos="fade-up">
    <div class="col-md-6 mb-3">
        <form action="index.php" method="GET" class="d-flex">
            <input type="hidden" name="page" value="products">
            <input type="text" name="search" class="form-control me-2 shadow-sm" placeholder="Cari nama produk..." value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-warning fw-bold shadow-sm" type="submit">Cari</button>
        </form>
    </div>
    <div class="col-md-6 mb-3">
        <div class="d-flex justify-content-md-end gap-2 overflow-auto py-1">
            <a href="index.php?page=products" class="btn <?= ($cat_filter=='') ? 'btn-dark' : 'btn-outline-dark' ?> btn-sm shadow-sm">Semua</a>
            <?php
            $cats = $conn->query("SELECT * FROM categories");
            while($c = $cats->fetch_assoc()):
            ?>
                <a href="index.php?page=products&category=<?= $c['id'] ?>" class="btn <?= ($cat_filter==$c['id']) ? 'btn-dark' : 'btn-outline-dark' ?> btn-sm shadow-sm"><?= $c['name'] ?></a>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<div class="row">
    <?php
    if($products->num_rows > 0):
        while($row = $products->fetch_assoc()): 
            $imgSrc = empty($row['image']) ? "https://placehold.co/400x300?text=Foto+Menyusul" : "uploads/".$row['image'];
    ?>
    <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up">
        <div class="card h-100 shadow-sm border-0 bg-light">
            <img src="<?= $imgSrc ?>" class="card-img-top product-img rounded-top" alt="<?= htmlspecialchars($row['name']) ?>">
            <div class="card-body">
                <span class="badge bg-secondary mb-2"><?= $row['cat_name'] ?></span>
                <h5 class="card-title fw-bold"><?= htmlspecialchars($row['name']) ?></h5>
                <h6 class="text-danger fw-bold">Rp <?= number_format($row['price'], 0, ',', '.') ?></h6>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0">
                <a href="index.php?page=detail&id=<?= $row['id'] ?>" class="btn btn-outline-warning text-dark fw-bold w-100 shadow-sm">Detail Produk</a>
            </div>
        </div>
    </div>
    <?php 
        endwhile; 
    else: 
    ?>
        <div class="col-12"><div class="alert alert-secondary shadow-sm">Produk tidak ditemukan.</div></div>
    <?php endif; ?>
</div>