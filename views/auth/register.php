<div class="container">
    <h1><?php echo $titulo; ?></h1>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="form-div">
        <form class="form" method="POST" action="/register">
            <div class="form__group">
                <label class="form__group__label" for="tipo">¿Qué tipo de usuario eres?</label>
                <select class="form__group__select" name="tipo" id="tipo">
                    <option value="producer">Producer / Music Supervisor</option>
                    <option value="aggregator">Music Aggregator</option>
                </select>
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">Nombre</label>
                <input class="form__group__input" type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">Apellido</label>
                <input class="form__group__input" type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="email">Email</label>
                <input class="form__group__input" type="email" name="email" id="email" placeholder="Tu email">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="password">Password</label>
                <input class="form__group__input" type="password" name="password" id="password" placeholder="Tu password">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="password2">Repetir Password</label>
                <input class="form__group__input" type="password" name="password2" id="password2" placeholder="Repite tu password">
            </div>

            <input class="btn-submit" type="submit" value="Iniciar Sesión">
        </form>
    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión</a><a href="/olvide-password" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</div>