<h1>{% music_albums_edit-title %}</h1>

<a href="/music/albums" class="btn-back">{%admin_albums_back-btn%}</a>

<div class="form-div">
    <form class="form" method="POST">
        <?php include_once __DIR__.'/form.php'?>
        <input type="submit" id="btn-artista" value="{%admin_genres_edit-btn%}" class="btn-submit">
    </form>
</div>