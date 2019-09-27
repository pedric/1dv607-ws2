<?php

class Member {
  public $id;
  public $firstName;
  public $lastName;
  public $birthNumber;
  public $boats;
  const data_src = 'resources/members.json';

  public function __construct($f,$l,$b) {
    $this->id = uniqid();
    $this->firstName = $f;
    $this->lastName = $l;
    $this->birthNumber = $b;
    $this->saveMember();
  }

  /*
   * Getters
   */

   public function getFullName(){
     return $this->firstName . " " . $this->lastName;
   }

   public function getFirstName(){
     return $this->firstName;
   }

   public function getLastName(){
     return $this->lastName;
   }

   public function getBirthNumber(){
     return $this->birthNumber;
   }

   public function getId(){
     return $this->id;
   }

   /*
    * Setters
    */
    public function setFirstName($n){
      $this->firstName = $n;
    }

    public function setLastName($n){
      $this->lastName = $n;
    }

    public function setBirthNumber($n){
      $this->birthNumber = $n;
    }

    /*
     * Other methods
     */
    public function saveMember() {
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      $new_member_array = json_encode($this);
      array_push($array,$new_member_array);
      $json_string = json_encode($array);
      file_put_contents(Member::data_src, $json_string);
    }
}
