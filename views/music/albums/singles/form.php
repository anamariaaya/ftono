<fieldset class="form__fieldset">
    <legend class="form__legend">{%music_albums_legend%}</legend>
    <!--Sello discográfico-->
    <?php
        if($tipoUsuario->id_nivel != 3):?>
            <div class="form__group">
                <label class="form__group__label" for="sello">
                    {%music_albums_label_label%}
                    <span class="text-yellow">*</span>
                </label>
                <select id="sello" name="sello" class="form__group__select">
                    <option selected disabled value="">
                        {%music_albums_label_placeholder%}
                    </option>
                    <?php foreach($sellos as $sello): ?>
                        <option value="<?php echo s($sello->id); ?>"
                            <?php
                                echo isset($_POST['sello']) && $_POST['sello'] == $sello->id ? 'selected'
                                : (isset($cancionSello->id) && $cancionSello->id == $sello->id ? 'selected' :
                                ''); 
                            ?>>
                            <?php echo s($sello->nombre); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form__group--inline alert-style">
                <input class="form__group__input--checkbox" type="checkbox" id="noLabel" name="noLabel" <?php echo isset($_POST['sello']) && $_POST['sello'] !== $sello->id ? 'checked' : (isset($cancionSello->id) && $cancionSello->id !== $sello->id ? 'checked' : (!isset($cancionSello) ? 'checked' : '')); ?>>
                <label for="noLabel" class="form__group__label">{%music_albums_no_label%}</label>
            </div>
    <?php endif;
    ?>
    
    <!--Título de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="titulo">
            {%music_songs_form-title_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="text"
            class="form__group__input"
            id="titulo"
            name="titulo"
            placeholder="{%music_songs_form-title_placeholder%}"
            value="<?php echo !empty($song->titulo) ? s($song->titulo) : '';?>"/>
    </div>

    <!--Versión de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="version">
            {%music_songs_form-version_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-version_placeholder%}"
            value="<?php echo !empty($song->version) ? s($song->version) : '';?>"/>
    </div>

    <!--URL Youtube-->
    <div class="form__group">
        <label class="form__group__label" for="url">
            {%music_songs_form-youtube_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="text"
            class="form__group__input"
            id="url"
            name="url"
            placeholder="{%music_songs_form-youtube_placeholder%}"
            value="<?php echo !empty($song->url) && !isset($edit) ? s(getYTVideoUrl($song->url)) : (isset($edit) && empty($_POST['url'])  ? getYTVideoUrl($song->url) : (!empty($_POST['url'])  ? $song->url : ''));?>"/>
    </div>

    <!--ISRC de la canción-->
    <div class="form__group">
        <label class="form__group__label" for="isrc">
            {%music_songs_form-isrc_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="text"
            class="form__group__input"
            id="isrc"
            name="isrc"
            placeholder="{%music_songs_form-isrc_placeholder%}"
            value="<?php echo !empty($song->isrc) ? s($song->isrc) : '';?>"/>
    </div>

    <!--Nivel de canción-->
    <div class="form__group">
        <label class="form__group__label" for="nivel">
            {%music_songs_form-song-level_label%}
            <span class="text-yellow">*</span>
        </label>
        <select class="form__group__select" name="nivel" id="nivel">
            <option selected disabled>
                {%music_songs_form-song-level_placeholder%}
            </option>
            <?php foreach($niveles as $nivel): ?>
                <option value="<?php echo $nivel->id; ?>"
                    <?php 
                        echo isset($_POST['nivel']) && $_POST['nivel'] == $nivel->id 
                            ? 'selected' 
                            : (isset($cancionNivel->id_nivel) && $cancionNivel->id_nivel == $nivel->id ? 'selected' : ''); 
                    ?>>
                    
                    <?php echo $lang =='en' ? $nivel->nivel_en : $nivel->nivel_es ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!--Artista principal-->
    <div class="form__group">
        <label class="form__group__label" for="artista">
            {%music_songs_form-artist_label%}
            <span class="text-yellow">*</span>
        </label>
        <select class="form__group__select" name="artista" id="artista">
            <?php if(isset($single)): ?>
                <option selected disabled>
                    {%music_songs_form-artist_placeholder%}
                </option>
                <?php foreach($artistas as $artista): ?>
                <option value="<?php echo s($artista->id); ?>"
                    <?php echo isset($_POST['artista']) && $_POST['artista'] == $artista->id ? 'selected' : (isset($cancionArtista->id_artista) && $cancionArtista->id_artista == $artista->id ? 'selected' : ''); ?>>
                    <?php echo $artista->nombre ?>
                </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="<?php echo s($artista->id); ?>" selected disabled><?php echo $artista->nombre ?></option>
            <?php endif; ?>
        </select>
    </div>

    <!--Colaboradores-->
    <div class="form__group">
        <label class="form__group__label" for="colaboradores">
            {%music_song_form-colaborators_label%}
        </label>
        <input
            type="text"
            class="form__group__input"
            id="colaboradores"
            name="colaboradores"
            placeholder="{%music_song_form-colaborators_placeholder%}"
            value="<?php echo !empty($songColab) ? s($songColab->colaboradores) : '';?>"/>
    </div>

    <!--Género principal-->
    <div class="form__group">
        <label class="form__group__label" for="genero">
            {%music_songs_form-genre_label%}
            <span class="text-yellow">*</span>
        </label>
        <select class="form__group__select" name="genero" id="genero">
            <option selected disabled>
                {%music_songs_form-genre_placeholder%}
            </option>

            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"
                    <?php
                        echo isset($_POST['genero']) && $_POST['genero'] == $genero->id ? 'selected' : (isset($cancionGenero->id_genero) && $cancionGenero->id_genero == $genero->id ? 'selected' : ''); ?>>
                    <?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Géneros secundarios-->
    <div class="form__group">
        <label class="form__group__label" for="generos">
            {%music_songs_form-subgenre_label%}
        </label>
        <select class="form__group__select" id="generos" multiple>
            <option disabled>
                {%music_songs_form-subgenre_placeholder%}
            </option>
            <?php 
            // Determine the selected genres
            $selectedGenres = isset($_POST['selectedGenres']) ? explode(',', $_POST['selectedGenres']) :
                // If not, check if we are editing and use the saved genres
                (!empty($selectedGenres) ? $selectedGenres : []);

            foreach ($generos as $genero): ?>
                <option 
                    value="<?php echo $genero->id; ?>" 
                    <?php echo in_array($genero->id, $selectedGenres) ? 'selected' : ''; ?>>
                    <?php echo $lang === 'en' ? $genero->genero_en : $genero->genero_es; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Tags for selected genres -->
        <div id="selectedGenres" class="form__group__languages">
            <?php foreach ($selectedGenres as $selectedGenreId): ?>
                <?php
                    $genreName = '';
                    foreach ($generos as $genero) {
                        if ($genero->id == $selectedGenreId) {
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

        <!-- Hidden input to store selected genres -->
        <input 
            type="hidden" 
            id="selectedGenresInput" 
            name="selectedGenres" 
            value="<?php echo implode(',', $selectedGenres); ?>">
    </div>

    <!--Categorías-->
    <div class="form__group">
        <label class="form__group__label" for="categorias">
            {%music_songs_form-categories_label%}
        </label>
        <select class="form__group__select" id="categorias" multiple>
            <option disabled>
                {%music_songs_form-categories_placeholder%}
            </option>
            <?php 
            // Determine the selected categories
            // If it's a POST request, take values from the POST data
            $selectedCategories = isset($_POST['selectedCategories']) ? explode(',', $_POST['selectedCategories']) :
                // If not, check if we are editing and use the saved categories
                (!empty($selectedCategories) ? $selectedCategories : []);

            foreach ($categorias as $categoria): ?>
                <option 
                    value="<?php echo $categoria->id; ?>" 
                    <?php echo in_array($categoria->id, $selectedCategories) ? 'selected' : ''; ?>>
                    <?php echo $lang === 'en' ? $categoria->categoria_en : $categoria->categoria_es; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Tags for selected categories -->
        <div id="selectedCategories" class="form__group__languages">
            <?php foreach ($selectedCategories as $selectedCategoryId): ?>
                <?php
                    $categoryName = '';
                    foreach ($categorias as $categoria) {
                        if ($categoria->id == $selectedCategoryId) {
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

        <!-- Hidden input to store selected categories -->
        <input 
            type="hidden" 
            id="selectedCategoriesInput" 
            name="selectedCategories" 
            value="<?php echo implode(',', $selectedCategories); ?>">
    </div>

    <!--Instrumentos-->
    <div class="form__group">
        <label class="form__group__label" for="instrumentos">
            {%music_songs_form-instruments_label%}
        </label>
        <select class="form__group__select" id="instrumentos" multiple>
            <option disabled>
                {%music_songs_form-instruments_placeholder%}
            </option>
            <?php 
            // Determine the selected instruments
            $selectedInstruments = isset($_POST['selectedInstruments']) ? explode(',', $_POST['selectedInstruments']) :
                // If not, check if we are editing and use the saved instruments
                (!empty($selectedInstruments) ? $selectedInstruments : []);

            foreach ($instrumentos as $instrumento): ?>
                <option 
                    value="<?php echo $instrumento->id; ?>" 
                    <?php echo in_array($instrumento->id, $selectedInstruments) ? 'selected' : ''; ?>>
                    <?php echo $lang === 'en' ? $instrumento->keyword_en : $instrumento->keyword_es; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Tags for selected instruments -->
        <div id="selectedInstruments" class="form__group__languages">
            <?php foreach ($selectedInstruments as $selectedInstrumentId): ?>
                <?php
                    $instrumentName = '';
                    foreach ($instrumentos as $instrumento) {
                        if ($instrumento->id == $selectedInstrumentId) {
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

        <!-- Hidden input to store selected instruments -->
        <input 
            type="hidden" 
            id="selectedInstrumentsInput" 
            name="selectedInstruments" 
            value="<?php echo implode(',', $selectedInstruments); ?>">
    </div>


    <!--Keywords-->
    <div class="form__group">
        <label class="form__group__label" for="keywords">
            {%music_songs_form-keywords_label%}
        </label>
        <select class="form__group__select" id="keywords" multiple>
            <option disabled>
                {%music_songs_form-keywords_placeholder%}
            </option>
            <?php 
            // Determine the selected keywords
            $selectedKeywords = isset($_POST['selectedKeywords']) ? explode(',', $_POST['selectedKeywords']) :
                // If not, check if we are editing and use the saved keywords
                (!empty($selectedKeywords) ? $selectedKeywords : []);

            foreach ($keywords as $keyword): ?>
                <option 
                    value="<?php echo $keyword->id; ?>" 
                    <?php echo in_array($keyword->id, $selectedKeywords) ? 'selected' : ''; ?>>
                    <?php echo $lang === 'en' ? $keyword->keyword_en : $keyword->keyword_es; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Tags for selected keywords -->
        <div id="selectedKeywords" class="form__group__languages">
            <?php foreach ($selectedKeywords as $selectedKeywordId): ?>
                <?php
                    $keywordName = '';
                    foreach ($keywords as $keyword) {
                        if ($keyword->id == $selectedKeywordId) {
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

        <!-- Hidden input to store selected keywords -->
        <input 
            type="hidden" 
            id="selectedKeywordsInput" 
            name="selectedKeywords" 
            value="<?php echo implode(',', $selectedKeywords); ?>">
    </div>


    <!--Idiomas-->
    <div class="form__group">
        <label for="idiomas" class="form__group__label">
            {%music_albums_languages_label%}
            <span class="text-yellow">*</span>
        </label>
        <select id="idiomas" name="idiomas" class="form__group__select" multiple>
            <option disabled value="">{%music_albums_languages_placeholder%}</option>

            <?php 
            // Retrieve previously selected languages
            $selectedLanguages = isset($_POST['selectedLanguages']) ? explode(',', $_POST['selectedLanguages']) :
                // If not, check if we are editing and use the saved languages
                (!empty($selectedLanguages) ? $selectedLanguages : []);

            foreach ($idiomas as $idioma): ?>
                <option 
                    value="<?php echo $idioma->id; ?>"
                    <?php echo in_array($idioma->id, $selectedLanguages) ? 'selected' : ''; ?>>
                    <?php echo ($lang === 'en') ? $idioma->idioma_en : $idioma->idioma_es; ?>
                </option>
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
        <label class="form__group__label">
            {%music_songs-form-lyrics_label%}
        </label>
        <textarea
            class="form__group__input"
            id="letra"
            name="letra"
            placeholder="{%music_songs-form-lyrics_placeholder%}"><?php 
            // Preserve the value
            echo isset($_POST['letra']) ? htmlspecialchars(trim($_POST['letra']), ENT_QUOTES, 'UTF-8') : (isset($cancionLetra->letra) ? htmlspecialchars(trim($cancionLetra->letra), ENT_QUOTES, 'UTF-8') : '');
            ?></textarea>
    </div>

    <!--Escritores-->
    <div class="form__group">
        <label class="form__group__label" for="escritores">
            {%music_songs_form-writers_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="text"
            class="form__group__input"
            id="escritores"
            name="escritores"
            placeholder="{%music_songs_form-writers_placeholder%}"
            value="<?php 
                echo isset($_POST['escritores']) 
                    ? htmlspecialchars(trim($_POST['escritores']), ENT_QUOTES, 'UTF-8') 
                    : (isset($cancionEscritores->escritores) 
                        ? htmlspecialchars(trim($cancionEscritores->escritores), ENT_QUOTES, 'UTF-8') 
                        : ''); 
            ?>"/>
    </div>

    <!--Porcentaje de escritor: publisher + escritores-->
    <p class="text-blue">{%music_songs_form-writers-percent_legend%}:</p>
    <div class="form__group">
        <label class="form__group__label" for="escritor_propiedad">
            {%music_songs_form-writers-percent_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="number"
            class="form__group__input"
            id="escritor_propiedad"
            name="escritor_propiedad"
            min="0"
            max="100"
            placeholder="{%music_songs_form-writers-percent_placeholder%}"
            value="<?php 
                echo isset($_POST['escritor_propiedad']) 
                    ? htmlspecialchars(trim($_POST['escritor_propiedad']), ENT_QUOTES, 'UTF-8') 
                    : (isset($cancionEscritorPropiedad->escritor_propiedad) 
                        ? htmlspecialchars(trim($cancionEscritorPropiedad->escritor_propiedad), ENT_QUOTES, 'UTF-8') 
                        : ''); 
            ?>"/>
    </div>

    <div class="form__group">
        <label class="form__group__label" for="publisher_propiedad">
            {%music_songs_form-publisher-percent_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="number"
            class="form__group__input"
            id="publisher_propiedad"
            name="publisher_propiedad"
            min="0"
            max="100"
            placeholder="{%music_songs_form-publisher-percent_placeholder%}"
            value="<?php 
                echo isset($_POST['publisher_propiedad']) 
                    ? htmlspecialchars(trim($_POST['publisher_propiedad']), ENT_QUOTES, 'UTF-8') 
                    : (isset($cancionEscritorPropiedad->publisher_propiedad) 
                        ? htmlspecialchars(trim($cancionEscritorPropiedad->publisher_propiedad), ENT_QUOTES, 'UTF-8') 
                        : ''); 
            ?>"/>
    </div>

    <!--Porcentaje de fonograma-->
    <p class="text-blue">{%music_songs-form-fonogram-percent_legend%}:</p>

    <div class="form__group">
        <label class="form__group__label" for="sello_propiedad">
            {%music_songs-form-fonogram-percent_label%}
            <span class="text-yellow">*</span>
        </label>
        <input
            type="number"
            class="form__group__input"
            id="sello_propiedad"
            name="sello_propiedad"
            min="0"
            max="100"
            placeholder="{%music_songs-form-fonogram_placeholder%}"
            value="<?php 
                echo isset($_POST['sello_propiedad']) 
                    ? htmlspecialchars(trim($_POST['sello_propiedad']), ENT_QUOTES, 'UTF-8') 
                    : (isset($cancionSelloPropiedad->sello_propiedad) 
                        ? htmlspecialchars(trim($cancionSelloPropiedad->sello_propiedad), ENT_QUOTES, 'UTF-8') 
                        : ''); 
            ?>"/>
    </div>
</fieldset>
