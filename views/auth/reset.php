<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p>Elige tu nueva contraseña</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if($token_valido){ ?>
        <form method="POST" class="form--max">
            <div class="form__group">
                <label for="password" class="form__group__label">Nuevo Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form__group__input"
                    placeholder="Tu nuevo password"
                />
            </div>

            <input type="submit" value="Guardar Password" class="btn-submit" />
        </form>
    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia sesión</a>
        <a href="/registro" class="acciones__enlace">Crea una Cuenta</a>        
    </div>
</main>