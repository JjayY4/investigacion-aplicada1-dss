<?php
require_once 'includes/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    $index = getProductIndex($id);
    $_SESSION['errors'] = [];

    if (empty($id)) {
        $_SESSION['errors'][] = "Debe seleccionar un producto.";
    } elseif ($index === -1) {
        $_SESSION['errors'][] = "El producto seleccionado no existe.";
    }

    if ($cantidad === false || $cantidad <= 0) {
        $_SESSION['errors'][] = "La cantidad debe ser un número entero mayor a cero.";
    } elseif ($index !== -1 && $cantidad > $_SESSION['products'][$index]['stock']) {
        $_SESSION['errors'][] = "No hay suficiente stock. Stock actual: " . $_SESSION['products'][$index]['stock'];
    }

    if (empty($_SESSION['errors'])) {
        $_SESSION['products'][$index]['stock'] -= $cantidad;
        $total_venta = $cantidad * $_SESSION['products'][$index]['precio'];
        $_SESSION['success'] = "Venta realizada. Total cobrado: $" . number_format($total_venta, 2);
        header("Location: ventass.php");
        exit;
    }
}
require_once 'includes/header.php';
?>
<h1>Realizar Venta</h1>
<?php if (empty($_SESSION['products'])): ?>
    <p>No hay productos en inventario para vender.</p>
    <a href="create.php" class="btn btn-success">Agregar Producto</a>
<?php else: ?>
    <form method="POST" action="ventass.php" novalidate>
        <div class="form-group">
            <label for="id">Seleccionar Producto</label>
            <select name="id" id="id" required>
                <option value="">-- Seleccione un producto --</option>
                <?php foreach ($_SESSION['products'] as $product): ?>
                    <option value="<?= htmlspecialchars($product['id']) ?>" <?= (isset($_POST['id']) && $_POST['id'] === $product['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($product['nombre']) ?> - $<?= number_format($product['precio'], 2) ?> (Stock: <?= $product['stock'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad a Vender</label>
            <input type="number" name="cantidad" id="cantidad" value="<?= htmlspecialchars($_POST['cantidad'] ?? '1') ?>" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Procesar Venta</button>
        <a href="index.php" class="btn">Cancelar</a>
    </form>
<?php endif; ?>
<?php require_once 'includes/footer.php'; ?>