import {er, num, indicativo, formArtist, artistFields} from '../music/selectores.js';

import {body, dashboardContenido, tabsBtns, tabsContent, tabsDiv, submitBtns, languageSelect, selectedLanguagesContainer, selectedLanguagesInput, selloInput, noLabelCheckbox, defaultLabelInput, fileInput, fileNameContainer, selectedGenresContainer, selectedGenresInput, genreSelect, selectedInstrumentsContainer, selectedInstrumentsInput, instrumentSelect, selectedKeywordsContainer, selectedKeywordsInput, keywordSelect, selectedCategoriesContainer, selectedCategoriesInput, categorySelect} from './selectores.js';


export async function readLang(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/lenguaje');
        const data = await resultado.json();
        return data;
    }catch(error){
        console.log(error);
    }
}

//Leer el lang.json
export async function readJSON(){
    try{
        const resultado = await fetch(window.location.origin+'/api/filmtono/alerts', {mode: 'cors'});
        const data = await resultado.json();
        return data;
    }catch(error){
        console.log(error);
    }
}

export async function imprimirAlerta(message, type, container, sibling) {
    // Crea el div
    const divMensaje = document.createElement('div');
    divMensaje.style.gridColumn = '1 / 3';
    
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

    const lang = await readLang();
    const alerts = await readJSON();
    divMensaje.textContent = alerts[message][lang];

    // Insertar en el DOM
    container.insertBefore(divMensaje, sibling);

    // Quitar el alert despues de 3 segundos
    setTimeout( () => {
        divMensaje.remove();
    }, 4000);
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
        imprimirAlerta('input', 'error', form, e.target);
    }

    if(e.target.type === 'email'){
        if(er.test(e.target.value) === false){
            imprimirAlerta('email', 'error', form, e.target);
        } 
    }

    //verificar que se alla elegido una opción de un select
    if(e.target.type === 'select-one'){
        if(e.target.value === '0' || e.target.value === ''){
            imprimirAlerta('select', 'error', form, e.target);
        }
    }

    if(e.target.type === 'tel'){
        if(num.test(e.target.value) === false || e.target.value.length < 8){
            imprimirAlerta('phone', 'error', form, e.target);
        } 
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

export function loader(button){
    // Hide the loading screen when the page is fully loaded
    document.getElementById('loadingScreen').style.display = 'none';

    //Add event listener for the button given to trigger the loader
    button.addEventListener('click', showLoadingScreen);
    
    // Function to show the loading screen
    function showLoadingScreen() {
        document.getElementById('loadingScreen').style.display = 'flex';
    }
}

export function loaderPage(){
    document.getElementById('loadingScreen').style.display = 'none';
    window.addEventListener('load', () => {
        document.getElementById('loadingScreen').style.display = 'flex';
    });
}

export function stopLoader(){
    document.getElementById('loadingScreen').style.display = 'none';
}

export async function eliminarItem(e){
    e.preventDefault();

    const lang = await readLang();
    const alerts = await readJSON();
    if(e.target.classList.contains('btn-delete')){
        const id = e.target.value;
        dashboardContenido.classList.add('overlay');

        const alertaContenedor = document.createElement('div');
        alertaContenedor.classList.add('modal-alerta--activo');
        

        const alertaDiv = document.createElement('DIV');
        alertaDiv.classList.add('modal-alerta');

        const alertaIcono = document.createElement('I');
        alertaIcono.classList.add('fa-solid', 'fa-circle-exclamation', 'modal-alerta__icono');

        const alertaTitulo = document.createElement('H3');
        alertaTitulo.classList.add('modal-alerta__titulo');
        alertaTitulo.textContent = alerts['delete_item'][lang];

        const alertaParrafo = document.createElement('P');
        alertaParrafo.classList.add('modal-alerta__parrafo');
        alertaParrafo.textContent = alerts['delete_confirmation'][lang];

        const alertaBotones = document.createElement('DIV');
        alertaBotones.classList.add('modal-alerta__botones');

        const alertaBotonCancelar = document.createElement('BUTTON');
        alertaBotonCancelar.classList.add('modal-alerta__boton', 'modal-alerta__boton--cancelar');
        alertaBotonCancelar.textContent = 'Cancelar';
        alertaBotonCancelar.onclick = cerrarAlerta;

        const btnCerrar = document.createElement('button');
        btnCerrar.classList.add('deleteModal__btn-close');
        btnCerrar.innerHTML = '<i class="fas fa-times"></i>';
        btnCerrar.onclick = cerrarAlerta;

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('btn-delete');
        btnEliminar.textContent = alerts['delete'][lang];
        btnEliminar.value = id;
        btnEliminar.dataset.type = e.target.dataset.type;
        btnEliminar.dataset.role = e.target.dataset.role;
        btnEliminar.dataset.item = e.target.dataset.item;
        loader(btnEliminar);

        //redirect to delete route
        btnEliminar.onclick = (e) => {
           if( e.target.dataset.type === undefined || e.target.dataset.type === 'undefined'){
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.value}`;
            }
            else{
                window.location.href = `/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.value}&type=${e.target.dataset.type}`;
            }
        }

        //Agregar botones al div de botones
        alertaBotones.appendChild(alertaBotonCancelar);
        alertaBotones.appendChild(btnEliminar);
        alertaDiv.appendChild(alertaIcono);
        alertaDiv.appendChild(alertaTitulo);
        alertaDiv.appendChild(alertaParrafo);
        alertaDiv.appendChild(alertaBotones);
        alertaDiv.appendChild(btnCerrar);
        alertaContenedor.appendChild(alertaDiv);
        body.appendChild(alertaContenedor);
    }
}
export function cerrarAlerta(){
    const alerta = document.querySelector('.modal-alerta--activo');
    if(alerta){
        alerta.remove();
        dashboardContenido.classList.remove('overlay');
        
    }
}

export function changeTabs(){
    for(let i = 0; i < tabsBtns.length; i++){
        tabsBtns[i].addEventListener('click', () => {
            tabsBtns.forEach(btn => btn.classList.remove('tabs__lg--btn--active'));
            tabsContent.forEach(content => content.style.display = 'none');
            tabsBtns[i].classList.add('tabs__lg--btn--active');
            tabsContent[i].style.display = 'block';
        });
    }
}

export function btnSubmitLoader(){
    submitBtns.forEach(btn => {
        loader(btn);
    });
}

export function normalizeText(text) {
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
}

export function caps(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
}

//social media url validation
export function validateUrl(e) {
    let urlValue = e.target.value.trim(); // Get the current value of the input and trim spaces

    // Debugging: Log the URL value before validating
    console.log('Original URL:', urlValue);

    // Pre-validation: If the URL doesn't have "http://" or "https://", we will add "https://"
    if (!urlValue.match(/^https?:\/\//)) {
        urlValue = 'https://' + urlValue;
    }

    // Log the modified URL for debugging
    console.log('Modified URL for validation:', urlValue);

    const re = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]+\.[a-zA-Z]{2,})(\/[a-zA-Z0-9-._~:/?#[\]@!$&'()*+,;=]*)?$/; // Updated regex

    // Remove previous timeout if any (this is for debouncing)
    clearTimeout(e.target.dataset.timer);

    // If the input is from paste, delay validation
    if (e.type === 'paste') {
        // Delay for paste action to ensure the full URL is inserted
        setTimeout(() => validateUrlInternal(e, re), 500);
    } else {
        // Otherwise, just validate after a short delay
        e.target.dataset.timer = setTimeout(() => {
            validateUrlInternal(e, re);
        }, 500); // Delay the validation after typing stops (500ms)
    }
}

// Internal function that validates URL and shows the alert
function validateUrlInternal(e, re) {
    let urlValue = e.target.value.trim(); // Get the current value of the input and trim spaces

    // Debugging: Log the URL value after modification and validation
    console.log('Final URL for validation:', urlValue);

    if (re.test(urlValue) === false) {
        imprimirAlerta('url', 'error', e.target.closest('.form__group'), e.target);
    } else {
        // If the URL is valid, set the corrected value back into the input
        e.target.value = urlValue;
    }
}


// languageHandler.js

export function handleLanguageSelection() {
    // Clear existing tags to prevent duplication
    selectedLanguagesContainer.innerHTML = '';

    // First, populate the selected languages if they exist in the input value
    if (selectedLanguagesInput.value) {
        const selectedValues = selectedLanguagesInput.value.split(',').filter(value => value !== '');
        selectedValues.forEach(value => {
            addLanguageTag(value);
        });
    }

    // Add event listener to select dropdown
    languageSelect.addEventListener('change', () => {
        const selectedValue = languageSelect.value;
        
        // Check if the option is already selected
        const existingTag = selectedLanguagesContainer.querySelector(`[data-value="${selectedValue}"]`);
        if (!existingTag) {
            // Only add the tag if it doesn't already exist
            addLanguageTag(selectedValue);
        }
    });

    function addLanguageTag(selectedValue) {
        const option = languageSelect.querySelector(`option[value="${selectedValue}"]`);
        if (option) {
            const tag = document.createElement('div');
            tag.classList.add('language-tag');
            tag.textContent = option.text;
            tag.setAttribute('data-value', selectedValue); // Store the value for reference

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-language');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', () => {
                option.selected = false; // Unselect the language
                tag.remove();
                updateSelectedLanguagesInput(); // Update hidden input field
            });

            // Append button and tag to the container
            tag.appendChild(removeButton);
            selectedLanguagesContainer.appendChild(tag);

            // Update the hidden input field with selected languages
            updateSelectedLanguagesInput();
        }
    }

    function updateSelectedLanguagesInput() {
        // Get the selected values from the tags and set them in the hidden input
        const selectedValues = [...selectedLanguagesContainer.querySelectorAll('.language-tag')]
            .map(tag => tag.getAttribute('data-value'))
            .filter(value => value !== '');
        selectedLanguagesInput.value = selectedValues.join(',');
    }
}

// Genre handler
export function handleGenreSelection() {
    // Clear existing tags to prevent duplication
    selectedGenresContainer.innerHTML = '';

    // First, populate the selected languages if they exist in the input value
    if (selectedGenresInput.value) {
        const selectedValues = selectedGenresInput.value.split(',').filter(value => value !== '');
        selectedValues.forEach(value => {
            addGenreTag(value);
        });
    }

    // Add event listener to select dropdown
    genreSelect.addEventListener('change', () => {
        const selectedValue = genreSelect.value;
        
        // Check if the option is already selected
        const existingTag = selectedGenresContainer.querySelector(`[data-value="${selectedValue}"]`);
        if (!existingTag) {
            // Only add the tag if it doesn't already exist
            addGenreTag(selectedValue);
        }
    });

    function addGenreTag(selectedValue) {
        const option = genreSelect.querySelector(`option[value="${selectedValue}"]`);
        if (option) {
            const tag = document.createElement('div');
            tag.classList.add('genero-tag');
            tag.textContent = option.text;
            tag.setAttribute('data-value', selectedValue); // Store the value for reference

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-genero');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', () => {
                option.selected = false; // Unselect the language
                tag.remove();
                updateSelectedGenresInput(); // Update hidden input field
            });

            // Append button and tag to the container
            tag.appendChild(removeButton);
            selectedGenresContainer.appendChild(tag);

            // Update the hidden input field with selected languages
            updateSelectedGenresInput();
        }
    }

    function updateSelectedGenresInput() {
        // Get the selected values from the tags and set them in the hidden input
        const selectedValues = [...selectedGenresContainer.querySelectorAll('.genero-tag')]
            .map(tag => tag.getAttribute('data-value'))
            .filter(value => value !== '');
        selectedGenresInput.value = selectedValues.join(',');
    }
}

export function handleCategorySelection() {
    // Clear existing tags to prevent duplication
    selectedCategoriesContainer.innerHTML = '';

    // First, populate the selected languages if they exist in the input value
    if (selectedCategoriesInput.value) {
        const selectedValues = selectedCategoriesInput.value.split(',').filter(value => value !== '');
        selectedValues.forEach(value => {
            addCategoryTag(value);
        });
    }

    // Add event listener to select dropdown
    categorySelect.addEventListener('change', () => {
        const selectedValue = categorySelect.value;
        
        // Check if the option is already selected
        const existingTag = selectedCategoriesContainer.querySelector(`[data-value="${selectedValue}"]`);
        if (!existingTag) {
            // Only add the tag if it doesn't already exist
            addCategoryTag(selectedValue);
        }
    });

    function addCategoryTag(selectedValue) {
        const option = categorySelect.querySelector(`option[value="${selectedValue}"]`);
        if (option) {
            const tag = document.createElement('div');
            tag.classList.add('categoria-tag');
            tag.textContent = option.text;
            tag.setAttribute('data-value', selectedValue); // Store the value for reference

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-categoria');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', () => {
                option.selected = false; // Unselect the language
                tag.remove();
                updateSelectedCategoriesInput(); // Update hidden input field
            });

            // Append button and tag to the container
            tag.appendChild(removeButton);
            selectedCategoriesContainer.appendChild(tag);

            // Update the hidden input field with selected languages
            updateSelectedCategoriesInput();
        }
    }

    function updateSelectedCategoriesInput() {
        // Get the selected values from the tags and set them in the hidden input
        const selectedValues = [...selectedCategoriesContainer.querySelectorAll('.categoria-tag')]
            .map(tag => tag.getAttribute('data-value'))
            .filter(value => value !== '');
        selectedCategoriesInput.value = selectedValues.join(',');
    }
}

export function handleInstrumentSelection() {
    // Clear existing tags to prevent duplication
    selectedInstrumentsContainer.innerHTML = '';

    // First, populate the selected languages if they exist in the input value
    if (selectedInstrumentsInput.value) {
        const selectedValues = selectedInstrumentsInput.value.split(',').filter(value => value !== '');
        selectedValues.forEach(value => {
            addInstrumentTag(value);
        });
    }

    // Add event listener to select dropdown
    instrumentSelect.addEventListener('change', () => {
        const selectedValue = instrumentSelect.value;
        
        // Check if the option is already selected
        const existingTag = selectedInstrumentsContainer.querySelector(`[data-value="${selectedValue}"]`);
        if (!existingTag) {
            // Only add the tag if it doesn't already exist
            addInstrumentTag(selectedValue);
        }
    });

    function addInstrumentTag(selectedValue) {
        const option = instrumentSelect.querySelector(`option[value="${selectedValue}"]`);
        if (option) {
            const tag = document.createElement('div');
            tag.classList.add('instrumento-tag');
            tag.textContent = option.text;
            tag.setAttribute('data-value', selectedValue); // Store the value for reference

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-instrumento');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', () => {
                option.selected = false; // Unselect the language
                tag.remove();
                updateSelectedInstrumentsInput(); // Update hidden input field
            });

            // Append button and tag to the container
            tag.appendChild(removeButton);
            selectedInstrumentsContainer.appendChild(tag);

            // Update the hidden input field with selected languages
            updateSelectedInstrumentsInput();
        }
    }

    function updateSelectedInstrumentsInput() {
        // Get the selected values from the tags and set them in the hidden input
        const selectedValues = [...selectedInstrumentsContainer.querySelectorAll('.instrumento-tag')]
            .map(tag => tag.getAttribute('data-value'))
            .filter(value => value !== '');
        selectedInstrumentsInput.value = selectedValues.join(',');
    }
}

export function handleKeywordsSelection() {
    // Clear existing tags to prevent duplication
    selectedKeywordsContainer.innerHTML = '';

    // First, populate the selected languages if they exist in the input value
    if (selectedKeywordsInput.value) {
        const selectedValues = selectedKeywordsInput.value.split(',').filter(value => value !== '');
        selectedValues.forEach(value => {
            addKeywordTag(value);
        });
    }

    // Add event listener to select dropdown
    keywordSelect.addEventListener('change', () => {
        const selectedValue = keywordSelect.value;
        
        // Check if the option is already selected
        const existingTag = selectedKeywordsContainer.querySelector(`[data-value="${selectedValue}"]`);
        if (!existingTag) {
            // Only add the tag if it doesn't already exist
            addKeywordTag(selectedValue);
        }
    });

    function addKeywordTag(selectedValue) {
        const option = keywordSelect.querySelector(`option[value="${selectedValue}"]`);
        if (option) {
            const tag = document.createElement('div');
            tag.classList.add('keyword-tag');
            tag.textContent = option.text;
            tag.setAttribute('data-value', selectedValue); // Store the value for reference

            // Create the remove button
            const removeButton = document.createElement('button');
            removeButton.classList.add('remove-keyword');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', () => {
                option.selected = false; // Unselect the language
                tag.remove();
                updateSelectedKeywordsInput(); // Update hidden input field
            });

            // Append button and tag to the container
            tag.appendChild(removeButton);
            selectedKeywordsContainer.appendChild(tag);

            // Update the hidden input field with selected languages
            updateSelectedKeywordsInput();
        }
    }

    function updateSelectedKeywordsInput() {
        // Get the selected values from the tags and set them in the hidden input
        const selectedValues = [...selectedKeywordsContainer.querySelectorAll('.keyword-tag')]
            .map(tag => tag.getAttribute('data-value'))
            .filter(value => value !== '');
        selectedKeywordsInput.value = selectedValues.join(',');
    }
}

// labelCheckbox.js

export function initializeLabelCheckbox() {
    

    if (selloInput && noLabelCheckbox && defaultLabelInput) {
        noLabelCheckbox.addEventListener('change', () => {
            if (noLabelCheckbox.checked) {
                selloInput.disabled = true; // Disable the input field
                selloInput.value = ""; // Clear any existing value
                defaultLabelInput.disabled = false; // Enable the hidden input to be sent
            } else {
                selloInput.disabled = false; // Enable the input field
                defaultLabelInput.disabled = true; // Disable the hidden input to prevent sending
            }
        });

        // Ensure hidden input is not submitted by default
        defaultLabelInput.disabled = true;
    }
}

export function initializeFileNameDisplay() {
     // Element to display the file name
    fileNameContainer.classList.add('form__group--file-name', 'no-display');

    if (fileInput) {
        fileInput.insertAdjacentElement('afterend', fileNameContainer);

        fileInput.addEventListener('change', () => {
            const fileName = fileInput.files.length > 0 ? fileInput.files[0].name : fileInput.getAttribute('data-text');
            fileNameContainer.classList.remove('no-display');
            fileNameContainer.textContent = fileName;
        });
    }
}



