import{botones,pagAnterior,pagSiguiente,afterNav,btnContrato,nombre,email,cargo,telContacto,empresa,idFiscal,direccion,terms,privacy,divCheck,btnSubmit,paisContacto,telIndex,hiddenMusic,hiddenArtistic,contratoMusical,contratoArtistico,confirmContrato,confirmContratoArt}from"./selectores.js";import{validarFormulario,imprimirAlerta}from"../base/funciones.js";import{readLang,readJSON}from"../base/funciones.js";let checkMusical=!1,paso=1;export function tabs(){botones.forEach(t=>{t.addEventListener("click",(function(t){paso=t.target.dataset.paso,cambiarSeccion(t),botonesPaginador()}))})}const secciones=document.querySelectorAll(".tabs__section");function cambiarSeccion(t){const e=document.querySelector("#paso-"+paso);e.classList.add("mostrar"),t.target.classList.add("active"),"paso-1"===e.id?(botones[0].classList.add("active"),botones[1].classList.remove("active"),botones[2].classList.remove("active"),secciones[0].classList.add("mostrar"),secciones[1].classList.remove("mostrar"),secciones[2].classList.remove("mostrar")):"paso-2"===e.id?(botones[1].classList.add("active"),botones[2].classList.remove("active"),secciones[1].classList.add("mostrar"),secciones[2].classList.remove("mostrar"),secciones[0].classList.remove("mostrar")):(botones[1].classList.add("active"),botones[2].classList.add("active"),secciones[2].classList.add("mostrar"),secciones[0].classList.remove("mostrar"),secciones[1].classList.remove("mostrar"))}async function botonesPaginador(){const t=await readLang(),e=await readJSON();switch(paso){case"1":pagAnterior.classList.add("ocultar"),pagSiguiente.classList.remove("ocultar"),afterNav.classList.remove("step2"),afterNav.classList.remove("step3"),pagSiguiente.classList.remove("btn-tabs--disabled");break;case"2":pagAnterior.classList.remove("ocultar"),pagSiguiente.classList.remove("ocultar"),afterNav.classList.add("step2"),afterNav.classList.remove("step3"),pagSiguiente.classList.remove("btn-tabs--disabled");break;case"3":pagAnterior.classList.remove("ocultar"),pagSiguiente.textContent=e.register[t]+" ✓",pagSiguiente.onclick=validarCheck,afterNav.classList.add("step3"),afterNav.classList.remove("step2"),btnContrato&&btnContrato.forEach(t=>{t.onclick=modalContrato})}}export function paginador(){pagAnterior.addEventListener("click",paginaAnterior),pagSiguiente.addEventListener("click",paginaSiguiente)}function paginaSiguiente(){botones[1].classList.contains("active")?botones[2].classList.contains("active")||botones[2].click():botones[1].click()}function paginaAnterior(t){botones[2].classList.contains("active")?botones[1].click():botones[1].classList.contains("active")&&botones[0].click()}export function formularioReg(){cargo.addEventListener("blur",validarFormulario),telContacto.addEventListener("blur",validarFormulario),empresa.addEventListener("blur",validarFormulario),idFiscal.addEventListener("blur",validarFormulario),direccion.addEventListener("blur",validarFormulario)}function validarCheck(t){if(t.preventDefault(),terms.checked)if(privacy.checked)if(!1===checkMusical)alertaCheck("contract");else{const t=[cargo,telContacto,empresa,idFiscal,direccion];Array.from(t).every(t=>""!==t.value)?btnSubmit.click():alertaCheck("inputs")}else alertaCheck("privacy");else alertaCheck("terms")}async function alertaCheck(t){const e=document.createElement("div");e.classList.add("alerta__error");const a=document.querySelector(".alerta__error");a&&a.remove();const o=await readLang(),n=await readJSON();e.textContent=n[t][o],divCheck.appendChild(e),setTimeout(()=>{e.remove()},4e3)}async function getContrato(t){try{const e=await fetch(t);return await e.json()}catch(t){console.log(t)}}async function modalContrato(t){t.preventDefault();const e=await readLang(),a=await readJSON(),o=document.querySelector("body");o.classList.add("overlay");const n=document.createElement("div");n.classList.add("register");const s=document.createElement("div");s.classList.add("register__modal");const c=document.createElement("button");let i;c.classList.add("register__btn-cerrar"),c.innerHTML='<i class="fas fa-times"></i>',c.onclick=cerrarModal,i="contrato-musical"===t.target.id?window.location.origin+"/api/filmtono/c-musical":window.location.origin+"/api/filmtono/c-artistico";const r=document.createElement("div"),l=await getContrato(i);r.innerHTML=l;const d=document.createElement("P");d.textContent=a.signature[e],d.classList.add("firma");const m=document.createElement("P");m.textContent=a.signatureInfo[e],m.classList.add("firma__info");const u=document.createElement("form"),v=document.createElement("canvas");v.width=600,v.height=200,v.style.border="1px solid black",v.style.backgroundColor="white",v.style.margin="0 auto",v.style.display="block","contrato-musical"===t.target.id?v.id="canvas-musical":v.id="canvas-artistico";const p=v.getContext("2d");p.fillStyle="white",p.strokeStyle="black",p.lineWidth=2,p.lineCap="round";let f=!1,g=0,L=0;function b(t){f=!0,t.touches?[g,L]=[t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop]:[g,L]=[t.offsetX,t.offsetY]}function C(t){f&&(p.beginPath(),t.touches?(p.moveTo(g,L),p.lineTo(t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop),[g,L]=[t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop]):(p.moveTo(g,L),p.lineTo(t.offsetX,t.offsetY),[g,L]=[t.offsetX,t.offsetY]),p.stroke())}function h(){f=!1,p.beginPath()}v.addEventListener("mousedown",b),v.addEventListener("mousemove",C),v.addEventListener("mouseup",h),v.addEventListener("touchstart",b),v.addEventListener("touchmove",C),v.addEventListener("touchend",h);const y=document.createElement("button");y.classList.add("btn-contrato--optional"),y.textContent=a.clear[e],y.onclick=function(){p.clearRect(0,0,v.width,v.height),v.isCanvasBlank=!0,"canvas-musical"===v.id&&(imprimirAlerta("signValidation","error",m),k.classList.add("btn-tabs--disabled"))};const k=document.createElement("button");"canvas-musical"===v.id?k.classList.add("btn-tabs","btn-tabs--disabled"):k.classList.add("btn-tabs"),k.textContent="Guardar",k.onclick=canvasValidation(v,k),u.appendChild(v),s.appendChild(c),s.appendChild(r),s.appendChild(d),s.appendChild(m),s.appendChild(u),s.appendChild(y),s.appendChild(k),n.appendChild(s),o.appendChild(n),datosContrato(v),paisContrato()}async function canvasValidation(t,e){const a=await readLang(),o=await readJSON();t.addEventListener("mouseup",()=>{isCanvasBlank(t)||("canvas-musical"===t.id?(e.classList.remove("btn-tabs--disabled"),contratoMusical.style.display="none",confirmContrato.style.display="block",confirmContrato.textContent=o.confirm[a],checkMusical=!0,hiddenMusic.value=t.toDataURL()):(contratoArtistico.style.display="none",confirmContratoArt.style.display="block",confirmContratoArt.textContent=o.confirm[a],hiddenArtistic.value=t.toDataURL()),e.onclick=cerrarModal)})}function isCanvasBlank(t){const e=t.getContext("2d");return!new Uint32Array(e.getImageData(0,0,t.width,t.height).data.buffer).some(t=>0!==t)}async function paisContrato(){if("0"!==paisContacto.value){const t=document.querySelector("#pais_contacto_name"),e=await readLang(),a=document.querySelector("#contract-pais"),o="https://restcountries.com/v3.1/alpha/"+paisContacto.value;fetch(o).then(t=>t.json()).then(o=>{"es"===e?(a.textContent=o[0].translations.spa.common,t.value=o[0].translations.spa.common):(a.textContent=o[0].name.common,t.value=o[0].name.common)})}}function datosContrato(t){document.querySelector(".grid-firmas").classList.remove("no-display");const e=document.querySelector("#contract-empresa"),a=document.querySelector("#contract-nombre"),o=document.querySelector("#contract-id-fiscal"),n=document.querySelector("#contract-direccion"),s=document.querySelector("#contract-telefono"),c=document.querySelector("#contract-email"),i=document.getElementById("signature-img");e.textContent=empresa.value,a.textContent=nombre.value,o.textContent=idFiscal.value,n.textContent=direccion.value,s.textContent=telIndex.value+telContacto.value,c.textContent=email.value,t.addEventListener("click",()=>{i.src=t.toDataURL(),i.classList.remove("no-display")})}function cerrarModal(){const t=document.querySelector("body"),e=document.querySelector(".register");t.classList.remove("overlay"),e.remove()}
//# sourceMappingURL=perfiles.js.map
