require_once __DIR__ . '/../vendor/autoload.php';

use App\Database\Database;
use App\Repositories\UserRepository;
use App\Services\UserService;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$db = Database::connect();
$userRepo = new UserRepository($db);
$userService = new UserService($userRepo);

// Aqui você inicia o bot, por exemplo:
$bot = new Discord\Discord([
    'token' => $_ENV['DISCORD_TOKEN']
]);

$bot->on('ready', function ($discord) use ($userService) {
    echo "Bot está online\n";

    $discord->on('message', function ($message) use ($userService) {
        if ($message->content === '!user') {
            $user = $userService->getUser(1); // Exemplo
            $message->reply("Usuário: " . $user?->name ?? 'Não encontrado');
        }
    });
});

$bot->run();
