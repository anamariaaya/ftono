import {Empresa} from './Empresa.js';

export const btnRegistro = document.querySelector('#btn-registro');

export const btnMenu = document.querySelectorAll('.dashboard__enlace');

export const er = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

export const num = /^[0-9]+$/;

export const ig= /(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)\/(\w+)/;

export const empresa = new Empresa();