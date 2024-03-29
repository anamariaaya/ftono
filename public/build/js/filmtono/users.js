import{gridUsuarios}from"./selectores.js";import{eliminarItem}from"../base/funciones.js";export async function consultaUsuarios(){try{const e=await fetch(window.location.origin+"/api/filmtono/users");mostrarUsuarios(await e.json())}catch(e){console.log(e)}}export function mostrarUsuarios(e){e.forEach(e=>{const{id:t,nombre:n,apellido:a,email:s,confirmado:d,nivel_admin:o,nivel_musica:c,compradores:i,empresa:l}=e,r=document.createElement("H3");r.classList.add("card__title"),r.textContent=o?"Administrador":c?2==c?"Editorial":"Sello":"Comprador";const m=document.createElement("P");m.classList.add("card__info--title"),m.textContent=l;const p=document.createElement("P");p.classList.add("card__info"),p.textContent=n+" "+a;const u=document.createElement("P");u.classList.add("card__info"),u.textContent=s;const f=document.createElement("P");f.classList.add("card__info--span"),f.textContent=d?"Confirmado":"Sin confirmar";const C=document.createElement("A");C.classList.add("btn-view"),C.textContent="Ver más",C.href="/filmtono/users/current?id="+t;const h=document.createElement("I");h.classList.add("fa-solid","fa-eye"),C.appendChild(h);const E=document.createElement("A");E.classList.add("btn-update"),E.href="/filmtono/users/edit?id="+t;const _=document.createElement("I");_.classList.add("fa-solid","fa-pencil","no-click"),E.appendChild(_);const L=document.createElement("BUTTON");L.classList.add("btn-delete"),L.value=t,L.dataset.role="filmtono",L.dataset.item="users",L.onclick=eliminarItem;const x=document.createElement("I");x.classList.add("fa-solid","fa-trash-can","no-click"),L.appendChild(x);const I=document.createElement("DIV");I.classList.add("card__acciones"),I.appendChild(E),I.appendChild(L);const U=document.createElement("DIV");U.classList.add("card"),U.appendChild(r),l&&U.appendChild(m),U.appendChild(p),U.appendChild(u),U.appendChild(f),U.appendChild(C),U.appendChild(I),gridUsuarios.appendChild(U)})}
//# sourceMappingURL=users.js.map
