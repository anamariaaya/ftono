import { selectPais } from "./selectores.js";
async function readLang(){
    try{
        const resultado = await fetch('http://localhost:3000/api/filmtono/lenguaje');
        const data = await resultado.json();
        return data;
    }catch(error){
        console.log(error);
    }
}

export async function consultaPaises(){
    try{
        let url = `https://restcountries.com/v3.1/all`;
        // if(lang !== 'en'){
        //     url += `&lang=${lang}`;
        // }
        const resultado = await fetch(url);
        const datos = await resultado.json();
        mostrarPaises(datos);
    }catch(error){
        console.log(error);
    }
}


function mostrarPaises(datos){
    readLang().then(lang => {
            if(lang === 'es'){
                datos.forEach(pais => {
                    //ordenar los paises por orden alfabético
                    datos.sort((a, b) => {
                        if(a.translations.spa.common < b.translations.spa.common){
                            return -1;
                        }
                        if(a.translations.spa.common > b.translations.spa.common){
                            return 1;
                        }
                        return 0;
                    });
                    //crear option con el nombre del pais
                    const option = document.createElement('option');
                    option.value = pais.translations.spa.common;
                    option.textContent = pais.translations.spa.common;
                    selectPais.appendChild(option);
                });
            } else{
                datos.forEach(pais => {
                    //ordenar los países por orden alfabético
                    datos.sort((a, b) => {
                        if(a.name.common < b.name.common){
                            return -1;
                        }
                        if(a.name.common > b.name.common){
                            return 1;
                        }
                        return 0;
                    });

                    //crear option con el nombre del pais
                    const option = document.createElement('option');
                    option.value = pais.name.common;
                    option.textContent = pais.name.common;
                    selectPais.appendChild(option);  
                });
            }
        }
    );
}

export function paisElegido(){
    selectPais.addEventListener('change', e => {
        const pais = e.target.value;
        console.log(pais);
    });
}

