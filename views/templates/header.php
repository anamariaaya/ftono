<header class="header">
    <div class="header__bar">
        <div class="header__left">
            <a href="/">
                <img class="header__left--logo" src="build/img/logo.svg" alt="Logo Filmtono">
            </a>
            <a href="javascript: history.go(-1)">
                <i class="fas fa-arrow-left header__left--arrow <?php echo $inicio ? 'no-display' : '' ;?>"></i>
            </a>
        
            <label for="search" class="header__left__label">
                <img class="btn-search" src="build/img/search-bar.svg">
                <input type= text class="header__left__search-bar"/>
            </label>
        </div>

        <div class="header__login">
            <a class="header__login__btn--login" href="/login">Log in</a>
            <a class="header__login__btn--signup" href="/register">Sign up</a>
        </div>
    </div>
</header>