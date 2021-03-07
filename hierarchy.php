<?php

use Deputy\UserHierarchy;
use Deputy\Utils\JSONDataLoader;
use Deputy\Validators\RolesValidator;
use Deputy\Validators\UsersValidator;

require __DIR__ . '/vendor/autoload.php';

$dataPath = dirname(__FILE__) . '/data/';
$usersFile = $dataPath . 'users.json';
$rolesFile = $dataPath . 'roles.json';

$userId = isset($argv[1]) && is_numeric($argv[1]) ? (int)$argv[1] : 1;

$userHierarchy = new UserHierarchy();
$userHierarchy->setRoles((new JSONDataLoader(new RolesValidator()))->load($rolesFile));
$userHierarchy->setUsers((new JSONDataLoader(new UsersValidator()))->load($usersFile));

echo json_encode($userHierarchy->getSubOrdinates($userId));