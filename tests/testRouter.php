<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\config\Bootstrap;
use App\Controller\CopieExamenController;
use App\Repository\Database;
use App\Repository\PdoCopieExamenRepository;
use App\Router\Router;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

new Bootstrap();

$pdo = Database::getInstance()->getConnexion();
$repository = new PdoCopieExamenRepository($pdo);
$strategie = new CalculNoteAvecRetardService();
$service = new SoumissionCopieService($repository);
$controller = new CopieExamenController($service, $repository, $strategie);

$router = new Router();
$router->get('/copies', [$controller, 'index']);
$router->get('/copies/create', [$controller, 'create']);
$router->post('/copies', [$controller, 'store']);
$router->get('/copies/{id}', [$controller, 'show']);

echo "=== Test 1: GET /copies ===\n";
ob_start();
$router->dispatch('GET', '/copies');
$output = ob_get_clean();
assert(str_contains($output, "Copies d'examen"), "GET /copies échoué");
echo "OK (Liste des copies affichée)\n";

echo "=== Test 2: GET /copies/create ===\n";
ob_start();
$router->dispatch('GET', '/copies/create');
$output = ob_get_clean();
assert(str_contains($output, "Soumettre une copie"), "GET /copies/create échoué");
echo "OK (Formulaire affiché)\n";

echo "=== Test 3: GET /copies/{id} ===\n";
$copies = $repository->findAll();
if (!empty($copies)) {
    $firstId = $copies[0]->getId();
    ob_start();
    $router->dispatch('GET', "/copies/{$firstId}");
    $output = ob_get_clean();
    assert(str_contains($output, "Copie d'examen"), "GET /copies/{id} échoué");
    echo "OK (Détail de la copie #{$firstId} affiché)\n";
}

echo "=== Test 4: Route 404 inconnue ===\n";
ob_start();
$router->dispatch('GET', '/route-inexistante');
$output = ob_get_clean();
assert(str_contains($output, "404"), "Page 404 non affichée");
echo "OK (404 géré avec succès)\n";

echo "\nTous les tests du routeur ont réussi !\n";
