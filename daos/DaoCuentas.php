<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Cuenta as Cuenta;
use daos\DaoProfiles as DaoProfiles;

class DaoCuentas implements IDao
{

    private $connection;
    private static $instance = null;

    //Info db
    const TABLENAME = "cuentas";
    const TABLE_IDCUENTA = "idCuenta";
    const TABLE_EMAIL = "email";
    const TABLE_PASSWORD = "password";
    const TABLE_PRIVILEGIOS = "privilegios";

    private function __construct(){
        
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoCuentas();

        return self::$instance;
    }

    public function delete($dato){
        //desarrollar
    }
    
    public function add($cuenta)
    {
        if ($cuenta instanceof Cuenta) {


            try {
                $query = "INSERT INTO " . DaoCuentas::TABLENAME . " ( " . DaoCuentas::TABLE_EMAIL . " , " . DaoCuentas::TABLE_PASSWORD . " , " . DaoCuentas::TABLE_PRIVILEGIOS . " ) VALUES ( " . ":" . DaoCuentas::TABLE_EMAIL . " , " . ":" . DaoCuentas::TABLE_PASSWORD . " , " . ":" . DaoCuentas::TABLE_PRIVILEGIOS . " );";

                $parameters[DaoCuentas::TABLE_EMAIL] = $cuenta->getEmail();
                $parameters[DaoCuentas::TABLE_PASSWORD] = $cuenta->getPassword();
                $parameters[DaoCuentas::TABLE_PRIVILEGIOS] = $cuenta->getPrivilegios();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                //el id se genera en la base de datos, por eso tengo que pedir nuevamente el objeto.
                $object = $this->getByEmail($cuenta->getEmail());
                $cuenta->setId($object->getId());
            
                $daoProfile = DaoProfiles::GetInstance();

                $daoProfile->add($cuenta);

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }


    public function getAll()
    {
        try {
            $cuentaList = array();

            $query = "SELECT * FROM " . DaoCuentas::TABLENAME;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $cuentaList = $this->mapeo($resultSet);

            return $cuentaList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Falta complementar el perfil
    public function getById($id)
    {
        try {

            $query = "SELECT * FROM " . DaoCuentas::TABLENAME . " WHERE " . DaoCuentas::TABLE_IDCUENTA . " = " . $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $array = !empty($array) ? $array[0] : [];

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByEmail($email)
    {
        try {

            $query = " SELECT * FROM " . DaoCuentas::TABLENAME . " WHERE " . DaoCuentas::TABLE_EMAIL . " = " . "'" . $email . "'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $array = !empty($array) ? $array[0] : [];

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {
                return new Cuenta($p[DaoCuentas::TABLE_IDCUENTA], $p[DaoCuentas::TABLE_EMAIL], $p[DaoCuentas::TABLE_PASSWORD], $p[DaoCuentas::TABLE_PRIVILEGIOS]);
            },
            $value
        );


        return $resp;
    }

    public function exist($email)
    {
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoCuentas::TABLENAME . " WHERE " . DaoCuentas::TABLE_EMAIL . " = " . "'" . $email . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function verificar($email, $password)
    {

        if ($this->exist($email)) {

            $cuenta = $this->getByEmail($email);

            if ($cuenta != false) {
                if ($cuenta->getPassword() == $password) {
                    $_SESSION['cuenta'] = $cuenta;
                }
            }
        }
    }
}
