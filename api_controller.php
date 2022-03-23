
<?php

/**

*Obtener la lista de publicaciones del portal. 
 */

require_once 'models/productsModel.php';
require_once 'api/ApiView.php';

class Api_controller{
    private $model;
    private $view;
    private $data;
    
    function __construct(){

        $this->model = new ProductsModel();
        $this->view = new ApiView();
     }
    
    public function getAll($paramas = null){
        $publicaciones = $this->model->getAllpublicaciones();
        $this->view->response($publicaciones);
        
    }