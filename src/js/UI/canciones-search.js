import { gridCanciones, cancionesInput, artistaSelect, clearSearch, nivelSelect } from './selectores.js';
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

async function filtraCanciones() {
    if(gridCanciones){
        // Listen for input changes in the search field
        cancionesInput.addEventListener('input', async (e) => {
            currentQuery = e.target.value.toLowerCase().trim();  // Update the query
            fetchQuery(currentQuery, currentArtist);  // Pass the updated query and current artist
        });

        // Listen for changes in the artist select dropdown
        artistaSelect.addEventListener('change', async (e) => {
            currentArtist = e.target.value;  // Update the artist filter
            fetchQuery(currentQuery, currentArtist);  // Pass the updated artist and current query
        });

        // Function to send the request to the backend with both search and artist filters
        async function fetchQuery(query, artist) {
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

            if (url === '/api/public/songs/search?') {
                return;  // Don't fetch if no filters are applied
            }

            // Send the request to the backend
            const response = await fetch(url);
            const filteredSongs = await response.json();  // Get filtered songs
            mostrarCanciones(filteredSongs);  // Display filtered songs
        }
    }
}

// Function to delete the filters and reset everything
if(clearSearch){
    function deleteFilter() {
        // Reset the artist select filter to the default state (empty or first option)
        artistaSelect.value = '';  // Set select input back to default (empty string)
    
        // Clear the search input field
        cancionesInput.value = '';
    
        // Trigger the input event manually to ensure the filter resets
        cancionesInput.dispatchEvent(new Event('input'));
    
        // Clear the state variables and remove previous event listeners
        currentQuery = '';
        currentArtist = '';
    
        // Call the function to reload the songs without any filters
        consultaCanciones();
    }
    
    // Call the search and filter function when the page loads
    filtraCanciones();
    
    // Ensure clear button works
    clearSearch.addEventListener('click', deleteFilter);
}
