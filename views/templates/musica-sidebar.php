<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">


        <a href="<?php
            sesionActiva();
        ?>" class="dashboard__enlace <?php pagina_admin('dashboard');?>">
            <i class="fas fa-home dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>
        
        <a href="/music/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Perfil
            </span>
        </a>

        <a href="/music/labels" class="dashboard__enlace <?php pagina_admin('labels');?>">
            <i class="fa-solid fa-certificate dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                labels
            </span>
        </a>

        <a href="/admin/ciudades" class="dashboard__enlace <?php pagina_admin('ciudades');?>">
            <i class="fa-solid fa-location-dot dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Licencias
            </span>
        </a>
    </nav>
</aside>