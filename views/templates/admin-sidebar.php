<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">


        <a href="<?php
            sesionActiva();
        ?>" class="dashboard__enlace <?php pagina_admin('dashboard');?>">
            <i class="fas fa-home dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Home
            </span>
        </a>

        <a href="/filmtono/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Profile
            </span>
        </a>

        <a href="/filmtono/promos" class="dashboard__enlace <?php pagina_admin('promos');?>">
            <i class="fa-solid fa-photo-film dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Promos
            </span>
        </a>

        <a href="/filmtono/users" class="dashboard__enlace <?php pagina_admin('users');?>">
            <i class="fa-solid fa-users dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Users
            </span>
        </a>
        
        <a href="/filmtono/labels" class="dashboard__enlace <?php pagina_admin('labels');?>">
            <i class="fa-solid fa-certificate dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Labels
            </span>
        </a>

        <a href="/filmtono/categories" class="dashboard__enlace <?php pagina_admin('categories');?>">
            <i class="fa-solid fa-box-archive dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Categories
            </span>
        </a>

        <a href="/filmtono/albums" class="dashboard__enlace <?php pagina_admin('albums');?>">
            <i class="fa-solid fa-compact-disc dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Albums
            </span>
        </a>

        <a href="/filmtono/artists" class="dashboard__enlace <?php pagina_admin('artists');?>">
            <i class="fa-solid fa-microphone-lines dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Artists
            </span>
        </a>

        <a href="/filmtono/keywords" class="dashboard__enlace <?php pagina_admin('keywords');?>">
            <i class="fa-solid fa-font dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Keywords
            </span>
        </a>

        <a href="/filmtono/payments" class="dashboard__enlace <?php pagina_admin('payments');?>">
            <i class="fa-solid fa-money-check-dollar dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Payments
            </span>
        </a>

        <a href="/filmtono/contracts" class="dashboard__enlace <?php pagina_admin('contracts');?>">
            <i class="fa-solid fa-file-signature dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Contracts
            </span>
        </a>
    </nav>
</aside>