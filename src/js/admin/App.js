import { consultaPaises, paisElegido } from "./APIPaises.js";
import {tabs, paginador, formularioReg} from "./perfiles.js";
import { selectPais, afterNav } from "./selectores.js";
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
        if(afterNav){
            formularioReg();
            tabs();
            paginador();
        }
        if(chooseLang){
            chooseLang();
        }
    }
}

export default App;