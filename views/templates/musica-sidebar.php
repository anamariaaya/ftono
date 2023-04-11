<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">


        <a href="<?php
            sesionActiva();
        ?>" class="dashboard__enlace <?php pagina_admin('dashboard');?>">
            <i class="fas fa-home dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('index'); ?>
            </span>
        </a>
        
        <a href="/music/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('t-profile'); ?>
            </span>
        </a>

        <a href="/music/labels" class="dashboard__enlace <?php pagina_admin('labels'); regBtn();?>">
            <i class="fa-solid fa-certificate dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('labels'); ?>
            </span>
        </a>

        <a href="/admin/ciudades" class="dashboard__enlace <?php pagina_admin('ciudades'); regBtn();?>">
            <i class="fa-solid fa-location-dot dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('licenses'); ?>
            </span>
        </a>
    </nav>
</aside>