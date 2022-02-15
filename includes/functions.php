<?php

require 'app.php';

function includeTemplate( string $name, bool $inicio = false ){
    include TEMPLATES_URL."/${name}.php";
}