import { selectLang, divLang, btnLang } from './selectores.js';

export function chooseLang(){

    //Mostrar el select de idioma
    divLang.onmouseover = function(){
        selectLang.classList.remove('no-display');
    };
    selectLang.onmouseout = function(){
        selectLang.classList.add('no-display');
    };

    btnLang.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const lang = e.target.value;
            window.location = `?lang=${lang}`;
        });
    });
}