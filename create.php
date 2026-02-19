<?php
require_once 'includes/function.php';   

if($_SERVER['REQUEST_METHOD']==='POST'){
    $id = trim($_POST['id'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
    $_SESSION['errors']=[];

    //validacioenss

if(empty($id) || empty($nombre) || empty($descripcion) || empty($categoria)){
    $_SESSION['errors'][]="Campos obligatorioss";
}
if (getProductIndex($id) !== -1) {
        $_SESSION['errors'][] = "El ID ingresado ya existe.";
    }
if ($precio === false || $precio < 0) {
        $_SESSION['errors'][] = "El precio debe ser un número positivo";
    }
    if ($stock === false || $stock < 0) {
        $_SESSION['errors'][] = "El stock debe ser un número valido";
    }


if(empty($_SESSION['errors'])){
    $_SESSION['products'][]=[
        'id'=>$id,
        'nombre'=>$nombre,
        'descripcion'=>$descripcion,
        'categoria' => $categoria,
        'precio' => $precio,
        'stock' => $stock

    ];$_SESSION['success'] = "Producto agregado correctamente.";
    header("Location: index.php");
    exit;
}

}