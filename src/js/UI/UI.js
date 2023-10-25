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

export default UI;