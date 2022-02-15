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

    const img = document.querySelector('#mainImg');
    const rightImg = document.querySelector('#rightImg');
    const leftImg = document.querySelector('#leftImg');
    

    let i = 0;
    img.src = imgArray[i];
    rightImg.src = imgArray[i+1];
    leftImg.src = imgArray[i = imgArray.length -1];

    // function slider(){
    //     img.src = imgArray[i];
    //     i = ( i < imgArray.length -1) ? i+1 : 0;
    // }
    // setInterval(slider, 2000);

    const buttonNext = document.querySelector('.next');
    const buttonPrev = document.querySelector('.prev');

    buttonNext.addEventListener('click', function(){
        img.src = imgArray[i];
        i = ( i < imgArray.length -1) ? i+1 : 0;
    });
        
    //  buttonNext.onclick = slideShowNext = () => {
    //     img.src = imgArray[i];
    //      i = ( i < imgArray.length -1) ? i+1 : 0;
    //  }

    buttonPrev.onclick = slideShowPrev = () => {
        img.src = imgArray[i];
        i = ( i <= 0 ) ? imgArray.length -1 : i-1;
    }
};

// function mainSlide(){
//     let i = 0;
//     const slider = document.querySelector('.slider');
//     const imgArray = [
//         '../build/img/1.jpg',
//         '../build/img/2.jpg',
//         '../build/img/3.jpg'
//     ]
//     const buttonNext = document.querySelector('.next');

//     imgArray.forEach(img => {
//         const imagen = document.createElement('IMG');
//         imagen.src = `${imgArray[i++]}`;
//         imagen.dataset.imagenId=i;
//         slider.appendChild(imagen);
//     });

    
// };

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
