import{contratosContainer,contratosSearch}from"./selectores.js";import{readLang,readJSON,eliminarItem}from"../base/funciones.js";export async function consultaContratos(){try{const t=await fetch(window.location.origin+"/api/filmtono/contracts");mostrarContratos(await t.json())}catch(t){console.log(t)}}async function mostrarContratos(t){const e=await readLang(),a=await readJSON();t.forEach(t=>{const n=t.nombre_doc.split("-")[2],{id:c,nombre:s,apellido:d,empresa:o,fecha:r,nombre_doc:i}=t,l=document.createElement("a");l.classList.add("cards__link"),l.href="/filmtono/contracts/current?id="+c+"&type="+n;const m=document.createElement("div");m.classList.add("cards__card");const p=document.createElement("div");p.classList.add("cards__info");const _=document.createElement("div");_.classList.add("cards__info--div");const C=document.createElement("p");C.textContent=a["contracts_user-name"][e]+":",C.classList.add("cards__text","cards__text--span");const u=document.createElement("p");u.textContent=`${s} ${d}`,u.classList.add("cards__text"),_.appendChild(C),_.appendChild(u);const h=document.createElement("div");h.classList.add("cards__info--div");const f=document.createElement("p");f.textContent=a.contracts_empresa[e]+":",f.classList.add("cards__text","cards__text--span");const x=document.createElement("p");x.textContent=o,x.classList.add("cards__text"),h.appendChild(f),h.appendChild(x);const L=document.createElement("div");L.classList.add("cards__info--div");const E=document.createElement("p");E.textContent=a.contracts_type[e]+":",E.classList.add("cards__text","cards__text--span");const y=document.createElement("p");y.textContent="music"===n?a["contracts_type-music"][e]:a["contracts_type-artistic"][e],y.classList.add("cards__text"),L.appendChild(E),L.appendChild(y);const v=document.createElement("div");v.classList.add("cards__info--div");const g=document.createElement("p");g.textContent=a.contracts_fecha[e]+":",g.classList.add("cards__text","cards__text--span");const w=document.createElement("p"),b=new Date(r).toLocaleDateString(e,{year:"numeric",month:"short",day:"numeric"});w.textContent=b,w.classList.add("cards__text"),v.appendChild(g),v.appendChild(w);const S=document.createElement("div");S.classList.add("cards__actions");const j=document.createElement("button");j.classList.add("btn-delete"),j.id="eliminar",j.value=c,j.dataset.type=n,j.dataset.item="contracts",j.dataset.role="filmtono",j.onclick=eliminarItem;const k=document.createElement("i");k.classList.add("fa-solid","fa-trash-can","no-click"),j.appendChild(k),S.appendChild(j),p.appendChild(_),p.appendChild(h),p.appendChild(L),p.appendChild(v),m.appendChild(p),m.appendChild(S),l.appendChild(m),contratosContainer.appendChild(l)}),filtrarContratos()}function filtrarContratos(){contratosSearch.addEventListener("input",t=>{const e=t.target.value.toLowerCase();document.querySelectorAll(".cards__card").forEach(t=>{-1!==t.textContent.toLowerCase().indexOf(e)?(t.style.display="flex",t.style.marginRight="2rem",contratosContainer.style.gap="0"):t.style.display="none"})})}
//# sourceMappingURL=contratos.js.map
