<h1>{% music_songs_edit-title %}</h1>

<a href="/music/albums" class="btn-back">{%music_album-back_btn%}</a>

<div class="form-div">
    <form class="form" method="POST">
        <?php include_once __DIR__.'/form.php'?>
        <input type="submit" value="{%music_songs_edit-btn%}" class="btn-submit">
    </form>
</div>
