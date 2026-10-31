<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<h1><?= e($title ?? 'Data Kategori') ?></h1>

<a href="<?= BASEURL ?>/categories/create" class="btn btn-primary mb-3">
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
                    <a href="<?= BASEURL ?>/categories/edit/<?= $category['id'] ?>"
                       class="btn btn-warning btn-sm">Edit</a>

                    <form action="<?= BASEURL ?>/categories/delete/<?= $category['id'] ?>"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>
