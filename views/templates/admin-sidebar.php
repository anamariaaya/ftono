<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">


        <a href="<?php
            sesionActiva();
        ?>" class="dashboard__enlace <?php pagina_admin('dashboard');?>">
            <i class="fas fa-home dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_index');?>
            </span>
        </a>

        <a href="/filmtono/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_profile');?>
            </span>
        </a>

        <a href="/filmtono/promos" class="dashboard__enlace <?php pagina_admin('promos');?>">
            <i class="fa-solid fa-photo-film dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_promos');?>
            </span>
        </a>

        <a href="/filmtono/users" class="dashboard__enlace <?php pagina_admin('users');?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_users');?>
            </span>
        </a>
        
        <a href="/filmtono/labels" class="dashboard__enlace <?php pagina_admin('labels');?>">
            <i class="fa-solid fa-certificate dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_labels');?>
            </span>
        </a>

        <a href="/filmtono/categories" class="dashboard__enlace <?php pagina_admin('categories');?>">
            <i class="fa-solid fa-box-archive dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_categories');?>
            </span>
        </a>

        <a href="/filmtono/albums" class="dashboard__enlace <?php pagina_admin('albums');?>">
            <i class="fa-solid fa-compact-disc dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_albums');?>
            </span>
        </a>

        <a href="/filmtono/artists" class="dashboard__enlace <?php pagina_admin('artists');?>">
            <i class="fa-solid fa-microphone-lines dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_artists');?>
            </span>
        </a>

        <a href="/filmtono/genres" class="dashboard__enlace <?php pagina_admin('genres');?>">
            <i class="fa-solid fa-microphone-lines dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_genres');?>
            </span>
        </a>

        <a href="/filmtono/keywords" class="dashboard__enlace <?php pagina_admin('keywords');?>">
            <i class="fa-solid fa-font dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_keywords');?>
            </span>
        </a>

        <a href="/filmtono/licenses" class="dashboard__enlace <?php pagina_admin('licenses');?>">
            <i class="fa-solid fa-font dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_licenses');?>
            </span>
        </a>

        <a href="/filmtono/payments" class="dashboard__enlace <?php pagina_admin('payments');?>">
            <i class="fa-solid fa-money-check-dollar dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_payments');?>
            </span>
        </a>

        <a href="/filmtono/contracts" class="dashboard__enlace <?php pagina_admin('contracts');?>">
            <i class="fa-solid fa-file-signature dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_contracts');?>
            </span>
        </a>
    </nav>
</aside>