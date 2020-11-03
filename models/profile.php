<?php
namespace models;



class Profile{

	private $dni;
	private $nombre;
	private $apellido;
	private $direccion;
    private $telefono;
    private $entradas;

    function __construct ($dni = "",$nombre = "", $apellido = "",$direccion = "",$telefono = "") {

		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->entradas = null;

    }

	/**
	 * Get the value of nombre
	 */ 
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 *
	 * @return  self
	 */ 
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Get the value of apellido
	 */ 
	public function getApellido()
	{
		return $this->apellido;
	}

	/**
	 * Set the value of apellido
	 *
	 * @return  self
	 */ 
	public function setApellido($apellido)
	{
		$this->apellido = $apellido;

		return $this;
	}

	/**
	 * Get the value of direccion
	 */ 
	public function getDireccion()
	{
		return $this->direccion;
	}

	/**
	 * Set the value of direccion
	 *
	 * @return  self
	 */ 
	public function setDireccion($direccion)
	{
		$this->direccion = $direccion;

		return $this;
	}

	/**
	 * Get the value of telefono
	 */ 
	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * Set the value of telefono
	 *
	 * @return  self
	 */ 
	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;

		return $this;
	}

	

    /**
     * Get the value of entradas
     */ 
    public function getEntradas()
    {
        return $this->entradas;
    }

    /**
     * Set the value of entradas
     *
     * @return  self
     */ 
    public function setEntradas($entradas)
    {
        $this->entradas = $entradas;

        return $this;
    }

	/**
	 * Get the value of dni
	 */ 
	public function getDni()
	{
		return $this->dni;
	}

	/**
	 * Set the value of dni
	 *
	 * @return  self
	 */ 
	public function setDni($dni)
	{
		$this->dni = $dni;

		return $this;
	}
}