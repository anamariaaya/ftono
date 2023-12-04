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

export function loader(){
    document.addEventListener("DOMContentLoaded", function(event) {
        // Hide the loading screen when the page is fully loaded
        document.getElementById('loadingScreen').style.display = 'none';
    
        // Add event listener to all anchor tags
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Check if the link is not opening in a new tab or window
                if (!e.target.target || e.target.target.toLowerCase() === '_self') {
                    showLoadingScreen();
                }
            });
        });
    });
    
    // Function to show the loading screen
    function showLoadingScreen() {
        document.getElementById('loadingScreen').style.display = 'flex';
    }
    
    // Add event listener to all forms for submit event
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', showLoadingScreen);
    });
}

export default UI;