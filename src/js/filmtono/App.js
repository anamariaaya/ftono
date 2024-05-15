import { artistaSecundario, artistasInput, btnAgregar, contratosContainer, gridUsuarios, portada, promoInput, gridCategorias, gridGeneros, gridKeywords, gridLabels, gridIdiomas, gridMensajes } from "./selectores.js";
import { chooseLang } from "../UI/language.js";
import { styleDatalist, styleFileInput, artistasSecundarios, addArtist } from "./artistas.js";
import { readFileName } from "./ux.js";
import { consultaContratos } from "./contratos.js";
import { consultaUsuarios } from "./users.js";
import { consultaCategorias } from "./categorias.js";
import { consultaGeneros } from "./generos.js";
import { consultaKeywords } from "./keywords.js";
import { consultaLabels } from "./labels.js";
import { consultaIdiomas } from "./idiomas.js";
import { consultaMensajes } from "./mensajes.js";
import { changeTabs, eliminarItem, btnSubmitLoader } from "../base/funciones.js";
import {btnEliminar, submitBtns, tabsDiv} from '../base/selectores.js';
import { countryValue } from "../music/APIPaises.js";
import { btnSubmit, paisValue } from "../music/selectores.js";
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
            btnEliminar.forEach(btn => {
                    btn.addEventListener('click', eliminarItem);
                }
            );
        }
        if(paisValue){
            countryValue();
        }
        if(tabsDiv){
            changeTabs();
        }
        if(passbtn){
            showPassword();
        }
        if(submitBtns){
            btnSubmitLoader();
        }
        if(gridCategorias){
            consultaCategorias();
        }
        if(gridGeneros){
            consultaGeneros();
        }
        if(gridKeywords){
            consultaKeywords();
        }
        if(gridLabels){
            consultaLabels();
        }
        if(gridIdiomas){
            consultaIdiomas();
        }
        if(gridMensajes){
            consultaMensajes();
        }
    }
}

export default App;