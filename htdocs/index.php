<?php
declare(strict_types=1);

use GibsonOS\Core\Exception\RequestError;
use GibsonOS\Core\Exception\UserError;
use GibsonOS\Core\Service\ControllerService;
use GibsonOS\Core\Service\RequestService;
use GibsonOS\Module\Middleware\Service\InstanceService;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$serviceManager = initServiceManager();

$instanceService = $serviceManager->get(InstanceService::class);
$requestService = $serviceManager->get(RequestService::class);

try {
    $instanceService->tokenLogin($requestService->getHeader('X-GibsonOs-Token'));
} catch (UserError|RequestError $e) {
    // Login error
}

$controllerService = $serviceManager->get(ControllerService::class);
$controllerService->runAction();
