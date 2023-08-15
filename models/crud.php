<?php


interface Crud{

    public function create($tabla, $datos);

    public function delete($tabla,$datos);


    public function alter($data);


    public function read($data);


    public function filter($tabla,$datos);


    
}