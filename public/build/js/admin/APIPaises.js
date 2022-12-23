export async function consultaPaises(){try{const o=await fetch("https://restcountries.com/v3.1/all");mostrarPaises(await o.json())}catch(o){console.log(o)}}function mostrarPaises(o){o.forEach(o=>{console.log(o.translations.spa.common)})}console.log(language);
//# sourceMappingURL=APIPaises.js.map
