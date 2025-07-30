namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
    public function __construct(private UserRepository $repo) {}

    public function getUser(int $id) {
        return $this->repo->findById($id);
    }
}
