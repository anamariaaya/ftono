import{contratosContainer,contratosSearch}from"./selectores.js";import{readLang,readJSON,eliminarItem,normalizeText}from"../base/funciones.js";export async function consultaContratos(){try{const t=await fetch(window.location.origin+"/api/filmtono/contracts");mostrarContratos(await t.json())}catch(t){console.log(t)}}async function mostrarContratos(t){const e=await readLang(),a=await readJSON();t.forEach(t=>{const n=t.nombre_doc.split("-")[2],{id:c,nombre:s,apellido:d,empresa:o,fecha:r}=t,i=document.createElement("a");i.classList.add("cards__link"),i.href="/filmtono/contracts/current?id="+c+"&type="+n;const l=document.createElement("div");l.classList.add("cards__card");const m=document.createElement("div");m.classList.add("cards__info");const p=document.createElement("div");p.classList.add("cards__info--div");const _=document.createElement("p");_.textContent=a["contracts_user-name"][e]+":",_.classList.add("cards__text","cards__text--span");const u=document.createElement("p");u.textContent=`${s} ${d}`,u.classList.add("cards__text"),p.appendChild(_),p.appendChild(u);const C=document.createElement("div");C.classList.add("cards__info--div");const h=document.createElement("p");h.textContent=a.contracts_empresa[e]+":",h.classList.add("cards__text","cards__text--span");const x=document.createElement("p");x.textContent=o,x.classList.add("cards__text"),C.appendChild(h),C.appendChild(x);const f=document.createElement("div");f.classList.add("cards__info--div");const L=document.createElement("p");L.textContent=a.contracts_type[e]+":",L.classList.add("cards__text","cards__text--span");const E=document.createElement("p");E.textContent="music"===n?a["contracts_type-music"][e]:a["contracts_type-artistic"][e],E.classList.add("cards__text"),f.appendChild(L),f.appendChild(E);const y=document.createElement("div");y.classList.add("cards__info--div");const v=document.createElement("p");v.textContent=a.contracts_fecha[e]+":",v.classList.add("cards__text","cards__text--span");const g=document.createElement("p"),w=new Date(r).toLocaleDateString(e,{year:"numeric",month:"short",day:"numeric"});g.textContent=w,g.classList.add("cards__text"),y.appendChild(v),y.appendChild(g);const S=document.createElement("div");S.classList.add("cards__actions");const b=document.createElement("button");b.classList.add("btn-delete"),b.id="eliminar",b.value=c,b.dataset.type=n,b.dataset.item="contracts",b.dataset.role="filmtono",b.onclick=eliminarItem;const j=document.createElement("i");j.classList.add("fa-solid","fa-trash-can","no-click"),b.appendChild(j),S.appendChild(b),m.appendChild(p),m.appendChild(C),m.appendChild(f),m.appendChild(y),i.appendChild(m),i.appendChild(S),l.appendChild(i),contratosContainer.appendChild(l)}),filtrarContratos()}function filtrarContratos(){contratosSearch.addEventListener("input",t=>{const e=normalizeText(t.target.value);document.querySelectorAll(".cards__card").forEach(t=>{-1!==normalizeText(t.textContent).indexOf(e)?(t.style.display="flex",t.style.marginRight="2rem",contratosContainer.style.columnGap="0"):t.style.display="none"})})}
//# sourceMappingURL=contratos.js.map
