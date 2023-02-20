<header class="header">
    <div class="header__bar">
        <div class="header__left">
            <a href="/">
                <img class="header__left--logo" src="/build/img/logo.svg" alt="Logo Filmtono">
            </a>
            <a href="javascript: history.go(-1)">
                <i class="fas fa-arrow-left header__left--arrow <?php echo $inicio ? 'no-display' : '' ;?>"></i>
            </a>
        
            <label for="search" class="header__left__label">
                <img class="btn-search" src="/build/img/search-bar.svg">
                <input type= text class="header__left__search-bar"/>
            </label>
        </div>

        <div class="header__lang">
            <div class="header__select no-display" id="language">
                <button class="btn-lang" value="en">English</button>
                <button class="btn-lang" value="es">Español</button>
            </div>
        </div>

        <div class="header__login">
            <?php if(isset($_SESSION['id'])): ?>
                <form class="dashboard__form" action="/logout" method="POST">
                    <input class="header__login__btn--login"type="submit" value="Cerrar Sesión">
                </form>
                <a class="header__login__btn--signup" href="<?php sesionActiva()?>">Admin</a>
            <?php else: ?>
            <a class="header__login__btn--login" href="/login">Log in</a>
            <a class="header__login__btn--signup" href="/register">Sign up</a>
            <?php endif; ?>
        </div>
    </div>
</header>