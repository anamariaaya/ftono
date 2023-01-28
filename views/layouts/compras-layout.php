<!DOCTYPE html>
<html lang="es" class="admin-html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmtono - <?php echo $titulo; ?></title>

    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/build/css/app.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="dashboard">
<?php 
        include_once __DIR__ .'/../templates/header-dashboard.php';
    ?>
        <div class="dashboard__grid">
            <?php
                include_once __DIR__ .'/../templates/compras-sidebar.php';  
            ?>

            <main class="dashboard__contenido">
                <?php isRegistered('No olvides completar tu registro para poder comprar, acceder a todas las funciones de tu dashboard y agregar elementos a tu lista de deseos', $contenido); ?>
            </main>
        </div>

    <script type="module" src="/build/js/admin.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <?php
        echo $script ?? '';
    ?>
           
</body>
</html>