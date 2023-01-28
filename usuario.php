<?php

//ADVERTENCIA: En el momento en el que se crea el primer usuario con el password hasheado
//SE DEBE ELIMINAR EL ARCHIVO.

//Importar la conexión:
require 'includes/config/database.php';
$db = conectarDB();


//Crear email y password:
$email = "ejemplo@ejemplo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);


//Query para crear el usuario:
$query = " INSERT INTO usuarios (email,password) VALUES ('{$email}', '{$passwordHash}') ";

// echo $query;



//Agregarlo a la base de datos:
mysqli_query($db,$query);