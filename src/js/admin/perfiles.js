import {botones, pagAnterior, pagSiguiente, afterNav, btnContrato} from './selectores.js';
// import {form} from './form.js';
// import { datosEmpresa } from './Empresa.js';
// import { llenarDatos } from '../base/funciones.js';
// import { sellos } from './sellos.js';

let paso = 1;

export function tabs() {   
    botones.forEach(tab => {
        tab.addEventListener('click', function(e) {
            paso = e.target.dataset.paso;
            cambiarSeccion(e);
            botonesPaginador();
        });
    });
}
const secciones = document.querySelectorAll('.tabs__section');
function cambiarSeccion(e) {
    
    
    const tabActivo = document.querySelector(`#paso-${paso}`);
    tabActivo.classList.add('mostrar');
    e.target.classList.add('active');

    // Remueve la clase active de los botones
    if(tabActivo.id === 'paso-1'){
        botones[0].classList.add('active');
        botones[1].classList.remove('active');
        botones[2].classList.remove('active');
        secciones[0].classList.add('mostrar');
        secciones[1].classList.remove('mostrar');
        secciones[2].classList.remove('mostrar');
    } else if(tabActivo.id === 'paso-2'){
        botones[1].classList.add('active');
        botones[2].classList.remove('active');
        secciones[1].classList.add('mostrar');
        secciones[2].classList.remove('mostrar');
        secciones[0].classList.remove('mostrar');
    } else{
        botones[1].classList.add('active');
        botones[2].classList.add('active');
        secciones[2].classList.add('mostrar');
        secciones[0].classList.remove('mostrar');
        secciones[1].classList.remove('mostrar');
    }
    // secciones.forEach(seccion => {
    //     if (seccion.id !== tabActivo.id) {
    //         seccion.classList.remove('mostrar');
    //     }
    // });      
}
function botonesPaginador(){ 
    switch(paso) {
        case '1':
            pagAnterior.classList.add('ocultar');
            pagSiguiente.classList.remove('ocultar');
            afterNav.classList.remove('step2');
            afterNav.classList.remove('step3');
            break;
        case '2':
            pagAnterior.classList.remove('ocultar');
            pagSiguiente.classList.remove('ocultar');
            afterNav.classList.add('step2');
            afterNav.classList.remove('step3');
            break;
        case '3':
            pagAnterior.classList.remove('ocultar');
            pagSiguiente.textContent = 'Registrarse';
            pagSiguiente.onclick = setType;
            afterNav.classList.add('step3');
            afterNav.classList.remove('step2');
            if(btnContrato){
                btnContrato.onclick = modalContrato;
            };
            break;
        default:
            break;
    }
}

export function paginador(){
    pagAnterior.addEventListener('click', paginaAnterior);
    pagSiguiente.addEventListener('click',paginaSiguiente);
}

function paginaSiguiente(){
    if(!botones[1].classList.contains('active')){
        botones[1].click();
    } else if(!botones[2].classList.contains('active')){
        botones[2].click();
    }
}

function paginaAnterior(e){
    if(botones[2].classList.contains('active')){
        botones[1].click();
    } else if(botones[1].classList.contains('active')){
        botones[0].click();
    }
}

function setType(e){
    e.target.type = 'submit';
}

function modalContrato(e){
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

    const canvas = document.createElement('canvas');
    canvas.id = 'canvas';
    canvas.width = 600;
    canvas.height = 200;
    canvas.style.border = '1px solid black';
    canvas.style.backgroundColor = 'white';
    canvas.style.margin = '0 auto';
    canvas.style.display = 'block';

    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "white";
    ctx.strokeStyle = "black";
    ctx.lineWidth = 2;
    ctx.lineCap = "round";

    let isDrawing = false;
    let x = 0;
    let y = 0;

    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("touchstart", startDrawing);
    canvas.addEventListener("touchmove", draw);
    canvas.addEventListener("touchend", stopDrawing);

    // function startDrawing(e) {
    //     isDrawing = true;
    //     [x, y] = [e.clientX, e.clientY];
    // }
    function startDrawing(e) {
    isDrawing = true;
        if (e.touches) {
            [x, y] = [e.touches[0].pageX - e.target.offsetLeft, e.touches[0].pageY - e.target.offsetTop];
        } else {
            [x, y] = [e.offsetX, e.offsetY];
        }
    }
    
    // function draw(e) {
    //     if (!isDrawing) return;
    //         ctx.beginPath();
    //     if (e.touches) {
    //         ctx.moveTo(x, y);
    //         ctx.lineTo(e.touches[0].clientX, e.touches[0].clientY);
    //         [x, y] = [e.touches[0].clientX, e.touches[0].clientY];
    //     } else {
    //         ctx.moveTo(x , y);
    //         ctx.lineTo(e.clientX, e.clientY);
    //         [x, y] = [e.clientX, e.clientY];
    //     }
    //      ctx.stroke();
    // }

    function draw(e) {
        if (!isDrawing) return;
        ctx.beginPath();
        if (e.touches) {
            ctx.moveTo(x, y);
            ctx.lineTo(e.touches[0].pageX - e.target.offsetLeft, e.touches[0].pageY - e.target.offsetTop);
            [x, y] = [e.touches[0].pageX - e.target.offsetLeft, e.touches[0].pageY - e.target.offsetTop];
        } else {
            ctx.moveTo(x, y);
            ctx.lineTo(e.offsetX, e.offsetY);
            [x, y] = [e.offsetX, e.offsetY];
        }
        ctx.stroke();
    }
    
    function stopDrawing() {
        isDrawing = false;
        ctx.beginPath();
    }      

    function limpiar(){
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    const clearbtn = document.createElement('button');
    clearbtn.classList.add('btn-tabs');
    clearbtn.textContent = 'Limpiar';
    clearbtn.onclick = limpiar;

    modal.appendChild(btnCerrar);
    modal.appendChild(canvas);
    modal.appendChild(clearbtn);
    divModal.appendChild(modal);
    body.appendChild(divModal);
}

function cerrarModal(){
    const body = document.querySelector('body');
    const modal = document.querySelector('.register');
    body.classList.remove('overlay');
    modal.remove();
}