import{idiomasInput,gridIdiomas}from"./selectores.js";import{readLang,readJSON,eliminarItem,normalizeText}from"../base/funciones.js";export async function consultaIdiomas(){try{const e=window.location.origin+"/api/filmtono/languages",a=await fetch(e);mostrarIdiomas(await a.json())}catch(e){console.log(e)}}export async function mostrarIdiomas(e){const a=await readLang();await readJSON();(e=e.map(e=>({id:e.id,idioma_en:e.idioma_en.toLowerCase(),idioma_es:e.idioma_es.toLowerCase()}))).sort((e,t)=>"es"===a?e.idioma_es<t.idioma_es?-1:e.idioma_es>t.idioma_es?1:0:e.idioma_en<t.idioma_en?-1:e.idioma_en>t.idioma_en?1:0),e.forEach(e=>{const{id:t,idioma_en:i,idioma_es:o,id_categoria:n}=e,d=document.createElement("DIV");d.classList.add("cards__div");const s=document.createElement("H3");s.classList.add("card__info--title"),s.textContent="es"==a?o:i;const c=new URLSearchParams(window.location.search).get("category"),l=document.createElement("A");l.classList.add("btn-update"),l.href="/filmtono/languages/edit?id="+t;const m=document.createElement("I");m.classList.add("fa-solid","fa-pencil","no-click"),l.appendChild(m);const r=document.createElement("BUTTON");r.classList.add("btn-delete"),r.value=t,r.dataset.type=c,r.dataset.role="filmtono",r.dataset.item="languages",r.onclick=eliminarItem;const p=document.createElement("I");p.classList.add("fa-solid","fa-trash-can","no-click"),r.appendChild(p),r.onclick=eliminarItem;const u=document.createElement("DIV");u.classList.add("card__acciones"),u.appendChild(l),u.appendChild(r);const f=document.createElement("DIV");f.classList.add("card"),d.appendChild(s),d.appendChild(u),f.appendChild(d),gridIdiomas.appendChild(f)}),filtraIdiomas()}function filtraIdiomas(){idiomasInput.addEventListener("input",e=>{const a=normalizeText(e.target.value);document.querySelectorAll(".card").forEach(e=>{-1!==normalizeText(e.textContent).indexOf(a)?(e.style.display="flex",e.style.marginRight="2rem",gridIdiomas.style.columnGap="0"):e.style.display="none"})})}
//# sourceMappingURL=idiomas.js.map
