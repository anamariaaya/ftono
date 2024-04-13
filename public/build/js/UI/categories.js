import{categoriasInput,gridCategorias}from"./selectores.js";import{readLang,readJSON,eliminarItem,normalizeText}from"../base/funciones.js";export async function consultaCategorias(){try{const e=await fetch(window.location.origin+"/api/public/categories");mostrarCategorias(await e.json())}catch(e){console.log(e)}}export async function mostrarCategorias(e){const a=await readLang();await readJSON();e.forEach(e=>{const{id:t,categoria_en:r,categoria_es:i}=e,n=document.createElement("A");n.classList.add("p-cards__grid__link"),"genres"===e.categoria_en?n.href="/category/genres":n.href="/category?id="+t+"&name="+r;const o=document.createElement("P");o.classList.add("p-cards__grid__text"),o.textContent="es"==a?i:r;const s=document.createElement("DIV");s.classList.add("p-cards__grid__item","card-public"),n.appendChild(o),s.appendChild(n),gridCategorias.appendChild(s)}),filtraCategorias()}function filtraCategorias(){categoriasInput.addEventListener("input",e=>{const a=normalizeText(e.target.value);document.querySelectorAll(".card-public").forEach(e=>{-1!==normalizeText(e.textContent).indexOf(a)?(e.style.display="flex",e.style.marginRight="2rem",gridCategorias.style.columnGap="0"):e.style.display="none"})})}
//# sourceMappingURL=categories.js.map
