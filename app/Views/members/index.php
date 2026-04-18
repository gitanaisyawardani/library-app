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

        .top-box {
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

        .search-form input[type="text"] {
            flex: 1;
            min-width: 250px;
            padding: 14px 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        .search-form input[type="text"]:focus {
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

        .top-actions {
            margin-top: 14px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-link {
            text-decoration: none;
            color: #1f3c88;
            font-weight: bold;
            background: #eaf2ff;
            padding: 10px 14px;
            border-radius: 10px;
            transition: 0.3s ease;
        }

        .action-link:hover {
            background: #d7e7ff;
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

        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .member-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12);
        }

        .member-name {
            font-size: 20px;
            color: #1f3c88;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .member-meta {
            color: #555;
            font-size: 15px;
            margin-bottom: 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background: #f3f4f6;
            color: #374151;
        }

        .status-suspended {
            background: #fee2e2;
            color: #991b1b;
        }

        .detail-link {
            display: inline-block;
            text-decoration: none;
            background: #1f3c88;
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .detail-link:hover {
            background: #162d66;
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
            <p>Kelola data anggota perpustakaan dengan tampilan yang rapi dan konsisten</p>
        </div>

        <div class="top-box">
            <form method="get" action="<?= base_url('members') ?>" class="search-form">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari member berdasarkan nama atau kode member..."
                    value="<?= esc($_GET['search'] ?? '') ?>"
                >
                <button type="submit">Cari</button>
            </form>

            <div class="top-actions">
                <a href="<?= base_url('members') ?>" class="action-link">↻ Reset Pencarian</a>
                <a href="<?= base_url('books') ?>" class="action-link">📚 Lihat Daftar Buku</a>
                <a href="<?= base_url('search-books') ?>" class="action-link">🔎 Cari Buku Online</a>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="error-box">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($members)): ?>
            <div class="info-box">
                Total member yang tampil: <strong><?= count($members) ?></strong>
            </div>

            <div class="members-grid">
                <?php foreach ($members as $member): ?>
                    <?php
                        $status = strtolower($member['status'] ?? 'inactive');
                        $statusClass = 'status-inactive';

                        if ($status === 'active') {
                            $statusClass = 'status-active';
                        } elseif ($status === 'suspended') {
                            $statusClass = 'status-suspended';
                        }
                    ?>
                    <div class="member-card">
                        <h3 class="member-name">
                            <?= esc($member['name'] ?? 'Tidak ada nama') ?>
                        </h3>

                        <p class="member-meta">
                            <strong>Kode Member:</strong>
                            <?= esc($member['member_code'] ?? '-') ?>
                        </p>

                        <p class="member-meta">
                            <strong>Email:</strong>
                            <?= esc($member['email'] ?? '-') ?>
                        </p>

                        <span class="status-badge <?= esc($statusClass) ?>">
                            <?= esc(ucfirst($status)) ?>
                        </span>

                        <br>

                        <a href="<?= base_url('members/' . ($member['id'] ?? 0)) ?>" class="detail-link">
                            Lihat Detail
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <h3>Tidak ada data member</h3>
                <p>Data anggota belum tersedia atau hasil pencarian tidak ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>