<?php

require_once 'dataBaseConnection.php';
require_once 'crud.php';

class Usuario extends DataBaseConnection{

    private $alias;

    private $email;

    private $contrasenia;

    private $activo;

    private $bloqueado;

    private $urlImagenUsuario;

    private $fechaCambioPwd;

    private $rol;

    function  __construct(){
        parent::__construct();
    }

  
	public function getAlias() {
		return $this->alias;
	}
	

	public function setAlias($alias): self {
		$this->alias = $alias;
		return $this;
	}
	

	public function getEmail() {
		return $this->email;
	}
	

	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}
	
	
	public function getContrasenia() {
		return $this->contrasenia;
	}
	

	public function setContrasenia($contrasenia): self {
		$this->contrasenia = $contrasenia;
		return $this;
	}
	

	public function getActivo() {
		return $this->activo;
	}

	public function setActivo($activo): self {
		$this->activo = $activo;
		return $this;
	}
	

	public function getBloqueado() {
		return $this->bloqueado;
	}
	

	public function setBloqueado($bloqueado): self {
		$this->bloqueado = $bloqueado;
		return $this;
	}
	

	public function getUrlImagenUsuario() {
		return $this->urlImagenUsuario;
	}
	

	public function setUrlImagenUsuario($urlImagenUsuario): self {
		$this->urlImagenUsuario = $urlImagenUsuario;
		return $this;
	}
	
	
	public function getFechaCambioPwd() {
		return $this->fechaCambioPwd;
	}
	
	public function setFechaCambioPwd($fechaCambioPwd): self {
		$this->fechaCambioPwd = $fechaCambioPwd;
		return $this;
	}
	
	
	public function getRol() {
		return $this->rol;
	}


	public function setRol($rol): self {
		$this->rol = $rol;
		return $this->rol;
	}

	
}