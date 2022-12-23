export async function consultaPaises(){
    try{
        const resultado = await fetch('https://restcountries.com/v3.1/all');
        const datos = await resultado.json();
        mostrarPaises(datos);

    }catch(error){
        console.log(error);
    }
}

console.log(language);

function mostrarPaises(datos){
    datos.forEach(pais => {
        console.log(pais.translations.spa.common);        
    });

    //Organizar los paises en orden alfabético usando el foreach y el sort
    // const paises = [];
    // datos.forEach( pais => {
    //     paises.push(pais.name.common);
    // });
    // paises.sort();
    // //mostrar cada país en consola
    // paises.forEach( pais => {
    //     console.log(pais);
    // });

    // const select = document.querySelector('#pais');
    // datos.forEach( pais => {
    //     const {name: {common}} = pais;
    //     const option = document.createElement('option');
    //     option.value = common;
    //     option.textContent = common;
    //     select.appendChild(option);
    // });
}
