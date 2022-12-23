export async function consultaCiudades(){try{const o=await fetch("https://restcountries.com/v3.1/all"),t=await o.json();console.log(t)}catch(o){console.log(o)}}
//# sourceMappingURL=APICiudades.js.map
