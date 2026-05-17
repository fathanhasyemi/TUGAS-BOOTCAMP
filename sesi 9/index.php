<?php
require_once __DIR__ . '/koneksi.php';

if (!isset($conn) || !$conn) {
    die('Koneksi database gagal. Periksa file koneksi.php dan konfigurasi database Anda.');
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Pastikan tabel products ada.
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) DEFAULT NULL,
    kategori VARCHAR(100) DEFAULT 'Lainnya',
    harga DECIMAL(13,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$message = '';
$messageType = 'success';
$editMode = false;
$editProduct = null;

function sanitize($value) {
    return trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
}

function uploadImage($file, $existingPath = null) {
    global $uploadDir;
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return $existingPath;
    }

    $allowed = ['jpg', 'jpeg', 'png'];
    $fileName = basename($file['name']);
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed, true)) {
        return false;
    }

    $targetName = uniqid('img_', true) . '.' . $extension;
    $targetPath = $uploadDir . $targetName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        if ($existingPath && file_exists(__DIR__ . '/' . $existingPath)) {
            @unlink(__DIR__ . '/' . $existingPath);
        }
        return 'uploads/' . $targetName;
    }

    return false;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = sanitize($_POST['nama_produk'] ?? '');
    $deskripsi = sanitize($_POST['deskripsi'] ?? '');
    $kategori = sanitize($_POST['kategori'] ?? 'Lainnya');
    $harga = filter_var($_POST['harga'] ?? 0, FILTER_VALIDATE_FLOAT);
    $stok = filter_var($_POST['stok'] ?? 0, FILTER_VALIDATE_INT);
    $action = $_POST['action'] ?? 'save';
    $existingImage = sanitize($_POST['existing_image'] ?? '');

    if ($nama_produk === '' || $harga === false || $stok === false) {
        $messageType = 'danger';
        $message = 'Nama produk, harga, dan stok harus diisi dengan benar.';
    } else {
        $imagePath = $existingImage;
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
            $uploaded = uploadImage($_FILES['gambar'], $existingImage);
            if ($uploaded === false) {
                $messageType = 'danger';
                $message = 'Format gambar tidak valid. Gunakan JPG, JPEG, PNG, atau GIF.';
            } else {
                $imagePath = $uploaded;
            }
        }

        if ($message === '') {
            if ($action === 'save') {
                $stmt = mysqli_prepare($conn, 'INSERT INTO products (nama_produk, deskripsi, gambar, kategori, harga, stok) VALUES (?, ?, ?, ?, ?, ?)');
                mysqli_stmt_bind_param($stmt, 'ssssdi', $nama_produk, $deskripsi, $imagePath, $kategori, $harga, $stok);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $message = 'Produk berhasil ditambahkan.';
            } elseif ($action === 'update') {
                $id = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);
                if ($id && $id > 0) {
                    $stmt = mysqli_prepare($conn, 'UPDATE products SET nama_produk = ?, deskripsi = ?, gambar = ?, kategori = ?, harga = ?, stok = ? WHERE id = ?');
                    mysqli_stmt_bind_param($stmt, 'sssdiii', $nama_produk, $deskripsi, $imagePath, $kategori, $harga, $stok, $id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    header('Location: ' . $_SERVER['PHP_SELF'] . '?edited=1');
                    exit;
                } else {
                    $messageType = 'danger';
                    $message = 'ID produk tidak valid untuk pembaruan.';
                }
            }
        }
    }
}

if (isset($_GET['delete_id'])) {
    $deleteId = filter_var($_GET['delete_id'], FILTER_VALIDATE_INT);
    if ($deleteId && $deleteId > 0) {
        $result = mysqli_query($conn, "SELECT gambar FROM products WHERE id = $deleteId LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        if ($row && !empty($row['gambar']) && file_exists(__DIR__ . '/' . $row['gambar'])) {
            @unlink(__DIR__ . '/' . $row['gambar']);
        }
        mysqli_query($conn, "DELETE FROM products WHERE id = $deleteId");
        header('Location: ' . $_SERVER['PHP_SELF'] . '?deleted=1');
        exit;
    }
}

if (isset($_GET['edited'])) {
    $message = 'Produk berhasil diperbarui.';
}
if (isset($_GET['deleted'])) {
    $message = 'Produk berhasil dihapus.';
}

if (isset($_GET['edit_id'])) {
    $editId = filter_var($_GET['edit_id'], FILTER_VALIDATE_INT);
    if ($editId && $editId > 0) {
        $stmt = mysqli_prepare($conn, 'SELECT * FROM products WHERE id = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt, 'i', $editId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $editProduct = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        if ($editProduct) {
            $editMode = true;
        }
    }
}

$productResult = mysqli_query($conn, 'SELECT * FROM products ORDER BY id DESC');
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="d-flex flex-column flex-md-row align-items-start justify-content-between mb-4 gap-3">
            <div>
                <h1 class="h3 mb-2">Manajemen Produk</h1>
                <p class="text-muted mb-0">Tambah, ubah, hapus, dan lihat semua produk di tabel.</p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary">Total produk: <?php echo mysqli_num_rows($productResult); ?></span>
            </div>
        </div>

        <?php if ($message !== ''): ?>
            <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12 col-xl-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-4"><?php echo $editMode ? 'Ubah Produk' : 'Tambah Produk'; ?></h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="<?php echo $editMode ? 'update' : 'save'; ?>">
                            <?php if ($editMode): ?>
                                <input type="hidden" name="id" value="<?php echo (int) $editProduct['id']; ?>">
                                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProduct['gambar']); ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" value="<?php echo $editMode ? htmlspecialchars($editProduct['nama_produk']) : ''; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"><?php echo $editMode ? htmlspecialchars($editProduct['deskripsi']) : ''; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="<?php echo $editMode ? htmlspecialchars($editProduct['kategori']) : 'Lainnya'; ?>">
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="form-label">Harga</label>
                                    <input type="number" name="harga" class="form-control" min="0" step="0.01" value="<?php echo $editMode ? htmlspecialchars($editProduct['harga']) : ''; ?>" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control" min="0" value="<?php echo $editMode ? htmlspecialchars($editProduct['stok']) : ''; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="gambar" class="form-control">
                                <?php if ($editMode && !empty($editProduct['gambar'])): ?>
                                    <div class="mt-3">
                                        <img src="<?php echo htmlspecialchars($editProduct['gambar']); ?>" alt="Gambar produk" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100"><?php echo $editMode ? 'Perbarui Produk' : 'Simpan Produk'; ?></button>
                            <?php if ($editMode): ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($productResult) > 0): ?>
                                        <?php while ($product = mysqli_fetch_assoc($productResult)): ?>
                                            <tr>
                                                <td><?php echo (int) $product['id']; ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <?php if (!empty($product['gambar']) && file_exists(__DIR__ . '/' . $product['gambar'])): ?>
                                                            <img src="<?php echo htmlspecialchars($product['gambar']); ?>" alt="<?php echo htmlspecialchars($product['nama_produk']); ?>" class="table-thumb rounded">
                                                        <?php else: ?>
                                                            <div class="table-thumb-placeholder rounded bg-secondary"></div>
                                                        <?php endif; ?>
                                                        <div>
                                                            <strong><?php echo htmlspecialchars($product['nama_produk']); ?></strong><br>
                                                            <small class="text-muted"><?php echo htmlspecialchars($product['deskripsi']); ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo htmlspecialchars($product['kategori']); ?></td>
                                                <td>Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></td>
                                                <td><?php echo (int) $product['stok']; ?></td>
                                                <td class="text-center">
                                                    <a href="?edit_id=<?php echo (int) $product['id']; ?>" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                    <a href="?delete_id=<?php echo (int) $product['id']; ?>" onclick="return confirm('Hapus produk ini?');" class="btn btn-sm btn-outline-danger">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada produk. Tambahkan produk baru.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
