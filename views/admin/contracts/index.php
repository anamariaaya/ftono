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
            <?php
             foreach( $contratos as $contrato): ?>       
                <a href="/filmtono/contracts/current?id=<?php echo $contrato->id;?>">
                    <div class="cards__card">
                        <div class="cards__info">
                            <p class="cards__text">
                                <span>{%contracts_user-name%}: </span>
                                <?php echo $contrato->nombre.' '.$contrato->apellido;?></p>
                            <p class="cards__text">
                                <span>{%contracts_empresa%}: </span>
                                <?php echo $contrato->empresa;?></p>
                            <p class="cards__text">
                                <span>{%contracts_type%}: 
                                </span>
                                <?php
                                $filename = $contrato->nombre_doc;
                                $parts = explode('-', $filename);
                                $type = $parts[2];
                                if($type == 'music'):?>
                                    {%contracts_type-music%}
                                <?php else: ?>
                                    {%contracts_type-artistic%}
                                <?php endif; ?>
                            </p>
                            <p class="cards__text">
                                <span>{%contracts_fecha%}: </span>
                                <?php echo $contrato->fecha;?></p>
                        </div>
                        <div class="cards__actions">
                            <button id="eliminar-contrato" class="btn-delete" value="<?php echo $contrato->id;?>">
                                <i class="fa-solid fa-trash-can no-click"></i>
                            </button>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
    </div>
</div>