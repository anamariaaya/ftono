<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <div class="dashboard__saludo">
            <a href="/">
                <img class="dashboard__logo" src="/build/img/logo.svg" loading="lazy" alt="logotipo Asignar">
            </a>

            <h3 class="dashboard__titulo">Hola, <?php echo $_SESSION['nombre']; ?></h3>
        </div>

        <nav class="dashboard__nav">
           <?php
            if(isset($_SESSION['nivel_compra'])):?>
                 <a href="/cart">
                <img class="dashboard__nav-icono" src="/build/img/cart.svg" loading="lazy" alt="icono carrito">
                <!-- <span class="dashboard__nav-numero"><?php echo $total; ?></span> -->
                </a>
                <a href="/categories" class="dashboard__nav-enlace">Explorar Música</a>
            <?php endif; ?>

            <form class="dashboard__form" action="/logout" method="POST">
                <input class="dashboard__submit--logout" type="submit" value="Cerrar Sesión"/>
            </form>
        </nav>
    </div>
</header>