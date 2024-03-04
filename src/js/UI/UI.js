
import { dropdownDiv, dropdownMenu, dropdownBtn, passbtn} from "./selectores.js";
import { nextBtn, prevBtn } from "./selectores.js";
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
export function mainSlider(){
    const wrapper = document.querySelector('.main__slider__wrapper');
    const slides = document.querySelectorAll('.main__slider__item');
    let slideWidth = slides[0].clientWidth;
    let counter = 0;
    const time = 7000;

    const updateButtonStates = () => {
        prevBtn.disabled = counter <= 0;
        prevBtn.classList.toggle('main__slider__btn--disabled', counter <= 0);
        nextBtn.disabled = counter >= slides.length - 1;
        nextBtn.classList.toggle('main__slider__btn--disabled', counter >= slides.length - 1);
    };

    updateButtonStates(); // Set the initial state of the buttons

    const moveSlide = () => {
        if(counter >= slides.length - 1) {
            counter = -1; // Reset to -1 because it will increment to 0 in moveSlide()
        }
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        counter++;
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
        updateButtonStates();
    };

    const moveSlideBack = () => {
        if(counter <= 0) {
            counter = slides.length; // Reset to length because it will decrement
        }
        wrapper.style.transition = 'transform 0.5s ease-in-out';
        counter--;
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
        updateButtonStates();
    };

    // Reintegrate automatic sliding with setInterval
    setInterval(() => {
        moveSlide(); // Automatically move to the next slide
    }, time);

    // Manual control
    nextBtn.addEventListener('click', moveSlide);
    prevBtn.addEventListener('click', moveSlideBack);

    // Responsive adjustments
    window.addEventListener('resize', () => {
        slideWidth = slides[0].clientWidth;
        wrapper.style.transform = `translateX(${-slideWidth * counter}px)`;
    });
}



export default UI;