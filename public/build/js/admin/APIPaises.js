import{validarFormulario}from"../base/funciones.js";import{selectPais,paisContacto,indicativo}from"./selectores.js";import{readLang}from"../base/funciones.js";export async function consultaPaises(){try{let t="https://restcountries.com/v3.1/all";const o=await fetch(t);mostrarPaises(await o.json())}catch(t){console.log(t)}}function mostrarPaises(t){readLang().then(o=>{"es"===o?t.forEach(o=>{t.sort((t,o)=>t.translations.spa.common<o.translations.spa.common?-1:t.translations.spa.common>o.translations.spa.common?1:0);const a=document.createElement("option");a.value=o.cca2,a.textContent=o.translations.spa.common,selectPais.appendChild(a),paisContacto.appendChild(a.cloneNode(!0))}):t.forEach(o=>{t.sort((t,o)=>t.name.common<o.name.common?-1:t.name.common>o.name.common?1:0);const a=document.createElement("option");a.value=o.cca2,a.textContent=o.name.common,selectPais.appendChild(a),paisContacto.appendChild(a.cloneNode(!0))})})}export function paisElegido(){selectPais.addEventListener("blur",validarFormulario),paisContacto.addEventListener("blur",validarFormulario)}export function indicativoTel(){paisContacto.addEventListener("change",(function(t){if(""!==t.target.value){const o="https://restcountries.com/v3.1/alpha/"+t.target.value;fetch(o).then(t=>t.json()).then(t=>{if(console.log(),0===Object.keys(t[0].idd).length)indicativo.value="0-";else{const o=t[0].idd.root,a=t[0].idd.suffixes[0];indicativo.value=`${o}${a}`,indicativo.setAttribute("readonly","readonly"),indicativo.setAttribute("value",`${o}${a}`)}})}}))}
//# sourceMappingURL=APIPaises.js.map
