import { dropdownDiv, dropdownMenu, dropdownBtn } from "./selectores.js"; "./selectores.js";

function UI(){
    dropdownDiv.onmouseover = function(){
        dropdownMenu.classList.remove('no-display');
        dropdownBtn.classList.add('active');
    };
    dropdownMenu.onmouseout = function(){
        dropdownMenu.classList.add('no-display');
        dropdownBtn.classList.remove('active');
    }
}

export default UI;