<?php
class TransactionsController extends Controller {

    public function __construct() {
        $this->requireLogin();
    }

    public function index(): void {
        $currentLimit = (int) ($_GET['limit'] ?? 10);
        $allowedLimits = [5, 10, 20, 50, 100];

        if (!in_array($currentLimit, $allowedLimits, true)) {
            $currentLimit = 10;
        }

        $page = max(1, (int) ($_GET['page'] ?? 1));

        $transactions = $this->model('Transaction')->paginate(
            $page,
            $currentLimit
        );

        $this->view('transactions/index', [
            'title' => 'Riwayat Transaksi',
            'transactions' => $transactions,
            'currentLimit' => $currentLimit,
        ]);
    }

    public function stockIn(): void {
        $this->store('IN', 'Barang masuk berhasil dicatat!');
    }

    public function stockOut(): void {
        $this->store('OUT', 'Barang keluar berhasil dicatat!');
    }

    private function store(string $type, string $msg): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('transactions');
        }

        $itemId = (int) ($_POST['item_id'] ?? 0);
        $qty = (int) ($_POST['quantity'] ?? 0);

        if ($itemId <= 0 || $qty <= 0) {
            $this->flash('danger', 'Data tidak valid.');
            $this->redirect('items');
        }

        $ok = $this->model('Transaction')->create([
            'item_id' => $itemId,
            'user_id' => $_SESSION['user']['id'],
            'type' => $type,
            'quantity' => $qty,
            'notes' => trim($_POST['notes'] ?? '') ?: null,
        ]);

        $this->flash(
            $ok ? 'success' : 'danger',
            $ok ? $msg : 'Gagal. Stok tidak mencukupi.'
        );

        $this->redirect('items');
    }
}
