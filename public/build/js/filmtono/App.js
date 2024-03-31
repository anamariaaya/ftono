import{artistaSecundario,artistasInput,btnAgregar,contratosContainer,gridUsuarios,portada,promoInput}from"./selectores.js";import{chooseLang}from"../UI/language.js";import{styleDatalist,styleFileInput,artistasSecundarios,addArtist}from"./artistas.js";import{readFileName}from"./ux.js";import{consultaContratos}from"./contratos.js";import{consultaUsuarios}from"./users.js";import{changeTabs,eliminarItem}from"../base/funciones.js";import{btnEliminar,tabsDiv}from"../base/selectores.js";import{countryValue}from"../music/APIPaises.js";import{paisValue}from"../music/selectores.js";class App{constructor(){this.initApp()}initApp(){chooseLang&&chooseLang(),artistasInput&&styleDatalist(),portada&&styleFileInput(),artistaSecundario&&artistasSecundarios(),btnAgregar&&addArtist(),promoInput&&readFileName(),contratosContainer&&consultaContratos(),gridUsuarios&&consultaUsuarios(),btnEliminar&&btnEliminar.forEach(t=>{t.addEventListener("click",eliminarItem)}),paisValue&&countryValue(),tabsDiv&&changeTabs()}}export default App;
//# sourceMappingURL=App.js.map
