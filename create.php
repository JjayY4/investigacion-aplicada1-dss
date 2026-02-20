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
require_once 'includes/header.php';
?>
<h1>Agregar Nuevo Producto</h1>
<form method="POST" action="create.php" novalidate>
    <div class="form-group">
        <label for="id">ID del Producto</label>
        <input type="text" name="id" id="id" value="<?= htmlspecialchars($_POST['id'] ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" required><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
    </div>
    <div class="form-group">
        <label for="categoria">Categoría</label>
        <input type="text" name="categoria" id="categoria" value="<?= htmlspecialchars($_POST['categoria'] ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="precio">Precio ($)</label>
        <input type="number" step="0.01" name="precio" id="precio" value="<?= htmlspecialchars($_POST['precio'] ?? '') ?>" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($_POST['stock'] ?? '') ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar Producto</button>
    <a href="index.php" class="btn">Cancelar</a>
</form>
<?php require_once 'includes/footer.php'; ?>