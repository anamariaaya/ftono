import { artistaSecundario, artistasInput, btnAgregar, contratosContainer, gridUsuarios, portada, promoInput } from "./selectores.js";
import { chooseLang } from "../UI/language.js";
import { styleDatalist, styleFileInput, artistasSecundarios, addArtist } from "./artistas.js";
import { readFileName } from "./ux.js";
import { consultaContratos } from "./contratos.js";
import { consultaUsuarios } from "./users.js";
import { eliminarItem } from "../base/funciones.js";
import {btnEliminar} from '../base/selectores.js';

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        if(chooseLang){
            chooseLang();
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
        if(gridUsuarios){
            consultaUsuarios();
        }
        if(btnEliminar){
            btnEliminar.addEventListener('click', eliminarItem);
        }
    }
}

export default App;