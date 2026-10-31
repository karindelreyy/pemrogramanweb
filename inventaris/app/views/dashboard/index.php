<?php require_once ROOT_PATH . '/app/views/layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Ringkasan Sistem Inventaris Barang</p>
    </div>
    <a href="<?= BASEURL ?>/items/create" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Barang
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted mb-2">
                    <i class="bi bi-tags"></i> Total Kategori
                </div>
                <h3 class="fw-bold"><?= number_format($categoryCount) ?></h3>
                <a href="<?= BASEURL ?>/categories" class="small text-decoration-none">Lihat kategori</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted mb-2">
                    <i class="bi bi-box-seam"></i> Jenis Barang
                </div>
                <h3 class="fw-bold"><?= number_format($itemCount) ?></h3>
                <a href="<?= BASEURL ?>/items" class="small text-decoration-none">Lihat barang</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted mb-2">
                    <i class="bi bi-stack"></i> Total Stok
                </div>
                <h3 class="fw-bold"><?= number_format($totalStock) ?></h3>
                <span class="small text-muted">Seluruh barang</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted mb-2">
                    <i class="bi bi-cash-stack"></i> Nilai Persediaan
                </div>
                <h3 class="fw-bold fs-5"><?= rupiah($totalValue) ?></h3>
                <span class="small text-muted">Total nilai stok</span>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0">Ringkasan Berdasarkan Kategori</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Jenis Barang</th>
                        <th>Total Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categorySummary)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada data kategori.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categorySummary as $index => $category): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="fw-semibold"><?= e($category['name']) ?></td>
                                <td><?= number_format($category['item_count']) ?> jenis</td>
                                <td><?= number_format($category['total_stock']) ?> unit</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/app/views/layouts/footer.php'; ?>
