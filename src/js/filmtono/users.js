import { gridUsuarios } from './selectores.js';
import { crearAlerta } from '../base/funciones.js';

export function mostrarUsuarios(datos){
        datos.forEach(usuario => {
                const {id, nombre, apellido, email, confirmado, nivel_admin, nivel_musica, compradores, empresa} = usuario;

                //generar la etiqueta para el tipo de usuario
                const tipoUsuario = document.createElement('H3');
                tipoUsuario.classList.add('card__title');
                if(nivel_admin){
                        tipoUsuario.textContent = 'Administrador';
                }else if(nivel_musica){
                        if(nivel_musica == 2){
                                tipoUsuario.textContent = 'Editorial';
                        }else {
                                tipoUsuario.textContent = 'Sello';
                        }
                }else{
                        tipoUsuario.textContent = 'Comprador';
                }

                //generar la etiqueta para la empresa
                const empresaUsuario = document.createElement('P');
                empresaUsuario.classList.add('card__info--title');
                empresaUsuario.textContent = empresa;


                //generar la etiqueta para el nombre
                const nombreUsuario = document.createElement('P');
                nombreUsuario.classList.add('card__info');
                nombreUsuario.textContent = nombre + ' ' + apellido;
                
                //generar la etiqueta para el email
                const emailUsuario = document.createElement('P');
                emailUsuario.classList.add('card__info');
                emailUsuario.textContent = email;

                //generar la etiqueta para el estado
                const estadoUsuario = document.createElement('P');
                estadoUsuario.classList.add('card__info--span');
                if(confirmado){
                        estadoUsuario.textContent = 'Confirmado';
                }else{
                        estadoUsuario.textContent = 'Sin confirmar';
                }

                //generar el botón para abir el modal con la información del usuario
                const btnInfo = document.createElement('A');
                btnInfo.classList.add('btn-view');
                btnInfo.textContent = 'Ver más';
                btnInfo.href = `/filmtono/users/${id}`;

                //general ícono de ojo para el botón de ver más
                const iconoOjo = document.createElement('I');
                iconoOjo.classList.add('fa-solid', 'fa-eye');

                //Agregar el ícono al botón
                btnInfo.appendChild(iconoOjo);

                //generar el botón para editar el usuario
                const btnEditar = document.createElement('A');
                btnEditar.classList.add('btn-update');
                btnEditar.href = `/filmtono/users/edit?id=${id}`;

                //generar ícono de lápiz para el botón de editar
                const iconoLapiz = document.createElement('I');
                iconoLapiz.classList.add('fa-solid', 'fa-pencil', 'no-click');

                //Agregar el ícono al botón
                btnEditar.appendChild(iconoLapiz);

                //generar el botón para eliminar el usuario
                const btnEliminar = document.createElement('BUTTON');
                btnEliminar.classList.add('btn-delete');
                btnEliminar.value = id;
                btnEliminar.onclick = eliminarUsuario;
                
                //generar ícono de basura para el botón de eliminar
                const iconoBasura = document.createElement('I');
                iconoBasura.classList.add('fa-solid', 'fa-trash-can', 'no-click');

                //Agregar el ícono al botón
                btnEliminar.appendChild(iconoBasura);

                //generar el contenedor de los botones
                const contenedorBotones = document.createElement('DIV');
                contenedorBotones.classList.add('card__acciones');

                //agregar los botones al contenedor
                contenedorBotones.appendChild(btnEditar);
                contenedorBotones.appendChild(btnEliminar);

                //Generar el contenedor de la información del usuario
                const card = document.createElement('DIV');
                card.classList.add('card');

                //agregar la información al contenedor
                card.appendChild(tipoUsuario);
                if(empresa){
                        card.appendChild(empresaUsuario);
                }
                card.appendChild(nombreUsuario);
                card.appendChild(emailUsuario);
                card.appendChild(estadoUsuario);
                card.appendChild(btnInfo);
                card.appendChild(contenedorBotones);

                //agregar el contenedor de la información al grid
                gridUsuarios.appendChild(card);
        });
}

export function eliminarUsuario(e){
        e.preventDefault();
        const id = e.target.value;
        crearAlerta('/filmtono/users/delete');
}