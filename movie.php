<?php

class movie 
{
    private $movieID;
    private $title;
    private $movieYear;
    private $runTime;
    private $classification;
    private $directorFName;
    private $directorLName;
    private $genre;
    
    public function __construct($id, $t, $my, $rt, $c, $dfn, $dln, $g)
    {
        $this->movieID=$id;
        $this->title=$t;
        $this->movieYear=$my;
        $this->runTime=$rt;
        $this->classification=$c;
        $this->directorFName=$dfn;
        $this->directorLName=$dln;
        $this->genre=$g;
    }
    
    public function getMovieID() {
        return $this->movieID;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getMovieYear() {
        return $this->movieYear;
    }
    public function getRunTime() {
        return $this->runTime;
    }
    public function getClassification() {
        return $this->classification;
    }
    public function getDirectorFName() {
        return $this->directorFName;
    }
    public function getDirectorLName() {
        return $this->directorLName;
    }
    public function getGenre() {
        return $this->genre;
    }
}
