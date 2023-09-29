import{artistasInput,portada,artistaSecundario,btnAgregar}from"./selectores.js";import{readLang,readJSON,validarFormulario}from"../base/funciones.js";export function styleDatalist(){artistasInput.forEach(t=>{t.onfocus=function(){t.nextElementSibling.style.display="block"};for(let e of t.nextElementSibling.options)e.classList.add("option"),e.onclick=function(){t.value=e.value,t.nextElementSibling.style.display="none"};t.oninput=function(){const e=t.value.toUpperCase();for(let a of t.nextElementSibling.options)a.value.toUpperCase().indexOf(e)>-1?a.style.display="block":a.style.display="none"},t.onclick=function(){t.nextElementSibling.style.display="block"}})}export function styleFileInput(){readLang().then(t=>{"es"===t?portada.forEach(t=>{t.setAttribute("data-text","Selecciona un archivo")}):portada.forEach(t=>{t.setAttribute("data-text","Select a file")})})}export function artistasSecundarios(){let t=artistaSecundario.nextElementSibling;for(let e of t.options)e.onclick=function(){let a=artistaSecundario.id,n=artistaSecundario.name;a=e.value,n=e.textContent,agregarArtistaSecundario(a,n),t.style.display="none"},artistaSecundario.oninput=function(){const e=artistaSecundario.value.toUpperCase();for(let a of t.options)a.value.toUpperCase().indexOf(e)>-1?a.style.display="block":a.style.display="none"};const e=document.createElement("div");e.classList.add("form__custom__input--artistas"),artistaSecundario.parentElement.insertBefore(e,artistaSecundario)}function agregarArtistaSecundario(t,e){const a=document.querySelector(".form__custom__input--artistas");document.querySelectorAll(".form__custom__input--artistas__p").forEach(e=>{e.id===t?e.remove():a.appendChild(e)});const n=document.createElement("p");n.classList.add("form__custom__input--artistas__p"),n.id=t,n.textContent=e;const o=document.createElement("button");o.classList.add("btn-eliminar"),o.textContent="X",o.id=t,o.onclick=function(){a.removeChild(n)},n.appendChild(o),a.appendChild(n);document.querySelector("#btn-artista").addEventListener("click",(function(t){const e=[];document.querySelectorAll(".form__custom__input--artistas__p").forEach(t=>{e.push(t.id)});const a=document.querySelector("#artsecundarios-hidden");a.value=e.toString(),console.log(a.value)}))}export async function addArtist(){const t=await readLang(),e=await readJSON();btnAgregar.addEventListener("click",(function(a){a.preventDefault();const n=document.querySelector("body");n.classList.add("overlay");const o=document.createElement("div");o.classList.add("register");const r=document.createElement("div");r.classList.add("register__modal");const i=document.createElement("button");i.classList.add("register__btn-cerrar"),i.innerHTML='<i class="fas fa-times"></i>',i.onclick=cerrarModal;const s=document.createElement("form");s.classList.add("register__form"),s.id="form-artista",s.autocomplete="off";const c=document.createElement("h2");c.classList.add("register__title"),c.textContent=e.addArtist[t];const l=document.createElement("div");l.classList.add("form__group");const d=document.createElement("label");d.classList.add("form__group__label"),d.htmlFor="nombre",d.textContent=e.name[t];const u=document.createElement("input");u.classList.add("form__group__input"),u.type="text",u.name="nombre",u.id="artista-nombre",u.addEventListener("blur",validarFormulario),u.placeholder=e.name[t];const m=document.createElement("input");m.classList.add("btn-submit"),m.type="submit",m.value=e.add[t],m.onclick=enviarArtista,l.appendChild(d),l.appendChild(u),s.appendChild(c),s.appendChild(l),s.appendChild(m),r.appendChild(i),r.appendChild(s),o.appendChild(r),n.appendChild(o)}))}async function enviarArtista(){const t=document.querySelector("#artista-nombre").value,e=new FormData;e.append("nombre",t);try{const t=window.location.origin+"/api/albums/artistasNew",a=await fetch(t,{method:"POST",body:e,mode:"no-cors"});if((await a.json()).resultado){const t=await readLang();console.log(t),"es"===t?alert("Artista agregado correctamente"):alert("Artist added successfully"),window.location.reload()}}catch(t){"es"===await readLang()?alert("Hubo un error"):alert("There was an error")}}function cerrarModal(){const t=document.querySelector("body"),e=document.querySelector(".register");t.classList.remove("overlay"),e.remove()}
//# sourceMappingURL=artistas.js.map
