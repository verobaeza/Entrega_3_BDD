CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_usuarios(id int, nombre varchar(100), tipo)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
nuevo_nombre;
clave;
tipo;

-- definimos nuestra función
BEGIN

    IF id NOT IN (SELECT id FROM usuarios) THEN
        IF tipo = 'artista' THEN
            INSERT INTO usuarios VALUES(id, REPLACE(nombre, ' ', ''), 'a', 'artista');
        ELSIF tipo = 'productora' THEN
            INSERT INTO usuarios VALUES(id, REPLACE(nombre, ' ', '_'), 'a'. 'productora');

        RETURN TRUE;
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql