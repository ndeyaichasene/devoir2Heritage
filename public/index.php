<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\config\Bootstrap;
use App\Repository\Database;

$bootstrap = new Bootstrap();

$database = Database::getInstance();
$database->getConnexion();

echo "Connecté à la base de données !";