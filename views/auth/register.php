<div class="container">
    <h1>
        {% <?php echo $titulo;?> %}
    </h1>

    <?php if(isset($_SESSION['id'])): ?>
        
        <p class="auth__text">{%auth_already_registered%}</p>
        <div class="auth">
            <i class="auth__icon--fail fa-regular fa-circle-xmark"></i>
            <a class="btn-submit" href="<?php sesionActiva()?>">{%auth_back_admin_btn%}</a>
        </div>
    <?php else: ?>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <div class="form-div">
        <form class="form" method="POST" action="/register">
            <div class="form__group">
                <input type="hidden" name="id_nivel" value="4">

                <label class="form__group__label" for="tipo">{%auth_register_music_purpose_label%}</label>
                <select class="form__group__select" name="id_compra" id="tipo">
                    <option selected disabled>
                        {%auth_register_select_default%}
                    </option>
                    <?php foreach($comprador as $tipo): ?>
                        <option value="<?php echo $tipo->id;?>"><?php echo $lang =='en' ? $tipo->tipo_en : $tipo->tipo_es ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">{%auth_register_name_label%}</label>
                <input class="form__group__input" type="text" name="nombre" id="nombre" placeholder="{%auth_register_name_label%}">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="nombre">{%auth_register_lastname_label%}</label>
                <input class="form__group__input" type="text" name="apellido" id="apellido" placeholder="{%auth_register_lastname_label%}">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="email">{%auth_register_email_label%}</label>
                <input class="form__group__input" type="email" name="email" id="email" placeholder="{%auth_register_email_label%}">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="password">{%auth_register_password_label%}</label>
                <input class="form__group__input" type="password" name="password" id="password" placeholder="{%auth_register_password_label%}">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="password2">{%auth_register_password_confirmation_label%}</label>
                <input class="form__group__input" type="password" name="password2" id="password2" placeholder="{%auth_register_password_confirmation_label%}">
            </div>

            <input class="btn-submit" type="submit" value="{%auth_register_btn%}">
        </form>
    </div>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">{%auth_register_already_account%}</a><a href="/forgot-password" class="acciones__enlace">{%auth_register_forgot_password%}</a>
    </div>
    
    <?php endif; ?>
</div>