import{imprimirAlerta,loader,readJSON,readLang}from"../base/funciones.js";import{btnContratoDash,dashboardEnlaces}from"./selectores.js";export function blockDashboard(){btnContratoDash.forEach(t=>{"music"===t.id&&dashboardEnlaces.forEach(t=>{"labels"!==t.id&&"music"!==t.id&&"artists"!==t.id||t.classList.add("dashboard__enlace--disabled")})})}export function signContract(){btnContratoDash.forEach(t=>{t.onclick=modalContrato})}async function getContrato(t){try{const e=await fetch(t);return await e.json()}catch(t){console.log(t)}}async function modalContrato(t){t.preventDefault();const e=await readLang(),a=await readJSON(),n=document.querySelector("body");n.classList.add("overlay");const o=document.createElement("div");o.classList.add("register");const i=document.createElement("div");i.classList.add("register__modal");const s=document.createElement("button");let d;s.classList.add("register__btn-cerrar"),s.innerHTML='<i class="fas fa-times"></i>',s.onclick=cerrarModal,d="music"===t.target.id?window.location.origin+"/api/filmtono/c-musical":window.location.origin+"/api/filmtono/c-artistico";const r=document.createElement("div"),c=await getContrato(d);r.innerHTML=c;const l=document.createElement("P");l.textContent=a.signature[e],l.classList.add("firma");const u=document.createElement("P");u.textContent=a.signatureInfo[e],u.classList.add("firma__info");const m=document.createElement("form"),f=document.createElement("canvas");window.innerWidth<600?(f.width=300,f.height=150):(f.width=600,f.height=200),f.style.border="1px solid black",f.style.backgroundColor="white",f.style.margin="0 auto",f.style.display="block","contrato-musical"===t.target.id?f.id="canvas-musical":f.id="canvas-artistico";const h=f.getContext("2d");h.fillStyle="white",h.strokeStyle="black",h.lineWidth=2,h.lineCap="round";let p=!1,g=0,b=0;function v(t){p=!0,t.touches?(n.style.overflow="hidden",[g,b]=[t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop]):[g,b]=[t.offsetX,t.offsetY]}function C(t){p&&(h.beginPath(),t.touches?(h.moveTo(g,b),h.lineTo(t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop),[g,b]=[t.touches[0].pageX-t.target.offsetLeft,t.touches[0].pageY-t.target.offsetTop]):(h.moveTo(g,b),h.lineTo(t.offsetX,t.offsetY),[g,b]=[t.offsetX,t.offsetY]),h.stroke())}function w(){n.style.overflow="auto",p=!1,h.beginPath()}f.addEventListener("mousedown",v),f.addEventListener("mousemove",C),f.addEventListener("mouseup",w),f.addEventListener("touchstart",v),f.addEventListener("touchmove",C),f.addEventListener("touchend",w);const L=document.createElement("input");L.type="hidden",L.id="signatureInput",L.name="signatureInput";const y=document.createElement("button");y.classList.add("btn-contrato--optional"),y.textContent=a.clear[e],y.onclick=function(){h.clearRect(0,0,f.width,f.height),f.isCanvasBlank=!0,imprimirAlerta("signValidation","error",u),T.classList.add("btn-tabs--disabled")};const E=t.target.id,k=t.target.dataset.u,T=document.createElement("button");T.classList.add("btn-tabs","btn-tabs--disabled"),T.textContent=a.save[e],T.onclick=canvasValidation(f,T,L,E,k),m.appendChild(f),i.appendChild(s),i.appendChild(r),i.appendChild(l),i.appendChild(u),i.appendChild(m),i.appendChild(y),i.appendChild(T),o.appendChild(i),n.appendChild(o)}async function canvasValidation(t,e,a,n,o){t.addEventListener("mouseup",()=>{isCanvasBlank(t)||(e.classList.remove("btn-tabs--disabled"),a=t.toDataURL(),e.addEventListener("click",()=>{loader(e),enviarImagen(a,n,o)}))})}function isCanvasBlank(t){const e=t.getContext("2d");return!new Uint32Array(e.getImageData(0,0,t.width,t.height).data.buffer).some(t=>0!==t)}async function enviarImagen(t,e,a){const n=new FormData;n.append("hiddenInput",t),n.append("tipo",e),n.append("usuario",a);try{const t=window.location.origin+"/api/filmtono/signature",e=await fetch(t,{method:"POST",body:n});(await e.json()).resultado&&window.location.reload()}catch(t){console.error("Error:",t)}}function cerrarModal(){const t=document.querySelector("body"),e=document.querySelector(".register");t.classList.remove("overlay"),e.remove()}
//# sourceMappingURL=contracts.js.map