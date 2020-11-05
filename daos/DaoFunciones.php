<?php

namespace daos;

use Models\Funcion as funcion;
use Models\Movie as movie;
use Models\Room as room;
use daos\DaoRooms as roomDao;
use daos\Connection;
use daos\DaoMovies as movieDao;

class ProjectionDAO {
    private $connection;
    const TABLE_IDFUNCION = "idFuncion";
    const TABLE_IDMOVIE = "idMovie";
    const TABLE_IDROOM = "idRoom";
    const TABLE_DATE = "date";
    const TABLE_HOUR = "time";

    public function __construct() {
        
    }

    public function Add($funcion)
    {
        try
        {
            $sql = "INSERT INTO funciones (idMovie,idRoom,date,time) VALUES (:idMovie,:idRoom,:date,:time);";
            $room=$funcion->getRoom();
            $movie=$funcion->getMovie();
            $parameters["idMovie"] =$movie->getId();
            $parameters["idRoom"] =$room->getId();
            $parameters["date"]=$funcion->getDate();
            $parameters["time"]=$funcion->getHour();
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($sql, $parameters);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

 /* Debo ingresar todos los atributos de Movie en el select y la creacion del objeto. Debo crear un atributo genero en el constructor que viene de base DaoGenre.
    public function getArrayByIdRoom($idRoom){
        $funcion_list=array();
        try{
            $sql="SELECT f.idFuncion,f.idRoom,f.time,f.date,m.idMovie,m.title
                    from funciones f
                    inner join movies m on m.idMovie = f.idMovie
                    where f.idRoom = $idRoom and concat(f.date,' ',f.time) > now()";
            $this->connection=Connection::getInstance();
            $resultSet=$this->connection->execute($sql);
            foreach ($resultSet as $row) {
                $movie=new Movie($row["title"],$row["idMovie"]); 
                $movie->setGenres($this->genero->getByIdMovie($row["idMovie"]));
                $funcion_list[]=new Funcion($row["idFuncion"],$movie,$idRoom,$row["date"],$row["time"]);
            }
            return $funcion_list;
        }
        catch(Exception $ex){
            throw $ex;
        }
    }*/


    public function GetById($id) {

        try
        {
            $parameters['id'] = $id;
            $room=$funcion->getRoom();
            $movie=$funcion->getMovie();

            $sql = "SELECT * FROM funciones WHERE id=:id";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql, $parameters);

            if(!empty($resultSet)) {
                return $this->mapeo($resultSet);
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
    }

    private function mapeo(){
       
        $value = is_array($value) ? $value : []; 
    
        $resp = array_map( 
            function ($p) { 
 
                $objet =  new Room( 
                    $p[DaoFuncion::TABLE_ID], 
                    $p[DaoFuncion::TABLE_IDMOVIE], 
                    $p[DaoFuncion::TABLE_IDROOM], 
                    $p[DaoFuncion::TABLE_DATE], 
                    $p[DaoFuncion::TABLE_HOUR], 
                ); 
 
                return $objet; 
            }, 
            $value 
        ); 
        return count($resp) > 1 ? $resp : $resp['0']; 
    }

    public function remove ($id)
    {
        try
        {
            $sql = "DELETE FROM funciones WHERE id=:id";  
             $this->connection=Connection::getInstance();
             return $this->connection->ExecuteNonQuery($sql);
        }
        catch(Exception $ex){
        throw $ex;
    }
    }

    public function getAllMovies(){
        $moviesList=array();
        try{
            $query="SELECT m.* from projections p
                    inner join movies m on p.id_movie=m.id_movie
                    where concat(p.proj_date,' ',p.proj_time) > now()
                    group by m.id_movie";
            $this->connection=Connection::getInstance();
            $results=$this->connection->execute($query);
            foreach ($results as $row) {
                $movie=new Movie($row["title"],
                    $row["id_movie"],
                    $row["synopsis"],
                    $row["poster_url"],
                    $row["video_url"],
                    $row["length"],
                    [],
                    $row["release_date"]);
                $movie->setGenres($this->genrexM->getByMovieId($row["id_movie"]));
                $moviesList[]=$movie;
            }
            return $moviesList;          
        }catch(Exception $ex){
            throw $ex;
        }
    }

    
    public function GetAllByDate($date) {
        $funcion_list =array();

        try
        {
            $parameters['date'] = $date;
            $sql = "SELECT * FROM funciones where date=:date ORDER BY date";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql, $parameters);

            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    return $this->leer($row);

                    $idRoom = $row["idRoom"];
                    $idMovie = $row["idMovie"];

                    $DaoRoom = new roomDao();
                    $room = $DaoRoom->GetById($idRoom);

                    $DaoMovie = new movieDao();
                    $movie = $DaoMovie->GetById($idMovie);

                    $funcion->setRoom($room);
                    $funcion->setMovie($movie);

                    array_push($funcion_list,$funcion);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return funcion_list;
    }

    public function GetAll(){
        $funcion_list =array();

        try
        {
            $sql = "SELECT * FROM funciones f where datediff(f.date,(curdate()-1)) > 0 ORDER BY date";

            $this->connection = Connection::getInstance();

            $resultSet = $this->connection->Execute($sql, $parameters);

            if(!empty($resultSet)) {
                foreach ($resultSet as $row) {
                    return $this->leer($row);

                    $idRoom = $row["idRoom"];
                    $idMovie = $row["idMovie"];

                    $DaoRoom = new roomDao();
                    $room = $DaoRoom->GetById($idRoom);

                    $DaoMovie = new movieDao();
                    $movie = $DaoMovie->GetById($idMovie);

                    $funcion->setRoom($room);
                    $funcion->setMovie($movie);

                    array_push($funcion_list,$funcion);
                }
            }
        }
        catch (PDOException $e)
        {
            throw $e;
        }
        return funcion_list;
    }

    public function leer($row){
        $funcion = new Funcion();

        $funcion->setId($row["id"]);
        $funcion->setDate($row["date"]);
        $funcion->setHour($row["hour"]);

        return $funcion;
    }

}