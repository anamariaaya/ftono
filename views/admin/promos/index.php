<h1>{%admin_promos_title%}</h1>

<a href="/filmtono/promos/new" class="btn-submit">
    <i class="fa-solid fa-plus"></i>
    {%admin_promos_new-btn%}
</a>

<h3 class="dashboard__subtitle--filter"></h3>

<div class="grid" id="grid-promos">
    <?php
        foreach($promos as $promo):?>
        <div class="card">
            <!--get the extension of the file-->
            <?php 
                //get the type of the file
                $type = mime_content_type($_SERVER['DOCUMENT_ROOT'].'/build/img/promos/'.$promo->promos);
                //get the first part of the type before the slash
                $type = explode('/', $type);
                //set the type of the file
                $type = $type[0];
            ?> 
            
            <?php if($type == 'image'):?>
                <img class="card__img" src="/build/img/promos/<?php echo $promo->promos ?>" alt="">
            <?php else:?>
                <video class="card__video" src="/build/img/promos/<?php echo $promo->promos ?>" autoplay loop muted></video>
            <?php endif;?>    

            <div class="card__acciones">
                <a href="/filmtono/promos/edit?id=<?php echo $promo->id;?>" class="btn-update">
                    <i class="fa-solid fa-edit"></i>
                </a>
                <button id="eliminar" class="btn-delete" data-role="filmtono" data-item="promos" value="<?php echo $promo->id;?>">
                    <i class="fa-solid fa-trash-can no-click"></i>
                </button>
            </div>
        </div>
        <?php endforeach; ?>
</div>
