<main class="auth">
    <h1 class="auth__heading">{%<?php echo $titulo; ?>%}</h1>
    <p>{%auth_reset-password_paragraph%}</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if($token_valido){ ?>
        <form method="POST" class="form--max">
            <div class="form__group">
                <label for="password" class="form__group__label">{%auth_reset-password_password_label%}</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form__group__input"
                    placeholder="{%auth_reset-password_password_label%}"
                />
                <label for="password2" class="form__group__label">{%auth_reset-password_password_confirmation_label%}</label>
                <input
                    type="password2"
                    name="password2"
                    id="password2"
                    class="form__group__input"
                    placeholder="{%auth_reset-password_password_confirmation_label%}"
                />
            </div>

            <input type="submit" value="{%auth_reset-password_btn%}" class="btn-submit" />
        </form>
    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">{%auth_register_already_account%}</a>
        <a href="/register" class="acciones__enlace">{%auth_login_not_account%}</a>        
    </div>
</main>