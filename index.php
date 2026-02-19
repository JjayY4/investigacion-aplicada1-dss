<?php
require_once 'includes/function.php';
require_once 'includes/header.php';
?>
<h1>Inventario de productos</h1>
<?php if(empty($_SESSION['products'])): ?>
    <p>No hay productos registrados en el sistema.</p>
<?php else: ?>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['products'] as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['nombre']) ?></td>
                        <td><?= htmlspecialchars($product['descripcion']) ?></td>
                        <td><?= htmlspecialchars($product['categoria']) ?></td>
                        <td>$<?= number_format($product['precio'], 2) ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= urlencode($product['id']) ?>" class="btn btn-warning" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                                <button type="submit" class="btn btn-danger" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>