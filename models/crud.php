<?php


interface Crud{

    public function create($data);

    public function delete($data);


    public function alter($data);


    public function read($data);


    public function filter($data);


    
}