import {btnRegistro, btnMenu} from './selectores.js';
import {form} from './form.js';
import { datosEmpresa } from './Empresa.js';
import { llenarDatos } from '../base/funciones.js';
import { sellos } from './sellos.js';

export function bloquearBotones(){  
    if(btnRegistro){
        btnMenu.forEach(btn => {
            btn.classList.add('disabled');
        });
        btnRegistro.addEventListener('click', modalRegistro);
    }
}

function modalRegistro(e){
    e.preventDefault();
    const body = document.querySelector('body');
    body.classList.add('overlay');

    const divModal = document.createElement('div');
    divModal.classList.add('register');

    const modal = document.createElement('div');
    modal.classList.add('register__modal');

    const btnCerrar = document.createElement('button');
    btnCerrar.classList.add('register__btn-cerrar');
    btnCerrar.innerHTML = '<i class="fas fa-times"></i>';
    btnCerrar.onclick = cerrarModal;

    const titulo = document.createElement('h3');
    titulo.classList.add('register__titulo');
    titulo.textContent = 'Completa tu registro';

    const submit = document.createElement('button');
    submit.classList.add('btn-submit');
    submit.onclick = sincronizarDatos;
    submit.textContent = 'Registrarse';

    //Agregar formulario y boton al modal
    modal.appendChild(btnCerrar);
    modal.appendChild(titulo);
    modal.appendChild(form);
    modal.appendChild(submit);
    divModal.appendChild(modal);
    body.appendChild(divModal);
}

function sincronizarDatos(){
    const datos = llenarDatos();    
   //sincronizar datos con datosEmpresa
    datosEmpresa.empresa = datos.empresa;
    datosEmpresa.id_fiscal = datos.id_fiscal;
    datosEmpresa.direccion = datos.direccion;
    datosEmpresa.ciudad = datos.ciudad;
    datosEmpresa.pais = datos.pais;
    datosEmpresa.instagram = datos.instagram;
    datosEmpresa.nombre_comercial = datos.nombre_comercial;
    datosEmpresa.apellido_comercial = datos.apellido_comercial;
    datosEmpresa.email_comercial = datos.email_comercial;
    datosEmpresa.tel_comercial = datos.tel_comercial;
    datosEmpresa.nombre_contable = datos.nombre_contable;
    datosEmpresa.apellido_contable = datos.apellido_contable;
    datosEmpresa.email_contable = datos.email_contable;
    datosEmpresa.tel_contable = datos.tel_contable;  
    apiRegistro();    
}

async function apiRegistro(){
    const data = new FormData();
    data.append('empresa', datosEmpresa.empresa);
    data.append('id_fiscal', datosEmpresa.id_fiscal);
    data.append('direccion', datosEmpresa.direccion);
    data.append('ciudad', datosEmpresa.ciudad);
    data.append('pais', datosEmpresa.pais);
    data.append('instagram', datosEmpresa.instagram);
    data.append('nombre_comercial', datosEmpresa.nombre_comercial);
    data.append('apellido_comercial', datosEmpresa.apellido_comercial);
    data.append('email_comercial', datosEmpresa.email_comercial);
    data.append('tel_comercial', datosEmpresa.tel_comercial);
    data.append('nombre_contable', datosEmpresa.nombre_contable);
    data.append('apellido_contable', datosEmpresa.apellido_contable);
    data.append('email_contable', datosEmpresa.email_contable);
    data.append('tel_contable', datosEmpresa.tel_contable);

    try{
        const url = 'http://localhost:3000/api/profile';
        
        const respuesta = await fetch(url, {
            method: 'POST',
            body: data
        });

        const resultado = await respuesta.json();

        if(resultado.resultado){
            statusPerfil();
            selloPerfil();
            Swal.fire({
                title: 'Registro exitoso',
                text: 'Ya puedes utilizar la plataforma',
                icon: 'success'
            }).then( () => {
                window.location.reload();
            });
        };
    }catch(error){
        console.log(error);
        Swal.fire({
            title: 'Error',
            text: 'Mensaje no enviado. Intenta de nuevo',
            icon: 'error'
        }).then( () => {
            window.location.reload();
        });
    }
}

async function statusPerfil(){
    const data = new FormData();
    data.append('perfil', '1');

    try{
        const url = 'http://localhost:3000/api/profile/status';
        
        const respuesta = await fetch(url, {
            method: 'POST',
            body: data
        });

        const resultado = await respuesta.json();
        if(resultado.resultado){
            console.log('status actualizado');
        }
    }catch(error){
        console.log(error);
    }
}


async function selloPerfil(){
    sellos.nombre = datosEmpresa.empresa;

    const data = new FormData();
    data.append('nombre', sellos.nombre);

    try{
        const url = 'http://localhost:3000/api/profile/sellos';
        
        const respuesta = await fetch(url, {
            method: 'POST',
            body: data
        });

        const resultado = await respuesta.json();

        if(resultado.resultado){
            console.log('sello agregado');
        }
    }catch(error){
        console.log(error);
    }
}

function cerrarModal(){
    const body = document.querySelector('body');
    const modal = document.querySelector('.register');
    body.classList.remove('overlay');
    modal.remove();
}

