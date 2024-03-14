import { artistaSecundario, artistasInput, btnAgregar, btnEliminarCuenta, btnEliminarUsuario, contratosContainer, portada, promoInput } from "./selectores.js";
import { eliminarCuenta } from "./profile.js";
import { chooseLang } from "../UI/language.js";
import { styleDatalist, styleFileInput, artistasSecundarios, addArtist } from "./artistas.js";
import { readFileName } from "./ux.js";
import { consultaContratos } from "./contratos.js";
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
        if(artistasInput){
            styleDatalist();
        }

        if(portada){
            styleFileInput();
        }

        if(artistaSecundario){
            artistasSecundarios();
        }
        if(btnAgregar){
            addArtist();
        }
        if(promoInput){
            readFileName();
        }
        if(contratosContainer){
            consultaContratos();
        }     
    }
}

export default App;