<h1>{%users_main_title%}</h1>

<div class="dashboard__total">
    <p><span>{%users_total%}: </span>
        <?php echo count($usuarios); ?>
    </p>

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