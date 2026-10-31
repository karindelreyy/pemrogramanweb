<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>
<h3 class="fw-bold mb-4">Tambah Barang</h3>
<div class="card border-0 shadow-sm">
<div class="card-body">
<form action="<?= BASEURL ?>/items/store" method="POST">
    <?php require ROOT_PATH . '/app/views/items/_form.php'; ?>
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= BASEURL ?>/items" class="btn btn-secondary">Kembali</a>
    </div>
</form>
</div>
</div>
<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>
