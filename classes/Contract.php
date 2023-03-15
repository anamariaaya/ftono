<?php

namespace Classes;

class MusicalContract{
    public $empresa;
    public $nombre;
    public $idFiscal;
    public $direccion;
    public $firma;
    public $pais;
    public $telefono;
    public $email;
    public $fecha;

    public function __construct($empresa, $nombre, $idFiscal, $direccion, $firma, $pais, $telefono, $email, $fecha){
        $this->empresa = $empresa;
        $this->nombre = $nombre;
        $this->idFiscal = $idFiscal;
        $this->direccion = $direccion;
        $this->firma = $firma;
        $this->pais = $pais;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->fecha = $fecha;
    }

    public function guardarContrato(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('Hello World from mPDF');
        $mpdf->Output();
    }
}