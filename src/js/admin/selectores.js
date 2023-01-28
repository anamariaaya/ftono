import {Empresa} from './Empresa.js';

export const er = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

export const num = /^[0-9]+$/;

export const ig= /(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am|instagr.com)\/(\w+)/;

export const empresa = new Empresa();

export const selectPais = document.querySelector('#pais');
export const botones = document.querySelectorAll('.tab__button');
export const pagAnterior = document.querySelector('#anterior');
export const pagSiguiente = document.querySelector('#siguiente');
export const afterNav = document.querySelector('.tabs__nav__line');
export const btnContrato = document.querySelector('#btn-contrato');