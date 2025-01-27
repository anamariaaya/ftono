import { gridCanciones, cancionesInput } from './selectores.js';
import { readLang, readJSON, eliminarItem, normalizeText, caps } from '../base/funciones.js';

export async function consultaCanciones() {
    try {
        const resultado = await fetch(window.location.origin + '/api/public/songs');
        const datos = await resultado.json();
        mostrarCanciones(datos);  // Show all songs initially
    } catch (error) {
        console.log(error);
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

// Function to handle filtering songs when the user types in the search input
async function filtraCanciones() {
    // Listen for input changes in the search field
    cancionesInput.addEventListener('input', async (e) => {
        const query = e.target.value.toLowerCase().trim();
        
        if (query.length > 0) {
            // Send the search query to the server to get filtered songs
            const response = await fetch(`/api/public/songs/search?search=${query}`);
            const filteredSongs = await response.json();  // Get filtered songs
            mostrarCanciones(filteredSongs);  // Display filtered songs
        } else {
            // If no query, display all songs again
            consultaCanciones();
        }
    });
}

// Call the search and filter function
filtraCanciones();
