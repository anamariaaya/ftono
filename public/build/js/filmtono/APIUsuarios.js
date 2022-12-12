import{mostrarUsuarios}from"./users.js";export async function consultaUsuarios(){try{const o=await fetch("http://localhost:3000/api/filmtono/users"),s=await o.json();mostrarUsuarios(s)}catch(o){console.log(o)}}
//# sourceMappingURL=APIUsuarios.js.map
