import{consultaPaises,indicativoTel,paisElegido}from"./APIPaises.js";import{tabs,paginador,formularioReg}from"./perfiles.js";import{selectPais,afterNav,paisContacto,albumsBlock,singlesBlock}from"./selectores.js";import{chooseLang}from"../UI/language.js";import{musicTabs}from"./MusicTabs.js";class App{constructor(){this.initApp()}initApp(){chooseLang&&chooseLang(),selectPais&&(consultaPaises(),paisElegido()),paisContacto&&indicativoTel(),afterNav&&(tabs(),paginador(),formularioReg()),albumsBlock&&singlesBlock&&musicTabs()}}export default App;
//# sourceMappingURL=App.js.map
