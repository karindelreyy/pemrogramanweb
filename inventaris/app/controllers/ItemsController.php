<?php
class ItemsController extends Controller {

    public function index(): void {
        $this->view('items/index', [
            'title' => 'Data Barang',
            'items' => $this->model('Item')->all(),
        ]);
    }

    public function create(): void {
        $this->view('items/create', [
            'title' => 'Tambah Barang',
            'item' => [],
            'code' => $this->model('Item')->generateCode(),
            'categories' => $this->model('Category')->all(),
        ]);
    }

    private function payload(array $input): array {
        return [
            'code' => trim($input['code'] ?? ''),
            'name' => trim($input['name'] ?? ''),
            'category_id' => ($input['category_id'] ?? '') !== '' ? (int)$input['category_id'] : null,
            'quantity' => max(0, (int)($input['quantity'] ?? 0)),
            'unit' => trim($input['unit'] ?? '') ?: 'unit',
            'price' => max(0, (float)($input['price'] ?? 0)),
            'entry_date' => ($input['entry_date'] ?? '') !== '' ? $input['entry_date'] : null,
            'description' => trim($input['description'] ?? ''),
        ];
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('items');
        }

        $data = $this->payload($_POST);

        if ($data['code'] === '' || $data['name'] === '') {
            $this->flash('danger', 'Kode dan nama barang wajib diisi.');
            $this->redirect('items/create');
        }

        try {
            $this->model('Item')->create($data);
            $this->flash('success', 'Barang berhasil ditambahkan.');
        } catch (PDOException $e) {
            $this->flash('danger', 'Gagal menyimpan barang. Periksa kode barang.');
        }

        $this->redirect('items');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);
        $item = $this->model('Item')->find($id);

        if (!$item) {
            $this->redirect('items');
        }

        $this->view('items/edit', [
            'title' => 'Edit Barang',
            'item' => $item,
            'categories' => $this->model('Category')->all(),
        ]);
    }

    public function update(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('items');
        }

        $id = (int)($_POST['id'] ?? 0);
        $data = $this->payload($_POST);

        if ($id <= 0 || $data['code'] === '' || $data['name'] === '') {
            $this->flash('danger', 'Data barang tidak valid.');
            $this->redirect('items');
        }

        try {
            $this->model('Item')->update($id, $data);
            $this->flash('success', 'Barang berhasil diperbarui.');
        } catch (PDOException $e) {
            $this->flash('danger', 'Gagal memperbarui barang. Periksa kode barang.');
        }

        $this->redirect('items');
    }

    public function delete(int $id): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('items');
        }

        $this->model('Item')->delete($id);
        $this->flash('success', 'Barang berhasil dihapus.');
        $this->redirect('items');
    }
}
