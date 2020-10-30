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

    public function getById($id){ 
        
        try { 
            $sql = "SELECT * FROM  cines WHERE idCine=id"; 

            $parameters['id'] = $id;
 
            $this->connection = Connection::GetInstance();
 
            $resultSet = $this->connection->Execute($sql);
 
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
            $sql = "select from " . DaoCines::TABLENAME;

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
        
 /*
        public function GetById($id){
            foreach($cines_list as $cine){
                if($id==$cine->getId()){
                    return $cine;
                }
            }
            return null;
        }
*//*
        public function modify($cine){
            foreach($this->cine as $i => $c){
                if($c->getId()== $cine->getId()){
                    $this->cines_list[$i] = $cine;
                    $this->SaveData();
                    return true;
                }
            }
            return false;
        }*/
       /* public function Update($cineInput){
            foreach($cines_list as $cine){
                if($cineInput->getId()==$cine->getId()){
                    $cine=$cineInput;
                }
            }
        }*/
/*
        public function Delete($id){
            $arrayCine = array();
            
            foreach($this->cines_list as $i => $cine){
                if($id==$cine->getId()){
                    unset($this->cine[$i]);
                    $this->SaveData();
                    return true;
                }
            }
            return false;
        }*/
/*
        public function GetAll()
        {
            return $this->cines_list;
        }*/
        /*
       private function SaveData()
        {
            $arrayToEncode = array();
            foreach($this->cines_list as $cine)
            {
                $valuesArray['id'] = $cine->getId();
                $valuesArray['nombre_cine'] = $cine->getNombre_Cine();
                $valuesArray['capacidad_total'] = $cine->getCapacidad_Total();
                $valuesArray['direccion'] = $cine->getDireccion();
                $valuesArray['valor_entrada'] = $cine->getValor_Entrada();
                
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents(self::FILE_NAME, $jsonContent);
        }*/
/*
        private function RetrieveData()
        {

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents(self::FILE_NAME);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine->setId($valuesArray["id"]);
                    $cine->setNombre_Cine($valuesArray['nombre_cine']);
                    $cine->setCapacidad_Total($valuesArray['capacidad_total']);
                    $cine->setDireccion($valuesArray['direccion']);
                    $cine->setValor_Entrada($valuesArray['valor_entrada']);
                    
                    array_push($this->cines_list, $cine);
                }
            }
        }
*/
        
     /*   private function ListFromApi(){

            $api_url = "https://api.thecinedb.org/3/cine/now_playing?page=1&language=en-US&api_key=" . KEY_TMDB;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            
            $new_cine_list = array();

            foreach($api_array['results'] as $valuesArray)
                {
                    $cine = new \models\cine();

                    $cine->setPopularity($valuesArray["popularity"]);
                    $cine->setVote_count($valuesArray["vote_count"]);
                    $cine->setVideo($valuesArray["video"]);
                    $cine->setPoster_path($valuesArray["poster_path"]);
                    $cine->setId($valuesArray["id"]);
                    $cine->setAdult($valuesArray["adult"]);
                    $cine->setBackdrop_path($valuesArray["backdrop_path"]);
                    $cine->setOriginal_language($valuesArray["original_language"]);
                    $cine->setOriginal_title($valuesArray["original_title"]);
                 
                    $cine->setTitle($valuesArray["title"]);
                    $cine->setVote_average($valuesArray["vote_average"]);
                    $cine->setOverview($valuesArray["overview"]);
                    $cine->setRelease_date($valuesArray["release_date"]);
                    $cine->setEnabled(true);
                    
                    $cine->setGenre_ids($this->genreConverter($valuesArray["genre_ids"]));
                    
                    array_push($new_cine_list, $cine);
                }


            return $new_cine_list;
        }*/

      /*  private function genreConverter($array_genre_ids){
            
            $genre_list = $this->GenreFromApi();
            $generos = array();

            foreach($array_genre_ids as $id){

                if(array_key_exists($id,$genre_list)){

                    array_push($generos,$genre_list[$id]->getName());
                }
            }
        
            return $generos;
        }*/

      /*  private function GenreFromApi(){
            $api_url = "https://api.thecinedb.org/3/genre/cine/list?api_key=" . KEY_TMDB . "&language=en-US" ;
            $api_json = file_get_contents($api_url);
            $api_array = ($api_json) ? json_decode($api_json, true) : array();

            $genre_list = array();

            foreach($api_array["genres"] as $valuesArray)
                {
                    $genre = new \models\Genre();
                    
                    $genre->setId($valuesArray["id"]);
                    $genre->setName($valuesArray["name"]);
                    
                    $genre_list[$genre->getId()] = $genre; 
                }

            return $genre_list;
        }*/

    }


?>