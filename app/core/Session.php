<?php

// Se crea la clase Session para manejar mensajes flash en la sesión
class Session {

    // Método estático para establecer o obtener un mensaje flash
    public static function flash(string $name, string $message = null ): ?string {

        // Si se proporciona un mensaje, se guarda en la sesión
        if ($message !== null) {
            $_SESSION[$name] = $message;
            return null;
        }


        // Si no se proporciona un mensaje, se obtiene y elimina de la sesión
        if (isset($_SESSION[$name])) {
            $msg = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $msg;
        }

        // Si no hay mensaje, retorna null
        return null;
    }
}