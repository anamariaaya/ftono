<?php

namespace Model;

class NTCompra extends ActiveRecord{
    protected static $tabla = 'n_t_compra';
    protected static $columnasDB = ['id', 'id_usuario', 'id_nivel', 'id_compra'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? '';
        $this->id_nivel = $args['id_nivel'] ?? '';
        $this->id_compra = $args['id_compra'] ?? '';
    }

    public function validar_tipo() {
        if(!$this->id_compra) {
            self::$alertas['error'][] = 'auth_alert_must_select_type_client';
        }
        return self::$alertas;
    }
}
