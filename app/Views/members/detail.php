<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
</head>
<body>

<h1><?= esc($title) ?></h1>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= esc($error) ?></p>
<?php elseif (!empty($member)): ?>
    <p><strong>Nama:</strong> <?= esc($member['name']) ?></p>
    <p><strong>Kode Member:</strong> <?= esc($member['member_code']) ?></p>
    <p><strong>Email:</strong> <?= esc($member['email']) ?></p>
    <p><strong>Phone:</strong> <?= esc($member['phone']) ?></p>
    <p><strong>Address:</strong> <?= esc($member['address']) ?></p>
    <p><strong>Status:</strong> <?= esc($member['status']) ?></p>
    <p><strong>Joined At:</strong> <?= esc($member['joined_at']) ?></p>
<?php else: ?>
    <p>Data member tidak ditemukan.</p>
<?php endif; ?>

<p><a href="<?= base_url('members') ?>">Kembali ke daftar member</a></p>

</body>
</html>