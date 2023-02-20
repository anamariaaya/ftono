<h1><?php echo $titulo; ?></h1>

<p></p>

<div id="tabs" class="tabs">
    <nav class="tabs__nav">
        <div class="tabs__nav__line"></div>
        <button type="button" data-paso="1" class="tab__button active">1</button>
        <button type="button" data-paso="2" class="tab__button">2</button>
        <button type="button" data-paso="3" class="tab__button">3</button>
    </nav>
    <p class="form__info">Los campos marcados con * son obligatorios</p>

    <form method="POST">
        <div id="paso-1" class="tabs__section mostrar">
            <h3>1. Datos personales</h3>
            <p>Completa tus datos</p>
            <div class="form--registro">
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="nombre">
                        <i class="fa-solid fa-user-check form--registro__group__icon"></i>
                        Nombre
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="nombre"
                            value="<?php echo $usuario->nombre.' '.$usuario->apellido; ?>"
                            disabled
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="email">
                        <i class="fa-solid fa-envelope-circle-check form--registro__group__icon"></i>
                        Email
                    </label>
                    <input class="form--registro__group__input" type="email"
                            name="email"
                            value="<?php echo $usuario->email; ?>"
                            disabled
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="cargo">
                        <i class="fa-solid fa-briefcase form--registro__group__icon"></i>
                        Cargo*
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="cargo"
                            id="cargo"
                            placeholder="Tu cargo"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="tel_contacto">
                        <i class="fa-solid fa-mobile-screen form--registro__group__icon"></i>
                        Teléfono*
                    </label>
                    <input class="form--registro__group__input" type="tel"
                            name="tel_contacto"
                            id="tel_contacto"
                            placeholder="Tu teléfono"
                            value=""
                    >
                </div>
            </div>
        </div>

        <div id ="paso-2" class="tabs__section">
            <h3>2. Sobre la empresa</h3>
            <p>Datos de la empresa</p>
            <div class="form--registro">
                <div class="form--registro__group">             
                    <label class="form--registro__group__label" for="empresa">
                        <i class="fa-regular fa-building form--registro__group__icon"></i>
                        Nombre de la Empresa *
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="empresa"
                            id="empresa"
                            placeholder="Empresa"
                            value=""
                    >
                </div>

                <div class="form--registro__group">
                    <label class="form--registro__group__label" for="id_fiscal">
                        <i class="fa-solid fa-landmark form--registro__group__icon"></i>
                        Identificación Fiscal *
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="id_fiscal"
                            id="id_fiscal"
                            placeholder="Nº de identificación fiscal"
                            value=""
                    >
                </div>

                <div class="form--registro__group">
                    <label class="form--registro__group__label" for="pais">
                        <i class="fa-solid fa-earth-americas form--registro__group__icon"></i>
                        País *
                    </label>
                    <select class="form--registro__group__select" name="pais" id="pais">
                        <option selected disabled value="0">Selecciona un país</option>
                    </select>
                </div>

                <div class="form--registro__group">
                    <label class="form--registro__group__label" for="direccion">
                        <i class="fa-solid fa-location-dot form--registro__group__icon"></i>
                        Dirección *
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="direccion"
                            id="direccion"
                            placeholder="Escribe la dirección"
                            value=""
                    >
                </div>
            </div>

            <p>Datos del contacto de compras</p>
            <div class="form--registro">            
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="nombre_compras">
                        <i class="fa-solid fa-user-plus form--registro__group__icon"></i>
                        Nombre
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="nombre_compras"
                            id="nombre_compras"
                            placeholder="Nombre"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="apellido_compras">
                        <i class="fa-solid fa-user-plus form--registro__group__icon"></i>
                        Apellido
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="apellido_compras"
                            id="apellido_compras"
                            placeholder="Apellido"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="email_compras">
                        <i class="fa-solid fa-at form--registro__group__icon"></i>
                        Email de compras
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="email_compras"
                            id="email_compras"
                            placeholder="Email de compras"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="tel_compras">
                        <i class="fa-solid fa-mobile-screen form--registro__group__icon"></i>
                        Teléfono de compras
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="tel_compras"
                            id="tel_compras"
                            placeholder="Teléfono de compras"
                            value=""
                    >
                </div>
            </div>
        </div>

        <div id="paso-3" class="tabs__section">
            <?php if(isset($_SESSION['nivel_compra'])): ?>
                <h3>3. Autorizaciones</h3>
                <?php elseif(isset($_SESSION['nivel_musica'])): ?>
                <h3>3. Firmas y autorizaciones</h3>
                <div class="tabs__auth">
                    <div class="tabs__auth__bloque">
                        <p>Firma el contrato de proveedor musical *</p>
                        <button type="button" class="btn-tabs btn-contrato" id="contrato-musical">Leer y Firmar</button>
                    </div>
                    <div class="tabs__auth__bloque">
                        <p>Firma el contrato de proveedor artístico</p>
                        <button type="button" class="btn-tabs btn-contrato" id="contrato-artisitico">Leer y Firmar</button>
                    </div>
                </div>
            <?php endif; ?>            
            
            <p>Aceptación de términos, privacidad y confirmación de comunicaciones</p>
            <div class="form" id="div-check">
                <div class="form--registro__checkbox">
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="terms"
                            id="terms"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="terms">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto los <a href="/terms-conditions">términos y condiciones *</a>
                    </label>
                </div>
                <div class="form--registro__checkbox">
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="privacy"
                            id="privacy"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="privacy">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto la <a href="/privacy-policy">Política de privacidad *</a>
                    </label>
                </div>
                <div class="form--registro__checkbox">
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="comunicados"
                            id="comunicados"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="comunicados">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto recibir comunicaciones por parte de Filmtono
                    </label>
                </div>
            </div>
        </div>

        <div class="tabs__pags">
            <button type="button" id="anterior" class="btn-tabs ocultar">&#129044; Anterior</button>
            <button type="button" id="siguiente" class="btn-tabs">Siguiente &#10143;</button>
        </div>
    </form>
</div>
