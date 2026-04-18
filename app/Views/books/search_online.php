<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
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
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            color: #1f3c88;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .search-box {
            background: #fff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-form input[type="text"],
        .search-form select {
            padding: 14px 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            background: #fff;
        }

        .search-form input[type="text"] {
            flex: 1;
            min-width: 250px;
        }

        .search-form select {
            min-width: 180px;
        }

        .search-form input[type="text"]:focus,
        .search-form select:focus {
            border-color: #1f3c88;
            box-shadow: 0 0 0 3px rgba(31, 60, 136, 0.12);
        }

        .search-form button {
            padding: 14px 22px;
            border: none;
            background: #1f3c88;
            color: white;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .search-form button:hover {
            background: #162d66;
        }

        .back-link {
            display: inline-block;
            margin-top: 12px;
            text-decoration: none;
            color: #1f3c88;
            font-weight: bold;
        }

        .info-box,
        .error-box {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .info-box {
            background: #eaf2ff;
            color: #1f3c88;
        }

        .error-box {
            background: #ffe9e9;
            color: #b42318;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .book-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12);
        }

        .book-cover {
            background: #f3f5f9;
            text-align: center;
            padding: 18px;
            min-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-cover img {
            width: 120px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .no-cover {
            color: #888;
            font-size: 14px;
        }

        .book-content {
            padding: 18px;
            flex: 1;
        }

        .book-title {
            font-size: 18px;
            color: #1f3c88;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .book-meta {
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        .book-meta strong {
            color: #222;
        }

        .empty-state {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            color: #666;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        @media (max-width: 600px) {
            .header h1 {
                font-size: 28px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1><?= esc($title) ?></h1>
            <p>Cari referensi buku dari Open Library API secara online</p>
        </div>

        <div class="search-box">
            <form method="get" action="<?= base_url('search-books') ?>" class="search-form">
                <input
                    type="text"
                    name="q"
                    placeholder="Masukkan judul buku, misalnya: harry potter, clean code, python..."
                    value="<?= esc($keyword ?? '') ?>"
                >

                <select name="category">
                    <option value="">Semua Kategori</option>
                    <option value="programming" <?= (($category ?? '') === 'programming') ? 'selected' : '' ?>>Programming</option>
                    <option value="novel" <?= (($category ?? '') === 'novel') ? 'selected' : '' ?>>Novel</option>
                    <option value="science" <?= (($category ?? '') === 'science') ? 'selected' : '' ?>>Science</option>
                    <option value="history" <?= (($category ?? '') === 'history') ? 'selected' : '' ?>>History</option>
                </select>

                <button type="submit">Cari Buku</button>
            </form>

            <a href="<?= base_url('books') ?>" class="back-link">← Kembali ke Daftar Buku</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-box">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($keyword) || !empty($category)): ?>
            <div class="info-box">
                Menampilkan hasil pencarian
                <?php if (!empty($keyword)): ?>
                    untuk keyword: <strong>"<?= esc($keyword) ?>"</strong>
                <?php endif; ?>

                <?php if (!empty($category)): ?>
                    <?php if (!empty($keyword)): ?> dan <?php endif; ?>
                    kategori: <strong><?= esc(ucfirst($category)) ?></strong>
                <?php endif; ?>

                <br>
                Total buku yang tampil: <strong><?= count($books) ?></strong>
            </div>
        <?php endif; ?>

        <?php if (!empty($books)): ?>
            <div class="results-grid">
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <div class="book-cover">
                            <?php if (isset($book['cover_i'])): ?>
                                <img
                                    src="https://covers.openlibrary.org/b/id/<?= esc($book['cover_i']) ?>-M.jpg"
                                    alt="Cover Buku"
                                >
                            <?php else: ?>
                                <div class="no-cover">Cover tidak tersedia</div>
                            <?php endif; ?>
                        </div>

                        <div class="book-content">
                            <h3 class="book-title">
                                <?= esc($book['title'] ?? 'Tidak ada judul') ?>
                            </h3>

                            <p class="book-meta">
                                <strong>Penulis:</strong>
                                <?= isset($book['author_name']) ? esc(implode(', ', $book['author_name'])) : 'Unknown' ?>
                            </p>

                            <p class="book-meta">
                                <strong>Tahun Terbit:</strong>
                                <?= esc($book['first_publish_year'] ?? '-') ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ((!empty($keyword) || !empty($category)) && empty($error)): ?>
            <div class="empty-state">
                <h3>Tidak ada hasil ditemukan</h3>
                <p>Coba gunakan kata kunci lain seperti <strong>programming</strong>, <strong>python</strong>, atau <strong>novel</strong>.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>