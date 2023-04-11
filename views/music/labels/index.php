<h1><?php echo $titulo; ?></h1>

<div class="dashboard__total">
    <p><span>{%p-total_labels%}: </span> </p>    

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="usuario-search" placeholder="{% ph-search__labels %}"/>
    </div>
</div>

<a href="/filmtono/users/new" class="btn-submit">
    <i class="fa-solid fa-plus"></i>
    {%b-add_label%}
</a>

<h3 class="dashboard__subtitle--filter"></h3>
    <?php foreach( $sellos as $sello): ?>
        <div class="usuarios__flex">
            <div class="usuarios__grid">
                <div class="usuarios__info">
                    <?php echo $sello->nombre;?>
                </div>
            </div>

            <button id="eliminar-usuario" class="btn-eliminar btn-eliminar--usuario" value="<?php echo $sello->id;?>">
                <i class="fa-solid fa-trash-can no-click"></i>
            </button>
        </div>
    <?php endforeach ?>
<div class="grid" id="grid-usuarios">

</div>