<?php

namespace Classes;

use Mpdf\Mpdf;

class ArtisticContract{
    public $id_usuario;
    public $empresa;
    public $nombre;
    public $id_fiscal;
    public $firmaOpt;
    public $pais;
    public $telefono;
    public $email;
    public $fecha;

    public function __construct($id_usuario, $empresa, $nombre, $id_fiscal,  $firmaOpt, $pais, $telefono, $email, $fecha){
        $this->id_usuario = $id_usuario;
        $this->empresa = $empresa;
        $this->nombre = $nombre;
        $this->id_fiscal = $id_fiscal;
        $this->firmaOpt = $firmaOpt;
        $this->pais = $pais;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->fecha = date('d-m-y');
    }

    public function guardarContrato(){
        $contract = '<html>
        </head>
            <style>
                .contrato h1{
                    text-align: center;
                    margin: 50px auto;
                }
                .contrato h2{
                    text-align: center;
                    margin: 35px auto;
                }
                .contrato h3{
                    text-align: left;
                    margin: 30px auto;
                }
                .contrato p{
                    text-align: justify;
                    line-height: 1.5;
                }
                .grid-firmas{
                    width: 50%
                    margin: 35px auto;
                    margin: 35px;
                }
                .grid-firmas__campo{
                    border: 2px solid #000;
                    margin: 7px;
                }
                .grid-firmas__campo p{
                    break-inside: avoid;
                    padding: 5px;
                }
                .grid-firmas__campo--span{
                    break-inside: avoid;
                    font-weight: bold;
                }
                .no-display{
                    display: none;
                }
            </style>
        </head>
        </body>';

        if($_SESSION['lang'] == 'en'){
            $contract .= file_get_contents(__DIR__.'/../views/contracts/c-artistico-en.php');
        }else{
            $contract .= file_get_contents(__DIR__.'/../views/contracts/c-artistico.php');
        }

        $contract .= '<div class="grid-firmas">
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span" >Authorized representative</p>
                            <p id="contract-empresa">'.$this->empresa.'</p>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Main Contact</p>
                            <p id="contract-nombre">'.$this->nombre.'</p>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Tax ID</p>
                            <p id="contract-id-fiscal">'.$this->id_fiscal.'</p>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Signature</p>
                            <img id="signature-img" width="350" src="'.$this->firmaOpt.'" alt="signature"/>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Country</p>
                            <p id="contract-pais">'.$this->pais.'</p>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Phone</p>
                            <p id="contract-telefono">'.$this->telefono.'</p>
                        </div>
                        <div class="grid-firmas__campo">
                            <p class="grid-firmas__campo--span">Email</p>
                            <p id="contract-email">'.$this->email.`</p>
                        </div>
                    </div>`;
        $contract .= '</body>
        </html>';
        
        //$mpdf = new \Mpdf\Mpdf();
        $mpdf = new \Mpdf\Mpdf(['contracts' => '../public/contracts/']);  
        $mpdf->WriteHTML($contract);
        $mpdf->OutputFile('../public/contracts/'.$this->id_usuario.'-artistic-'.date('d-m-y').'.pdf');
    }
}