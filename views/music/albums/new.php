<h1>{% music_albums_add-title %}</h1>

<a href="/music/albums" class="btn-back">
    <i class="fa-solid fa-arrow-left"></i>
    {%music_albums-back_btn%}
</a>

<div class="form-div">
    <form class="form" method="POST">
        <?php include_once __DIR__.'/form.php'?>
        <input type="submit" id="btn-artista" value="{%music_albums_add-btn%}" class="btn-submit">
    </form>
</div>