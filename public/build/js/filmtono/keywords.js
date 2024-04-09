import{keywordsInput,gridKeywords}from"./selectores.js";import{readLang,readJSON,eliminarItem,normalizeText}from"../base/funciones.js";export async function consultaKeywords(){try{const e=new URLSearchParams(window.location.search),t=e.get("id"),a=e.get("category"),o=window.location.origin+"/api/filmtono/keywords?id="+t+"&category="+a,d=await fetch(o);mostrarKeywords(await d.json())}catch(e){console.log(e)}}export async function mostrarKeywords(e){const t=await readLang();await readJSON();(e=e.map(e=>({id:e.id,keyword_en:e.keyword_en.toLowerCase(),keyword_es:e.keyword_es.toLowerCase()}))).sort((e,a)=>"es"===t?e.keyword_es<a.keyword_es?-1:e.keyword_es>a.keyword_es?1:0:e.keyword_en<a.keyword_en?-1:e.keyword_en>a.keyword_en?1:0),e.forEach(e=>{const{id:a,keyword_en:o,keyword_es:d,id_categoria:n}=e,r=document.createElement("DIV");r.classList.add("cards__div");const s=document.createElement("H3");s.classList.add("card__info--title"),s.textContent="es"==t?d:o;const c=new URLSearchParams(window.location.search).get("category"),i=document.createElement("A");i.classList.add("btn-update"),i.href="/filmtono/categories/keywords/edit?id="+a+"&category="+c;const l=document.createElement("I");l.classList.add("fa-solid","fa-pencil","no-click"),i.appendChild(l);const m=document.createElement("BUTTON");m.classList.add("btn-delete"),m.value=a,m.dataset.type=c,m.dataset.role="filmtono",m.dataset.item="keywords",m.onclick=eliminarItem;const y=document.createElement("I");y.classList.add("fa-solid","fa-trash-can","no-click"),m.appendChild(y),m.onclick=eliminarItem;const w=document.createElement("DIV");w.classList.add("card__acciones"),w.appendChild(i),w.appendChild(m);const p=document.createElement("DIV");p.classList.add("card"),r.appendChild(s),r.appendChild(w),p.appendChild(r),gridKeywords.appendChild(p)}),filtrakeywords()}function filtrakeywords(){keywordsInput.addEventListener("input",e=>{const t=normalizeText(e.target.value);document.querySelectorAll(".card").forEach(e=>{-1!==normalizeText(e.textContent).indexOf(t)?(e.style.display="flex",e.style.marginRight="2rem",gridKeywords.style.columnGap="0"):e.style.display="none"})})}
//# sourceMappingURL=keywords.js.map
