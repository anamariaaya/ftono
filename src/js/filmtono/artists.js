import {gridArtistas, artistasSearchInput} from './selectores.js';
import {readLang, readJSON, eliminarItem, normalizeText, caps} from '../base/funciones.js';


export async function consultaArtistas(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/artists/artists');
        const datos = await resultado.json();
       mostrarArtistas(datos);
    }catch(error){
        console.log(error);
    }
}

async function mostrarArtistas(datos){
    const lang = await readLang();
    const alerts = await readJSON();

    datos.forEach(artista => {
        //extract the type of contract from the name of the file nombre_doc
        const{id, nombre, precio_show, nivel_en, nivel_es} = artista;

        //Create the info section
        const cardArtista = document.createElement('div');
        cardArtista.classList.add('cards__card');

        const cardInfo = document.createElement('div');
        cardInfo.classList.add('cards__info');

        const titleArtista = document.createElement('p');
        titleArtista.textContent = nombre;
        titleArtista.classList.add('cards__text', 'cards__text--span');

        cardInfo.appendChild(titleArtista);

        const precioInfo = document.createElement('DIV');
        precioInfo.classList.add('cards__info--div');

        const titlePrecio = document.createElement('p');
        titlePrecio.textContent = alerts['show-price'][lang]+':';
        titlePrecio.classList.add('cards__text', 'cards__text--span');

        const precioArtista = document.createElement('p');
        precioArtista.textContent = '$'+precio_show.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        precioArtista.classList.add('cards__text', 'cards__text--span');

        precioInfo.appendChild(titlePrecio);
        precioInfo.appendChild(precioArtista);

        const nivelInfo = document.createElement('DIV');
        nivelInfo.classList.add('cards__info--div');

        const titleNivel = document.createElement('p');
        titleNivel.textContent = lang === 'en' ? 'Level: ' : 'Nivel: ';
        titleNivel.classList.add('cards__text', 'cards__text--span');


        const nivelArtista = document.createElement('p');
        nivelArtista.textContent = lang === 'en' ? caps(nivel_en) : caps(nivel_es);
        nivelArtista.classList.add('cards__text', 'cards__text--span');

        nivelInfo.appendChild(titleNivel);
        nivelInfo.appendChild(nivelArtista);

        //Create the actions section
        const cardActions = document.createElement('div');
        cardActions.classList.add('cards__actions');

        //generar el botón para editar el sello
        const btnEditar = document.createElement('A');
        btnEditar.classList.add('btn-update');
        btnEditar.href = '/filmtono/artists/edit?id='+id;

        //generar ícono de lápiz para el botón de editar
        const iconoLapiz = document.createElement('I');
        iconoLapiz.classList.add('fa-solid', 'fa-pencil', 'no-click');

        //Agregar el ícono al botón
        btnEditar.appendChild(iconoLapiz);

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.id = 'eliminar';
        btnEliminar.value = id;
        btnEliminar.dataset.item = 'artists';
        btnEliminar.dataset.role = 'filmtono';
        btnEliminar.onclick = eliminarItem;

        const iconEliminar = document.createElement('i');
        iconEliminar.classList.add('fa-solid', 'fa-trash-can', 'no-click');

        btnEliminar.appendChild(iconEliminar);
        cardActions.appendChild(btnEditar);
        cardActions.appendChild(btnEliminar);

        cardArtista.appendChild(cardInfo);
        cardArtista.appendChild(precioInfo);
        cardArtista.appendChild(nivelInfo);
        cardArtista.appendChild(cardActions);

  
        gridArtistas.appendChild(cardArtista);
    });
    filtrarArtistas();
}

function filtrarArtistas(){
    artistasSearchInput.addEventListener('input', e => {
        const texto = normalizeText(e.target.value);
        const cards = document.querySelectorAll('.cards__card');

        cards.forEach(card => {
            const nombre = normalizeText(card.textContent);
            if(nombre.indexOf(texto) !== -1){
                card.style.display = 'flex';
                card.style.marginRight = '2rem';
                gridArtistas.style.columnGap = '0';
            }else{
                card.style.display = 'none';
            }
        });
    }); 
}