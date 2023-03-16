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
        $this->empresa = $args['empresa'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->idFiscal = $args['idFiscal'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->firma = $args['firma'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';

        // $this->empresa = $empresa;
        // $this->nombre = $nombre;
        // $this->idFiscal = $idFiscal;
        // $this->direccion = $direccion;
        // $this->firma = $firma;
        // $this->pais = $pais;
        // $this->telefono = $telefono;
        // $this->email = $email;
        // $this->fecha = $fecha;
    }

    public function guardarContrato(){
        if($_SESSION['lang'] == 'en'){
            $contract = file_get_contents(__DIR__.'/../views/contracts/c-musical-en.php');
        }else{
            $contract = file_get_contents(__DIR__.'/../views/contracts/c-musical.php');
        }
        
        $mpdf = new \Mpdf\Mpdf();        
        $mpdf->WriteHTML($contract);
        $mpdf->Output();
    }
}