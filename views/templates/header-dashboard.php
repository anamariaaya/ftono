<header class="dashboard__header">
    <div class="dashboard__header-grid">
        <div class="dashboard__saludo">
            <a href="/">
                <img class="dashboard__logo" src="/build/img/logo.svg" loading="lazy" alt="logotipo Asignar">
            </a>

            <h3 class="dashboard__titulo"><?php echo tt('nav_hello').' '.$_SESSION['nombre'].'!'; ?></h3>
        </div>

        <nav class="dashboard__nav">
            <div class="header__lang">
                <div class="header__select no-display" id="language">
                    <button class="btn-lang" value="en">English</button>
                    <button class="btn-lang" value="es">Español</button>
                </div>
            </div>
            <?php
                if(isset($_SESSION['nivel_compra'])):
            ?>
                <a href="/cart">
                <img class="dashboard__nav-icono" src="/build/img/cart.svg" loading="lazy" alt="icono carrito">
                <!-- <span class="dashboard__nav-numero"><?php echo $total; ?></span> -->
                </a>
                <a href="/categories" class="dashboard__nav-enlace">
                    <?php echo tt('nav_explore_music'); ?>
                </a>
            <?php endif; ?>

            <form class="dashboard__form" action="/logout" method="POST">
                <input class="dashboard__submit--logout" type="submit" value="<?php echo tt('nav_logout'); ?>"/>
            </form>
        </nav>
    </div>
</header>