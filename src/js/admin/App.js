import { consultaPaises, indicativoTel, paisElegido } from "./APIPaises.js";
import {tabs, paginador, formularioReg} from "./perfiles.js";
import { selectPais, afterNav, paisContacto } from "./selectores.js";
import { chooseLang } from "../UI/language.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){        
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
        if(chooseLang){
            chooseLang();
        }
    }
}

export default App;