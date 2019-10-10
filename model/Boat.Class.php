<?php

/**
* Boat
*
* @package  model
* @author   fl222uw
*/

class Boat {
  private $id;
  private $ownerId;
  private $type;
  private $length;
  const data_src = 'resources/boats.json';

  public function __construct($oId,$t,$l) {
    $this->id = $this->getBoatId($oId);
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

  /**
   * Generates a boat id for new boat (combines owners id with the amount of owners boats)
   *
   * @param $oId
   * @return Integer
   */
   public function getBoatId($oId){
     $file = file_get_contents(Boat::data_src);
     $array = json_decode($file,true);
     return $oId + count($array) + 1;
   }

  /**
   * Saves new boat to json file directly from the constructor
   */
  public function saveBoat() {
    $file = file_get_contents(Boat::data_src);
    $array = json_decode($file,true);
    $new_boat_array = array(
      'id'=>$this->id,
      'ownerId'=>$this->ownerId,
      'type'=>$this->type,
      'length'=>$this->length,
    );
    array_push($array,$new_boat_array);
    $json_string = json_encode($array,JSON_PRETTY_PRINT);
    file_put_contents(Boat::data_src, $json_string);
  }

  /**
   * Deletes boat with matching id from json file
   *
   * @param $id
   */
  public static function deleteBoat($id) {
      $file = file_get_contents(Boat::data_src);
      $array = json_decode($file,true);
      $deleted_boat_info = null;
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $id){
          $deleted_boat_info = $array[$i]['type'] . " " . $array[$i]['length'];
          array_splice($array,$i,1);
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Boat::data_src, $json_string);
  }

  /**
   * Updates boat both in boat json register and Memeber json register
   *
   * @param $id,$oId,$t,$l
   */
  public static function updateBoat($id,$oId = null,$t = null,$l = null){
    $file = file_get_contents(Boat::data_src);
    $array = json_decode($file,true);
    $boat = array(
      'id' => $id,
      'ownerId' => $oId,
      'type' => $t,
      'length' => $l,

    );
    for($i = 0; $i < count($array);$i++){
      if($array[$i]['id'] == $id){
        if(isset($oId)){$array[$i]['ownerId'] = $oId;}
        if(isset($t)){$array[$i]['type'] = $t;}
        if(isset($l)){$array[$i]['length'] = $l;}
      }
    }
    Member::deleteBoat($oId,$id);
    Member::addBoat($oId,$boat);
    $json_string = json_encode($array,JSON_PRETTY_PRINT);
    file_put_contents(Boat::data_src, $json_string);
  }

}
