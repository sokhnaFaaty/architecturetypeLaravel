<?php
declare(strict_types=1);

use App\Repositories\BookRepository;
use App\Repositories\BookRepositoryInterface;
use Core\Container;
use Core\Database;
use Core\Router;

require __DIR__ . '/../bootstrap/autoload.php';

// 1. Container : enregistrement des dépendances.
$container = new Container();
$container->bind(BookRepositoryInterface::class, fn ($c) => new BookRepository(Database::connect()));

// 2. Router : chargement des routes.
$router = new Router();
require __DIR__ . '/../routes/web.php';

// 3. Dispatch : on laisse le router décider.
$base = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($base !== '/' && str_starts_with($path, $base)) {
    $path = substr($path, strlen($base));
}
if ($path === '') {
    $path = '/';
}

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $path, $container);
