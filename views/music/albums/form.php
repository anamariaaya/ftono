<fieldset class="form__fieldset">

<!--imagen de portada-->
    <div class="form__group">
        <label class="form__group__label">{%music_albums_cover_label%}</label>
        <input
            type="file"
            class="form__custom__input"
            id="portada"
            name="portada"
            placeholder="{%music_albums_cover_placeholder%}"
            value="<?php echo s($album->portada);?>"
            />
        <div class="form__group__image">
            <img src="/images/albums/<?php echo $album->portada; ?>" alt="<?php echo $album->titulo; ?>">
        </div>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_albums_title_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="titulo"
            name="titulo"
            placeholder="{%music_albums_title_placeholder%}"
            value="<?php echo s($album->titulo);?>"
            />
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_albums_upc_label%}</label>
        <input
            type="text"
            class="form__group__input"
            id="album"
            name="album"
            placeholder="{%music_albums_upc_placeholder%}"
            value="<?php echo s($album->upc);?>"
            />
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_albums_artist_label%}</label>
        <input type="text" list="artistas" name="artistas" id="artistas_input" class="form__group__input artistas_input" placeholder="{%music_albums_artist_placeholder%}"/>
        <datalist class="artistas_datalist">
            <?php foreach($artistas as $artista): ?>
                <option value="<?php echo s($artista->nombre); ?>"><?php echo s($artista->nombre); ?></option>
            <?php endforeach; ?>
        </datalist>
    </div>
    <div class="form__group">
        <label class="form__group__label">{%music_albums_artist-secondary_label%}</label>
        <input type="text" list="art-secundarios" name="art-secundarios" id="artsecundarios_input" class="form__group__input artistas_input" placeholder="{%music_albums_artist-secondary_placeholder%}"/>
        <datalist class="artistas_datalist" id="artsecundarios_datalist">
            <?php foreach($artistas as $artista): ?>
                <option value="<?php echo s($artista->id); ?>" data-name="<?php echo s($artista->nombre); ?>"><?php echo s($artista->nombre); ?></option>
            <?php endforeach; ?>
        </datalist>
        <p>If the artist is not on the list, add a new one</p>
        <button type="button" class="btn-back" id="btn-add-artist">{%music_albums_artist-secondary_btn%}</button>
        <input type="hidden" name="art-secundarios" id="artsecundarios-hidden" value="">
    </div>
    
</fieldset>
