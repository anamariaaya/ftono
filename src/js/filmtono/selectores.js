//Selectores de la sección de usuarios
export const container = document.querySelector('.dashboard__contenido');
export const gridUsuarios = document.querySelector('#grid-usuarios');

//Selectores de agregar artista
export const artistasInput = document.querySelectorAll('.artistas_input');
export const portada = document.querySelectorAll('.form__custom__input');

export const artistaSecundario = document.querySelector('#artsecundarios_input');
export const btnAgregar = document.querySelector('#btn-add-artist'); 

//Selectores de archivos
export const promoInput = document.getElementById('promos');
export const promoLabel = document.getElementById('promoLabel');

//Selectores de contratos
export const contratos ={
    id: null,
    nombre: '',
    apellido: '',
    empresa: '',
    fecha: '',
    nombre_doc: ''
};

export const contratosContainer = document.querySelector('#cards-container');
export const contratosSearch = document.querySelector('#contratos-search');

//Selectores de la sección de categorías
export const gridCategorias = document.querySelector('#grid-categorias');
export const categoriasInput = document.querySelector('#categorias-search');

//selectores de la sección de géneros
export const gridGeneros = document.querySelector('#grid-generos');
export const generosInput = document.querySelector('#generos-search');

//selectores de la sección de keywords
export const gridKeywords = document.querySelector('#grid-keywords');
export const keywordsInput = document.querySelector('#keywords-search');