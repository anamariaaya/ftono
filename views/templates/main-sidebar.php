<aside>
    <nav class="menu">
        <a href="/">
            <img class="btn-menu <?php echo $inicio ? 'active' : '' ;?>" src="build/img/home.svg">
        </a>

        <a href="/search">
            <img class="btn-menu <?php pagina_actual('search')?>" src="build/img/search.svg">
        </a>

        <a href="/cart">
            <img class="btn-menu <?php pagina_actual('cart')?>" src="build/img/cart.svg">
        </a>

        <a href="/categories">
            <img class="btn-menu <?php pagina_actual('categories')?>" src="build/img/play-btn.svg">
        </a>
        
        <div class="btn-dropdown">
            <img class="btn-menu" id="menu-btn" src="build/img/more.svg">
        <div>
        
        <div class="menu__dropdown no-display">
            <a href="/help">Help</a>
            <a href="/faq">FAQ</a>
        </div>
    </nav>
</aside>