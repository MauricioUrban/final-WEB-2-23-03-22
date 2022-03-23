<?php
/**
 *  
 *   
 * 
 *   d.- Como administrador quiero desactivar una publicación. La publicación solo se podrá desactivar si: 
 * no pertenece a una categoría destacada
 * el usuario no es premium

 */
include_once('Model');
include_once('View');
include_once('loginHelper');

class ProductsController{
    private $model;
    private $view;
    private $loginHelper;

    public function __construct(){
        $this->model = new Model();
        $this->view = new View();
        $this->loginHelper = new Helper();
    } 
    public function showPublication($id){ //  a.- Como usuario quiero poder ver una publicación determinada.
                                          // La publicación deberá mostrar, además de sus datos,
                                          // los detalles de la categoría y los datos del profesional asociado.
        $usuario = $this->loginHelper->validarUsuario;

        if ($usuarioValido){
            $publication = $this->model->getPublication($id);
            $this->registrarVisita($id); // Se debe registrar la visita a la publicación.
            $this->view->showPublication($publication);
            
        }
    }

    public function registrarVisita($id){ //1.- a
        
        $visitaFecha = $_REQUEST['fecha'];
        $id_publicacion = $_REQUEST['id_publicacion'];
        $id_user = $_REQUEST['id_user'];

        $product = $this->model->insertVisita($visitaFecha, $id_publicacion, $id_user);

    }     
    
    public function addPublicacion($usuario){ // b.- Como usuario quiero poder ingresar una nueva publicación al sistema. El usuario no puede tener más de 5 publicaciones activas a menos que sea premium.

        $this->loginHelper->checkLoggedIn();
        
        if ($cantPublicUsuario <= 5) {

            $fecha = $_REQUEST['fecha'];
            $activa = true;
            $descripcion = $_REQUEST['descripcion'];
            $id_user = $_REQUEST['id_user'];
            $id_categoria = $_REQUEST['id_categoria'];
    
            $publicacion = $this->model->insertPublicacion($fecha, $descripcion, $activa, $id_user, $id_categoria);
    
            $this->view->showProduct($publicacion);
        }
    }
    function listarPublicaciones(){//c.- Como usuario quiero poder listar todas las publicaciones que coincidan con un criterio de búsqueda.
                                                                // La búsqueda puede realizarse por categoría y/o descripción.
        $this->loginHelper->checkLoggedIn();

        $id_categoria = $_REQUEST['id_categoria'];
        $descripcion = $_REQUEST['descripcion'];

        if ((!empty( $id_categoria)) || (!empty($descripcion))){
            $publicaciones = filtrarPublicaciones($id_categoria, $descripcion);

        }

    
    } 
                

}



?>