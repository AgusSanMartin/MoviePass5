<?php
namespace daos;

use models\Room as room;
use daos\Connection as Connection;
// Arreglar el Modify

class DaoRooms {

    
    private $room_list = array();
    const TABLE_NAME = "room";
    const TABLE_IDROOM = "idRoom";
    const TABLE_NOMBRE = "nombre";
    const TABLE_CAPACIDAD ="capacidad";
    const TABLE_PRECIO = "precio";
    const TABLE_IDCINE = "idCine";

    public function __construct(){
              
    }

    public function Add(Room $room)
        {

            $sql = "insert into" . DaoRooms::TABLE_NAME  . "(idRoom,nombre, capacidad, precio,idCine) values (:idRoom, :nombre,:capacidad,:precio,:idCine)";

            $parameters['idRoom'] =  $room->getId();
            $parameters['nombre'] =  $room->getNombre();
            $parameters['capacidad'] =  $room->getCapacidad();
            $parameters['precio'] =  $room->getPrecio();
            $parameters['idCine'] =  $room->getIdCine();

           /* array_push($this->cines_list, $cine);
            $this->SaveData();*/
            try { 
            $this->connection = Connection::GetInstance(); 
    
            return $this->connection->ExecuteNonQuery($sql,$parameters);


        } catch (Exception $ex) { 
            throw $ex; 
        } 
    } 

    public function getById(int $id){ 
        
        try { 
            $sql = "SELECT * FROM " . DaoRooms::TABLE_NAME . " WHERE " . DaoRooms::TABLE_IDROOM . " = " . "'" . $id . "'" . " ;"; 

            $parameters['id'] = $id;
 
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql, $parameters);
 
            if(!empty($resultSet) && $object instanceof Room){ 
 
                 return $this->mapeo($resultSet);   
            }
            else{
                return false;
            }
 
 
        } catch (Exception $ex) { 
            throw $ex; 
        } 
       } 

       public function mapeo($value) 
       { 
    
           $value = is_array($value) ? $value : []; 
    
           $resp = array_map( 
               function ($p) { 
    
                   $objet =  new Room( 
                       $p[DaoRooms::TABLE_IDROOM], 
                       $p[DaoRooms::TABLE_NOMBRE], 
                       $p[DaoRooms::TABLE_CAPACIDAD], 
                       $p[DaoRooms::TABLE_PRECIO], 
                       $p[DaoRooms::TABLE_IDCINE], 
                   ); 
    
                   return $objet; 
               }, 
               $value 
           ); 
           return count($resp) > 1 ? $resp : $resp['0']; 
       }
       /* 
       public function modify($room){
        foreach($this->room as $i => $c){
            if($r->getId()== $room->getId()){
                $this->room_list[$i] = $room;
                $this->SaveData();
                return true;
            }
        }
        return false;
    }*/

    public function Update($room){
        $sql = "UPDATE " . DaoRooms::TABLE_NAME . "(" . TABLE_IDROOM . "," . TABLE_NOMBRE . "," . TABLE_CAPACIDAD . "," . TABLE_PRECIO . "," . TABLE_IDCINE . ")";
        
        
        $parameters[DaoRooms::TABLE_IDCINE] = $room->getId(); 
        $parameters[DaoRooms::TABLE_NOMBRE] = $room->getNombre(); 
        $parameters[DaoRooms::TABLE_CAPACIDAD] = $room->getCapacidad(); 
        $parameters[DaoRooms::TABLE_DIRECCION] = $room->getPrecio(); 
        $parameters[DaoRooms::TABLE_PRECIOXENTRADA] = $room->getIdCine(); 
    
        try{
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql, $parameters); 
        } catch (Exception $ex) { 
            throw $ex; 
        }
    }

    
    public function getAll(){
        $sql = "select from " . DaoRooms::TABLE_NAME;

        try{
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($sql);
 
            if(!empty($resultSet) && $object instanceof Room){ 
 
                 return $this->mapeo($resultSet);   
            }
            else{
                return false;
            }
 
 
        } catch (Exception $ex) { 
            throw $ex; 
        } 

    }
       


}
?>