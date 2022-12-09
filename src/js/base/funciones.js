import {er, num, ig} from '../admin/selectores.js';
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