import {er, num, ig} from '../admin/selectores.js';
import {container} from '../filmtono/selectores.js';
export function imprimirAlerta(message, type, container, sibling) {
    // Crea el div
    const divMensaje = document.createElement('div');
    divMensaje.classList.add('text-center', 'alert', 'd-block', 'col-12');
    
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

    // Mensaje de error
    divMensaje.textContent = message;

    // Insertar en el DOM
    container.insertBefore(divMensaje, sibling);

    // Quitar el alert despues de 3 segundos
    setTimeout( () => {
        divMensaje.remove();
    }, 3000);
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
        //console.log('No hay nada');
        imprimirAlerta('Todos los campos son obligatorios', 'error', form, e.target);
    }

    if(e.target.type === 'email'){
        if(er.test(e.target.value) === false){
            imprimirAlerta('Email no valido', 'error', form, e.target);
        } 
    }

    if(e.target.type === 'tel'){
        if(num.test(e.target.value) === false || e.target.value.length < 9){
            imprimirAlerta('Teléfono no valido', 'error', form, e.target);
        } 
    }

    if(e.target.id === 'instagram'){
        if(ig.test(e.target.value) === false){
            imprimirAlerta('Instagram no valido', 'error', form, e.target);
        } 
    }
    //comprobar que todos los campos esten llenos
    const inputs = document.querySelectorAll('input');
    //comprobar que todos los inputs tengan un valor
    const arrayInputs = Array.from(inputs);
    if(arrayInputs.every( input => input.value !== '')){
        llenarDatos();
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