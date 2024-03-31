import { dropdownDiv, passbtn, wrapper } from "./selectores.js";
import { chooseLang } from "./language.js";
import { UI, showPassword, mainSlider } from "./UI.js";
import { btnSubmitLoader } from "../base/funciones.js";
import { submitBtns } from '../base/selectores.js';



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
    }
}

export default App;