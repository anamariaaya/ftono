<main class="main">
    <div class="main__slider">
        <div class="main__slider__wrapper">
            <?php
                foreach($promos as $promo):?>
                    <div class="main__slider__item">
                    <?php 
                        //get the type of the file
                        $type = mime_content_type($_SERVER['DOCUMENT_ROOT'].'/build/img/promos/'.$promo->promos);
                        //get the first part of the type before the slash
                        $type = explode('/', $type);
                        //set the type of the file
                        $type = $type[0];
                    ?> 
                    <?php if($type == 'image'):?>
                        <img class="main__slider__img" src="/build/img/promos/<?php echo $promo->promos?>" alt="">
                    <?php else:?>
                        <video class="main__slider__video" src="/build/img/promos/<?php echo $promo->promos?>" autoplay loop muted></video>
                    <?php endif;?>
                    </div>
                <?php endforeach; ?>
            
           
        </div>
        <div class="main__slider__controls">
            <button class="main__slider__btn main__slider__btn--prev" id="prev"><i class="fas fa-arrow-left"></i></button>
            <button class="main__slider__btn main__slider__btn--next" id="next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</main>

<div class="container">
    <!-- Section with categories grid -->
    <h2 class="main__subtitle">{%index_subtitle-categories%}</h2>
    <div class="main__grid">
        <div class="main__grid__item">
            <a href="/category?name=genres">
                <img class="main__grid__img" src="/build/img/categories/thumb--genres.jpeg" alt="{%category-genres%}">
            </a>
            <p class="main__grid__text">{%category-genres%}</p>
        </div>
        <div class="main__grid__item">
            <a href="/category?name=sensations">
                <img class="main__grid__img" src="/build/img/categories/thumb--sensations.jpeg" alt="{%category-sensations%}">
            </a>
            <p class="main__grid__text">{%category-sensations%}</p>
        </div>
        <div class="main__grid__item">
            <a href="/category?name=instruments">
                <img class="main__grid__img" src="/build/img/categories/thumb--instruments.jpeg" alt="{%category-instruments%}">
            </a>
            <p class="main__grid__text">{%category-instruments%}</p>
        </div>
        <div class="main__grid__item">
            <a href="/category?name=movies-tv">
                <img class="main__grid__img" src="/build/img/categories/thumb--movies.jpeg" alt="{%category-movies%}">
            </a>
            <p class="main__grid__text">{%category-movies%}</p>
        </div>
    </div>
    <!-- End of categories grid -->
</div>

<!-- Section with the artists -->
<div class="container">
    <h2 class="main__subtitle">{%index_subtitle-artists%}</h2>

</div>