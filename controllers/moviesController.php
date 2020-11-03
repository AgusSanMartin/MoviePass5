<?php namespace controllers;


use daos\DaoGenres as DaoGenres;
use daos\DaoMovies as DaoMovies;
use models\Genre as Genre;
use models\Movie as Movie;

class MoviesController {
   
        //Funcion que actualiza la cartelera de Movies(atributo enabled false para las peliculas que ya no esten) y los generos
        public function updateFromApi(){
            $daoMovies = DaoMovies::GetInstance();
            $daoMovies->updateFromApi();
            $moviesList = $daoMovies->getEnabled();

            $daoGenres = DaoGenres::GetInstance();
            $daoGenres->updateFromApi();
            $listGenres = $daoGenres->getAll();

            include(ROOT . VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/list_movies.php');
        }
        
        //Lista las peliculas Actuales
        public function listMovies(){
    
            $daoMovies = DaoMovies::GetInstance();
            $moviesList = $daoMovies->getEnabled();

            $daoGenres = DaoGenres::GetInstance();
            $listGenres = $daoGenres->getAll();

            include(ROOT . VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/list_movies.php');
        }

        public function listMovieByGenre($idGenre = 0){

            $daoGenres = DaoGenres::GetInstance();
            $genre = $daoGenres->getById($idGenre);
            $listGenres = $daoGenres->getAll();

            $daoMovies = DaoMovies::GetInstance();
            $moviesList = $daoMovies->genreMovies($genre);
            
            include(ROOT . VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/list_movies.php');
        }

        public function viewMovie($idMovie = 0){
            
            $daoMovies = DaoMovies::GetInstance();

            $movie = $daoMovies->getById($idMovie);

            include(VIEWS_PATH . "nav-bar.php");
            include(ROOT . 'views/view-movie.php');
        }

        


        
    }

     

?>