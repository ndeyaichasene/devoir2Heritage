<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\config\Bootstrap;
use App\Controller\CopieExamenController;
use App\Repository\Database;
use App\Repository\PdoCopieExamenRepository;
use App\Router\Router;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

// 1. Initialisation de l'environnement
new Bootstrap();

// 2. Initialisation des dépendances
$pdo = Database::getInstance()->getConnexion();
$repository = new PdoCopieExamenRepository($pdo);
$strategie = new CalculNoteAvecRetardService();
$service = new SoumissionCopieService($strategie, $repository);
$controller = new CopieExamenController($service, $repository);

// 3. Configuration du routeur
$router = new Router();

// Redirection de la racine vers la liste des copies
$router->get('/', function () {
    header('Location: /copies');
    exit;
});

// Les quatre routes obligatoires
$router->get('/copies', [$controller, 'index']);
$router->get('/copies/create', [$controller, 'create']);
$router->post('/copies', [$controller, 'store']);
$router->get('/copies/{id}', [$controller, 'show']);

// 4. Résolution de la requête HTTP
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/copies';

$router->dispatch($requestMethod, $requestUri);
