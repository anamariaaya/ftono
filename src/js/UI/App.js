import { dropdownDiv, passbtn } from "./selectores.js";
import { chooseLang } from "./language.js";
import { UI, showPassword, mainSlider } from "./UI.js";
import { eliminarItem } from "../base/funciones.js";
import {btnEliminar} from '../base/selectores.js';

class App{
    constructor(){
        this.initApp();
    }

    initApp(){

        if(dropdownDiv){
           UI();
        }
        if(chooseLang){
            chooseLang();
        }
        if(passbtn){
            showPassword();
        }
        if(btnEliminar){
            btnEliminar.addEventListener('click', eliminarItem);
        }
        mainSlider();

    }
}

export default App;