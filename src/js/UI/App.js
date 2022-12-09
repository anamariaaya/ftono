import { dropdownDiv } from "./selectores.js";
import UI from "./UI.js";

class App{
    constructor(){
        this.initApp();
    }

    initApp(){
        if(dropdownDiv){
           UI();
        }
    }
}

export default App;