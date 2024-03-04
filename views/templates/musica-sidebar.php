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
        
        <a href="/music/profile" class="dashboard__enlace <?php pagina_admin('profile');?>">
            <i class="fa-solid fa-user dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_profile'); ?>
            </span>
        </a>

        <?php
            if($nivel->id_nivel == '2'):?>
                <a href="/music/labels" class="dashboard__enlace <?php pagina_admin('labels'); regBtn();?>">
                    <i class="fa-solid fa-certificate dashboard__icono"></i>
                    <span class="dashboard__menu-texto">
                        <?php echo tt('sidebar_labels'); ?>
                    </span>
                </a>
            <?php endif;
        ?>

        <a href="/music/albums" class="dashboard__enlace <?php pagina_admin('albums'); regBtn();?>">
            <i class="fa-solid fa-compact-disc dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_music');?>
            </span>
        </a>

        <a href="/music/artists" class="dashboard__enlace <?php pagina_admin('artists'); regBtn();?>">
            <i class="fa-solid fa-microphone-lines dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_artists');?>
            </span>
        </a>

        <a href="/music/company" class="dashboard__enlace <?php pagina_admin('company'); regBtn();?>">
            <i class="fa-solid fa-location-dot dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                <?php echo tt('sidebar_company'); ?>
            </span>
        </a>
    </nav>
</aside>