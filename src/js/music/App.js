import { consultaPaises, countryCurrentValue, indicativoTel, paisElegido } from "./APIPaises.js";
import {tabs, paginador, formularioReg} from "./perfiles.js";
import { selectPais, afterNav, paisContacto, firmasDashboard, countrySelected, gridSellos } from "./selectores.js";
import { chooseLang } from "../UI/language.js";
import { blockDashboard, signContract } from "./contracts.js";
import { eliminarItem, btnSubmitLoader, changeTabs } from "../base/funciones.js";
import { btnEliminar, submitBtns, tabsDiv } from '../base/selectores.js';
import { passbtn } from "../UI/selectores.js";
import { showPassword } from "../UI/UI.js";
import {consultaSellos } from "./labels.js";

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

        if(firmasDashboard){
            blockDashboard();
            signContract();
        }
        if(countrySelected){
            countryCurrentValue();
        }
        if(btnEliminar){
            btnEliminar.forEach(btn => {
                    btn.addEventListener('click', eliminarItem);
                }
            );
        }
        if(passbtn){
            showPassword();
        }
        if(tabsDiv){
            changeTabs();
        }
        if(submitBtns){
            btnSubmitLoader();
        }
        if(gridSellos){
            consultaSellos();
        }
    }
}

export default App;