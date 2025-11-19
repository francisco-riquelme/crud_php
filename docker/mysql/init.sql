-- Si la tabla ya existe (útil para pruebas), la eliminamos primero.
-- Solo haz esto en entornos de desarrollo.
DROP TABLE IF EXISTS usuarios;

-- CREACIÓN DE LA TABLA 'usuarios'
CREATE TABLE usuarios (
    -- ID autoincremental y llave primaria (PRIMARY KEY)
    id INT(11) NOT NULL AUTO_INCREMENT,

    -- Nombre del usuario (máximo 100 caracteres)
    nombre VARCHAR(100) NOT NULL,

    -- Correo electrónico (debe ser único y no nulo)
    email VARCHAR(255) NOT NULL UNIQUE,

    -- Definimos 'id' como la llave primaria de la tabla
    PRIMARY KEY (id)
);

-- 💡 OPCIONAL: Insertar datos de prueba
INSERT INTO usuarios (nombre, correo) VALUES
('Juan Perez', 'juan.perez@ejemplo.com'),
('Maria Lopez', 'maria.lopez@ejemplo.com'),
('Carlos Ruiz', 'carlos.ruiz@ejemplo.com');