<?php

## Se incluye el archivo de configuración de la base de datos
require_once __DIR__ . '/../../config/database.php';

## La clase MODEL es la clase madre de todos los modelos
class Model {

    ## Se define la propiedad protegida $db para la conexion a la base de datos
    protected PDO $db;


    ## Constructor para inicializar la conexión a la base de datos
    public function __construct() {

       ## Inicializa la conexión a la base de datos utilizando la clase Database
        $this->db = ( new Database() )->connect(); // Llama al método connect() de la clase Database

    }

    protected function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}