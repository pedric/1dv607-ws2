<?php

class Boat {
  public $id;
  public $ownerId;
  public $type;
  public $length;
  const data_src = 'resources/boats.json';

  public function __construct($oId,$t,$l) {
    $this->id = uniqid();
    $this->ownerId = $oId;
    $this->type = $t;
    $this->length = $l;
    $this->saveBoat();
  }

  /*
   * Getters
   */

   public function getLength(){
     return $this->length;
   }

   public function getType(){
     return $this->type;
   }

   public function getOwnerId(){
     return $this->ownerId;
   }

   public function getId(){
     return $this->id;
   }

   /*
    * Setters
    */
    public function setLength($l){
      $this->length = $l;
    }

    public function setType($t){
      $this->type = $t;
    }

    public function setOwnerId($oId){
      $this->ownerId = $oId;
    }

  /*
   * Other methods
   */
  public function saveBoat() {
    $file = file_get_contents(Boat::data_src);
    $array = json_decode($file,true);
    $new_boat_array = json_encode($this);
    array_push($array,$new_boat_array);
    $json_string = json_encode($array);
    file_put_contents(Boat::data_src, $json_string);
  }

}
