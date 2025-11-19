<?php

## Se incluye el archivo de configuración de la base de datos
require_once __DIR__ . '/../core/Model.php';

## La clase usuario extiende de la clase MODEL (La clase madre de todos los modelos)
class Usuario extends Model {

    ## Nombre de la tabla en la base de datos ( protegida para uso interno )
    protected $table = 'usuarios';


    ## Método para obtener todos los usuarios
    public function getAllUsers() {

        try {
            $stmt = $this->db->prepare("Select * FROM {$this->table}"); // Preparar la consulta SQL
            $stmt->execute();
            ## No se agrega FETCH_ASSOC porque ya está definido en la configuración de la base de datos (Database.php)
            return $stmt->fetchAll(); // Ejecutar la consulta y obtener todos los resultados
        
        ## $stmt es la variable que almacena la consulta preparada
        ## $this->db es la conexión a la base de datos heredada de la clase Model ()
        ## ->prepare() es un método de PDO para preparar una consulta SQL
        ## ( "Select * FROM {$this->table}" ) es la consulta SQL para seleccionar todos los registros de la tabla usuarios
        ## ->execute() ejecuta la consulta preparada
        ## ->fetchAll() obtiene todos los resultados de la consulta como un array asociativo
        } catch (PDOException $e) {
            die("Error al obtener los usuarios: " . $e->getMessage());
        }
    }


    ## Método para crear un nuevo usuario pasandole el nombre y email como parámetros
    public function createUser($nombre, $email) {
        try {
            
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} (nombre, email) VALUES (:nombre, :email)"); // Consulta SQL para insertar un nuevo usuario
            
            ## Vincula los parámetros y ejecuta la consulta
            ## :nombre y :email son marcadores de posición en la consulta SQL
            ## bindParam( 'referencia' , 'valor recibido en la función') vincula los valores reales a estos marcadores

            $stmt->bindParam(':nombre', $nombre); // (:) Vincula los parametros a los valores de forma segura evita inyecciones SQL
            $stmt->bindParam(':email', $email); // (:) Vincula los parametros a los valores de forma segura evita inyecciones SQL
            return $stmt->execute(); // Ejecuta la consulta y retorna el resultado (true o false) 
        } catch (PDOException $e) {
            die("Error al crear el usuario: " . $e->getMessage());
        }
    }

    ## Método para eliminar un usuario por su ID
    public function delete($id) {

        try {
            ## Prepara y ejecuta la consulta SQL para eliminar el usuario por su ID 
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();    // Ejecuta la consulta y retorna el resultado (true o false)
        } catch (PDOException $e) {
            die("Error al eliminar el usuario: " . $e->getMessage());
        }
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, $nombre, $email) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET nombre = :nombre, email = :email
            WHERE id = :id
        ");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

}