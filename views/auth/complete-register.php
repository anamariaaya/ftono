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
                    <label class="form--registro__group__label" for="tel">
                        <i class="fa-solid fa-mobile-screen form--registro__group__icon"></i>
                        Teléfono*
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="tel"
                            id="tel"
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
                        Nombre de la Empresa
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
                        Identificación Fiscal
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="id_fiscal"
                            id="id_fiscal"
                            placeholder="Nº de identificación fiscal"
                            value=""
                    >
                </div>

                <div class="form--registro__group">
                    <label class="form--registro__group__label" for="país">
                        <i class="fa-solid fa-earth-americas form--registro__group__icon"></i>
                        País
                    </label>
                    <select class="form--registro__group__select" name="pais" id="pais">
                        <option selected disabled value="0">Selecciona un país</option>
                    </select>
                </div>

                <div class="form--registro__group">
                    <label class="form--registro__group__label" for="direccion">
                        <i class="fa-solid fa-location-dot form--registro__group__icon"></i>
                        Dirección
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
                    <label class="form--registro__group__label" for="compras-nombre">
                        <i class="fa-solid fa-user-plus form--registro__group__icon"></i>
                        Nombre
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="compras-nombre"
                            id="compras-nombre"
                            placeholder="Nombre"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="compras-apellido">
                        <i class="fa-solid fa-user-plus form--registro__group__icon"></i>
                        Apellido
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="compras-apellido"
                            id="compras-apellido"
                            placeholder="Apellido"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="compras-email">
                        <i class="fa-solid fa-at form--registro__group__icon"></i>
                        Email de compras
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="compras-email"
                            id="compras-email"
                            placeholder="Email de compras"
                            value=""
                    >
                </div>
                <div class="form--registro_group">
                    <label class="form--registro__group__label" for="compras-tel">
                        <i class="fa-solid fa-mobile-screen form--registro__group__icon"></i>
                        Teléfono de compras
                    </label>
                    <input class="form--registro__group__input" type="text"
                            name="compras-tel"
                            id="compras-tel"
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
                <p>Firma el contrato de uso de la plataforma</p>
                <button type="button" class="btn-tabs" id="btn-contrato">Leer y Firmar el contrato</button>
            <?php endif; ?>            
            
            <p>Aceptación de términos, privacidad y confirmación de comunicaciones</p>
            <div class="form">
                <div class="form--registro__checkbox">
                    
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="terminos"
                            id="terminos"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="terminos">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto los <a href="/terms-conditions">términos y condiciones *</a>
                    </label>
                </div>
                <div class="form--registro__checkbox">
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="privacidad"
                            id="privacidad"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="privacidad">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto la <a href="/privacy-policy">Política de privacidad *</a>
                    </label>
                </div>
                <div class="form--registro__checkbox">
                    
                    <input class="form--registro__checkbox__input" type="checkbox"
                            name="comunicaciones"
                            id="comunicaciones"
                            value="1"
                    >
                    <label class="form--registro__checkbox__label" for="comunicaciones">
                        <i class="fa-regular fa-file-lines form--registro__group__icon"></i>
                        Acepto recibir comunicaciones por parte de Filmtono
                    </label>
                </div>
            </div>
        </div>

        <div class="tabs__pags">
            <button type="button" id="anterior" class="btn-tabs ocultar">&laquo; Anterior</button>
            <button type="button" id="siguiente" class="btn-tabs">Siguiente &raquo;</button>
        </div>
    </form>
</div>
