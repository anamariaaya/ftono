document.addEventListener('DOMContentLoaded', function(){
    mainSlide();
    pruebaNueva();
});
let i = 0;
function mainSlide(){
    const imgArray = [
        '../build/img/1.jpg',
        '../build/img/2.jpg',
        '../build/img/3.jpg',
        '../build/img/4.jpg',
        '../build/img/5.jpg',
        '../build/img/6.jpg',
        '../build/img/7.jpg'
    ];

    const slider = document.querySelector('.slider');
	imgArray.forEach(image => {		
	
	    const img = document.createElement('IMG');
	    img.src = `${imgArray[i]}`;
	    img.dataset.imagenId = i++;

	    slider.appendChild(img);
        const id = parseInt(img.dataset.imagenId);
	    // console.log(id);

        if (id == 0){
            img.classList.add('mainImg');
        } else if(id == 1){
            img.classList.add('rightImg');
        } else if(id == imgArray.length-1){
            img.classList.add('leftImg');
        }

        const buttonNext = document.querySelector('.next');
        const buttonPrev = document.querySelector('.prev');

        buttonNext.addEventListener('click', function(){
            img.src = `${imgArray[id]}`;
            if ( id < imgArray.length -1 ) {
                img.src = `${imgArray[id+1]}`  
            } else if(id = imgArray.length -1){
                img.src = `${imgArray[0]}`
            }
        });
            
        buttonPrev.addEventListener('click', function(){
            img.src = `${imgArray[id]}`;
            if ( id >= 0 ) {
                img.src = `${imgArray[id-1]}`;
            } else if(id = 0){
                img.src = `${imgArray[imgArray.length -1]}`;
            }
        });

    });    

};

function pruebaNueva(){
    const wrapper = document.querySelector('.cat-wrapper');
    const songs = document.querySelector('.cat-container');
    const ancho = songs.clientWidth+'px';
    const next = document.querySelector('.cat-next');
    const prev = document.querySelector('.cat-prev');

    next.addEventListener('click', function(){
        wrapper.style.transform = "translateX(-350px)";
    })

    console.log(ancho);
}

(function ($) {
	"use strict";
	$(document).ready(function () {
		var navListItems = $("ul.setup-panel li a"),
			allWells = $(".setup-content");

		allWells.hide();

		navListItems.click(function (e) {
			e.preventDefault();
			var $target = $($(this).attr("href")),
				$item = $(this).closest("li");

			if (!$item.hasClass("disabled")) {
				navListItems.closest("li").removeClass("active");
				$item.addClass("active");
				allWells.hide();
				$target.show();
			}
		});

		$("ul.setup-panel li.active a").trigger("click");

		// DEMO ONLY //
		$("#activate-step-2").on("click", function (e) {
			$("ul.setup-panel li:eq(1)").removeClass("disabled");
			$('ul.setup-panel li a[href="#step-2"]').trigger("click");
			// $(this).remove();
		});

		$("#activate-step-3").on("click", function (e) {
			$("ul.setup-panel li:eq(2)").removeClass("disabled");
			$('ul.setup-panel li a[href="#step-3"]').trigger("click");
			// $(this).remove();
		});

	});
})(jQuery);

