import { gridCanciones, cancionesInput, artistaSelect, clearSearch, nivelSelect, generoSelect, instrumentoSelect, categoriasSelect, idiomasSelect } from './selectores.js';
import { readLang, readJSON } from '../base/funciones.js';


export async function consultaCanciones() {
    if(gridCanciones){
        try {
            const url = window.location.origin + '/api/public/songs';
            const resultado = await fetch(url);
            const datos = await resultado.json();
            mostrarCanciones(datos);  // Show all songs initially
        } catch (error) {
            console.log(error);
        }
    }
}

async function mostrarCanciones(datos) {
    gridCanciones.innerHTML = '';  // Clear the grid before displaying new results

    const lang = await readLang();
    const alerts = await readJSON();

    datos.forEach(cancion => {
        const { id, titulo, url, artista_name } = cancion;

        const cardCancion = document.createElement('div');
        cardCancion.classList.add('main__artists__item');

        const cardVideo = document.createElement('IFRAME');
        cardVideo.classList.add('main__artists__video', 'margin-auto');
        cardVideo.src = 'https://www.youtube.com/embed/' + url + '?controls=0&showinfo=0&rel=0&autoplay=1&mute=1&loop=1&playlist=' + url;
        cardVideo.frameborder = '0';
        cardVideo.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        cardVideo.allowFullscreen = true;
        cardVideo.loading = 'lazy';

        const titleCancion = document.createElement('p');
        titleCancion.textContent = titulo;
        titleCancion.classList.add('cards__text', 'cards__text--span', 'text-yellow', 'text-24', 'center');

        const artistaCancion = document.createElement('p');
        artistaCancion.textContent = artista_name;
        artistaCancion.classList.add('cards__text', 'cards__text--span', 'text-green', 'text-24', 'center');

        cardCancion.appendChild(titleCancion);
        cardCancion.appendChild(cardVideo);
        cardCancion.appendChild(artistaCancion);

        gridCanciones.appendChild(cardCancion);
    });
}

let currentQuery = '';
let currentArtist = '';
let currentNivel = '';
let currentGenero = '';
let currentInstrumento = '';
let currentCategoria = '';
let currentIdioma = '';

async function filtraCanciones() {
    // Listen for changes in the search input field
    cancionesInput.addEventListener('input', async (e) => {
        currentQuery = e.target.value.toLowerCase().trim();  // Update the query
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated query and current artist
    });

    // Listen for changes in the artist select dropdown
    artistaSelect.addEventListener('change', async (e) => {
        currentArtist = e.target.value;  // Update the artist filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated artist and current query
    });

    // Listen for changes in the nivel select dropdown
    nivelSelect.addEventListener('change', async (e) => {
        currentNivel = e.target.value;  // Update the nivel filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated nivel and current query
    });

    // Listen for changes in the genero select dropdown
    generoSelect.addEventListener('change', async (e) => {
        currentGenero = e.target.value;  // Update the genero filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated genero and current query
    });

    // Listen for changes in the instrumento select dropdown
    instrumentoSelect.addEventListener('change', async (e) => {
        currentInstrumento = e.target.value;  // Update the instrumento filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated instrumento and current query
    });

    // Listen for changes in the categorias select dropdown
    categoriasSelect.addEventListener('change', async (e) => {
        currentCategoria = e.target.value;  // Update the categoria filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated categoria and current query
    });

    // Listen for changes in the idiomas select dropdown
    idiomasSelect.addEventListener('change', async (e) => {
        currentIdioma = e.target.value;  // Update the idioma filter
        fetchQuery(currentQuery, currentArtist, currentNivel, currentGenero, currentInstrumento, currentCategoria, currentIdioma);  // Pass the updated idioma and current query
    });

    // Function to send the request to the backend with both search and artist filters
    async function fetchQuery(query, artist, nivel, genero, instrumento, categoria, idioma) {
        let url = `/api/public/songs/search?`;

        if (query.length > 0) {
            url += `search=${query}`;
        }

        if (artist.length > 0) {
            if (query.length > 0) {
                url += `&`;
            }
            url += `artist=${artist}`;
        }

        if (nivel.length > 0) {
            if (query.length > 0 || artist.length > 0) {
                url += `&`;
            }
            url += `level=${nivel}`;
        }

        if (genero.length > 0) {
            if (query.length > 0 || artist.length > 0 || nivel.length > 0) {
                url += `&`;
            }
            url += `genre=${genero}`;
        }

        if (instrumento.length > 0) {
            if (query.length > 0 || artist.length > 0 || nivel.length > 0 || genero.length > 0) {
                url += `&`;
            }
            url += `instrument=${instrumento}`;
        }

        if (categoria.length > 0) {
            if (query.length > 0 || artist.length > 0 || nivel.length > 0 || genero.length > 0 || instrumento.length > 0) {
                url += `&`;
            }
            url += `category=${categoria}`;
        }

        if (idioma.length > 0) {
            if (query.length > 0 || artist.length > 0 || nivel.length > 0 || genero.length > 0 || instrumento.length > 0 || categoria.length > 0) {
                url += `&`;
            }
            url += `language=${idioma}`;
        }

        if (url === '/api/public/songs/search?') {
            return;  // Don't fetch if no filters are applied
        }

        // Send the request to the backend
        const response = await fetch(url);
        const filteredSongs = await response.json();  // Get filtered songs
        mostrarCanciones(filteredSongs);  // Display filtered songs
    }
    
}

// Function to delete the filters and reset everything
if(clearSearch){
    function deleteFilter() {
        // Trigger the input event manually to ensure the filter resets
        cancionesInput.dispatchEvent(new Event('input'));

        // Reset the artist select filter to the default state (empty or first option)
        artistaSelect.value = '';  // Set select input back to default (empty string)

        nivelSelect.value = '';  // Set select input back to default (empty string)
    
        // Clear the search input field
        cancionesInput.value = '';

        // Reset the genero select filter to the default state (empty or first option)
        generoSelect.value = '';  // Set select input back to default (empty string)

        // Reset the instrumento select filter to the default state (empty or first option)
        instrumentoSelect.value = '';  // Set select input back to default (empty string)

        // Reset the categorias select filter to the default state (empty or first option)
        categoriasSelect.value = '';  // Set select input back to default (empty string)

        // Reset the idiomas select filter to the default state (empty or first option)
        idiomasSelect.value = '';  // Set select input back to default (empty string)
    
        // Clear the state variables and remove previous event listeners
        currentQuery = '';
        currentArtist = '';
        currentNivel = '';
        currentGenero = '';
        currentInstrumento = '';
        currentCategoria = '';
        currentIdioma = '';
    
        //reload the whole page
        location.reload();
    }
    
    // Call the search and filter function when the page loads
    filtraCanciones();
    
    // Ensure clear button works
    clearSearch.addEventListener('click', deleteFilter);
}
