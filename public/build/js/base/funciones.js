import{er,num,indicativo}from"../admin/selectores.js";import{container}from"../filmtono/selectores.js";export async function readLang(){try{const t=await fetch("http://localhost:3000/api/filmtono/lenguaje");return await t.json()}catch(t){console.log(t)}}export async function readJSON(){try{const t=await fetch("http://localhost:3000/api/filmtono/alerts");return await t.json()}catch(t){console.log(t)}}export async function imprimirAlerta(t,e,a,r){const o=document.createElement("div");o.style.gridColumn="1 / 3","error"===e?o.classList.add("alerta__error"):o.classList.add("alerta__exito");const n=document.querySelector(".alerta__error");n&&n.remove();const l=await readLang(),c=await readJSON();o.textContent=c[t][l],a.insertBefore(o,r),setTimeout(()=>{o.remove()},3e3)}export function validarFormulario(t){const e=t.target.parentElement;if(t.target.value.length>0){const t=document.querySelector(".alerta__error");t&&t.remove()}else imprimirAlerta("input","error",e,t.target);"email"===t.target.type&&!1===er.test(t.target.value)&&imprimirAlerta("email","error",e,t.target),"select-one"===t.target.type&&("0"!==t.target.value&&""!==t.target.value||imprimirAlerta("select","error",e,t.target)),"tel"===t.target.type&&(!1===num.test(t.target.value)||t.target.value.length<9)&&imprimirAlerta("phone","error",e,t.target)}export function llenarDatos(){const t=document.querySelectorAll(".form input"),e=Array.from(t),a={};return e.forEach(t=>{a[t.id]=t.value}),a}export function limpiarHTML(t){for(;t.firstChild;)t.removeChild(t.firstChild)}export function crearAlerta(t,e){const a=document.createElement("div");a.classList.add("modal-alerta--activo");const r=document.createElement("DIV");r.classList.add("modal-alerta");const o=document.createElement("I");o.classList.add("fa-solid","fa-circle-exclamation","modal-alerta__icono");const n=document.createElement("H3");n.classList.add("modal-alerta__titulo"),n.textContent="¿Estás seguro?";const l=document.createElement("P");l.classList.add("modal-alerta__parrafo"),l.textContent="Esta acción no se puede deshacer";const c=document.createElement("DIV");c.classList.add("modal-alerta__botones");const i=document.createElement("BUTTON");i.classList.add("modal-alerta__boton","modal-alerta__boton--cancelar"),i.textContent="Cancelar",i.onclick=cerrarAlerta;const s=document.createElement("FORM");s.setAttribute("action",t),s.setAttribute("method","POST");const d=document.createElement("INPUT");d.setAttribute("type","hidden"),d.setAttribute("name","id"),d.setAttribute("value",e);const m=document.createElement("INPUT");m.setAttribute("type","submit"),m.setAttribute("value","Eliminar"),m.classList.add("modal-alerta__boton"),s.appendChild(d),s.appendChild(m),c.appendChild(i),c.appendChild(s),r.appendChild(o),r.appendChild(n),r.appendChild(l),r.appendChild(c),a.appendChild(r),container.appendChild(a)}export function cerrarAlerta(){const t=document.querySelector(".modal-alerta--activo");t&&t.remove()}
//# sourceMappingURL=funciones.js.map
