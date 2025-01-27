<div class="container">
    <h1>{%<?php echo $titulo; ?>%}</h1>
    <div class="dashboard__total">
        <div class="dashboard__search">
            <input class="dashboard__total__type-search" type="text" id="songs-search" placeholder="{%t-search-songs_placeholder%}"/>
            <div class="grid form">
                <div class="form__group">
                    <label class="form__group__label" for="artistas">{%t-search-songs_artist%}</label>
                    <select class="form__group__select" name="artistas" id="songs-artistas">
                        <option selected disabled>
                            {%t-search-songs_artist_placeholder%}
                        </option>
                        <?php foreach ($artistas as $artista) { ?>
                            <option value="<?php echo $artista->id; ?>"><?php echo $artista->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form__group">
                    <label class="form__group__label" for="nivel">{%t-search-songs_level%}</label>
                    <select class="form__group__select" name="nivel" id="songs-niveles">
                        <option selected disabled>
                            {%t-search-songs_level_placeholder%}
                        </option>
                        <?php foreach ($niveles as $nivel) : ?>
                            <option value="<?php echo $nivel->id; ?>">
                                <?php echo $lang =='en' ? $nivel->nivel_en : $nivel->nivel_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="cards__container" id="grid-songs">
    </div>
</div>