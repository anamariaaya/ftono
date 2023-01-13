import{btnEliminarCuenta,btnEliminarUsuario}from"./selectores.js";import{eliminarCuenta}from"./profile.js";import{consultaUsuarios}from"./APIUsuarios.js";class App{constructor(){this.initApp()}initApp(){btnEliminarCuenta&&eliminarCuenta(),consultaUsuarios()}}export default App;
//# sourceMappingURL=App.js.map
