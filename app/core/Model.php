<?php

## Se incluye el archivo de configuración de la base de datos
require_once __DIR__ . '/../config/database.php';

## La clase MODEL es la clase madre de todos los modelos
class Model {

    ## Se define la propiedad protegida $db para la conexion a la base de datos
    protected $db;


    ## Constructor para inicializar la conexión a la base de datos
    public function __construct() {

        ## Se establece la conexión a la base de datos utilizando la clase Database
        ## (::) es el operador de resolución de ámbito para acceder a métodos estáticos
        $this->db = Database::getConnection();
    }
}