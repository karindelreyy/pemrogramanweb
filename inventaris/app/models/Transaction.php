<?php
class Transaction extends Model {

    public function create(array $data): bool {
        try {
            $this->db->beginTransaction();

            $this->db->prepare(
                "INSERT INTO transactions
                (item_id, user_id, type, quantity, notes)
                VALUES (:item_id, :user_id, :type, :quantity, :notes)"
            )->execute([
                ':item_id' => $data['item_id'],
                ':user_id' => $data['user_id'],
                ':type' => $data['type'],
                ':quantity' => $data['quantity'],
                ':notes' => $data['notes'] ?? null,
            ]);

            $op = ($data['type'] === 'IN') ? '+' : '-';

            $this->db->prepare(
                "UPDATE items
                SET quantity = quantity {$op} :quantity
                WHERE id = :item_id"
            )->execute([
                ':quantity' => $data['quantity'],
                ':item_id' => $data['item_id'],
            ]);

            $check = $this->db->prepare(
                "SELECT quantity FROM items WHERE id = :item_id"
            );
            $check->execute([':item_id' => $data['item_id']]);

            if ((int) $check->fetchColumn() < 0) {
                $this->db->rollBack();
                return false;
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }

    public function paginate(int $page = 1, int $limit = 10): array {
        $totalData = (int) $this->db
            ->query("SELECT COUNT(*) FROM transactions")
            ->fetchColumn();

        $totalPages = (int) ceil($totalData / $limit);
        $page = max(1, min($page, max(1, $totalPages)));
        $offset = ($page - 1) * $limit;

        $stmt = $this->db->prepare(
            "SELECT t.*, i.code AS item_code,
                    i.name AS item_name,
                    COALESCE(u.full_name, u.username) AS user_name
             FROM transactions t
             LEFT JOIN items i ON i.id = t.item_id
             LEFT JOIN users u ON u.id = t.user_id
             ORDER BY t.created_at DESC, t.id DESC
             LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(),
            'total_data' => $totalData,
            'total_pages' => $totalPages,
            'current_page' => $page,
        ];
    }
}
