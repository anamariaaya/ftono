import{selectPais}from"./selectores.js";async function readLang(){try{const o=await fetch("http://localhost:3000/api/filmtono/lenguaje");return await o.json()}catch(o){console.log(o)}}export async function consultaPaises(){try{let o="https://restcountries.com/v3.1/all";const t=await fetch(o);mostrarPaises(await t.json())}catch(o){console.log(o)}}function mostrarPaises(o){readLang().then(t=>{"es"===t?o.forEach(t=>{o.sort((o,t)=>o.translations.spa.common<t.translations.spa.common?-1:o.translations.spa.common>t.translations.spa.common?1:0);const n=document.createElement("option");n.value=t.translations.spa.common,n.textContent=t.translations.spa.common,selectPais.appendChild(n)}):o.forEach(t=>{o.sort((o,t)=>o.name.common<t.name.common?-1:o.name.common>t.name.common?1:0);const n=document.createElement("option");n.value=t.name.common,n.textContent=t.name.common,selectPais.appendChild(n)})})}export function paisElegido(){selectPais.addEventListener("change",o=>{const t=o.target.value;console.log(t)})}
//# sourceMappingURL=APIPaises.js.map
