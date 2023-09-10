<?php

require '../models/entityModel.php';
require '../controllers/entityController.php';

$model = new entityModel();
$controller = new EntityController($model);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$controller->index($page);

$model->closeCon();