<fieldset class="form__fieldset">
    <div class="form__group">
        <label class="form__group__label" for="nombre">{%artists_form-name_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="nombre"
            name="nombre"
            placeholder="{%artists_form-name_placeholder%}"
            value="<?php echo s($artista->nombre);?>"/>
    </div>
    <div class="form__group">
        <label class="form__group__label" for="precio_show">{%artists_form-show-price_label%}</label>
        <textarea
            class="form__group__input"
            id="precio_show"
            name="precio_show"
            placeholder="{%artists_form-show-price_placeholder%}"><?php echo s($artista->precio_show);?></textarea>
    </div>
</fieldset>