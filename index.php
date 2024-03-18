<?php
spl_autoload_register(function ($class) {
    if (file_exists(__DIR__ . "/classes/{$class}.php")) {
        require_once "classes/{$class}.php";
    }
});

$class = $_REQUEST['class'] ?? null;
$method = $_REQUEST['method'] ?? null;

if (class_exists($class)) {
    $page = new $class($_REQUEST);
    if (!empty($method) and method_exists($class, $method)) {
        $page->$method($_REQUEST);
    }
    $page->show();
}
