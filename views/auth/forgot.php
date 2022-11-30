<main class="container">
    <div class="auth">
        <h1><?php echo $titulo; ?></h1>
        <p>Te enviaremos un correo para recuperar tu contraseña</p>

        <?php
            require_once __DIR__ . '/../templates/alertas.php';
        ?>

        <form method="POST" action="/forgot-password" class="form--max">
            <div class="form__group">
                <label for="email" class="form__group__label">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form__group__input"
                    placeholder="Tu Email"
                />
            </div>

            <input type="submit" value="Enviar Instrucciones" class="btn-submit" />
        </form>

        <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia sesión</a>
            <a href="/registro" class="acciones__enlace">Crea una Cuenta</a>        
        </div>
    </div>
</main>