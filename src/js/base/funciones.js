import {er, num, indicativo, formArtist, artistFields} from '../music/selectores.js';

import {body, dashboardContenido, tabsBtns, tabsContent, tabsDiv, submitBtns} from './selectores.js';


export async function readLang(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/lenguaje');
        const data = await resultado.json();
        return data;
    }catch(error){
        console.log(error);
    }
}

//Leer el lang.json
export async function readJSON(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/alerts', {mode: 'cors'});
        const data = await resultado.json();
        return data;
    }catch(error){
        console.log(error);
    }
}

export async function imprimirAlerta(message, type, container, sibling) {
    // Crea el div
    const divMensaje = document.createElement('div');
    divMensaje.style.gridColumn = '1 / 3';
    
    // Si es de tipo error agrega una clase
    if(type === 'error') {
         divMensaje.classList.add('alerta__error');
    } else {
         divMensaje.classList.add('alerta__exito');
    }

    const error = document.querySelector('.alerta__error');
    if(error){
        error.remove();
    }

    const lang = await readLang();
    const alerts = await readJSON();
    divMensaje.textContent = alerts[message][lang];

    // Insertar en el DOM
    container.insertBefore(divMensaje, sibling);

    // Quitar el alert despues de 3 segundos
    setTimeout( () => {
        divMensaje.remove();
    }, 4000);
}

export function validarFormulario(e) {
    const form = e.target.parentElement;

    if(e.target.value.length > 0){
        //Elimina los errores
        const error = document.querySelector('.alerta__error');
        if(error){
            error.remove();
        }
       
    } else {
        imprimirAlerta('input', 'error', form, e.target);
    }

    if(e.target.type === 'email'){
        if(er.test(e.target.value) === false){
            imprimirAlerta('email', 'error', form, e.target);
        } 
    }

    //verificar que se alla elegido una opción de un select
    if(e.target.type === 'select-one'){
        if(e.target.value === '0' || e.target.value === ''){
            imprimirAlerta('select', 'error', form, e.target);
        }
    }

    if(e.target.type === 'tel'){
        if(num.test(e.target.value) === false || e.target.value.length < 8){
            imprimirAlerta('phone', 'error', form, e.target);
        } 
    }
}

export function llenarDatos() {
    const inputs = document.querySelectorAll('.form input');
    const arrayInputs = Array.from(inputs);
    const datos = {};
    arrayInputs.forEach( input => {
        datos[input.id] = input.value;
    });
    return datos;
}

export function limpiarHTML(element){
    while(element.firstChild) {
        element.removeChild(element.firstChild);
    }
}

export function loader(button){
    // Hide the loading screen when the page is fully loaded
    document.getElementById('loadingScreen').style.display = 'none';

    //Add event listener for the button given to trigger the loader
    button.addEventListener('click', showLoadingScreen);
    
    // Function to show the loading screen
    function showLoadingScreen() {
        document.getElementById('loadingScreen').style.display = 'flex';
    }
}

export function loaderPage(){
    document.getElementById('loadingScreen').style.display = 'none';
    window.addEventListener('load', () => {
        document.getElementById('loadingScreen').style.display = 'flex';
    });
}

export function stopLoader(){
    document.getElementById('loadingScreen').style.display = 'none';
}

export async function eliminarItem(e){
    e.preventDefault();

    const lang = await readLang();
    const alerts = await readJSON();
    if(e.target.classList.contains('btn-delete')){
        const id = e.target.value;
        dashboardContenido.classList.add('overlay');

        const alertaContenedor = document.createElement('div');
        alertaContenedor.classList.add('modal-alerta--activo');
        // alertaContenedor.onclick = cerrarAlerta;

        const alertaDiv = document.createElement('DIV');
        alertaDiv.classList.add('modal-alerta');

        const alertaIcono = document.createElement('I');
        alertaIcono.classList.add('fa-solid', 'fa-circle-exclamation', 'modal-alerta__icono');

        const alertaTitulo = document.createElement('H3');
        alertaTitulo.classList.add('modal-alerta__titulo');
        alertaTitulo.textContent = alerts['delete_item'][lang];

        const alertaParrafo = document.createElement('P');
        alertaParrafo.classList.add('modal-alerta__parrafo');
        alertaParrafo.textContent = alerts['delete_confirmation'][lang];

        const alertaBotones = document.createElement('DIV');
        alertaBotones.classList.add('modal-alerta__botones');

        const alertaBotonCancelar = document.createElement('BUTTON');
        alertaBotonCancelar.classList.add('modal-alerta__boton', 'modal-alerta__boton--cancelar');
        alertaBotonCancelar.textContent = 'Cancelar';
        alertaBotonCancelar.onclick = cerrarAlerta;

        const btnCerrar = document.createElement('button');
        btnCerrar.classList.add('deleteModal__btn-close');
        btnCerrar.innerHTML = '<i class="fas fa-times"></i>';
        btnCerrar.onclick = cerrarAlerta;

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.textContent = alerts['delete'][lang];
        btnEliminar.value = id;
        btnEliminar.dataset.type = e.target.dataset.type;
        btnEliminar.dataset.role = e.target.dataset.role;
        btnEliminar.dataset.item = e.target.dataset.item;
        loader(btnEliminar);

        //redirect to delete route
        btnEliminar.onclick = (e) => {
           if( e.target.dataset.type === undefined || e.target.dataset.type === 'undefined'){
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.value}`;
            }
            else{
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.value}&type=${e.target.dataset.type}`;
            }
        }

        //Agregar botones al div de botones
        alertaBotones.appendChild(alertaBotonCancelar);
        alertaBotones.appendChild(btnEliminar);
        alertaDiv.appendChild(alertaIcono);
        alertaDiv.appendChild(alertaTitulo);
        alertaDiv.appendChild(alertaParrafo);
        alertaDiv.appendChild(alertaBotones);
        alertaDiv.appendChild(btnCerrar);
        alertaContenedor.appendChild(alertaDiv);
        body.appendChild(alertaContenedor);
    }
}
export function cerrarAlerta(){
    const alerta = document.querySelector('.modal-alerta--activo');
    if(alerta){
        alerta.remove();
    }
}

export function changeTabs(){
    for(let i = 0; i < tabsBtns.length; i++){
        tabsBtns[i].addEventListener('click', () => {
            tabsBtns.forEach(btn => btn.classList.remove('tabs__lg--btn--active'));
            tabsContent.forEach(content => content.style.display = 'none');
            tabsBtns[i].classList.add('tabs__lg--btn--active');
            tabsContent[i].style.display = 'block';
        });
    }
}

export function btnSubmitLoader(){
    submitBtns.forEach(btn => {
        loader(btn);
    });
}

export function normalizeText(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
}

export function caps(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}

//social media url validation
export function validateUrl(e) {
    let urlValue = e.target.value.trim(); // Get the current value of the input and trim spaces
    const re = /^(https?:\/\/)?([a-zA-Z0-9-]+)\.[a-zA-Z]{2,}(\/\S*)?$/; // Flexible URL validation

    if (re.test(urlValue) === false) {
        imprimirAlerta('url', 'error', e.target.closest('.form__group'), e.target);
    } else {
        // If no http/https, prepend 'https://'
        if (!urlValue.match(/^https?:\/\//)) {
            urlValue = 'https://' + urlValue;
        }
        
        // Set the corrected value back into the input
        e.target.value = urlValue;
    }
}
