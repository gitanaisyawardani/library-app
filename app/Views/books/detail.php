<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link rel="icon" href="data:,">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #e4ecf7);
            color: #333;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 34px;
            color: #1f3c88;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .detail-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
            padding: 28px;
            margin-bottom: 24px;
        }

        .book-title {
            font-size: 30px;
            color: #1f3c88;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 14px 18px;
            margin-top: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #1f3c88;
        }

        .detail-value {
            color: #444;
            line-height: 1.6;
        }

        .description-box {
            margin-top: 22px;
            padding: 18px;
            background: #f8fbff;
            border-left: 5px solid #1f3c88;
            border-radius: 10px;
        }

        .description-box h3 {
            margin-bottom: 10px;
            color: #1f3c88;
            font-size: 18px;
        }

        .description-box p {
            color: #555;
            line-height: 1.7;
        }

        .action-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .action-link {
            display: inline-block;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .primary-link {
            background: #1f3c88;
            color: #fff;
        }

        .primary-link:hover {
            background: #162d66;
        }

        .secondary-link {
            background: #eaf2ff;
            color: #1f3c88;
        }

        .secondary-link:hover {
            background: #d7e7ff;
        }

        .error-box {
            background: #ffe9e9;
            color: #b42318;
            padding: 16px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .empty-state {
            background: #fff;
            padding: 35px;
            border-radius: 16px;
            text-align: center;
            color: #666;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        @media (max-width: 700px) {
            .header h1 {
                font-size: 28px;
            }

            .book-title {
                font-size: 24px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1><?= esc($title) ?></h1>
            <p>Informasi lengkap buku perpustakaan</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-box">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($book)): ?>
            <div class="detail-card">
                <h2 class="book-title"><?= esc($book['title'] ?? 'Tidak ada judul') ?></h2>

                <div class="detail-grid">
                    <div class="detail-label">Penulis</div>
                    <div class="detail-value"><?= esc($book['author'] ?? '-') ?></div>

                    <div class="detail-label">ISBN</div>
                    <div class="detail-value"><?= esc($book['isbn'] ?? '-') ?></div>

                    <div class="detail-label">Kategori</div>
                    <div class="detail-value"><?= esc($book['category'] ?? '-') ?></div>

                    <div class="detail-label">Penerbit</div>
                    <div class="detail-value"><?= esc($book['publisher'] ?? '-') ?></div>

                    <div class="detail-label">Tahun Terbit</div>
                    <div class="detail-value"><?= esc($book['year'] ?? '-') ?></div>

                    <div class="detail-label">Stok</div>
                    <div class="detail-value"><?= esc($book['stock'] ?? '0') ?></div>
                </div>

                <div class="description-box">
                    <h3>Deskripsi Buku</h3>
                    <p><?= esc($book['description'] ?? 'Deskripsi tidak tersedia.') ?></p>
                </div>

                <div class="action-bar">
                    <a href="<?= base_url('books') ?>" class="action-link primary-link">← Kembali ke Daftar Buku</a>
                    <a href="<?= base_url('search-books') ?>" class="action-link secondary-link">🔎 Cari Buku Online</a>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>Data buku tidak ditemukan</h3>
                <p>Buku yang kamu cari mungkin tidak tersedia atau gagal dimuat dari API.</p>

                <div class="action-bar" style="justify-content:center; margin-top:20px;">
                    <a href="<?= base_url('books') ?>" class="action-link primary-link">Kembali ke Daftar Buku</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>