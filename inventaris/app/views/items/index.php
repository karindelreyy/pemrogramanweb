<?php require ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Data Barang</h3>
        <p class="text-muted">Kelola seluruh data inventaris barang.</p>
    </div>
    <a href="<?= BASEURL ?>/items/create" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<div class="card border-0 shadow-sm">
<div class="card-body table-responsive">
<table class="table table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>No.</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($items)): ?>
        <tr><td colspan="8" class="text-center">Belum ada data barang.</td></tr>
    <?php else: ?>
        <?php foreach ($items as $i => $row): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= e($row['code']) ?></td>
            <td><?= e($row['name']) ?></td>
            <td><?= e($row['category_name'] ?? '-') ?></td>
            <td>
                <?php if ((int)$row['quantity'] <= 5): ?>
                    <span class="badge bg-danger"><?= e($row['quantity']) ?> <?= e($row['unit']) ?></span>
                <?php else: ?>
                    <?= e($row['quantity']) ?> <?= e($row['unit']) ?>
                <?php endif; ?>
            </td>
            <td><?= rupiah($row['price']) ?></td>
            <td><?= e($row['entry_date'] ?? '-') ?></td>
            <td>
                <a href="<?= BASEURL ?>/items/edit?id=<?= $row['id'] ?>"
                   class="btn btn-warning btn-sm">Edit</a>
                <form action="<?= BASEURL ?>/items/delete/<?= $row['id'] ?>"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus barang ini?')">
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</div>
</div>

<?php require ROOT_PATH . '/app/views/layouts/footer.php'; ?>
