import {contratos, contratosContainer, contratosSearch} from './selectores.js';
import {imprimirAlerta, readLang, readJSON, eliminarItem} from '../base/funciones.js';

export async function consultaContratos(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/contracts');
        const datos = await resultado.json();
    //    console.log(datos);
       mostrarContratos(datos);
    }catch(error){
        console.log(error);
    }
}

async function mostrarContratos(datos){
    const lang = await readLang();
    const alerts = await readJSON();

    datos.forEach(contrato => {
        //extract the type of contract from the name of the file nombre_doc
        const tipoContrato = contrato.nombre_doc.split('-')[2];
        const{id, nombre, apellido, empresa, fecha, nombre_doc} = contrato;

        //Create the card to wrap the contract info and actions
        const cardLink = document.createElement('a');
        cardLink.href = '/filmtono/contracts/current?id='+id+'&type='+tipoContrato;

        //Create the info section
        const cardContrato = document.createElement('div');
        cardContrato.classList.add('cards__card');

        const cardInfo = document.createElement('div');
        cardInfo.classList.add('cards__info');

        const nameInfo = document.createElement('div');
        nameInfo.classList.add('cards__info--div');

        const titleNombre = document.createElement('p');
        titleNombre.textContent = alerts['contracts_user-name'][lang]+':';
        titleNombre.classList.add('cards__text', 'cards__text--span');

        const nombreCompleto = document.createElement('p');
        nombreCompleto.textContent = `${nombre} ${apellido}`;
        nombreCompleto.classList.add('cards__text');
        
        nameInfo.appendChild(titleNombre);
        nameInfo.appendChild(nombreCompleto);

        const empresaInfo = document.createElement('div');
        empresaInfo.classList.add('cards__info--div');

        const titleEmpresa = document.createElement('p');
        titleEmpresa.textContent = alerts['contracts_empresa'][lang]+':';
        titleEmpresa.classList.add('cards__text', 'cards__text--span');

        const empresaContrato = document.createElement('p');
        empresaContrato.textContent = empresa;
        empresaContrato.classList.add('cards__text');

        empresaInfo.appendChild(titleEmpresa);
        empresaInfo.appendChild(empresaContrato);

        const tipoInfo = document.createElement('div');
        tipoInfo.classList.add('cards__info--div');

        const titleTipo = document.createElement('p');
        titleTipo.textContent = alerts['contracts_type'][lang]+':';
        titleTipo.classList.add('cards__text', 'cards__text--span');

        const tipo = document.createElement('p');
        tipo.textContent = tipoContrato;
        tipo.classList.add('cards__text');

        tipoInfo.appendChild(titleTipo);
        tipoInfo.appendChild(tipo);

        const fechaInfo = document.createElement('div');
        fechaInfo.classList.add('cards__info--div');

        const titleFecha = document.createElement('p');
        titleFecha.textContent = alerts['contracts_fecha'][lang]+':';
        titleFecha.classList.add('cards__text', 'cards__text--span');

        const fechaContrato = document.createElement('p');
        fechaContrato.textContent = fecha;
        fechaContrato.classList.add('cards__text');

        fechaInfo.appendChild(titleFecha);
        fechaInfo.appendChild(fechaContrato);

        //Create the actions section
        const cardActions = document.createElement('div');
        cardActions.classList.add('cards__actions');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.id = id;
        btnEliminar.onclick = eliminarItem;

        const iconEliminar = document.createElement('i');
        iconEliminar.classList.add('fa-solid', 'fa-trash-can', 'no-click');

        btnEliminar.appendChild(iconEliminar);
        cardActions.appendChild(btnEliminar);


        cardInfo.appendChild(nameInfo);
        cardInfo.appendChild(empresaInfo);
        cardInfo.appendChild(tipoInfo);
        cardInfo.appendChild(fechaInfo);

        cardContrato.appendChild(cardInfo);
        cardContrato.appendChild(cardActions);

        cardLink.appendChild(cardContrato);
        contratosContainer.appendChild(cardLink);
    });
    filtrarContratos();
}

function filtrarContratos(){
    contratosSearch.addEventListener('input', e => {
        const texto = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.cards__card');

        cards.forEach(card => {
            const nombre = card.textContent.toLowerCase();
            if(nombre.indexOf(texto) !== -1){
                card.style.display = 'flex';
                card.style.marginRight = '2rem';
                contratosContainer.style.gap = '0';
            }else{
                card.style.display = 'none';
            }
        });
    }); 
}