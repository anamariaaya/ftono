<?php

namespace Model;

class Featured extends ActiveRecord{
    protected static $tabla = 'featured';
    protected static $columnasDB = ['videoId', 'title'];

    public function __construct($args = [])
    {
        $this->videoId = $args['videoId'] ?? '';
        $this->title = $args['title'] ?? '';
    }
}