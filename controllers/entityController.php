<?php
class EntityController{

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function index($page = 1) {
        $perPage = 10; 
        $totalEntities = $this->model->getTotalEntitiesCount();
        $totalPages = ceil($totalEntities / $perPage);

        $entities = $this->model->getEntities($page, $perPage);

        include '../views/entity_view.php';
    }

}
