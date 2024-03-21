import{er,num,indicativo}from"../admin/selectores.js";import{container}from"../filmtono/selectores.js";import{body,dashboardContenido}from"./selectores.js";export async function readLang(){try{const e=await fetch(window.location.origin+"/api/filmtono/lenguaje");return await e.json()}catch(e){console.log(e)}}export async function readJSON(){try{const e=await fetch(window.location.origin+"/api/filmtono/alerts",{mode:"cors"});return await e.json()}catch(e){console.log(e)}}export async function imprimirAlerta(e,t,a,o){const r=document.createElement("div");r.style.gridColumn="1 / 3","error"===t?r.classList.add("alerta__error"):r.classList.add("alerta__exito");const n=document.querySelector(".alerta__error");n&&n.remove();const d=await readLang(),l=await readJSON();r.textContent=l[e][d],a.insertBefore(r,o),setTimeout(()=>{r.remove()},4e3)}export function validarFormulario(e){const t=e.target.parentElement;if(e.target.value.length>0){const e=document.querySelector(".alerta__error");e&&e.remove()}else imprimirAlerta("input","error",t,e.target);"email"===e.target.type&&!1===er.test(e.target.value)&&imprimirAlerta("email","error",t,e.target),"select-one"===e.target.type&&("0"!==e.target.value&&""!==e.target.value||imprimirAlerta("select","error",t,e.target)),"tel"===e.target.type&&(!1===num.test(e.target.value)||e.target.value.length<8)&&imprimirAlerta("phone","error",t,e.target)}export function llenarDatos(){const e=document.querySelectorAll(".form input"),t=Array.from(e),a={};return t.forEach(e=>{a[e.id]=e.value}),a}export function limpiarHTML(e){for(;e.firstChild;)e.removeChild(e.firstChild)}export function crearAlerta(e,t){const a=document.createElement("div");a.classList.add("modal-alerta--activo");const o=document.createElement("DIV");o.classList.add("modal-alerta");const r=document.createElement("I");r.classList.add("fa-solid","fa-circle-exclamation","modal-alerta__icono");const n=document.createElement("H3");n.classList.add("modal-alerta__titulo"),n.textContent="¿Estás seguro?";const d=document.createElement("P");d.classList.add("modal-alerta__parrafo"),d.textContent="Esta acción no se puede deshacer";const l=document.createElement("DIV");l.classList.add("modal-alerta__botones");const i=document.createElement("BUTTON");i.classList.add("modal-alerta__boton","modal-alerta__boton--cancelar"),i.textContent="Cancelar",i.onclick=cerrarAlerta;const c=document.createElement("FORM");c.setAttribute("action",e),c.setAttribute("method","POST");const s=document.createElement("INPUT");s.setAttribute("type","hidden"),s.setAttribute("name","id"),s.setAttribute("value",t);const m=document.createElement("INPUT");m.setAttribute("type","submit"),m.setAttribute("value","Eliminar"),m.classList.add("modal-alerta__boton"),c.appendChild(s),c.appendChild(m),l.appendChild(i),l.appendChild(c),o.appendChild(r),o.appendChild(n),o.appendChild(d),o.appendChild(l),a.appendChild(o),container.appendChild(a)}export function cerrarAlerta(){const e=document.querySelector(".modal-alerta--activo");e&&e.remove()}export function loader(e){document.getElementById("loadingScreen").style.display="none",e.addEventListener("click",(function(){document.getElementById("loadingScreen").style.display="flex"}))}export async function eliminarItem(e){e.preventDefault();const t=await readLang(),a=await readJSON();if(e.target.classList.contains("btn-delete")){const o=e.target.id;dashboardContenido.classList.add("overlay");const r=document.createElement("div");r.classList.add("deleteModal");const n=document.createElement("div");n.classList.add("deleteModal__modal");const d=document.createElement("button");d.classList.add("deleteModal__btn-close"),d.innerHTML='<i class="fas fa-times"></i>',d.onclick=cerrarModal;const l=document.createElement("i");l.classList.add("fa-solid","fa-circle-exclamation","deleteModal__icon");const i=document.createElement("p");i.classList.add("deleteModal__paragraph"),i.textContent=a.delete_item[t];const c=document.createElement("div");c.classList.add("btn__wrapper");const s=document.createElement("button");s.classList.add("btn-delete"),s.textContent=a.delete[t],s.id=o,s.dataset.type=e.target.dataset.type,s.dataset.role=e.target.dataset.role,s.dataset.item=e.target.dataset.item,loader(s),s.onclick=e=>{""!==e.target.dataset.type?window.location.href=`/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.id}&type=${e.target.dataset.type}`:window.location.href=`/${e.target.dataset.role}/${e.target.dataset.item}/delete?id=${e.target.id}`};const m=document.createElement("button");m.classList.add("btn-cancel"),m.textContent=a.cancel[t],m.onclick=cerrarModal,c.appendChild(s),c.appendChild(m),n.appendChild(d),n.appendChild(l),n.appendChild(i),n.appendChild(c),r.appendChild(n),body.appendChild(r)}}function cerrarModal(){const e=document.querySelector(".deleteModal");dashboardContenido.classList.remove("overlay"),e.remove()}
//# sourceMappingURL=funciones.js.map
