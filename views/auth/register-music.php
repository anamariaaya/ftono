<div class="container">
    <h1 class="heading-yellow"><?php echo $titulo; ?></h1>

    <?php if(isset($_SESSION['id'])): ?>
        
        <p class="auth__text">Ya estás registrado</p>
        <div class="auth">
            <i class="auth__icon--fail fa-regular fa-circle-xmark"></i>
            <a class="btn-submit" href="<?php sesionActiva()?>">Volver al Admin</a>
        </div>
    <?php else: ?>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="form-div">
        <form class="form" method="POST" action="/register-music">
            <div class="form__group">
                <label class="form__group__label" for="tipo">¿Qué tipo de usuario eres?</label>
                <select class="form__group__select" name="id_musica" id="tipo">
                    <option selected disabled>--Selecciona</option>
                    <?php foreach($musico as $tipo): ?>
                        <option value="<?php echo $tipo->id; ?>"><?php echo $tipo->tipo; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">Nombre</label>
                <input class="form__group__input" type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">Apellido</label>
                <input class="form__group__input" type="text" name="apellido" id="apellido" placeholder="Tu apellido">
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

            <input class="btn-submit" type="submit" value="Crear cuenta">
        </form>
    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión</a><a href="/olvide-password" class="acciones__enlace">¿Olvidaste tu contraseña?</a>
    </div>

    <?php endif; ?>

</div>

