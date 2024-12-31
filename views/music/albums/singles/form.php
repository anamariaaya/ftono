<fieldset class="form__fieldset">
    <div class="form__group">
        <label class="form__group__label" for="titulo">{%music_songs_form-title_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="titulo"
            name="titulo"
            placeholder="{%music_songs_form-title_placeholder%}"
            value="<?php echo s($single->titulo);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label" for="version">{%music_songs_form-version_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-version_placeholder%}"
            value="<?php echo s($single->version);?>"/>
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

    
    <!-- <div class="form__group">
        <label class="form__group__label" for="tipo">{%music_songs_form-instruments_label%}</label>
        <select class="form__group__select" name="id_musica" id="tipo">
            <option selected disabled>
                {%music_songs_form-instruments_placeholder%}
            </option>
            <?php foreach($instrumentos as $instrumento): ?>
                <option value="<?php echo $instrumento->id; ?>"><?php echo $lang =='en' ? $instrumento->keyword_en : $instrumento->keyword_es ?></option>
            <?php endforeach; ?>
        </select>
    </div> -->

    <div class="form__group">
        <label class="form__group__label">{%music_song_form-colaborators_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_song_form-colaborators_placeholder%}"
            value="<?php echo s($single->version);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-writers_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-writers_placeholder%}"
            value="<?php echo s($single->version);?>"/>
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
            value="<?php echo s($single->version);?>"/>
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
            value="<?php echo s($single->version);?>"/>
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
            value="<?php echo s($single->version);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label" for="tipo">{%music_songs-form-language_label%}</label>
        <select class="form__group__select" name="id_musica" id="tipo">
            <option selected disabled>
                {%music_songs-form-language_placeholder%}
            </option>
            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!--textarea for lyrics-->
    <div class="form__group">
        <label class="form__group__label">{%music_songs-form-lyrics_label%}</label>
        <textarea
            class="form__group__input"
            id="lyrics"
            name="lyrics"
            placeholder="{%music_songs-form-lyrics_placeholder%}"
            value="<?php echo s($single->version);?>"></textarea>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-isrc_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-isrc_placeholder%}"
            value="<?php echo s($single->version);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_songs_form-youtube_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="version"
            name="version"
            placeholder="{%music_songs_form-youtube_placeholder%}"
            value="<?php echo s($single->version);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label" for="tipo">{%music_songs_form-keywords_label%}</label>
        <select class="form__group__select" name="id_musica" id="tipo">
            <option selected disabled>
                {%music_songs_form-keywords_placeholder%}
            </option>
            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form__group">
        <label class="form__group__label" for="tipo">{%music_songs_form-single-level_label%}</label>
        <select class="form__group__select" name="id_musica" id="tipo">
            <option selected disabled>
                {%music_songs_form-single-level_placeholder%}
            </option>
            <?php foreach($generos as $genero): ?>
                <option value="<?php echo $genero->id; ?>"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>
