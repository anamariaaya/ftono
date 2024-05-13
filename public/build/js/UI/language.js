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
            // Create a URL object based on the current location
            const currentUrl = new URL(window.location);
            // Access the URL's search parameters
            const searchParams = currentUrl.searchParams;
            // Set or update the 'lang' parameter
            searchParams.set('lang', lang);
            // Update the search property of the main URL
            currentUrl.search = searchParams.toString();
            // Redirect to the new URL
            window.location.href = currentUrl.href;
        });
    });
}
