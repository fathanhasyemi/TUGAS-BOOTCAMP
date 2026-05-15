<?php
require_once __DIR__ . '/koneksi.php';

if (!isset($conn) || !$conn) {
    die('Koneksi database gagal. Periksa file koneksi.php dan konfigurasi database Anda.');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$tableExists = mysqli_query($conn, "SHOW TABLES LIKE 'products'");
if (!$tableExists || mysqli_num_rows($tableExists) === 0) {
    die('Tabel products belum tersedia. Import file ecommerce_db.sql terlebih dahulu.');
}

mysqli_query($conn, "ALTER TABLE products ADD COLUMN IF NOT EXISTS kategori VARCHAR(100) DEFAULT 'Lainnya'");

$productCountResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$productCount = (int) mysqli_fetch_assoc($productCountResult)['total'];

if ($productCount < 6) {
    $defaultProducts = [
        ['nama' => 'Laptop Gaming', 'harga' => 15000000, 'deskripsi' => 'Laptop gaming performa tinggi untuk game dan multimedia.', 'stok' => 10, 'kategori' => 'Elektronik'],
        ['nama' => 'Sneakers Putih', 'harga' => 450000, 'deskripsi' => 'Sneakers nyaman untuk kegiatan sehari-hari dan olahraga ringan.', 'stok' => 18, 'kategori' => 'Fashion'],
        ['nama' => 'Headphone Wireless', 'harga' => 850000, 'deskripsi' => 'Headphone bluetooth dengan suara jernih dan bass mantap.', 'stok' => 7, 'kategori' => 'Aksesoris'],
        ['nama' => 'Tas Ransel', 'harga' => 320000, 'deskripsi' => 'Tas ransel stylish dan kuat untuk kerja atau jalan-jalan.', 'stok' => 12, 'kategori' => 'Fashion'],
        ['nama' => 'Smartwatch', 'harga' => 950000, 'deskripsi' => 'Smartwatch pintar dengan fitur monitoring kesehatan.', 'stok' => 9, 'kategori' => 'Elektronik'],
        ['nama' => 'Lampu Meja LED', 'harga' => 230000, 'deskripsi' => 'Lampu meja modern dengan pengaturan kecerahan.', 'stok' => 15, 'kategori' => 'Rumah']
    ];

    foreach ($defaultProducts as $product) {
        $nama = mysqli_real_escape_string($conn, $product['nama']);
        $harga = (int) $product['harga'];
        $deskripsi = mysqli_real_escape_string($conn, $product['deskripsi']);
        $stok = (int) $product['stok'];
        $kategori = mysqli_real_escape_string($conn, $product['kategori']);

        mysqli_query($conn, "INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori) VALUES ('$nama', $harga, '$deskripsi', $stok, '$kategori')");
    }
}

$selectedCategory = isset($_GET['kategori']) ? trim(strip_tags($_GET['kategori'])) : '';
$whereClause = '';
if ($selectedCategory !== '' && $selectedCategory !== 'Semua') {
    $selectedCategoryEscaped = mysqli_real_escape_string($conn, $selectedCategory);
    $whereClause = "WHERE kategori = '$selectedCategoryEscaped'";
}

$productQuery = "SELECT * FROM products $whereClause ORDER BY id DESC";
$productResult = mysqli_query($conn, $productQuery);

$categoryResult = mysqli_query($conn, "SELECT DISTINCT kategori FROM products ORDER BY kategori ASC");
$categories = ['Semua'];
if ($categoryResult) {
    while ($row = mysqli_fetch_assoc($categoryResult)) {
        if (!empty($row['kategori'])) {
            $categories[] = $row['kategori'];
        }
    }
}
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Commerce Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e4d5d5; }
        .product-card { transition: transform .2s, box-shadow .2s; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(0,0,0,.12); }
        .badge-kategori { text-transform: capitalize; }        .product-card .card-body { display: flex; flex-direction: column; }
        .product-card .btn { white-space: normal; }
        .filter-buttons { display: flex; flex-wrap: wrap; gap: .5rem; }
        .filter-buttons a { min-width: 100px; }    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row align-items-start justify-content-between mb-4 gap-3">
            <div>
                <h1 class="h3 mb-2">Toko E-Commerce</h1>
                <p class="text-muted mb-0">Pilih kategori untuk melihat produk sesuai filter.</p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary">Total produk: <?php echo $productResult ? mysqli_num_rows($productResult) : 0; ?></span>
            </div>
        </div>

        <div class="mb-4">
            <div class="filter-buttons" role="group" aria-label="Filter kategori">
                <?php foreach ($categories as $category): ?>
                    <?php $isActive = ($category === $selectedCategory || ($category === 'Semua' && $selectedCategory === '')); ?>
                    <a href="?kategori=<?php echo urlencode($category); ?>" class="btn btn-outline-primary<?php echo $isActive ? ' active' : ''; ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="row g-4">
            <?php if ($productResult && mysqli_num_rows($productResult) > 0): ?>
                <?php while ($product = mysqli_fetch_assoc($productResult)): ?>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card product-card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-1"><?php echo htmlspecialchars($product['nama_produk']); ?></h5>
                                    <span class="badge bg-success badge-kategori"><?php echo htmlspecialchars($product['kategori']); ?></span>
                                </div>
                                <p class="text-muted mb-3"><?php echo htmlspecialchars($product['deskripsi']); ?></p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fw-semibold text-primary">Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></span>
                                        <span class="text-secondary">Stok: <?php echo (int) $product['stok']; ?></span>
                                    </div>
                                    <button class="btn btn-outline-primary w-100">Tambah ke Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning">Produk tidak ditemukan untuk kategori yang dipilih.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
