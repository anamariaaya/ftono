import { btnEliminar } from "./selectores.js";
import { eliminarCuenta } from "./profile.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        if(btnEliminar){
            eliminarCuenta();
        }
    }
}

export default App;