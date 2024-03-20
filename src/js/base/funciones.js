import {er, num, indicativo} from '../admin/selectores.js';
import {container} from '../filmtono/selectores.js';
import {body, dashboardContenido} from './selectores.js';

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

export function crearAlerta(accion, id){
    const alertaContenedor = document.createElement('div');
    alertaContenedor.classList.add('modal-alerta--activo');
    // alertaContenedor.onclick = cerrarAlerta;

    const alertaDiv = document.createElement('DIV');
    alertaDiv.classList.add('modal-alerta');

    const alertaIcono = document.createElement('I');
    alertaIcono.classList.add('fa-solid', 'fa-circle-exclamation', 'modal-alerta__icono');

    const alertaTitulo = document.createElement('H3');
    alertaTitulo.classList.add('modal-alerta__titulo');
    alertaTitulo.textContent = '¿Estás seguro?';

    const alertaParrafo = document.createElement('P');
    alertaParrafo.classList.add('modal-alerta__parrafo');
    alertaParrafo.textContent = 'Esta acción no se puede deshacer';

    const alertaBotones = document.createElement('DIV');
    alertaBotones.classList.add('modal-alerta__botones');

    const alertaBotonCancelar = document.createElement('BUTTON');
    alertaBotonCancelar.classList.add('modal-alerta__boton', 'modal-alerta__boton--cancelar');
    alertaBotonCancelar.textContent = 'Cancelar';
    alertaBotonCancelar.onclick = cerrarAlerta;

    const alertaBotonEliminar = document.createElement('FORM');
    alertaBotonEliminar.setAttribute('action', accion);
    alertaBotonEliminar.setAttribute('method', 'POST');

    const alertaInput = document.createElement('INPUT');
    alertaInput.setAttribute('type', 'hidden');
    alertaInput.setAttribute('name', 'id');
    alertaInput.setAttribute('value', id);

    const alertaInputSubmit = document.createElement('INPUT');
    alertaInputSubmit.setAttribute('type', 'submit');
    alertaInputSubmit.setAttribute('value', 'Eliminar');
    alertaInputSubmit.classList.add('modal-alerta__boton');

    alertaBotonEliminar.appendChild(alertaInput);
    alertaBotonEliminar.appendChild(alertaInputSubmit);

    //Agregar botones al div de botones
    alertaBotones.appendChild(alertaBotonCancelar);
    alertaBotones.appendChild(alertaBotonEliminar);

    //Agregar elementos en el DIV alerta
    alertaDiv.appendChild(alertaIcono);
    alertaDiv.appendChild(alertaTitulo);
    alertaDiv.appendChild(alertaParrafo);
    alertaDiv.appendChild(alertaBotones);

    alertaContenedor.appendChild(alertaDiv);
    container.appendChild(alertaContenedor);    
}

export function cerrarAlerta(){
    const alerta = document.querySelector('.modal-alerta--activo');
    if(alerta){
        alerta.remove();
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

export async function eliminarItem(e){
    e.preventDefault();
    const lang = await readLang();
    const alerts = await readJSON();
    if(e.target.classList.contains('btn-delete')){
        const id = e.target.id;
        dashboardContenido.classList.add('overlay');

        const divModal = document.createElement('div');
        divModal.classList.add('deleteModal');

        const modal = document.createElement('div');
        modal.classList.add('deleteModal__modal');

        const btnCerrar = document.createElement('button');
        btnCerrar.classList.add('deleteModal__btn-close');
        btnCerrar.innerHTML = '<i class="fas fa-times"></i>';
        btnCerrar.onclick = cerrarModal;

        const icon = document.createElement('i');
        icon.classList.add('fa-solid', 'fa-circle-exclamation', 'deleteModal__icon');

        const paragraph = document.createElement('p');
        paragraph.classList.add('deleteModal__paragraph');
        paragraph.textContent = alerts['delete_item'][lang];

        const btnWrapper = document.createElement('div');
        btnWrapper.classList.add('btn__wrapper');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.textContent = alerts['delete'][lang];
        btnEliminar.id = id;
        btnEliminar.dataset.type = e.target.dataset.type;
        btnEliminar.dataset.role = e.target.dataset.role;
        btnEliminar.dataset.item = e.target.dataset.item;

        //redirect to delete route
        btnEliminar.onclick = (e) => {
            if(e.target.dataset.type !== ''){
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.id}&type=${e.target.dataset.type}`;
            }else{
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.id}`;
            }
        }

        const btnCancelar = document.createElement('button');
        btnCancelar.classList.add('btn-cancel');
        btnCancelar.textContent = alerts['cancel'][lang];
        btnCancelar.onclick = cerrarModal;

        btnWrapper.appendChild(btnEliminar);
        btnWrapper.appendChild(btnCancelar);

        modal.appendChild(btnCerrar);
        modal.appendChild(icon);
        modal.appendChild(paragraph);
        modal.appendChild(btnWrapper);

        divModal.appendChild(modal);
        body.appendChild(divModal);
    }
}
function cerrarModal(){
    const modal = document.querySelector('.deleteModal');
    dashboardContenido.classList.remove('overlay');
    modal.remove();
}