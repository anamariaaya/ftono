<div class="tabs__music">
    <div class="tabs__music__buttons">
        <button class="tabs__music__buttons--btn tabs__music__buttons--btn--active" id="btn-albums">{% music_tab_albums %}</button>
        <button class="tabs__music__buttons--btn" id="btn-singles">{% music_tab_singles %}</button>
    </div>

    <!--Section of albums-->
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

    <!--Section of singles-->
    <div class="tabs__music--singles tabs__music--disabled">
        <h1>{% music_singles-title %}</h1>
        <div class="dashboard__total">
            <p><span>{% music_singles-total %}: </span> </p>    

            <div class="dashboard__search">
                <input class="dashboard__total__type-search" type="text" id="singles-search" placeholder="{% music_singles_search-placeholder %}"/>
            </div>
        </div>

        <p>{%music_singles-subtitle%}</p>

        <a href="/music/singles/new" class="btn-submit">
            <i class="fa-solid fa-plus"></i>
            {% music_singles_add-btn %}
        </a>

        <h3 class="dashboard__subtitle--filter"></h3>
        <?php if (isset($singles) && !empty($singles)): ?>
            <div class="cards__container" id="grid-singles">
            </div>
        <?php else: ?>
            <p>{% music_singles-empty %}</p>
        <?php endif ?>
    </div>
</div>