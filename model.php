<?php

/**
 * Como usuario quiero poder ver una publicación determinada.
 * La publicación deberá mostrar, además de sus datos,
 * los detalles de la categoría y los datos del profesional asociado.
 * Se debe registrar la visita a la publicación.
 */


class Model{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname = db_publication;charset=utf8', 'root', '');
    }
    
    function getPublication($id){ // 1.- a
        $query = $this->db->prepare('SELECT publicacion.fecha, publicacion.descripcion, publicacion.id_user, publicacion.id_categoria,
                                            categoria.nombre, categoria.destacada,
                                            user.email, user.telefono, user.premiun
                                             FROM publicacion INNER JOIN categoria INNER JOIN user WHERE publicacion.id = ?');
        $query->execute($id);

        $publication = $query->fetch(PDO::FETCH_OBJ);

        return $publication;
    }

    function insertVisita($visitaFecha, $id_publicacion, $id_user){
        $query = $this->db->prepare('INSERT INTO visita(fecha, id_publicacion, id_user) VALUES (?,?,?)');
        $query->execute([$visitaFecha, $id_publicacion, $id_user]);

        return $this->db->lastInsertId();
    }

    function insertPublicacion($fecha, $descripcion, $activa, $id_user, $id_categoria){
        $query = $this->db->prepare('INSERT INTO publicacion(fecha, descricion, activa, id_user, id_categoria) VALUES (?,?,?,?,?)');
        $query->execute([$fecha, $descripcion, $activa, $id_user, $id_categoria]);

        return $this->db->lastInsertId();

    }

    function filtrarPublicaciones($id_categoria, $descripcion){

        $query = $this->db->prepare('SELECT publicacion.id, publicacion.date, publicacion.descripcion, publicacion.id_user, publicacion.id_categoria 
                                     FROM publicacion 
                                     WHERE publicacion.id_categoria = user.id AND publicacion.id_categoria = ? OR FIELD_A `%publicacion.descripcion%` = ?');
            $query->execute($id_categoria, $descripcion);
    
            $products = $query->fetchAll(PDO::FETCH_OBJ);
    
            return $products;
        }

    }



}
?>