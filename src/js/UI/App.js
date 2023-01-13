import { dropdownDiv } from "./selectores.js";
import { chooseLang } from "./language.js";
import UI from "./UI.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        if(dropdownDiv){
           UI();
        }
        if(chooseLang){
            chooseLang();
        }
    }
}

export default App;