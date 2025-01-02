import { consultaPaises, countryCurrentValue, indicativoTel, paisElegido } from "./APIPaises.js";
import {tabs, paginador, formularioReg} from "./perfiles.js";
import { selectPais, afterNav, paisContacto, firmasDashboard, countrySelected, gridSellos, gridArtistas, formArtist, albumsBlock, gridAlbumes } from "./selectores.js";
import { chooseLang } from "../UI/language.js";
import { blockDashboard, signContract } from "./contracts.js";
import { eliminarItem, btnSubmitLoader, changeTabs, handleLanguageSelection, initializeLabelCheckbox, handleGenreSelection, handleInstrumentSelection, handleKeywordsSelection, handleCategorySelection } from "../base/funciones.js";
import { btnEliminar, submitBtns, tabsDiv, languageSelect, selloInput, genreSelect, instrumentSelect, keywordSelect, categorySelect } from '../base/selectores.js';
import { passbtn } from "../UI/selectores.js";
import { showPassword } from "../UI/UI.js";
import {consultaSellos } from "./labels.js";
import {consultaArtistas} from "./artists.js";
import {validateArtistForm} from "./artistValidation.js";
import { musicTabs } from "./musicTabs.js";
import { consultaAlbumes } from "./albums.js";

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
        if(gridArtistas){
            consultaArtistas();
        }
        if(formArtist){
            validateArtistForm();
        }
        if(languageSelect){
            handleLanguageSelection();
        }if(selloInput){
            initializeLabelCheckbox();
        }
        if(albumsBlock){
            musicTabs();
        }
        if(gridAlbumes){
            consultaAlbumes();
        }
        if(genreSelect){
            handleGenreSelection();
        }
        if(instrumentSelect){
            handleInstrumentSelection();
        }
        if(keywordSelect){
            handleKeywordsSelection();
        }
        if(categorySelect){
            handleCategorySelection();
        }
    }
}

export default App;