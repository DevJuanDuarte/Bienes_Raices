<?php

namespace App;

class Propiedad {


    //Errores:
    protected static $errores = [];

    //Base de datos:
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion','habitaciones' , 'wc' , 'estacionamiento' , 'creado' , 'vendedorId'];
    

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;


    //Definir la conexión a la base de datos:
    public static function setDB ($database) {
        self::$db = $database;
    }


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }


    public function guardar()
    {

        //Sanitizar los atributos antes de insertar:
        $atributos = $this->sanitizarAtributos();


        //Insertar en la base de datos:
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        debuguear($resultado);
    }

    //Identificar y unir los atributos de la BD
    //Iterar sobre columnasDB
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos () {
        //Obtenemos los atributos
        $atributos = $this->atributos();
        $sanitizado = [];
        //Los recorremos y vamos sanitizando cada uno de ellos
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado; 

    }

    //Validación: Función para leer errores, inicia con un arreglo vacío para que no nos marque que no está definido.
    public static function getErrors () {
        return self::$errores;
    }

    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
    
        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }
    
        if (strlen($this->descripcion) <= 50) {
            self::$errores[] = "Debes añadir una descripcion y debe tener al menos 50 caracteres";
        }
    
        if (!$this->habitaciones) {
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
    
        if (!$this->wc) {
            self::$errores[] = "El numero de baños es obligatorio";
        }
    
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir un numero de lugares deestacionamiento";
        }
    
        if (!$this->vendedorId) {
            self::$errores[] = "Debes añadir un vendedor";
        }


        // if (!$this->imagen['name'] || $this->imagen['error']) {
        //     $errores[] = 'La imagen es obligatoria';
        // }

        // //Validar por tamaño en (1mb máximo):
        // $medida = 1000 * 1000;

        // if ($this->imagen['size'] > $medida) {
        //     $errores[] = 'La imagen es muy pesada';
        // }


        return self::$errores;
    }

    
}
