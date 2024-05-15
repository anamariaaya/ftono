import { dropdownDiv, passbtn, wrapper, gridCategorias, gridGeneros, gridCategory, mensajeInput } from "./selectores.js";
import { chooseLang } from "./language.js";
import { UI, showPassword, mainSlider, mensaje } from "./UI.js";
import { btnSubmitLoader } from "../base/funciones.js";
import { submitBtns } from '../base/selectores.js';
import { consultaCategorias } from "./categories.js";
import { consultaGeneros } from "./generos.js";
import { consultaCategory } from "./category.js";

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
        if(submitBtns){
            btnSubmitLoader();
        }
        if(wrapper){
            mainSlider();
        }
        if(gridCategorias){
            consultaCategorias();
        }
        if(gridGeneros){
            consultaGeneros();
        }
        if(gridCategory){
            consultaCategory();
        }
        if(mensajeInput){
            mensaje();
        }
    }
}

export default App;