import { btnEliminarCuenta, btnEliminarUsuario } from "./selectores.js";
import { eliminarCuenta } from "./profile.js";
import { chooseLang } from "../UI/language.js";
// import { eliminarUsuario } from "./users.js";
//import { consultaUsuarios } from "./APIUsuarios.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        if(chooseLang){
            chooseLang();
        }
        if(btnEliminarCuenta){
            eliminarCuenta();
        }
        // if(btnEliminarUsuario){
        //     eliminarUsuario();
        // }
        //consultaUsuarios();
    }
}

export default App;