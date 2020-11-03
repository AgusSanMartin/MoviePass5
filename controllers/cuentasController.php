<?php namespace controllers;

    use daos\DaoCuentas as DaoCuentas;
    use models\Cuenta as Cuenta;
    use models\Profile as Profile;

class CuentasController
    {

        public function verificar($email="",$password=""){
            
            $DaoCuentas = DaoCuentas::GetInstance();
            
            $DaoCuentas->verificar($email,$password);
            
            if(isset($_SESSION['cuenta']))
            {
            require_once "views/template.php";
            }
            else {
            require_once "views/login.php";
            }
        }

        public function registrarse(){

            require_once "views/register.php";
        }

        public function crear($email, $password, $rPassword , $dni ,$nombre, $apellido, $telefono, $direccion){

            if($password == $rPassword){

                $profile = new Profile($dni,$nombre,$apellido,$direccion,$telefono);

                $cuenta = new Cuenta(0,$email, $password,1);

                $cuenta->setProfile($profile);

                $DaoCuentas = DaoCuentas::GetInstance();

                $DaoCuentas->add($cuenta);

                require_once VIEWS_PATH . "login.php";
            }else {
                
                require_once "views/register.php";
            }
            
        }


    }

    