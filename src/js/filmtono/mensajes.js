import { gridMensajes } from './selectores.js';
import { readLang, readJSON, eliminarItem, normalizeText } from '../base/funciones.js';

export async function consultaMensajes(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/messages');
        const datos = await resultado.json();
        console.log(datos);
        mostrarMensajes(datos);

    }catch(error){
        console.log(error);
    }
}
export async function mostrarMensajes(datos){
        const lang = await readLang();
        const alerts = await readJSON();
        datos.forEach(contacto => {
                const {id, nombre, apellido, email, pais, telefono, presupuesto, mensaje} = contacto;


                //generar la etiqueta para el nombre
                const nombreContacto = document.createElement('P');
                nombreContacto.classList.add('card__info--title');
                nombreContacto.textContent = nombre + ' ' + apellido;
                
                //generar la etiqueta para el email
                const emailContacto = document.createElement('P');
                emailContacto.classList.add('card__info');
                emailContacto.textContent = email;

                const paisContacto = document.createElement('P');
                paisContacto.classList.add('card__info');
                paisContacto.textContent = pais;

                //generar el botón para abir el modal con la información del usuario
                const btnInfo = document.createElement('A');
                btnInfo.classList.add('btn-view');
                btnInfo.textContent = alerts['see-more'][lang];
                btnInfo.href = `/filmtono/messages/current?id=${id}`;

                //general ícono de ojo para el botón de ver más
                const iconoOjo = document.createElement('I');
                iconoOjo.classList.add('fa-solid', 'fa-eye');

                //Agregar el ícono al botón
                btnInfo.appendChild(iconoOjo);

                //generar el botón para eliminar el usuario
                const btnEliminar = document.createElement('BUTTON');
                btnEliminar.classList.add('btn-delete');
                btnEliminar.value = id;
                btnEliminar.dataset.role = 'filmtono';
                btnEliminar.dataset.item = 'messages';
                btnEliminar.onclick = eliminarItem;
                
                //generar ícono de basura para el botón de eliminar
                const iconoBasura = document.createElement('I');
                iconoBasura.classList.add('fa-solid', 'fa-trash-can', 'no-click');

                //Agregar el ícono al botón
                btnEliminar.appendChild(iconoBasura);
                btnEliminar.onclick = eliminarItem;

                //generar el contenedor de los botones
                const contenedorBotones = document.createElement('DIV');
                contenedorBotones.classList.add('card__acciones');

                //agregar los botones al contenedor
                contenedorBotones.appendChild(btnEliminar);

                //Generar el contenedor de la información del usuario
                const card = document.createElement('DIV');
                card.classList.add('card');

                //agregar la información al contenedor

                card.appendChild(nombreContacto);
                card.appendChild(emailContacto);
                card.appendChild(paisContacto);


                card.appendChild(btnInfo);
                card.appendChild(contenedorBotones);

                //agregar el contenedor de la información al grid
                gridMensajes.appendChild(card);
        });
        filtrarUsuarios();
}

function filtrarUsuarios(){
        const input = document.querySelector('#mensajes-search');
        input.addEventListener('input', e => {
                const texto = normalizeText(e.target.value);
                const cards = document.querySelectorAll('.card');

                cards.forEach(card => {
                        const nombre = normalizeText(card.textContent);
                        if(nombre.indexOf(texto) !== -1){
                                card.style.display = 'flex';
                                card.style.marginRight = '2rem';
                                gridMensajes.style.columnGap = '0';
                        }else{
                                card.style.display = 'none';
                        }
                });
        }); 
}