
<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<h1><?= e($title ?? 'Data Kategori') ?></h1>

<a href="<?= BASE_URL ?>/categories/create" class="btn btn-primary mb-3">
    Tambah Kategori
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $i => $category): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($category['name']) ?></td>
                <td><?= e($category['description'] ?? '') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/categories/edit?id=<?= $category['id'] ?>"
                       class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>
