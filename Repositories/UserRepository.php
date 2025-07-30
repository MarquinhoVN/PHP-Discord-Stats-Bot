namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository {
    public function __construct(private PDO $db) {}

    public function findById(int $id): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;
        return new User($row['id'], $row['name'], $row['email']);
    }
}
