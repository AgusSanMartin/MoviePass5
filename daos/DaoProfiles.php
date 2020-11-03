<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Cliente as Cliente;
use models\Cuenta;
use models\Profile as Profile;

class DaoProfiles implements IDao
{

    private $connection;
    private static $instance = null;

    //Info db
    const TABLENAME = "profiles";
    const TABLE_DNI = "dni";
    const TABLE_NOMBRE = "nombre";
    const TABLE_APELLIDO = "apellido";
    const TABLE_DIRECCION = "direccion";
    const TABLE_TELEFONO = "telefono";
    const TABLE_IDCUENTA = "idCuenta";


    private function __construct()
    {
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoProfiles();

        return self::$instance;
    }

    //Falta testear
    public function delete($object)
    {
        if($object instanceof Profile){

            if($this->exist($object)){
                try{

                $query = "DELETE FROM ". DaoProfiles::TABLENAME . 
                " WHERE " . DaoProfiles::TABLE_DNI ." = " . $object->getDni() ." ; ";

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query);

                

            }
            catch (Exception $ex) {
                throw $ex;
            }
            }
        }
      
    }

    public function update($profile){
       
        if($profile instanceof Profile){
            
            if($this->exist($profile)){

                try{

                $query = "UPDATE " . DaoProfiles::TABLENAME .
                " SET " . DaoProfiles::TABLE_NOMBRE . " = :" . DaoProfiles::TABLE_NOMBRE . " , ".
                DaoProfiles::TABLE_APELLIDO . " = :" . DaoProfiles::TABLE_APELLIDO . " , ".
                DaoProfiles::TABLE_DIRECCION . " = :". DaoProfiles::TABLE_DIRECCION . " , ".
                DaoProfiles::TABLE_TELEFONO . " = :" . DaoProfiles::TABLE_TELEFONO . 
                " WHERE " . DaoProfiles::TABLE_DNI . " = " . $profile->getDni() . " ;";

                $parameters = $this->toArray($profile,1);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);


                }
                catch (Exception $ex) {
                    throw $ex;
                }

            }
        }
    }

    public function exist($profile)
    {   
        if($profile instanceof Profile){
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoProfiles::TABLENAME . " WHERE " . DaoProfiles::TABLE_DNI . " = " . "'" . $profile->getDni() . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        }else return false;
    }

    public function getByIdCuenta(int $idCuenta)
    {

        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLENAME . " WHERE " . DaoProfiles::TABLE_IDCUENTA . " = " . "'" . $idCuenta . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            return $object;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByDni(int $dni)
    {

        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLENAME . " WHERE " . DaoProfiles::TABLE_DNI . " = " . "'" . $dni . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            return $object;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLENAME . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            return $array;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Recibe vacio el profile;
    public function add($cuenta)
    {
        echo "estoy en DaoProfiles";

        if (($cuenta instanceof Cuenta) && ($cuenta->getProfile() instanceof Profile)) {
            echo "Paso el filtro en el dao profile";

            try {
                $query = "INSERT INTO " . DaoProfiles::TABLENAME . "( " . DaoProfiles::TABLE_DNI . " , " . DaoProfiles::TABLE_NOMBRE . " , " . DaoProfiles::TABLE_APELLIDO . " , " . DaoProfiles::TABLE_DIRECCION . " , "  . DaoProfiles::TABLE_TELEFONO . " , "  . DaoProfiles::TABLE_IDCUENTA . " ) " .
                    " VALUES ( " . ":" . DaoProfiles::TABLE_DNI . " , " . ":" . DaoProfiles::TABLE_NOMBRE . " , " . ":" . DaoProfiles::TABLE_APELLIDO . " , " . ":" . DaoProfiles::TABLE_DIRECCION . " , " . ":" . DaoProfiles::TABLE_TELEFONO . " , " . ":" . DaoProfiles::TABLE_IDCUENTA . " ) ; ";

                $parameters = $this->toArray($cuenta->getProfile());
                $parameters[DaoProfiles::TABLE_IDCUENTA] = $cuenta->getId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }


    public function toArray($object, $type = 0)
    {

        $parameters = array();

        if ($object instanceof Profile) {
           
            if($type == 0){
                $parameters[DaoProfiles::TABLE_DNI] = $object->getDni();
            }
            
            $parameters[DaoProfiles::TABLE_NOMBRE] = $object->getNombre();
            $parameters[DaoProfiles::TABLE_APELLIDO] = $object->getApellido();
            $parameters[DaoProfiles::TABLE_DIRECCION] = $object->getDireccion();
            $parameters[DaoProfiles::TABLE_TELEFONO] = $object->getTelefono();
        }

        return $parameters;
    }

    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {
                return new Profile($p[DaoProfiles::TABLE_DNI], $p[DaoProfiles::TABLE_NOMBRE], $p[DaoProfiles::TABLE_APELLIDO], $p[DaoProfiles::TABLE_DIRECCION], $p[DaoProfiles::TABLE_TELEFONO]);
            },
            $value
        );


        return $resp;
    }
}
