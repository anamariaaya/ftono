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
        const {id, titulo, version, isrc, url, sello} = single;

        const linkSingle = document.createElement('A');
        linkSingle.href = window.location.origin+'/music/singles/current?id='+id;
        linkSingle.classList.add('cards__card');

        const cardSingle = document.createElement('DIV');

        const cardInfo = document.createElement('DIV');
        cardInfo.classList.add('cards__info');

        const cardTitle = document.createElement('P');
        cardTitle.textContent = titulo;
        cardTitle.classList.add('cards__text', 'cards__text--span', 'text-green', 'text-24');

        // const cardArtista = document.createElement('P');
        // cardArtista.textContent = artista_name;
        // cardArtista.classList.add('cards__text', 'text-20', 'text-yellow');

        const cardISRC = document.createElement('P');
        cardISRC.textContent = 'ISRC: '+isrc;
        cardISRC.classList.add('cards__text');

        const cardVersion = document.createElement('P');
        cardVersion.textContent = alerts['version'][lang]+': '+version;
        cardVersion.classList.add('cards__text');

        cardInfo.appendChild(cardTitle);
        // cardInfo.appendChild(cardArtista);
        cardInfo.appendChild(cardISRC);
        cardInfo.appendChild(cardVersion);

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