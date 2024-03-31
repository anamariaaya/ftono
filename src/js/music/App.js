import { consultaPaises, countryCurrentValue, indicativoTel, paisElegido } from "./APIPaises.js";
import {tabs, paginador, formularioReg} from "./perfiles.js";
import { selectPais, afterNav, paisContacto, albumsBlock, singlesBlock, firmasDashboard, countrySelected } from "./selectores.js";
import { chooseLang } from "../UI/language.js";
import { musicTabs } from "./MusicTabs.js";
import { blockDashboard, signContract } from "./contracts.js";
import { eliminarItem, btnSubmitLoader } from "../base/funciones.js";
import { btnEliminar, submitBtns } from '../base/selectores.js';
import { passbtn } from "../UI/selectores.js";
import { showPassword } from "../UI/UI.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){ 
        if(chooseLang){
            chooseLang();
        }       
        if(selectPais){
            consultaPaises();
            paisElegido();
        }
        if(paisContacto){
            indicativoTel();
        }
        if(afterNav){
            tabs();
            paginador();
            formularioReg();
        }
        if(albumsBlock && singlesBlock){
            musicTabs();
        }
        if(firmasDashboard){
            blockDashboard();
            signContract();
        }
        if(countrySelected){
            countryCurrentValue();
        }
        if(btnEliminar){
            btnEliminar.addEventListener('click', eliminarItem);
        }
        if(passbtn){
            showPassword();
        }
        if(submitBtns){
            btnSubmitLoader();
        }
    }
}

export default App;