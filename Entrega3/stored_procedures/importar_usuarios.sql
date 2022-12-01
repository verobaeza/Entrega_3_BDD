CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_usuarios (id int, nombre varchar(100), tipo_usuario varchar(10), pais VARCHAR(100))

-- declaramos lo que retorna
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar
DECLARE
chars VARCHAR := '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
clave_asignada VARCHAR := '';
pos INT;
--nombre_usuario_artista VARCHAR;
--nombre_usuario_productora VARCHAR;

-- definimos nuestra función
BEGIN

    -- Loop para crear contraseña
    FOR i IN 1..10 LOOP
        pos := CAST( random() * ( LENGTH(chars) - 1) AS INT );
        clave_asignada := clave_asignada || substr(chars, pos, 1);
    END LOOP;

    -- Importar artistas
    IF tipo_usuario = 'artista' THEN
        -- Nombre_usuario_artista := REPLACE(nombre, ' ', '_')
        IF REPLACE(nombre, ' ', '_') NOT IN (SELECT nombre_usuario FROM usuarios) THEN
            INSERT INTO usuarios(nombre_usuario, clave, tipo, ref_id) values(REPLACE(nombre, ' ', '_'), clave_asignada, tipo_usuario, id);

            RETURN TRUE;
        END IF;
     --Importar productoras
    ELSIF tipo_usuario = 'productora' THEN
        -- nombre_usuario_productora := CONCAT(LOWER(REPLACE(nombre, ' ', '_')), pais)
        IF CONCAT(LOWER(REPLACE(nombre, ' ', '_')), '_', LOWER(REPLACE(pais,' ', '_'))) NOT IN (SELECT nombre_usuario FROM usuarios) THEN
            INSERT INTO usuarios(nombre_usuario, clave, tipo, ref_id) VALUES(CONCAT(LOWER(REPLACE(nombre, ' ', '_')), '_', LOWER(REPLACE(pais,' ', '_'))), clave_asignada, tipo_usuario, id);
            RETURN TRUE;
        END IF;
    ELSE
        RETURN FALSE;

    END IF;
-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql