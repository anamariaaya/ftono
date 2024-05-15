<div class="container">
    
     <h1>
        {% <?php echo $titulo;?> %}
    </h1>

    <p class="center">{%login_purchase-title%}</p>

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
            <input type="hidden" name="id_nivel" value="4">

            <div class="form__group">
                <label class="form__group__label" for="nombre">{%auth_register_name_label%}</label>
                <input class="form__group__input" type="text" name="nombre" id="nombre" placeholder="{%auth_register_name_label%}" value="<?php echo s($contacto->nombre); ?>">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="apellido">{%auth_register_lastname_label%}</label>
                <input class="form__group__input" type="text" name="apellido" id="apellido" placeholder="{%auth_register_lastname_label%}" value="<?php echo s($contacto->apellido); ?>">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="email">{%auth_register_email_label%}</label>
                <input class="form__group__input" type="email" name="email" id="email" placeholder="{%auth_register_email_label%}" value="<?php echo s($contacto->email); ?>">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="pais">{%auth_register_country_label%}</label>
                <input class="form__group__input" type="text" name="pais" id="pais" placeholder="{%auth_register_country_label%}" value="<?php echo s($contacto->pais); ?>">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="telefono">{%auth_register_phone_label%}</label>
                <input class="form__group__input" type="text" name="telefono" id="telefono" placeholder="{%auth_register_phone_label%}" value="<?php echo s($contacto->telefono); ?>">
            </div>

            <div class="form__group">
                <label class="form__group__label" for="presupuesto">{%auth_register_budget_label%}</label>
                <input class="form__group__input" type="text" name="presupuesto" id="presupuesto" placeholder="{%auth_register_budget_placeholder%}" value="<?php echo s($contacto->presupuesto); ?>">
            </div>


            <div class="form__group">
                <p class="texto--password">{%auth_register_message_paragraph%}</p>
                <label class="form__group__label" for="mensaje">{%auth_register_message_label%}</label>
                <textarea class="form__group__textarea" name="mensaje" id="mensaje" placeholder="{%auth_register_message_placeholder%}"></textarea>
            </div>

            <input class="btn-submit" type="submit" value="{%auth_register_message_btn%}">
        </form>
    </div>
    
    <?php endif; ?>
</div> 