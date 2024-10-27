import { gridAlbumes,albumesInput } from "./selectores.js";
import { readLang, readJSON, eliminarItem, normalizeText, caps } from "../base/funciones.js";

export async function consultaAlbumes(){
    try{
        const resultado = await fetch(window.location.origin+'/api/music/albums/albums');
        const datos = await resultado.json();
        mostrarAlbumes(datos);
    }catch(error){
        console.log(error);
    }
}

async function mostrarAlbumes(datos){
    const lang = await readLang();
    const alerts = await readJSON();

    datos.forEach(album => {
        const {id, titulo, portada, upc, publisher} = album;

        const linkAlbum = document.createElement('A');
        linkAlbum.href = window.location.origin+'/music/albums/current?id='+id;
        linkAlbum.classList.add('cards__card');

        const cardAlbum = document.createElement('DIV');

        const cardInfo = document.createElement('DIV');
        cardInfo.classList.add('cards__info');

        const imgAlbum = document.createElement('IMG');
        imgAlbum.src = '/portadas/'+portada;
        imgAlbum.alt = titulo;
        imgAlbum.classList.add('cards__img', 'cards__img--album');

        const cardTitle = document.createElement('P');
        cardTitle.textContent = titulo;
        cardTitle.classList.add('cards__text', 'cards__text--span', 'text-green', 'text-24');

        const cardUPC = document.createElement('P');
        cardUPC.textContent = 'UPC: '+upc;
        cardUPC.classList.add('cards__text');

        const cardPublisher = document.createElement('P');
        cardPublisher.textContent = alerts['publisher'][lang]+': '+publisher;
        cardPublisher.classList.add('cards__text');

        cardInfo.appendChild(imgAlbum);
        cardInfo.appendChild(cardTitle);
        cardInfo.appendChild(cardUPC);
        cardInfo.appendChild(cardPublisher);

        const cardActions = document.createElement('DIV');
        cardActions.classList.add('cards__actions');

        const btnEditar = document.createElement('A');
        btnEditar.classList.add('btn-update');
        btnEditar.href = window.location.origin+'/music/albums/edit?id='+id;

        const iconoLapiz = document.createElement('I');
        iconoLapiz.classList.add('fas', 'fa-pencil-alt', 'no-click');

        btnEditar.appendChild(iconoLapiz);

        const btnEliminar = document.createElement('BUTTON');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.id = 'eliminar';
        btnEliminar.value = id;
        btnEliminar.dataset.item = 'albums';
        btnEliminar.dataset.role = 'music';
        btnEliminar.onclick = eliminarItem;

        const iconEliminar = document.createElement('I');
        iconEliminar.classList.add('fa-solid', 'fa-trash-can', 'no-click');

        btnEliminar.appendChild(iconEliminar);

        cardActions.appendChild(btnEditar);
        cardActions.appendChild(btnEliminar);

        cardAlbum.appendChild(cardInfo);
        cardAlbum.appendChild(cardActions);

        linkAlbum.appendChild(cardAlbum);

        gridAlbumes.appendChild(linkAlbum);
    });
    filtrarAlbumes();
}

function filtrarAlbumes(){
    albumesInput.addEventListener('input', (e) => {
        const busqueda = normalizeText(e.target.value);
        const albumes = gridAlbumes.querySelectorAll('.cards__card');

        albumes.forEach(album => {
            const titulo = normalizeText(album.textContent);
            if(titulo.indexOf(busqueda) !== -1){
                album.style.display = 'flex';
                album.style.marginRight = '2rem';
                gridAlbumes.style.columnGap = '0';
            }else{
                album.style.display = 'none';
            }
        });
    });
}