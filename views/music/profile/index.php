<h1>{% <?php echo $titulo;?> %}</h1>

<?php
    require_once __DIR__ . '/../../templates/alertas.php';
?>

<div class="form-div tabs__lg">
    <div class="tabs__lg__buttons">
        <button class="tabs__lg--btn tabs__lg--btn--active" id="btn-admin">{%profile_your-data_title%}</button>
        <button class="tabs__lg--btn" id="btn-musica">{%profile_company-data_title%}</button>
    </div>
    
    <form class="form tabs__lg--tab" method="POST">
        <?php include_once __DIR__.'/formUser.php'?>
    </form>

    <form class="form tabs__lg--tab tabs__lg--disabled" method="POST">
        <?php include_once __DIR__.'/formCompany.php'?>
    </form>
</div>