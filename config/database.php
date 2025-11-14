<?php

## Clase para manejar la conexión a la base de datos utilizando PDO
class Database {

    ## Propiedad estática para almacenar la instancia de la conexión
    private static $instance = null;


    ## Método estático para obtener la conexión a la base de datos se accede con :: (operador de resolución de ámbito)
    public static function getConnection() {

        ## Verifica si la instancia ya ha sido creada (conexión singleton)
        if (self::$instance === null) {
            $host = 'localhost';
            $dbname = 'crud_php';
            $user = 'root';
            $password = '1234';


            ## Intenta establecer la conexión a la base de datos
            try {
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";


                ## Configura las opciones de PDO
                $option = [
                    ## Configura el modo de error para lanzar excepciones
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ## Configura el modo de obtención de resultados por defecto como array asociativo
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ## Desactiva la emulación de consultas preparadas para mayor seguridad
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];


                ## Crea una nueva instancia de PDO para la conexión a la base de datos
                self::$instance = new PDO($dsn, $user, $password, $option);

                ## Maneja cualquier excepción que ocurra durante la conexión
            } catch ( PDOException $e ){
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }

        ## Devuelve la instancia de la conexión a la base de datos
        return self::$instance;
    }
}