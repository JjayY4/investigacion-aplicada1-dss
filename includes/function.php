<?php
session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}
function getProductIndex($id) {
    foreach ($_SESSION['products'] as $index => $product) {
        if ($product['id'] === $id) {
            return $index;
        }
    }
    return -1;
}