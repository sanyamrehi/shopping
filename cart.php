<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = $_POST['product_id'] ?? 0;

    if ($action === 'add') {
        add_to_cart($product_id);
    } elseif ($action === 'remove') {
        remove_from_cart($product_id);
    }
}

header('Location: index.php');
?>
