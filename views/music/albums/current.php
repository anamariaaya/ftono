<a href="/music/albums" class="btn-back">
    <i class="fa-solid fa-arrow-left"></i>
    {%music_albums-back_btn%}
</a>

<h1><?php echo $titulo;?></h1>

<div class="music__grid mTop-5">
    <img src="/portadas/<?php echo $album->portada;?>" alt="portada" class="" style="max-width:35rem;">

    <div class="music__info">
        <div class="music__detail">
            <p><?php echo $album->artista;?></p>
            <p><?php echo $album->genero;?></p>
            <p><?php echo $album->fecha;?></p>
            <p><?php echo $album->precio;?>€</p>
        </div>        
    </div>
</div>

<div class="music-table">
    <a href="/music/albums/song/new?id=<?php echo $album->id;?>" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i>
        {%music_songs_add-btn%}
    </a>
    <a>Aquí va la lista de canciones del álbum</a>
</div>