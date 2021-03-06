<?php namespace daos;

    use models\Cine as cine;
    use daos\Connection as Connection; 
    // Arreglar el Modify


    class DaoCines {
       
    
    private $connection;
    const TABLE_IDCINE = "idCine";
    const TABLE_NOMBRE = "nombre";
    const TABLE_DIRECCION = "direccion";
    const TABLE_ROOM = "room";

       
        public function __construct()
        {
           /*$this->RetrieveData();*/
        }

        public function Add($cine)
        {
            /* array_push($this->cines_list, $cine);
             $this->SaveData();*/

            $sql = "insert into cines (nombre, direccion,room ) values ( :nombre,:direccion, :room)";

            $parameters['nombre'] =  $cine->getNombre();
            $parameters['direccion'] =  $cine->getDireccion();
            $parameters['room'] =  $cine->getRoom();

            try { 
            $this->connection = Connection::GetInstance(); 
    
            return $this->connection->ExecuteNonQuery($sql,$parameters);


        } catch (Exception $ex) { 
            throw $ex; 
        } 
    } 

    public function getById($idCine){ 
        
        try { 
            $sql = "SELECT * FROM  cines WHERE idCine=:id"; 

            $parameters['idCine'] = $idCine;
 
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql,$parameters);
 
            if(!empty($resultSet) && $object instanceof Cine){ 
 
                 return $this->mapeo($resultSet);   
            }
            else{
                return false;
            }
 
 
        } catch (Exception $ex) { 
            throw $ex; 
        } 
       } 

       //Si el resultado del execute no termina dando un Cine, el mapeo lo transforma en uno
       public function mapeo($value) 
    { 
 
        $value = is_array($value) ? $value : []; 
 
        $resp = array_map( 
            function ($p) { 
 
                $objet =  new Cine( 
                    $p[DaoCines::TABLE_IDCINE], 
                    $p[DaoCines::TABLE_NOMBRE], 
                    $p[DaoCines::TABLE_DIRECCION], 
                    $p[DaoCines::TABLE_ROOM], 
                ); 
 
                return $objet; 
            }, 
            $value 
        ); 
        return count($resp) > 1 ? $resp : $resp['0']; 
    } 


        public function Update($cine){
            $sql = "UPDATE  cines (" . TABLE_NOMBRE . "," . TABLE_DIRECCION . "," . TABLE_ROOM  . ")";
            
            
            $parameters[DaoCines::TABLE_NOMBRE] = $cine->getNombre(); 
            $parameters[DaoCines::TABLE_DIRECCION] = $cine->getDireccion(); 
            $parameters[DaoCines::TABLE_ROOM] = $cine->getRoom(); 
        
            try{
                $this->connection = Connection::GetInstance(); 
                return $this->connection->ExecuteNonQuery($sql, $parameters); 
            } catch (Exception $ex) { 
                throw $ex; 
            }
        }


        public function getAll(){
            $sql = "select from cines";

            $cineList = array();

            try{
                $this->connection = Connection::GetInstance();
 
                $resultSet = $this->connection->Execute($sql);
     
                if(!empty($resultSet) && $object instanceof Cine){ 
     
                    foreach ($resultSet as $value) {
                        $aux = $this->mapeo($value);
                        array_push($cineList,$aux);
                    }  
                }
                else{
                    return false;
                }
     
     
            } catch (Exception $ex) { 
                throw $ex; 
            } 
            return $cineList;

        }
   
    }


?>