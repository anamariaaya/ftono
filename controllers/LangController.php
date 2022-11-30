<?php

// Leer el archivo JSON
$content = file_get_contents('../lang.json');

// Decodificar el JSON
$json = json_decode($content, true);

//Obtener el valor de la clave
echo $json['language']['es'];

//traer cada idioma como un objeto
$es = $json['language']['es'];
$en = $json['language']['en'];

//convertir $en en un objeto
$en = (object) $en;

debuguear($en);
