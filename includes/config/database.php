<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root' , '' , 'bienesraices_crud');

    if (!$db) {
        echo "Error no se pudo conectar";

        exit;
    } 
    return $db;
}