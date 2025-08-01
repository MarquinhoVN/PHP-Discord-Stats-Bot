<?php

use App\Controllers\UserController;

return [
    'GET' => [
        'usuarios' => [UserController::class, 'index'],
        'usuarios/show' => [UserController::class, 'show'],
    ],
    'POST' => [
        'usuarios' => [UserController::class, 'store'],
    ],
    'PUT' => [
        'usuarios/update' => [UserController::class, 'update'],
    ],
    'DELETE' => [
        'usuarios/delete' => [UserController::class, 'destroy'],
    ],
];
