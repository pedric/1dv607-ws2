<?php

class Member {
  public $id;
  public $firstName;
  public $lastName;
  public $birthNumber;
  public $boat;
  const data_src = 'resources/members.json';

  public function __construct($f = null,$l = null,$b = null) {
    $this->id = uniqid();
    if(isset($f)){$this->firstName = $f;}
    if(isset($l)){$this->lastName = $l;}
    if(isset($b)){$this->birthNumber = $b;}
    if($f && $l && $b){$this->saveMember();}
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
    public function saveMember(){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      $new_member_array = array(
        'id'=>$this->id,
        'firstName'=>$this->firstName,
        'lastName'=>$this->lastName,
        'birthNumber'=>$this->birthNumber,
        'boats'=>array(

        ));
      array_push($array,$new_member_array);
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    public function addBoat($oId,$boat){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $oId){
          array_push($array[$i]['boats'],$boat);
        }
      }
      $json_string = json_encode($array,JSON_PRETTY_PRINT);
      file_put_contents(Member::data_src, $json_string);
    }

    public function deleteMember($id){
      $file = file_get_contents(Member::data_src);
      $array = json_decode($file,true);
      $deleted_members_name = null;
      for($i = 0; $i < count($array);$i++){
        if($array[$i]['id'] == $id){
          $deleted_members_name = $array[$i]['firstName'] . " " . $array[$i]['lastName'];
          array_splice($array,$i);
        }
      }
      $json_string = json_encode($array);
      file_put_contents(Member::data_src, $json_string);
    }

    public function updateMember($id,$f = null,$l = null,$b = null){
        $file = file_get_contents(Member::data_src);
        $array = json_decode($file,true);
        for($i = 0; $i < count($array);$i++){
          if($array[$i]['id'] == $id){
            if(isset($f)){$array[$i]['firstName'] = $f;}
            if(isset($l)){$array[$i]['lastName'] = $l;}
            if(isset($b)){$array[$i]['birthDate'] = $b;}
          }
        }
        $json_string = json_encode($array,JSON_PRETTY_PRINT);
        file_put_contents(Member::data_src, $json_string);
    }

    public function getMember($id){
        $file = file_get_contents(Member::data_src);
        $array = json_decode($file,true);
        $hit = false;
        for($i = 0; $i < count($array);$i++){
          if($array[$i]['id'] == $id){
            $hit = $array[$i];
          }
        }
        return $hit;
    }
}
