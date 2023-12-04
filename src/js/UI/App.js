import { dropdownDiv, passbtn } from "./selectores.js";
import { chooseLang } from "./language.js";
import { UI, showPassword, loader } from "./UI.js";

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
        if(passbtn){
            showPassword();
        }

        loader();
    }
}

export default App;