import { validarFormulario } from "../base/funciones.js";
import { selectPais } from "./selectores.js";
import  {readLang} from "../base/funciones.js";
//import { validarFormulario } from '../base/funciones.js';


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
                    option.value = pais.cca2;
                    option.textContent = pais.name.common;
                    selectPais.appendChild(option);  
                });
            }
        }
    );
}

export function paisElegido(){
    selectPais.addEventListener('blur', validarFormulario);
}

