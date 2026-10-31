<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<h1>Tambah Kategori</h1>

<form action="<?= BASEURL ?>/categories/store" method="POST">
    <?php require ROOT_PATH . '/app/views/categories/_form.php'; ?>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= BASEURL ?>/categories" class="btn btn-secondary">Kembali</a>
</form>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>
