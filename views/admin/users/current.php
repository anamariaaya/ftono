<a href="/filmtono/users" class="btn-back">
    <i class="fa-solid fa-arrow-left"></i>
    {%users_back-btn%}
</a>

<h1><?php echo $usuario->nombre. ' '. $usuario->apellido;?></h1>

<h2 class="text-blue text-left mTop-5"> {%t-personal_data%}</h2>
<p><span class="text-blue">{%t-type-user%}: </span>
    <?php 
    if($ntadmin){
        echo 'Admin';
    } else if($ntmusica){
        if($_SESSION['lang'] === 'en'){
            echo $tipoMusica->tipo_en;
        } else{
            echo $tipoMusica->tipo_es;
        }
    } else{
        echo '{%t-user-without-type%}';
    }
    ?>
</p>

<p><span class="text-blue">{%t-email%}: </span><?php echo $usuario->email; ?></p>

<?php if($usuario->confirmado === '0'): ?>
    <p><span class="text-blue">{%t-confirmed%}: </span>{%t-no%}</p>
<?php else: ?>
    <p><span class="text-blue">{%t-confirmed%}: </span>{%t-yes%}</p>
<?php endif; ?>

<?php if(!$ntadmin): ?>
    <?php if($usuario->perfil === '0'): ?>
        <p><span class="text-blue">{%t-profile%}: </span>{%t-profile-incomplete%}</p>
    <?php else: ?>
        <p><span class="text-blue">{%t-profile%}: </span>{%t-profile-complete%}</p>
    <?php endif; ?>
<?php endif; ?>

<?php if($empresa) :?>
    <h2 class="text-blue text-left mTop-5"> {%t-company_data%}</h2>
<?php endif; ?>

<?php
//debugging($_SESSION['lang']);