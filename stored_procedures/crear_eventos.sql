/* ihn: la idea es que se cree un evento sólo si el nombre que se escoja no existia de antes. */

CREATE OR REPLACE FUNCTION

verificar_evento (nombre varchar(), nombreRecinto, ciudad, pais, capacidad, artista) /*ihn: los nombres pueden cambiar dependiendo de como sean los originales que defina el grupo par*/

RETURNS VOID AS $$

DECLARE:

idmax int:

BEGIN
    IF nombre IN (SELECT name FROM tablaeventos??) THEN
        RETURN FALSE;
    END IF;

    SELECT INTO idmax
    MAX(id)
    FROM tablaeventos??;

    insert into tablaeventos?? values(idmax + 1, nombre, nombreRecinto, ciudad, pais, capacidad, artista);
    RETURN TRUE;
END 
$$ language plpgsql

/*----ihn----*/



