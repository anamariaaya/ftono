<main class="container">
    <h1><?php echo $titulo; ?></h1>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="form-div">
        <form class="form" method="POST" action="/login">

            <div class="form__group">
                <label class="form__group__label" for="email">Email</label>
                <input class="form__group__input" type="email" name="email" id="email" placeholder="Tu email">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="password">Password</label>
                <input class="form__group__input" type="password" name="password" id="password" placeholder="Tu password">
            </div>

            <input class="btn-submit" type="submit" value="Iniciar Sesión">
        </form>
    </div>

    <div class="acciones">
        <a href="/register" class="acciones__enlace">¿No tienes cuenta? Regístrate</a><a href="/olvide-password" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>
</main>