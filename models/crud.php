<?php


interface Crud{

    public function create($tabla, $datos);

    public function delete($data);


    public function alter($data);


    public function read($data);


    public function filter($data);


    
}