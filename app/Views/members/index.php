<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
</head>
<body>

<h1><?= esc($title) ?></h1>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= esc($error) ?></p>
<?php endif; ?>

<?php if (!empty($members)): ?>
    <ul>
        <?php foreach ($members as $member): ?>
            <li>
                <a href="<?= base_url('members/' . $member['id']) ?>">
                    <?= esc($member['name']) ?>
                </a>
                - <?= esc($member['member_code']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada data member.</p>
<?php endif; ?>

</body>
</html>