import { btnAgregar } from "../filmtono/selectores.js";
import { dropdownDiv, dropdownMenu, dropdownBtn,  passbtn } from "./selectores.js";

export function UI(){
    dropdownDiv.onmouseover = function(){
        dropdownMenu.classList.remove('no-display');
        dropdownBtn.classList.add('active');
    };
    dropdownMenu.onmouseout = function(){
        dropdownMenu.classList.add('no-display');
        dropdownBtn.classList.remove('active');
    }
}

export function showPassword(){  
    passbtn.forEach(btn => {
        btn.addEventListener('click', () => {
            if(btn.classList.contains('fa-eye-slash')){
                btn.classList.remove('fa-eye-slash');
                btn.classList.add('fa-eye');
                btn.previousElementSibling.type = 'password';
            }else{
                btn.classList.remove('fa-eye');
                btn.classList.add('fa-eye-slash');
                btn.previousElementSibling.type = 'text';
            }
        });
    });
}

// export function loader(){
//     document.addEventListener("DOMContentLoaded", function(event) {
//         // Hide the loading screen when the page is fully loaded
//         document.getElementById('loadingScreen').style.display = 'none';
    
//         // Add event listener to all anchor tags
//         document.querySelectorAll('a').forEach(link => {
//             link.addEventListener('click', function(e) {
//                 // Check if the link is not opening in a new tab or window
//                 if (!e.target.target || e.target.target.toLowerCase() === '_self') {
//                     showLoadingScreen();
//                 }
//             });
//         });
//     });
    
//     // Add event listener to all forms for submit event
//     document.querySelectorAll('form').forEach(form => {
//         form.addEventListener('submit', showLoadingScreen);
//     });

//     document.querySelectorAll('button').forEach(btn => {
//         btn.addEventListener('click', showLoadingScreen);
//     });
// }

// Function to show the loading screen
export function showLoadingScreen() {
    document.getElementById('loadingScreen').style.display = 'flex';
}

//Function for main slider on index.php
export function mainSlider(){
    const wrapper = document.querySelector('.main__slider__wrapper');
    const slides = document.querySelectorAll('.main__slider__item');
    //Add class to the first slide to make the transition smooth
    slides[0].classList.add('main__slider__item--active');
    //get the width of the slides
    let slideWidth = slides[0].clientWidth;
    //set the initial position of the wrapper
    //set the initial slide
    let counter = 0;
    const time = 5000;
    //set the initial position of the wrapper
    //function to move the slides
    const moveSlide = () => {
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        counter++;
        wrapper.style.transform = `translateX(${-slideWidth * counter + (0.08*slideWidth)}px)`;
        // wrapper.style.transform = `translateX(${-slideWidth * counter + 15}px)`;

        addStyle();
        //calculate the wrapper transform to move the slide plus 5% of the slide width
        

        if(counter === slides.length - 1){
            setTimeout(() => {
                moveSlideBack();
            }, time);
        }
    }
    //function to move the slides back to the first slide
    const moveSlideBack = () => {
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        counter = 0;
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
        addStyle();
    }
    //set the interval to move the slides
    setInterval(moveSlide, time);
    //Add specific style to the slides displaying according to the counter and remove the style from the rest of the slides
    const addStyle = () => {
        slides.forEach(slide => {
            slide.classList.remove('main__slider__item--active');
        });
        slides[counter].classList.add('main__slider__item--active');
    }

    //Add event listeners to the buttons to move the slides
    const nextBtn = document.querySelector('.main__slider__btn--next');
    const prevBtn = document.querySelector('.main__slider__btn--prev');
    nextBtn.addEventListener('click', moveSlide);
    prevBtn.addEventListener('click', moveSlideOneBack);

    //function to move the slides one back
    function moveSlideOneBack(){
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        counter--;
        wrapper.style.transform = `translateX(${-slideWidth * counter + (0.08*slideWidth)}px)`;
        addStyle();
        if(counter === 0){
            setTimeout(() => {
                moveSlideBack();
            }, time);
        }
    }

    //Add event listener to the window to move the slides when the window is resized
    window.addEventListener('resize', () => {
        wrapper.style.transition = 'none';
        slideWidth = slides[0].clientWidth;
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
    });


}

export default UI;