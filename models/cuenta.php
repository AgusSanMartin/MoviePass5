<?php
namespace models;

use models\Profile as Profile;
class Cuenta
{

	private $id;
	private $email;
	private $password;
	private $privilegios;
	private $profile;

	function __construct ($id=0,$email="", $password="", $privilegios="") {

		$this->id = $id;
		$this->email = $email;
		$this->password = $password;
		$this->privilegios = $privilegios;
		$this->profile = new Profile();
    }

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of email
	 */ 
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @return  self
	 */ 
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of privilegios
	 */ 
	public function getPrivilegios()
	{
		return $this->privilegios;
	}

	/**
	 * Set the value of privilegios
	 *
	 * @return  self
	 */ 
	public function setPrivilegios($privilegios)
	{
		$this->privilegios = $privilegios;

		return $this;
    }
    

	/**
	 * Get the value of profile
	 */ 
	public function getProfile()
	{
		return $this->profile;
	}

	/**
	 * Set the value of profile
	 *
	 * @return  self
	 */ 
	public function setProfile($profile)
	{
		$this->profile = $profile;

		return $this;
	}
}