<?php
require_once 'includes/function.php';

$original_id = $_GET['id'] ?? $_POST['original_id'] ?? '';
$index = getProductIndex($original_id);
if ($index === -1) {
    $_SESSION['errors'] = ["Producto no encontrado."];
    header("Location: index.php");
    exit;
}

$product = $_SESSION['products'][$index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    $_SESSION['errors'] = [];

    if (empty($id) || empty($nombre) || empty($descripcion) || empty($categoria)) {
        $_SESSION['errors'][] = "Todos los campos de texto son obligatorios.";
    }
    if ($id !== $original_id && getProductIndex($id) !== -1) {
        $_SESSION['errors'][] = "El nuevo ID ingresado ya le pertenece a otro producto.";
    }
    if ($precio === false || $precio < 0) {
        $_SESSION['errors'][] = "El precio debe ser un número positivo.";
    }
if ($stock === false || $stock < 0) {
        $_SESSION['errors'][] = "El stock debe ser un número entero positivo o cero.";
    }if (empty($_SESSION['errors'])) {
        $_SESSION['products'][$index] = [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'precio' => $precio,
            'stock' => $stock
        ];
        $_SESSION['success'] = "Producto actualizado correctamente.";
        header("Location: index.php");
        exit;
    } else {
        $product = [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'precio' => $_POST['precio'],
            'stock' => $_POST['stock']
        ];
    }
}

require_once 'includes/header.php';
?>
<h1>Editar Producto</h1>
<form method="POST" action="edit.php" novalidate>
    <input type="hidden" name="original_id" value="<?= htmlspecialchars($original_id) ?>">
    <div class="form-group">
        <label for="id">ID del Producto</label>
        <input type="text" name="id" id="id" value="<?= htmlspecialchars($product['id']) ?>" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($product['nombre']) ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" required><?= htmlspecialchars($product['descripcion']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="categoria">Categoría</label>
        <input type="text" name="categoria" id="categoria" value="<?= htmlspecialchars($product['categoria']) ?>" required>
    </div>
    <div class="form-group">
        <label for="precio">Precio ($)</label>
        <input type="number" step="0.01" name="precio" id="precio" value="<?= htmlspecialchars($product['precio']) ?>" required>
    </div>
    <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Actualizar Producto</button>
    <a href="index.php" class="btn">Cancelar</a>
</form>
<?php require_once 'includes/footer.php'; ?>