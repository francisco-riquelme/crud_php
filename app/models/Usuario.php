<?php

## Se incluye el archivo de configuración de la base de datos
require_once __DIR__ . '/../core/Model.php';

## La clase usuario extiende de la clase MODEL (La clase madre de todos los modelos)
class Usuario extends Model {

    ## Nombre de la tabla en la base de datos ( protegida para uso interno )
    protected string $table = 'usuarios';


    ## Método para obtener todos los usuarios
    public function all(): array {

        try {
            return $this->query("SELECT * FROM {$this->table}")->fetchAll(); // Retorna todos los usuarios como un array asociativo
        } catch (PDOException $e) {
            die("Error al obtener los usuarios: " . $e->getMessage());
        }
    }


    ## Método para crear un nuevo usuario pasandole el nombre y email como parámetros
    public function create(string $nombre, string $email): bool {
        try {
            
            ## Prepara la consulta SQL para insertar un nuevo usuario
            $sql = "INSERT INTO {$this->table} (nombre, email) VALUES (?, ?)";
            return $this->query($sql, [$nombre, $email])->rowCount() > 0;
            
        } catch (PDOException $e) {
            die("Error al crear el usuario: " . $e->getMessage());
        }
    }

    ## Método para eliminar un usuario por su ID
    public function delete(int $id): bool {

        try {
            $sql = "DELETE FROM {$this->table} WHERE id = ?";
            return $this->query($sql, [$id])->rowCount() > 0;
        } catch (PDOException $e) {
            die("Error al eliminar el usuario: " . $e->getMessage());
        }
    }

    ## Método para obtener un usuario por su ID
    public function find(int $id): ?array {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id = ?";
            $stmt = $this->query($sql, [$id]);
            $user = $stmt->fetch();
            return $user ? $user : null;
        } catch (PDOException $e) {
            die("Error al obtener el usuario: " . $e->getMessage());
        }
    }

    ## Método para actualizar un usuario por su ID
    public function update(int $id, string $nombre, string $email): bool {
        try {
            $sql = "UPDATE {$this->table} SET nombre = ?, email = ? WHERE id = ?";
            return $this->query($sql, [$nombre, $email, $id])->rowCount() > 0;
        } catch (PDOException $e) {
            die("Error al actualizar el usuario: " . $e->getMessage());
        }
    }

}