<?php
declare(strict_types=1);


// Validar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    // Crea la sesión si no está ya iniciada
    session_start();
}