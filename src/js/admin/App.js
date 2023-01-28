import { consultaPaises, paisElegido } from "./APIPaises.js";
import {tabs, paginador} from "./perfiles.js";
import { selectPais, afterNav } from "./selectores.js";

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
            tabs();
            paginador();
        }
    }
}

export default App;