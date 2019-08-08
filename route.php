<?php

use App\Controllers\Main;

$controller = new Main();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_SERVER['REQUEST_URI']) {
        case "/api/Table":
            $controller->table();
            break;
        case "/api/SessionSubscribe":
            $controller->sessionSubscribe();
            break;
        default:
            $controller->response([], 'Метод не найден', true);
    }
}
