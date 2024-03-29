<h1><?php echo $titulo; ?></h1>

<div class="dashboard__total">
    <p><span>Total de usuarios: </span> </p>

    <div class="dashboard__filters">
        <i class="fas fa-users"></i>
        <p>Filtrar usuarios por rol:</p>
        <select name="dashboard_select" id="filtro-usuarios">
            <option selected disabled>-- Selecciona &darr;</option>
            <option value="">Todos</option>
            <option value="1">Administrador</option>
            <option value="2">Cliente</option>
        </select>
    </div>

    <div class="dashboard__search">
        <input class="dashboard__total__type-search" type="text" id="usuario-search" placeholder="Search user by name or email"/>
    </div>
</div>

<a href="/filmtono/users/new" class="btn-submit">
    <i class="fa-solid fa-plus"></i>
    Crear Usuario
</a>

<h3 class="dashboard__subtitle--filter"></h3>

<div class="cards">
    <div class="cards__container" id="grid-usuarios">
    </div>
</div>