import{artistaSecundario,artistasInput,btnAgregar,btnEliminarCuenta,btnEliminarUsuario,portada,promoInput}from"./selectores.js";import{eliminarCuenta}from"./profile.js";import{chooseLang}from"../UI/language.js";import{styleDatalist,styleFileInput,artistasSecundarios,addArtist}from"./artistas.js";import{readFileName}from"./ux.js";import{consultaContratos}from"./contratos.js";class App{constructor(){this.initApp()}initApp(){chooseLang&&chooseLang(),btnEliminarCuenta&&eliminarCuenta(),artistasInput&&styleDatalist(),portada&&styleFileInput(),artistaSecundario&&artistasSecundarios(),btnAgregar&&addArtist(),promoInput&&readFileName(),consultaContratos()}}export default App;
//# sourceMappingURL=App.js.map
