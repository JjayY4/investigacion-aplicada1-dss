<?php
$tiempo_vida = 60 * 60 * 24 * 30;
ini_set('session.cookie_lifetime', $tiempo_vida);
ini_set('session.gc_maxlifetime', $tiempo_vida);
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