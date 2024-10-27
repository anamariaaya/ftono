<div class="tabs__music">
    <div class="tabs__music__buttons">
        <button class="tabs__music__buttons--btn tabs__music__buttons--btn--active" id="btn-albums">{% music_tab_albums %}</button>
        <button class="tabs__music__buttons--btn" id="btn-singles">{% music_tab_singles %}</button>
    </div>
    <div class="tabs__music--albums">
        <h1>{% music_albums-title %}</h1>
        <div class="dashboard__total">
            <p><span>{% music_albums-total %}: <?php echo count($albums) ?></span> </p>    

            <div class="dashboard__search">
                <input class="dashboard__total__type-search" type="text" id="albumes-search" placeholder="{% music_albums_search-placeholder %}"/>
            </div>
        </div>

        <p>{%music_albums-subtitle%}</p>

        <a href="/music/albums/new" class="btn-submit">
            <i class="fa-solid fa-plus"></i>
            {% music_albums_add-btn %}
        </a>

        <h3 class="dashboard__subtitle--filter"></h3>
        <div class="cards__container" id="grid-albumes">
        </div>
    </div>

    <div class="tabs__music--singles tabs__music--disabled">
        <h1>{% music_singles-title %}</h1>
        <div class="dashboard__total">
            <p><span>{% music_singles-total %}: </span> </p>    

            <div class="dashboard__search">
                <input class="dashboard__total__type-search" type="text" id="usuario-search" placeholder="{% music_singles_search-placeholder %}"/>
            </div>
        </div>

        <p>{%music_singles-subtitle%}</p>

        <a href="/music/singles/new" class="btn-submit">
            <i class="fa-solid fa-plus"></i>
            {% music_singles_add-btn %}
        </a>

        <h3 class="dashboard__subtitle--filter"></h3>
        <div class="cards__container">
            <?php 
            if(isset($single)):
            foreach( $albums as $album): ?>        
                <a href="/music/albums/current?id=<?php echo $album->id;?>">
                    <div class="cards__card">
                        <div class="cards__info">
                            <img src="/portadas/<?php echo $album->portada;?>" alt="portada" class="cards__img cards__img--album">
                            <p class="cards__text"> <?php echo $album->titulo;?></p>
                            <p class="cards__text"> <?php echo $album->upc;?></p>
                            <p class="cards__text"> <?php echo $album->publisher;?></p>
                            <p class="cards__text"> <?php echo $album->fecha_rec;?></p>

                        </div>
                        <div class="cards__actions">
                            <!-- <a href="/music/albums/update?id=<?php echo $album->id;?>" class="btn-update">
                                <i class="fa-solid fa-pencil"></i>
                            </a> -->
                            <button id="eliminar-usuario" class="btn-delete" value="<?php echo $album->id;?>">
                                <i class="fa-solid fa-trash-can no-click"></i>
                            </button>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
            <?php else: ?>
                <p>{% music_singles-empty %}</p>
            <?php endif ?>
        </div>
    </div>
</div>