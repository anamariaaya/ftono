<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">


        <a href="<?php
            sesionActiva();
        ?>" class="dashboard__enlace <?php pagina_admin('dashboard');?>">
            <i class="fas fa-home dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_index'); ?>
            </span>
        </a>
        
        <a href="/clients/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_profile'); ?>
            </span>
        </a>

        <a href="/admin/inbox" class="dashboard__enlace <?php pagina_admin('purchases');?>">
            <i class="fa-solid fa-comments dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_purchases'); ?>
            </span>
        </a>

        <a href="/admin/ciudades" class="dashboard__enlace <?php pagina_admin('contracts');?>">
            <i class="fa-solid fa-location-dot dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_contracts'); ?>
            </span>
        </a>
    </nav>
</aside>