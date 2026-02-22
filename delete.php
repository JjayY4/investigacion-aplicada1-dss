<?php
require_once 'includes/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $index = getProductIndex($id);
    if ($index !== -1) {
        array_splice($_SESSION['products'], $index, 1);
        $_SESSION['success'] = "Producto eliminado correctamente.";
    } 
    else {
        $_SESSION['errors'] = ["El producto no existe."];
    }
}header("Location: index.php");
exit;