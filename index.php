<?php

session_start();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/book.php';
require_once __DIR__ . '/controllers/bookController.php';

$controller = new BookController();

// action dari URL, default = 'index'
$action = $_GET['action'] ?? 'index';
$id     = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Routing sederhana
switch ($action) {
    case 'create':
        $controller->create();
        break;

    case 'edit':
        if ($id > 0) {
            $controller->edit($id);
        } else {
            header('Location: index.php');
            exit();
        }
        break;

    case 'delete':
        if ($id > 0) {
            $controller->delete($id);
        } else {
            header('Location: index.php');
            exit();
        }
        break;

    case 'index':
    default:
        $controller->index();
        break;
}