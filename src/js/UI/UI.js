
import { dropdownDiv, dropdownMenu, dropdownBtn, passbtn} from "./selectores.js";
import { nextBtn, prevBtn, wrapper } from "./selectores.js";

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

//Function for main slider on index.php
export function mainSlider() {
    const slides = document.querySelectorAll('.main__slider__item');
    let slideWidth = slides[0].clientWidth;
    let counter = 0;
    const time = 7000;

    // Function to update active class on slides
    const updateActiveClass = () => {
        slides.forEach((slide, index) => {
            slide.classList.toggle('main__slider__item--active', index === counter);
        });
    };
    

    const updateButtonStates = () => {
        prevBtn.disabled = counter <= 0;
        prevBtn.classList.toggle('main__slider__btn--disabled', counter <= 0);
        nextBtn.disabled = counter >= slides.length - 1;
        nextBtn.classList.toggle('main__slider__btn--disabled', counter >= slides.length - 1);
    };

    updateButtonStates(); // Set the initial state of the buttons
    updateActiveClass();  // Update the active class on initial load

    const moveSlide = () => {
        if (counter >= slides.length - 1) counter=-1; // Prevent going beyond the last slide
        counter++;
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
        updateButtonStates();
        updateActiveClass();
    };

    const moveSlideBack = () => {
        if (counter <= 0) return; // Prevent going before the first slide
        counter--;
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
        updateButtonStates();
        updateActiveClass();
    };

    // Automatic sliding
    let autoSlideInterval = setInterval(moveSlide, time);

    // Stop the automatic sliding when manual navigation is used
    const stopAutoSlide = () => {
        clearInterval(autoSlideInterval);
    };
    
    nextBtn.addEventListener('click', () => {
        moveSlide();
        stopAutoSlide();
    });
    
    prevBtn.addEventListener('click', () => {
        moveSlideBack();
        stopAutoSlide();
    });
    
    window.addEventListener('resize', () => {
        slideWidth = slides[0].clientWidth;
        wrapper.style.transform = `translateX(${(-slideWidth * counter)}px)`;
        updateActiveClass();
    });
}    




export default UI;