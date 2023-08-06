<h1>{% <?php echo $titulo;?> %}</h1>

<div class="dashboard__total">
    <p><span>{% music_labels-total %}: </span> </p>    

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="usuario-search" placeholder="{% music_labels_search-placeholder %}"/>
    </div>
</div>

<p>{%music_labels-subtitle%}</p>

<a href="/music/labels/new" class="btn-submit">
    <i class="fa-solid fa-plus"></i>
    {% music_labels_add-btn %}
</a>

<h3 class="dashboard__subtitle--filter"></h3>
<div class="cards__container">
    <?php foreach( $sellos as $sello): ?>        
        <div class="cards__card">
            <div class="cards__info">
                <p class="cards__label">{%music_labels_card_label-name%}: </p>
                <p class="cards__text"> <?php echo $sello->nombre;?></p>
            </div>
            <div class="cards__info">
                <p class="cards__label">{%music_labels_card_label-date%}: </p>
                <p class="cards__text"> <?php echo $sello->creado;?></p>
            </div>
            <div class="cards__actions">
                <a href="/music/labels/update?id=<?php echo $sello->id;?>" class="btn-update">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <button id="eliminar-usuario" class="btn-delete" value="<?php echo $sello->id;?>">
                    <i class="fa-solid fa-trash-can no-click"></i>
                </button>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="grid" id="grid-usuarios">

</div>