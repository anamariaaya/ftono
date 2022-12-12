import { btnEliminarCuenta } from './selectores.js';
import { crearAlerta } from '../base/funciones.js';

export function eliminarCuenta(){

    btnEliminarCuenta.addEventListener('click', function(e){
            e.preventDefault();

            const id = e.target.value;
                crearAlerta('/filmtono/profile/delete');
        });
}