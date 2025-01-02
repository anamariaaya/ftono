<fieldset class="form__fieldset">
    <!--Título de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="titulo">{%music_songs_form-title_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="titulo"
            name="titulo"
            placeholder="{%music_songs_form-title_placeholder%}"
            value="<?php echo s($song->titulo);?>"/>
    </div>

    <!--Versión de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="version">{%music_songs_form-version_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-version_placeholder%}"
            value="<?php echo s($song->version);?>"/>
    </div>

    <!--URL Youtube-->
    <div class="form__group">
        <label class="form__group__label" for="url">{%music_songs_form-youtube_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="url"
            name="url"
            placeholder="{%music_songs_form-youtube_placeholder%}"
            value="<?php echo s($song->url);?>"/>
    </div>

    <!--ISRC de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="isrc">{%music_songs_form-isrc_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="isrc"
            name="isrc"
            placeholder="{%music_songs_form-isrc_placeholder%}"
            value="<?php echo s($song->isrc);?>"/>
    </div>

     <!--Nivel de canción-->
    <div class="form__group">
        <label class="form__group__label" for="nivel">{%music_songs_form-song-level_label%}</label>
        <select class="form__group__select" name="id_musica" id="nivel">
            <option selected disabled>
                {%music_songs_form-song-level_placeholder%}
            </option>
            <?php foreach($niveles as $nivel): ?>
                <option value="<?php echo $nivel->id; ?>"><?php echo $lang =='en' ? $nivel->nivel_en : $nivel->nivel_es ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!--Artista principal-->
    <div class="form__group">
        <label class="form__group__label" for="artista">{%music_songs_form-artist_label%}</label>
        <select class="form__group__select" name="artista" id="artista">
            <option selected disabled>
                {%music_songs_form-artist_placeholder%}
            </option>
            <?php if(isset($single)): ?>
                <?php foreach($artistas as $artista): ?>
                <option value="<?php echo $artista->id; ?>"><?php echo $artista->nombre ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="<?php echo $artista->id; ?>" selected disabled><?php echo $artista->nombre ?></option>
            <?php endif; ?>
        </select>
    </div>

    <!--Colaboradores-->
    <div class="form__group">
        <label class="form__group__label" for="colaboradores">{%music_song_form-colaborators_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="colaboradores"
            name="colaboradores"
            placeholder="{%music_song_form-colaborators_placeholder%}"
            value="<?php echo s($songColab->colaboradores);?>"/>
    </div>

    <!--Género principal-->
    <div class="form__group">
        <label class="form__group__label" for="genero">{%music_songs_form-genre_label%}</label>
        <select class="form__group__select" name="genero" id="genero">
            <option selected disabled>
                {%music_songs_form-genre_placeholder%}
            </option>
            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Géneros secundarios-->
    <div class="form__group">
        <label class="form__group__label" for="generos">{%music_songs_form-subgenre_label%}</label>
        <select class="form__group__select" name="generos" id="generos" multiple>
            <option disabled>
                {%music_songs_form-subgenre_placeholder%}
            </option>
            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></option>
            <?php endforeach; ?>
        </select>

        <div id="selectedGenres" class="form__group__languages">
            <?php foreach ($selectedGenres as $selectedGenreId) :?>
                <?php
                    $genreName = '';
                    foreach ($generos as $genero) {
                        if ($genero->id === $selectedGenreId) {
                            $genreName = $lang === 'en' ? $genero->genero_en : $genero->genero_es;
                        }
                    }
                ?>
                <span class="genero-tag" data-id="<?php echo $selectedGenreId; ?>">
                    <?php echo $genreName; ?>
                    <button type="button" class="remove-genero">&times;</button>
                </span>
            <?php endforeach; ?>
        </div>
       <input type="hidden" id="selectedGenresInput" name="selectedGenres" value="<?php echo implode(',', $selectedGenres); ?>">
    </div>

     <!--Categorías-->
     <div class="form__group">
        <label class="form__group__label" for="categorias">{%music_songs_form-categories_label%}</label>
        <select class="form__group__select" name="categorias" id="categorias" multiple>
            <option disabled>
                {%music_songs_form-categories_placeholder%}
            </option>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?php echo $categoria->id; ?>"><?php echo $lang =='en' ? $categoria->categoria_en : $categoria->categoria_es ?></option>
            <?php endforeach; ?>
        </select>

        <div id="selectedCategories" class="form__group__languages">
            <?php foreach ($selectedCategories as $selectedCategoryId) :?>
                <?php
                    $categoryName = '';
                    foreach ($categorias as $categoria) {
                        if ($categoria->id === $selectedCategoryId) {
                            $categoryName = $lang === 'en' ? $categoria->categoria_en : $categoria->categoria_es;
                        }
                    }
                ?>
                <span class="categoria-tag" data-id="<?php echo $selectedCategoryId; ?>">
                    <?php echo $categoryName; ?>
                    <button type="button" class="remove-categoria">&times;</button>
                </span>
            <?php endforeach; ?>
        </div>
       <input type="hidden" id="selectedCategoriesInput" name="selectedCategories" value="<?php echo implode(',', $selectedCategories); ?>">
    </div>

    <!--Instrumentos-->
    <div class="form__group">
        <label class="form__group__label" for="instrumentos">{%music_songs_form-instruments_label%}</label>
        <select class="form__group__select" name="instrumentos" id="instrumentos" multiple>
            <option disabled>
                {%music_songs_form-instruments_placeholder%}
            </option>
            <?php foreach($instrumentos as $instrumento): ?>
                <option value="<?php echo $instrumento->id; ?>"><?php echo $lang =='en' ? $instrumento->keyword_en : $instrumento->keyword_es ?></option>
            <?php endforeach; ?>
        </select>

        <div id="selectedInstruments" class="form__group__languages">
            <?php foreach ($selectedInstruments as $selectedInstrumentId) :?>
                <?php
                    $instrumentName = '';
                    foreach ($instrumentos as $instrumento) {
                        if ($instrumento->id === $selectedInstrumentId) {
                            $instrumentName = $lang === 'en' ? $instrumento->keyword_en : $instrumento->keyword_es;
                        }
                    }
                ?>
                <span class="instrumento-tag" data-id="<?php echo $selectedInstrumentId; ?>">
                    <?php echo $instrumentName; ?>
                    <button type="button" class="remove-instrumento">&times;</button>
                </span>
            <?php endforeach; ?>
        </div>
       <input type="hidden" id="selectedInstrumentsInput" name="selectedInstruments" value="<?php echo implode(',', $selectedInstruments); ?>">
    </div>

    <!--Keywords-->
    <div class="form__group">
        <label class="form__group__label" for="keywords">{%music_songs_form-keywords_label%}</label>
        <select class="form__group__select" name="keywords" id="keywords" multiple>
            <option disabled>
                {%music_songs_form-keywords_placeholder%}
            </option>
            <?php foreach($keywords as $keyword): ?>
                <option value="<?php echo $keyword->id; ?>"><?php echo $lang =='en' ? $keyword->keyword_en : $keyword->keyword_es ?></option>
            <?php endforeach; ?>
        </select>

        <div id="selectedKeywords" class="form__group__languages">
            <?php foreach ($selectedKeywords as $selectedKeywordId) :?>
                <?php
                    $keywordName = '';
                    foreach ($keywords as $keyword) {
                        if ($keyword->id === $selectedKeywordId) {
                            $keywordName = $lang === 'en' ? $keyword->keyword_en : $keyword->keyword_es;
                        }
                    }
                ?>
                <span class="keyword-tag" data-id="<?php echo $selectedKeywordId; ?>">
                    <?php echo $keywordName; ?>
                    <button type="button" class="remove-keyword">&times;</button>
                </span>
            <?php endforeach; ?>
        </div>
       <input type="hidden" id="selectedKeywordsInput" name="selectedKeywords" value="<?php echo implode(',', $selectedKeywords); ?>">
    </div>

    <!--Idiomas-->
    <div class="form__group">
        <label for="idiomas" class="form__group__label">{%music_albums_languages_label%}
            <span class="text-yellow">*</span>
        </label>
        <select id="idiomas" name="idiomas" class="form__group__select" multiple>
            <option disabled value="">{%music_albums_languages_placeholder%}</option>
            
            <?php foreach ($idiomas as $idioma): ?>
                <?php if ($lang === 'en'): ?>
                    <option value="<?php echo $idioma->id; ?>"
                        <?php echo $idioma->id, $selectedLanguages ? 'selected' : ''; ?>>
                        <?php echo $idioma->idioma_en; ?>
                    </option>
                <?php else: ?>
                    <option value="<?php echo $idioma->id; ?>"
                        <?php echo $idioma->id, $selectedLanguages ? 'selected' : ''; ?>>
                        <?php echo $idioma->idioma_es; ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <!-- Container to display the selected languages as tags -->
        <div id="selectedLanguages" class="form__group__languages">
            <?php foreach ($selectedLanguages as $selectedLanguageId): ?>
                <?php 
                // Get the language name based on the ID
                $languageName = '';
                foreach ($idiomas as $idioma) {
                    if ($idioma->id == $selectedLanguageId) {
                        $languageName = ($lang === 'en') ? $idioma->idioma_en : $idioma->idioma_es;
                        break;
                    }
                }
                ?>
                <span class="language-tag" data-id="<?php echo $selectedLanguageId; ?>">
                    <?php echo $languageName; ?> <button type="button" class="remove-language">&times;</button>
                </span>
            <?php endforeach; ?>
        </div>
        
        <!-- Hidden input to hold the selected language IDs -->
        <input type="hidden" id="selectedLanguagesInput" name="selectedLanguages" value="<?php echo implode(',', $selectedLanguages); ?>">
    </div>

    <!--textarea for lyrics-->
    <div class="form__group">
        <label class="form__group__label">{%music_songs-form-lyrics_label%}</label>
        <textarea
            class="form__group__input"
            id="lyrics"
            name="lyrics"
            placeholder="{%music_songs-form-lyrics_placeholder%}"
            value="<?php echo s($song->version);?>"></textarea>
    </div>
    
    <!--Escritores-->
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-writers_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-writers_placeholder%}"
            value="<?php echo s($song->version);?>"/>
    </div>

    <!--Porcentaje de escritor: publisher + escritores-->
    <p class="text-blue">{%music_songs_form-writers-percent_legend%}:</p>
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-writers-percent_label%}</label>
        <input
            type="number"
            class="form__group__input"
            id="version"
            name="version"
            min="0"
            max="100"
            placeholder="{%music_songs_form-writers-percent_placeholder%}"
            value="<?php echo s($song->version);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-publisher-percent_label%}</label>
        <input
            type="number"
            class="form__group__input"
            id="version"
            name="version"
            min="0"
            max="100"
            placeholder="{%music_songs_form-publisher-percent_placeholder%}"
            value="<?php echo s($song->version);?>"/>
    </div>

    <p class="text-blue">{%music_songs-form-fonogram-percent_legend%}:</p>

    <div class="form__group">
        <label class="form__group__label">{%music_songs-form-fonogram-percent_label%}</label>
        <input
            type="number"
            class="form__group__input"
            id="version"
            name="version"
            min="0"
            max="100"
            placeholder="{%music_songs-form-fonogram_placeholder%}"
            value="<?php echo s($song->version);?>"/>
    </div>
</fieldset>
