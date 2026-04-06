<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1><?= esc($title) ?></h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= esc($error) ?></p>
    <?php elseif (!empty($book)): ?>
        <p><strong>Judul:</strong> <?= esc($book['title']) ?></p>
        <p><strong>Penulis:</strong> <?= esc($book['author']) ?></p>
        <p><strong>ISBN:</strong> <?= esc($book['isbn']) ?></p>
        <p><strong>Kategori:</strong> <?= esc($book['category']) ?></p>
        <p><strong>Penerbit:</strong> <?= esc($book['publisher']) ?></p>
        <p><strong>Tahun:</strong> <?= esc($book['year']) ?></p>
        <p><strong>Stok:</strong> <?= esc($book['stock']) ?></p>
        <p><strong>Deskripsi:</strong> <?= esc($book['description']) ?></p>
    <?php else: ?>
        <p>Data buku tidak ditemukan.</p>
    <?php endif; ?>

    <p><a href="<?= base_url('books') ?>">Kembali</a></p>
</body>
</html>