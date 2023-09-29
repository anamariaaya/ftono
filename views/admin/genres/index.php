<h1>{% admin_genres_title %}</h1>


<div class="dashboard__total">
    <p><span>Total de géneros: </span>
        <?php
        echo count($generos);
        ?>
     </p>

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="genre-search" placeholder="Search gender by name"/>
    </div>
</div>

<a href="/filmtono/genres/new" class="btn-submit">
    <i class="fa-solid fa-plus"></i>
    Crear Género
</a>

<h3 class="dashboard__subtitle--filter"></h3>

<div class="grid" id="grid-usuarios">
    <?php
        foreach($generos as $genero):?>
        <div class="card">
            <p class="card__info"><?php echo $lang =='en' ? $genero->genero_en : $genero->genero_es ?></p>       

            <div class="card__acciones">
                <a href="/filmtono/genres/edit?id=<?php echo $genero->id; ?>" class="btn-actualizar">
                    <i class="fa-solid fa-pencil"></i>
                </a>
                <button id="eliminar" class="btn-eliminar--externo" value="<?php echo $genero->id;?>">
                    <i class="fa-solid fa-trash-can no-click"></i>
                </button>
            </div>
        </div>
        <?php endforeach; ?>
</div>