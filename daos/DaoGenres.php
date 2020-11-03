<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Genre as Genre;

class DaoGenres implements IDao
{

    private $connection;
    private static $instance = null;

    //Info db
    const TABLENAME = "generos";
    const TABLE_IDGENRE = "idGenero";
    const TABLE_NOMBRE = "nombre";

    private function __construct(){
        
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoGenres();

        return self::$instance;
    }

    public function delete($dato)
    {
        //desarrollar
    }

    

    public function getAll()
    {
        try {
            $genreList = array();

            $query = "SELECT * FROM " . DaoGenres::TABLENAME;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $genreList = $this->mapeo($resultSet);

            return $genreList;

        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function exist($genre)
    {
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoGenres::TABLENAME . " WHERE " . DaoGenres::TABLE_NOMBRE . " = " . "'" . $genre->getName() . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getById(int $idGenre)
    {

        try {
            $query = "SELECT * FROM " . DaoGenres::TABLENAME . " WHERE " . DaoGenres::TABLE_IDGENRE . " = " . "'" . $idGenre . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $array = !empty($array) ? $array[0] : [];

            return $array;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function arrayToGenre(array $genreIds)
    {
        $arregloGeneros = array();

        foreach ($genreIds as $id) {
            if (is_int($id)) {
                $object = $this->getById($id);

                if (!empty($object)) {
                    array_push($arregloGeneros, $object);
                }
            }
        }

        return $arregloGeneros;
    }

    public function add($genre)
    {
        if ($genre instanceof Genre) {


            try {
                $query = "INSERT INTO " . DaoGenres::TABLENAME . " ( " . DaoGenres::TABLE_IDGENRE ." , " . DaoGenres::TABLE_NOMBRE . " )  VALUES ( " . ":" . DaoGenres::TABLE_IDGENRE ." , " . ":" . DaoGenres::TABLE_NOMBRE ." ) ;";

                $parameters[DaoGenres::TABLE_IDGENRE] = $genre->getId();
                $parameters[DaoGenres::TABLE_NOMBRE] = $genre->getName();


                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function updateFromApi(){

        $listGenre = $this->genresFromApi();
        foreach($listGenre as $genre){
            if(!($this->exist($genre))){
                $this->add($genre);
            }
        }

    }

    //Devuelve un arreglo de Genre que vienen de la API
    private function genresFromApi()
    {
        $api_url = "https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY_TMDB . "&language=en-US";
        $api_json = file_get_contents($api_url);
        $api_array = ($api_json) ? json_decode($api_json, true) : array();

        $genre_list = array();

        foreach ($api_array["genres"] as $valuesArray) {
            $genre = new Genre();

            $genre->setId($valuesArray["id"]);
            $genre->setName($valuesArray["name"]);

            array_push($genre_list, $genre);
        }

        return $genre_list;
    }


    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {
                return new Genre($p[DaoGenres::TABLE_IDGENRE], $p[DaoGenres::TABLE_NOMBRE]);
            },
            $value
        );


        return $resp;
    }
}
