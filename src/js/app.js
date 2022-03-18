document.addEventListener('DOMContentLoaded', function(){
    menuDropdown();

    mainSlide();
});

function menuDropdown(){
    const dropdownDiv = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.menu-dropdown');
    const dropdownBtn = document.querySelector('#menu-btn');

    dropdownDiv.onclick = function(){
       dropdownMenu.classList.toggle('no-display');
       dropdownBtn.classList.toggle('active');
    };
};

const slider = document.querySelector('.slider');
const punto = document.querySelectorAll('.punto');

// function mainSlide(){
//     const imgArray = [
//         '../build/img/1.jpg',
//         '../build/img/2.jpg',
//         '../build/img/3.jpg',
//         '../build/img/4.jpg',
//         '../build/img/5.jpg',
//         '../build/img/6.jpg',
//         '../build/img/7.jpg'
//     ];

//     const img = document.querySelector('#mainImg');
//     const rightImg = document.querySelector('#rightImg');
//     const leftImg = document.querySelector('#leftImg');
    

//     let i = 0;
//     img.src = imgArray[i];
//     rightImg.src = imgArray[i+1];
//     leftImg.src = imgArray[i = imgArray.length -1];

//     // function slider(){
//     //     img.src = imgArray[i];
//     //     i = ( i < imgArray.length -1) ? i+1 : 0;
//     // }
//     // setInterval(slider, 2000);

//     const buttonNext = document.querySelector('.slider-next');
//     const buttonPrev = document.querySelector('.slider-prev');

//     buttonNext.addEventListener('click', function(){
//         img.src = imgArray[i];
//         i = ( i < imgArray.length -1) ? i+1 : 0;
//     });
        
//     //  buttonNext.onclick = slideShowNext = () => {
//     //     img.src = imgArray[i];
//     //      i = ( i < imgArray.length -1) ? i+1 : 0;
//     //  }

//     buttonPrev.onclick = slideShowPrev = () => {
//         img.src = imgArray[i];
//         i = ( i <= 0 ) ? imgArray.length -1 : i-1;
//     }
// };

function mainSlide(){
    let i = 0;
    const slider = document.querySelector('.slider');
    const imgArray = [
        '../build/img/1.jpg',
        '../build/img/2.jpg',
        '../build/img/3.jpg'
    ]
    const buttonNext = document.querySelector('.next');

    imgArray.forEach(img => {
        const imagen = document.createElement('IMG');
        imagen.src = `${imgArray[i++]}`;
        imagen.dataset.imagenId=i;
        slider.appendChild(imagen);
    });
};

// const slider = document.querySelector('.slider');
// const puntos = document.querySelector('.puntos');
// const carousel = document.querySelector('.carousel');


// function crearSlider(){
//     imgArray.forEach((img, i) => {
//         const imagen = document.createElement('IMG');
//         imagen.src = `${imgArray[i++]}`;
//         imagen.dataset.imagenId=i;
//         imagen.classList.add('sliderImg');
//         slider.appendChild(imagen);

//         const punto = document.createElement('LI');
//         punto.classList.add('punto');
//         puntos.appendChild(punto);        
        
//     });
// };

// crearSlider();

// const punto = document.querySelectorAll('.punto');
// const imagen = document.querySelectorAll('.sliderImg');

// punto.forEach((cadaPunto, i)=>{
//     punto[i].addEventListener('click', ()=>{
//         let posicion = i;
//         let operacion = posicion * -(100/7);

//         slider.style.transform = `translateX(${operacion}%)`;
        
//          punto.forEach ( (cadaPunto, i)=>{
//              punto[i].classList.remove('activo');
//          });
//         punto [i].classList.add('activo');

//     }); 
// });

//PRUEBA TABS
(function($) {
    'use strict';
    $(document).ready(function() {

      var navListItems = $('ul.setup-panel li a'),
          allWells = $('.setup-content');

      allWells.hide();

      navListItems.click(function(e)
      {
          e.preventDefault();
          var $target = $($(this).attr('href')),
              $item = $(this).closest('li');

          if (!$item.hasClass('disabled')) {
              navListItems.closest('li').removeClass('active');
              $item.addClass('active');
              allWells.hide();
              $target.show();
          }
      });

      $('ul.setup-panel li.active a').trigger('click');

      // DEMO ONLY //
      $('#activate-step-2').on('click', function(e) {
          $('ul.setup-panel li:eq(1)').removeClass('disabled');
          $('ul.setup-panel li a[href="#step-2"]').trigger('click');
          // $(this).remove();
      });

  	$('#activate-step-3').on('click', function(e) {
          $('ul.setup-panel li:eq(2)').removeClass('disabled');
          $('ul.setup-panel li a[href="#step-3"]').trigger('click');
          // $(this).remove();
      });

      $('#activate-step-4').on('click', function(e) {
            $('ul.setup-panel li:eq(3)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-4"]').trigger('click');
            // $(this).remove();
        });
        $('#activate-step-5').on('click', function(e) {
              $('ul.setup-panel li:eq(4)').removeClass('disabled');
              $('ul.setup-panel li a[href="#step-5"]').trigger('click');
              // $(this).remove();
          });
  });



}(jQuery));

//Función para que reproudzca el video on hover
// $(document).ready(function(){
//     var nowPlaying = "none";
//         $('div').hover(function(){
//             nowPlaying = $(this).find('iframe').attr('src');
//             $(this).find('iframe').attr('src',nowPlaying+'&autoplay=1');
//         }, function(){
//             $(this).find('iframe').attr('src',nowPlaying);
//         });
// });

function onYouTubeIframeAPIReady() {
    $('div[name="vp"]').each(function(){
    let vid =$(this).attr('videoId');
    let player = new YT.Player(this, {
    videoId: vid
    });
    })
}
    Mouseover = (el) => {
    let yt_object = YT.get(el.id)
    yt_object.playVideo();
    }
    Mouseout = (el) => {
    let yt_object = YT.get(el.id)
    yt_object.pauseVideo();
    }