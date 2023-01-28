<?php

namespace Model;

class Empresa extends ActiveRecord{
    protected static $tabla = 'empresa';
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
}