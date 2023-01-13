import{selectLang,divLang,btnLang}from"./selectores.js";export function chooseLang(){divLang.onmouseover=function(){selectLang.classList.remove("no-display")},selectLang.onmouseout=function(){selectLang.classList.add("no-display")},btnLang.forEach(n=>{n.addEventListener("click",n=>{const e=n.target.value;window.location="?lang="+e})})}
//# sourceMappingURL=language.js.map
