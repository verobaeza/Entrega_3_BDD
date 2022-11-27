CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_usuarios(user_id int, nombre varchar(100), tipo)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
clave;
-- definimos nuestra función
BEGIN

    IF user_id NOT IN (SELECT user_id FROM usuarios) THEN
        IF tipo = 'artista' THEN
            INSERT INTO usuarios VALUES(user_id, REPLACE(nombre, ' ', ''), 'a', 'artista');
        -- ELSIF tipo = 'productora' THEN
        --    INSERT INTO usuarios VALUES(user_id, REPLACE(nombre, ' ', '_'), 'a'. 'productora');

        RETURN TRUE;
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql