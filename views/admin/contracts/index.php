<h1>{%contracts_main-title%}</h1>

<div class="dashboard__total">
    <p>
        <span>{%contracts_total%}:</span>
        <?php echo count($contratosMusical) + count($contratosArtistico);?>
    </p>    

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="contratos-search" placeholder="Buscar..."/>
    </div>
</div>

<div class="cards">
    <div class="cards__container">
            <?php foreach( $contratos as $contrato): ?>       
                <a href="/music/albums/current?id=<?php echo $contrato->id;?>">
                    <div class="cards__card">
                        <div class="cards__info">
                            <p class="cards__text"> <?php echo $contrato->nombre_doc;?></p>
                            <p class="cards__text"> <?php echo $contrato->fecha;?></p>
                            <p class="cards__text"> <?php 
                                foreach($perfilUsuario as $perfilUsuario){
                                    if($perfilUsuario->id_empresa == $contrato->id_empresa){
                                        echo $perfilUsuario->id_empresa;
                                    }
                                                              
                            }?></p>
                        </div>
                        <div class="cards__actions">
                            <!-- <a href="/music/albums/update?id=<?php echo $album->id;?>" class="btn-update">
                                <i class="fa-solid fa-pencil"></i>
                            </a> -->
                            <button id="eliminar-usuario" class="btn-delete" value="<?php echo $contrato->id;?>">
                                <i class="fa-solid fa-trash-can no-click"></i>
                            </button>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
    </div>
</div>