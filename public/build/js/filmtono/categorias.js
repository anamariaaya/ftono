import { categoriasInput, gridCategorias } from './selectores.js';
import { readLang, readJSON, eliminarItem, normalizeText } from '../base/funciones.js';

export async function consultaCategorias(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/categories');
        const datos = await resultado.json();
        mostrarCategorias(datos);

    }catch(error){
        console.log(error);
    }
}
export async function mostrarCategorias(datos){
        const lang = await readLang();
        const alerts = await readJSON();
        datos.forEach(categoria => {
                const {id, categoria_en, categoria_es} = categoria;

                //generar el link para la categoria
                const categoriaLink = document.createElement('A');
                categoriaLink.classList.add('cards__link');
                if(categoria.categoria_en === 'genres'){
                    categoriaLink.href = '/filmtono/genres';
                } else{
                    categoriaLink.href = '/filmtono/categories/keywords?id='+id+'&category='+categoria_en;
                }

                //generar la etiqueta para el tipo de usuario
                const categoriaTitle = document.createElement('H3');
                categoriaTitle.classList.add('card__info--title');
                if(lang == 'es'){
                        categoriaTitle.textContent = categoria_es;
                }else{
                        categoriaTitle.textContent = categoria_en;
                }

                const btnEditar = document.createElement('A');
                btnEditar.classList.add('btn-update');
                btnEditar.href = '/filmtono/categories/edit?id='+id;
                

                //generar ícono de lápiz para el botón de editar
                const iconoLapiz = document.createElement('I');
                iconoLapiz.classList.add('fa-solid', 'fa-pencil', 'no-click');

                //Agregar el ícono al botón
                btnEditar.appendChild(iconoLapiz);

                //generar el botón para eliminar el usuario
                const btnEliminar = document.createElement('BUTTON');
                btnEliminar.classList.add('btn-delete');
                btnEliminar.value = id;
                btnEliminar.dataset.role = 'filmtono';
                btnEliminar.dataset.item = 'categories';
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
                contenedorBotones.appendChild(btnEditar);
                if(categoria.categoria_en !== 'genres' && categoria.categoria_en !== 'instruments' && categoria.categoria_en !== 'keywords'){
                        contenedorBotones.appendChild(btnEliminar);
                }
                

                //Generar el contenedor de la información del usuario
                const card = document.createElement('DIV');
                card.classList.add('card');

                //agregar la información al contenedor
                categoriaLink.appendChild(categoriaTitle);
                categoriaLink.appendChild(contenedorBotones);
                //agregar el link contenedor a la tarjeta
                card.appendChild(categoriaLink);
                //agregar el contenedor de la información al grid
                gridCategorias.appendChild(card);
        });
        filtraCategorias();
}

function filtraCategorias(){
        categoriasInput.addEventListener('input', e => {
                const texto = normalizeText(e.target.value);
                const cards = document.querySelectorAll('.card');

                cards.forEach(card => {
                        const categoriaTitle = normalizeText(card.textContent);
                        if(categoriaTitle.indexOf(texto) !== -1){
                                card.style.display = 'flex';
                                card.style.marginRight = '2rem';
                                gridCategorias.style.columnGap = '0';
                        }else{
                                card.style.display = 'none';
                        }
                });
        }); 
}