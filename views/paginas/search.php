<div class="container">
    <h1>{%<?php echo $titulo; ?>%}</h1>
    <div class="dashboard__total">
        <div class="dashboard__search" id="search-songs-dashboard">
            <div class="flex align-items-center">
                <input class="dashboard__total__type-search" type="text" id="songs-search" placeholder="{%t-search-songs_placeholder%}"/>
                <button class="btn-delete" id="clear-search">
                    <i class="fas fa-broom"></i>
                    {%clear-filters%}
                </button>
            </div>
            <!--artistas-->
            <div class="grid-2 form">
                <div class="form__group">
                    <label class="form__group__label" for="artistas">{%t-search-songs_artist%}</label>
                    <select class="form__group__select" name="artistas" id="songs-artistas">
                        <option value="" selected disabled>
                            {%t-search-songs_artist_placeholder%}
                        </option>
                        <?php foreach ($artistas as $artista) { ?>
                            <option value="<?php echo $artista->id; ?>"><?php echo $artista->nombre; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!--Niveles-->
                <div class="form__group">
                    <label class="form__group__label" for="nivel">{%t-search-songs_level%}</label>
                    <select class="form__group__select" name="nivel" id="songs-niveles">
                        <option value="" selected disabled>
                            {%t-search-songs_level_placeholder%}
                        </option>
                        <?php foreach ($niveles as $nivel) : ?>
                            <option value="<?php echo $nivel->id; ?>">
                                <?php echo $lang =='en' ? $nivel->nivel_en : $nivel->nivel_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--generos-->
                <div class="form__group">
                    <label class="form__group__label" for="genero">{%t-search-songs_genre%}</label>
                    <select class="form__group__select" name="genero" id="songs-generos">
                        <option value="" selected disabled>
                            {%t-search-songs_genre_placeholder%}
                        </option>
                        <?php foreach ($generos as $genero) : ?>
                            <option value="<?php echo $genero->id; ?>">
                                <?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--instrumentos-->
                <div class="form__group">
                    <label class="form__group__label" for="instrumento">{%t-search-songs-instrument%}</label>
                    <select class="form__group__select" name="instrumento" id="songs-instrumentos">
                        <option value="" selected disabled>
                            {%t-search-songs-instrument_placeholder%}
                        </option>
                        <?php foreach ($instrumentos as $instrumento) : ?>
                            <option value="<?php echo $instrumento->id; ?>">
                                <?php echo $lang =='en' ? $instrumento->keyword_en : $instrumento->keyword_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--Categorias-->
                <div class="form__group">
                    <label class="form__group__label" for="categoria">{%t-search-songs_category%}</label>
                    <select class="form__group__select" name="categoria" id="songs-categorias">
                        <option value="" selected disabled>
                            {%t-search-songs_category_placeholder%}
                        </option>
                        <?php foreach ($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria->id; ?>">
                                <?php echo $lang =='en' ? $categoria->categoria_en : $categoria->categoria_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--Idiomas-->
                <div class="form__group">
                    <label class="form__group__label" for="idioma">{%t-search-songs_language%}</label>
                    <select class="form__group__select" name="idioma" id="songs-idiomas">
                        <option value="" selected disabled>
                            {%t-search-songs_language_placeholder%}
                        </option>
                        <?php foreach ($idiomas as $idioma) : ?>
                            <option value="<?php echo $idioma->id; ?>">
                                <?php echo $lang =='en' ? $idioma->idioma_en : $idioma->idioma_es; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="cards__container" id="grid-songs-search">
    </div>
</div>