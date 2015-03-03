<?php
class Screen {
    //creates new attributes to object//
    //private so they cannot be accessed outside of class//
    private $screenID;
    private $seatNumber;
    private $fireExits;
   
    //adds contructors to each attribute//
    public function __construct($id, $sn, $f) {
        $this->screenID= $id;
        $this->seatNumber = $sn;
        $this->fireExits = $f;
           }
    
    //use get and set methods to attributes can remain private but they can be accessed outside of class//
    public function getScreenID() {return $this->screenID;} 
    public function getSeatNumber() {return $this->seatNumber;} 
    public function getFireExits() {return $this->fireExits;}
   }
