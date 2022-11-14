<?php

namespace Model;

class Editorial extends ActiveRecord{
    protected static $tabla = 'editorial';
    protected static $columnasDB = ['id', 'empresa', 'id_fiscal', 'direccion', 'ciudad', 'pais', 'instagram', 'nombre_comercial', 'apellido_comercial', 'email_comercial', 'tel_comercial', 'nombre_contable', 'apellido_contable', 'email_contable', 'tel_contable'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->empresa = $args['empresa'] ?? '';
        $this->id_fiscal = $args['id_fiscal'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->instagram = $args['instagram'] ?? '';
        $this->nombre_comercial = $args['nombre_comercial'] ?? '';
        $this->apellido_comercial = $args['apellido_comercial'] ?? '';
        $this->email_comercial = $args['email_comercial'] ?? '';
        $this->tel_comercial = $args['tel_comercial'] ?? '';
        $this->nombre_contable = $args['nombre_contable'] ?? '';
        $this->apellido_contable = $args['apellido_contable'] ?? '';
        $this->email_contable = $args['email_contable'] ?? '';
        $this->tel_contable = $args['tel_contable'] ?? '';
    }

    public function validarRegistro(){
        if(!$this->empresa) {
            self::$alertas['error'][] = 'El Nombre de la Empresa es Obligatorio';
        }
        if(!$this->id_fiscal) {
            self::$alertas['error'][] = 'El ID Fiscal es Obligatorio';
        }
        if(!$this->direccion) {
            self::$alertas['error'][] = 'La Dirección es Obligatoria';
        }
        if(!$this->ciudad) {
            self::$alertas['error'][] = 'La Ciudad es Obligatoria';
        }
        if(!$this->pais) {
            self::$alertas['error'][] = 'El País es Obligatorio';
        }
        if(!$this->nombre_comercial) {
            self::$alertas['error'][] = 'El Nombre del Comercial es Obligatorio';
        }
        if(!$this->apellido_comercial) {
            self::$alertas['error'][] = 'El Apellido del Comercial es Obligatorio';
        }
        if(!$this->email_comercial) {
            self::$alertas['error'][] = 'El Email del Comercial es Obligatorio';
        }
        if(!$this->tel_comercial) {
            self::$alertas['error'][] = 'El Teléfono del Comercial es Obligatorio';
        }
        if(!$this->nombre_contable) {
            self::$alertas['error'][] = 'El Nombre del Contable es Obligatorio';
        }
        if(!$this->apellido_contable) {
            self::$alertas['error'][] = 'El Apellido del Contable es Obligatorio';
        }
        if(!$this->email_contable) {
            self::$alertas['error'][] = 'El Email del Contable es Obligatorio';
        }
        if(!$this->tel_contable) {
            self::$alertas['error'][] = 'El Teléfono del Contable es Obligatorio';
        }
        return self::$alertas;
    }
}