import{er,num,indicativo}from"../admin/selectores.js";import{container}from"../filmtono/selectores.js";export async function readLang(){try{const e=await fetch(window.location.origin+"/api/filmtono/lenguaje");return await e.json()}catch(e){console.log(e)}}export async function readJSON(){try{const e=await fetch(window.location.origin+"/api/filmtono/alerts",{mode:"cors"});return await e.json()}catch(e){console.log(e)}}export async function imprimirAlerta(e,t,a,r){const o=document.createElement("div");o.style.gridColumn="1 / 3","error"===t?o.classList.add("alerta__error"):o.classList.add("alerta__exito");const n=document.querySelector(".alerta__error");n&&n.remove();const l=await readLang(),i=await readJSON();o.textContent=i[e][l],a.insertBefore(o,r),setTimeout(()=>{o.remove()},4e3)}export function validarFormulario(e){const t=e.target.parentElement;if(e.target.value.length>0){const e=document.querySelector(".alerta__error");e&&e.remove()}else imprimirAlerta("input","error",t,e.target);"email"===e.target.type&&!1===er.test(e.target.value)&&imprimirAlerta("email","error",t,e.target),"select-one"===e.target.type&&("0"!==e.target.value&&""!==e.target.value||imprimirAlerta("select","error",t,e.target)),"tel"===e.target.type&&(!1===num.test(e.target.value)||e.target.value.length<8)&&imprimirAlerta("phone","error",t,e.target)}export function llenarDatos(){const e=document.querySelectorAll(".form input"),t=Array.from(e),a={};return t.forEach(e=>{a[e.id]=e.value}),a}export function limpiarHTML(e){for(;e.firstChild;)e.removeChild(e.firstChild)}export function crearAlerta(e,t){const a=document.createElement("div");a.classList.add("modal-alerta--activo");const r=document.createElement("DIV");r.classList.add("modal-alerta");const o=document.createElement("I");o.classList.add("fa-solid","fa-circle-exclamation","modal-alerta__icono");const n=document.createElement("H3");n.classList.add("modal-alerta__titulo"),n.textContent="¿Estás seguro?";const l=document.createElement("P");l.classList.add("modal-alerta__parrafo"),l.textContent="Esta acción no se puede deshacer";const i=document.createElement("DIV");i.classList.add("modal-alerta__botones");const c=document.createElement("BUTTON");c.classList.add("modal-alerta__boton","modal-alerta__boton--cancelar"),c.textContent="Cancelar",c.onclick=cerrarAlerta;const s=document.createElement("FORM");s.setAttribute("action",e),s.setAttribute("method","POST");const d=document.createElement("INPUT");d.setAttribute("type","hidden"),d.setAttribute("name","id"),d.setAttribute("value",t);const m=document.createElement("INPUT");m.setAttribute("type","submit"),m.setAttribute("value","Eliminar"),m.classList.add("modal-alerta__boton"),s.appendChild(d),s.appendChild(m),i.appendChild(c),i.appendChild(s),r.appendChild(o),r.appendChild(n),r.appendChild(l),r.appendChild(i),a.appendChild(r),container.appendChild(a)}export function cerrarAlerta(){const e=document.querySelector(".modal-alerta--activo");e&&e.remove()}
//# sourceMappingURL=funciones.js.map
