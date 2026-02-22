<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos Investigación Aplicada 1</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/buttons.css">
    <link rel="stylesheet" href="assets/css/forms.css">
    <link rel="stylesheet" href="assets/css/tables.css">
    <link rel="stylesheet" href="assets/css/alerts.css">

</head>
<body>
    <nav>
        <a href="index.php">Inventario</a>
        <a href="create.php">Agregar Producto</a>
        <a href="ventass.php">Realizar venta</a>
    </nav>
    <main>
        <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
            <div id="toast-container">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <div class="toast error"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>    
            </div>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div id="toast-container">
                <div class="toast success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <script>
            setTimeout(() => {
                const toastContainer = document.getElementById('toast-container');
                if (toastContainer) {
                    toastContainer.style.display = 'none';
                }
            }, 4000);
        </script>