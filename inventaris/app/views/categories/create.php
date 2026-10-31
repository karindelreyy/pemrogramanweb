 <?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<h1>Tambah Kategori</h1>

<form action="<?= BASE_URL ?>/categories/store" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kategori</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            required
        >
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea
            name="description"
            id="description"
            class="form-control"
            rows="3"
        ></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>

    <a href="<?= BASE_URL ?>/categories" class="btn btn-secondary">
        Kembali
    </a>
</form>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>