<?php
class Item extends Model {
    protected string $table = 'items';

    public function all(): array {
        return $this->db->query(
            "SELECT i.*, c.name AS category_name
             FROM items i
             LEFT JOIN categories c ON c.id = i.category_id
             ORDER BY i.name"
        )->fetchAll();
    }

    public function create(array $data): bool {
        return $this->db->prepare(
            "INSERT INTO items
            (code, name, category_id, quantity, unit, price, entry_date, description)
            VALUES
            (:code, :name, :category_id, :quantity, :unit, :price, :entry_date, :description)"
        )->execute($data);
    }

    public function update(int $id, array $data): bool {
        $data['id'] = $id;
        return $this->db->prepare(
            "UPDATE items SET
            code = :code, name = :name, category_id = :category_id,
            quantity = :quantity, unit = :unit, price = :price,
            entry_date = :entry_date, description = :description
            WHERE id = :id"
        )->execute($data);
    }

    public function generateCode(): string {
        $max = $this->db->query(
            "SELECT MAX(CAST(SUBSTRING(code, 4) AS UNSIGNED))
             FROM items WHERE code LIKE 'ITM%'"
        )->fetchColumn();

        return 'ITM' . str_pad((string) (($max ? (int)$max : 0) + 1), 4, '0', STR_PAD_LEFT);
    }
}
