<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1><?= esc($title) ?></h1>

    <form method="get" action="<?= base_url('books') ?>">
        <input type="text" name="search" placeholder="Cari buku...">
        <button type="submit">Cari</button>
    </form>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= esc($error) ?></p>
    <?php endif; ?>

    <?php if (!empty($books)): ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <a href="<?= base_url('books/' . $book['id']) ?>">
                        <?= esc($book['title']) ?>
                    </a>
                    - <?= esc($book['author']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada data buku.</p>
    <?php endif; ?>
</body>
</html>