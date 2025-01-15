import { gridSingles,singlesInput } from "./selectores.js";
import { readLang, readJSON, eliminarItem, normalizeText, caps } from "../base/funciones.js";

export async function consultaSingles(){
    try{
        const resultado = await fetch(window.location.origin+'/api/music/singles');
        const datos = await resultado.json();
        mostrarSingles(datos);
    }catch(error){
        console.log(error);
    }
}

async function mostrarSingles(datos){
    const lang = await readLang();
    const alerts = await readJSON();
    console.log(datos);

    datos.forEach(single => {
        const {id, titulo, version, isrc, sello, artista_name, genero_en, genero_es, gensec_en, gensec_es, categorias_en, categorias_es, idioma_en, idioma_es, nivel_cancion_en, nivel_cancion_es} = single;

        const linkSingle = document.createElement('A');
        linkSingle.href = window.location.origin+'/music/singles/current?id='+id;
        linkSingle.classList.add('cards__card');

        const cardSingle = document.createElement('DIV');

        const cardInfo = document.createElement('DIV');
        cardInfo.classList.add('cards__info');

        const cardTitle = document.createElement('P');
        cardTitle.textContent = titulo;
        cardTitle.classList.add('cards__text', 'cards__text--span', 'text-green', 'text-24');

        const cardArtista = document.createElement('P');
        cardArtista.textContent = artista_name;
        cardArtista.classList.add('cards__text', 'text-20', 'text-yellow');

        const cardISRC = document.createElement('P');
        cardISRC.textContent = 'ISRC: '+isrc;
        cardISRC.classList.add('cards__text');

        const cardVersion = document.createElement('P');
        cardVersion.textContent = alerts['version'][lang]+': '+version;
        cardVersion.classList.add('cards__text');

        const cardGenre = document.createElement('P');
        if(lang === 'en'){
            cardGenre.textContent = alerts['genre'][lang]+': '+ genero_en;
        }else{
            cardGenre.textContent = alerts['genre'][lang]+': '+ genero_es;
        }
        cardGenre.classList.add('cards__text');

        const cardGenreSec = document.createElement('P');
        if(lang === 'en'){
            cardGenreSec.textContent = alerts['genre-sec'][lang]+': '+ gensec_en;
        }else{
            cardGenreSec.textContent = alerts['genre-sec'][lang]+': '+ gensec_es;
        }
        cardGenreSec.classList.add('cards__text');

        const cardCategories = document.createElement('P');
        if(lang === 'en'){
            cardCategories.textContent = alerts['categories'][lang]+': '+ categorias_en;
        }else{
            cardCategories.textContent = alerts['categories'][lang]+': '+ categorias_es;
        }
        cardCategories.classList.add('cards__text');

        const cardIdiomas = document.createElement('P');
        if(lang === 'en'){
            cardIdiomas.textContent = alerts['languages'][lang]+': '+ idioma_en;
        }else{
            cardIdiomas.textContent = alerts['languages'][lang]+': '+ idioma_es;
        }
        cardIdiomas.classList.add('cards__text');

        const cardLevel = document.createElement('P');
        if(lang === 'en'){
            cardLevel.textContent = alerts['level'][lang]+': '+ nivel_cancion_en;
        }else{
            cardLevel.textContent = alerts['level'][lang]+': '+ nivel_cancion_es;
        }
        cardLevel.classList.add('cards__text');

        cardInfo.appendChild(cardTitle);
        cardInfo.appendChild(cardArtista);
        cardInfo.appendChild(cardISRC);
        cardInfo.appendChild(cardVersion);
        cardInfo.appendChild(cardGenre);
        if(gensec_en !== null && gensec_es !== null){
            cardInfo.appendChild(cardGenreSec);
        }
        if(categorias_en !== null && categorias_es !== null){
            cardInfo.appendChild(cardCategories);
        }
        if(idioma_en !== null && idioma_es !== null){
            cardInfo.appendChild(cardIdiomas);
        }

        const cardActions = document.createElement('DIV');
        cardActions.classList.add('cards__actions');

        const btnEditar = document.createElement('A');
        btnEditar.classList.add('btn-update');
        btnEditar.href = window.location.origin+'/music/singles/edit?id='+id;

        const iconoLapiz = document.createElement('I');
        iconoLapiz.classList.add('fas', 'fa-pencil-alt', 'no-click');

        btnEditar.appendChild(iconoLapiz);

        const btnEliminar = document.createElement('BUTTON');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.id = 'eliminar';
        btnEliminar.value = id;
        btnEliminar.dataset.item = 'singles';
        btnEliminar.dataset.role = 'music';
        btnEliminar.onclick = eliminarItem;

        const iconEliminar = document.createElement('I');
        iconEliminar.classList.add('fa-solid', 'fa-trash-can', 'no-click');

        btnEliminar.appendChild(iconEliminar);

        cardActions.appendChild(btnEditar);
        cardActions.appendChild(btnEliminar);

        cardSingle.appendChild(cardInfo);
        cardSingle.appendChild(cardActions);

        linkSingle.appendChild(cardSingle);

        gridSingles.appendChild(linkSingle);
    });
    filtrarSingles();
}

function filtrarSingles(){
    singlesInput.addEventListener('input', (e) => {
        const busqueda = normalizeText(e.target.value);
        const singles = gridSingles.querySelectorAll('.cards__card');

        singles.forEach(single => {
            const titulo = normalizeText(single.textContent);
            if(titulo.indexOf(busqueda) !== -1){
                single.style.display = 'flex';
                single.style.marginRight = '2rem';
                gridSingles.style.columnGap = '0';
            }else{
                single.style.display = 'none';
            }
        });
    });
}