<fieldset class="form__fieldset">
    <div class="form__group">
        <label class="form__group__label">{%music_genres_form-new_label-english%}</label>
        <input
            type="text"
            class="form__group__input"
            id="album"
            name="album"
            placeholder="{%music_genres_form-new_placeholder-english%}"
            value="<?php echo s($generos->genero_en);?>"
            disabled/>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_genres_form-new_label-spanish%}</label>
        <input
            type="text"
            class="form__group__input"
            id="album"
            name="album"
            placeholder="{%music_genres_form-new_placeholder-spanish%}"
            value="<?php echo s($generos->genero_es);?>"
            disabled/>
    </div>
</fieldset>