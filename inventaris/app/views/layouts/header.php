
<?php $flash = take_flash(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? e($title) . ' - ' : '' ?><?= APP_NAME ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASEURL ?>">
            <i class="bi bi-box-seam"></i> <?= APP_NAME ?>
        </a>
        <span class="navbar-text text-white">
            Sistem Inventaris Barang
        </span>
    </div>
</nav>

<main class="container py-4">

<?php if ($flash): ?>
    <div class="alert alert-<?= e($flash['type']) ?>">
        <?= e($flash['message']) ?>
    </div>
<?php endif; ?>
