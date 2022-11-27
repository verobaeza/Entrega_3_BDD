CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_usuarios (id int, nombre varchar(100), tipo varchar(10))

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
-- DECLARE
-- clave;
-- definimos nuestra función
BEGIN

    IF id NOT IN (SELECT user_id FROM usuarios) AND tipo = 'artista' THEN
            INSERT INTO usuarios(user_id, nombre_usuario, clave, tipo) values(id, nombre, 'a', tipo);
        -- ELSIF tipo = 'productora' THEN
        --    INSERT INTO usuarios VALUES(, REPLACE(nombre, ' ', '_'), 'a'. 'productora');

        RETURN TRUE;
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql