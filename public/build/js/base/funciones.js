import{er,num,indicativo}from"../admin/selectores.js";import{container}from"../filmtono/selectores.js";import{body,dashboardContenido}from"./selectores.js";export async function readLang(){try{const e=await fetch(window.location.origin+"/api/filmtono/lenguaje");return await e.json()}catch(e){console.log(e)}}export async function readJSON(){try{const e=await fetch(window.location.origin+"/api/filmtono/alerts",{mode:"cors"});return await e.json()}catch(e){console.log(e)}}export async function imprimirAlerta(e,t,a,r){const n=document.createElement("div");n.style.gridColumn="1 / 3","error"===t?n.classList.add("alerta__error"):n.classList.add("alerta__exito");const o=document.querySelector(".alerta__error");o&&o.remove();const l=await readLang(),c=await readJSON();n.textContent=c[e][l],a.insertBefore(n,r),setTimeout(()=>{n.remove()},4e3)}export function validarFormulario(e){const t=e.target.parentElement;if(e.target.value.length>0){const e=document.querySelector(".alerta__error");e&&e.remove()}else imprimirAlerta("input","error",t,e.target);"email"===e.target.type&&!1===er.test(e.target.value)&&imprimirAlerta("email","error",t,e.target),"select-one"===e.target.type&&("0"!==e.target.value&&""!==e.target.value||imprimirAlerta("select","error",t,e.target)),"tel"===e.target.type&&(!1===num.test(e.target.value)||e.target.value.length<8)&&imprimirAlerta("phone","error",t,e.target)}export function llenarDatos(){const e=document.querySelectorAll(".form input"),t=Array.from(e),a={};return t.forEach(e=>{a[e.id]=e.value}),a}export function limpiarHTML(e){for(;e.firstChild;)e.removeChild(e.firstChild)}export function crearAlerta(e,t){const a=document.createElement("div");a.classList.add("modal-alerta--activo");const r=document.createElement("DIV");r.classList.add("modal-alerta");const n=document.createElement("I");n.classList.add("fa-solid","fa-circle-exclamation","modal-alerta__icono");const o=document.createElement("H3");o.classList.add("modal-alerta__titulo"),o.textContent="¿Estás seguro?";const l=document.createElement("P");l.classList.add("modal-alerta__parrafo"),l.textContent="Esta acción no se puede deshacer";const c=document.createElement("DIV");c.classList.add("modal-alerta__botones");const i=document.createElement("BUTTON");i.classList.add("modal-alerta__boton","modal-alerta__boton--cancelar"),i.textContent="Cancelar",i.onclick=cerrarAlerta;const d=document.createElement("FORM");d.setAttribute("action",e),d.setAttribute("method","POST");const s=document.createElement("INPUT");s.setAttribute("type","hidden"),s.setAttribute("name","id"),s.setAttribute("value",t);const m=document.createElement("INPUT");m.setAttribute("type","submit"),m.setAttribute("value","Eliminar"),m.classList.add("modal-alerta__boton"),d.appendChild(s),d.appendChild(m),c.appendChild(i),c.appendChild(d),r.appendChild(n),r.appendChild(o),r.appendChild(l),r.appendChild(c),a.appendChild(r),container.appendChild(a)}export function cerrarAlerta(){const e=document.querySelector(".modal-alerta--activo");e&&e.remove()}export function loader(e){document.getElementById("loadingScreen").style.display="none",e.addEventListener("click",(function(){document.getElementById("loadingScreen").style.display="flex"}))}export async function eliminarItem(e){e.preventDefault();const t=await readLang(),a=await readJSON();if(e.target.classList.contains("btn-delete")){const r=e.target.id;dashboardContenido.classList.add("overlay");const n=document.createElement("div");n.classList.add("register");const o=document.createElement("div");o.classList.add("register__modal"),console.log("Borrar: "+r);const l=document.createElement("button");l.classList.add("register__btn-cerrar"),l.innerHTML='<i class="fas fa-times"></i>',l.onclick=cerrarModal;const c=document.createElement("p");c.textContent=a.delete_item[t];const i=document.createElement("div");i.classList.add("btn__wrapper");const d=document.createElement("button");d.classList.add("btn-delete"),d.textContent=a.delete[t];const s=document.createElement("button");s.classList.add("btn-cancel"),s.textContent=a.cancel[t],s.onclick=cerrarModal,i.appendChild(d),i.appendChild(s),o.appendChild(c),o.appendChild(i),n.appendChild(o),body.appendChild(n)}}function cerrarModal(){const e=document.querySelector(".register");dashboardContenido.classList.remove("overlay"),e.remove()}
//# sourceMappingURL=funciones.js.map
