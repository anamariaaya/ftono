import { consultaPaises } from "./APIPaises.js";
import {bloquearBotones} from "./perfiles.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        consultaPaises();
        bloquearBotones();
    }
}

export default App;