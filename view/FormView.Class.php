<?php

class FormView {

  private $form;
  private $name;
  private $firstName;
  private $lastName;
  private $ownerId;
  private $boatId;
  private $boatType;
  private $birthNumber;
  private $memberId;
  private $member_info = array();

  public function __construct($f) {
      $this->form = $f;
      $this->name = isset($_GET['name']) ? $_GET['name'] : "" ;
      $this->ownerId = isset($_GET['ownerId']) ? $_GET['ownerId'] : "" ;
      $this->boatId = isset($_GET['id']) ? $_GET['id'] : "" ;
      $this->boatType = isset($_GET['type']) ? $_GET['type'] : "" ;
      $this->firstName = isset($_GET['firstName']) ? $_GET['firstName'] : "" ;
      $this->lastName = isset($_GET['lastName']) ? $_GET['lastName'] : "" ;
      $this->birthNumber = isset($_GET['birthNumber']) ? $_GET['birthNumber'] : "" ;
      $this->memberId = isset($_GET['memberId']) ? $_GET['memberId'] : "" ;
      $this->members_boats = isset($_GET['memberId']) ? Form::getMembersBoats($_GET['memberId']) : false ;
      $this->member_info = isset($_GET['memberId']) ? Form::getMemberData($_GET['memberId']) : false ;
  }

  public function getMemberSummary() {
    $member_summary = '<div style="padding-bottom:1em;">';
    if($this->member_info) {
        $member_summary .= '<div><strong>Current info</strong></div>';
          $member_summary .= '<div><strong>Name:</strong> ' . $this->member_info['firstName'] . ' ' . $this->member_info['lastName'] . '</div>';
          $member_summary .= '<div><strong>Birth number:</strong> ' . $this->member_info['birthNumber'] . '</div>';
          $member_summary .= '<div><strong>Boats:</strong> ' . count($this->members_boats) . '</div>';
    }
    $member_summary .= '</div>';
    return $member_summary;
  }

  public function getForm() {

    $form_markup = "";

    if($this->form == "addBoatForm") {
      $form_markup = '<h3>Add new boat for ' . $this->name . '</h3>
                      <form action="/">

                      <label>Type of boat</label>
                      <select name="type">
                        <option value="other">Other</option>
                        <option value="sailboat">Sailboat</option>
                        <option value="motorsailer">Motorsailer</option>
                        <option value="kayak or Canoe">Kayak or Canoe</option>
                      </select>

                      <div>
                      <label>Length (foot)</label>
                      <input type="number" name="length" required>
                      </div>

                      <input type="hidden" name="formtype" value="addBoat">
                      <input type="hidden" name="ownerId" value="'.$this->ownerId.'">

                      <input class="button-primary" type="submit" value="Add boat">

                      </form>';

    } else if($this->form == "addMemberForm") {
      $form_markup = '<h3>Add new member</h3>
                      <form action="/">

                      <div>
                      <label>First name</label>
                      <input type="text" name="firstName" required>
                      </div>

                      <div>
                      <label>Last name</label>
                      <input type="text" name="lastName" required>
                      </div>

                      <div>
                      <label>Birth number <span class="thin-text">(format:XXXXXXXXXX)</span></label>
                      <input type="text" name="birthNumber" maxlength="10" required>
                      </div>

                      <input type="hidden" name="formtype" value="addMember">

                      <input class="button-primary member-btn" type="submit" value="Add member">

                      </form>';
    } else if($this->form == "editMemberForm") {

      $form_markup = '<h3>Edit member '.$this->firstName.' '.$this->lastName.'</h3>' . $this->getMemberSummary() .
                      '<form action="/">

                      <div>
                      <label>First name</label>
                      <input type="text" name="firstName" value="'.$this->firstName.'" required>
                      </div>

                      <div>
                      <label>Last name</label>
                      <input type="text" name="lastName" value="'.$this->lastName.'" required>
                      </div>

                      <div>
                      <label>Birth number</label>
                      <input type="text" name="birthNumber" maxlength="10" value="'.$this->birthNumber.'" required>
                      </div>

                      <input type="hidden" name="memberId" value="'.$this->memberId.'">
                      <input type="hidden" name="formtype" value="editMember">

                      <input class="button-primary member-btn" type="submit" value="Update member">

                      </form>';
    } else if($this->form == "updateBoatForm") {
      $form_markup = '<h3>Edit boat: '.$this->boatId.'</h3>
                      <form action="/">

                      <label>Type of boat (Currently registered as '.$this->boatType.')</label>
                      <select name="type">
                        <option value="other" '.($this->boatType == "other" ? "selected" : "" ).'>Other</option>
                        <option value="sailboat" '.($this->boatType == "sailboat" ? "selected" : "" ).'>Sailboat</option>
                        <option value="motorsailer" '.($this->boatType == "motorsailer" ? "selected" : "" ).'>Motorsailer</option>
                        <option value="kayak or Canoe" '.($this->boatType == "kayak or Canoe" ? "selected" : "" ).'>Kayak or Canoe</option>
                      </select>

                      <div>
                      <label>Length (foot)</label>
                      <input type="number" name="length" value="'.$_GET['length'].'" required>
                      </div>

                      <input type="hidden" name="formtype" value="updateBoat">
                      <input type="hidden" name="ownerId" value="'.$this->ownerId.'">
                      <input type="hidden" name="id" value="'.$this->boatId.'">

                      <input class="button-primary" type="submit" value="Update boat">

                      </form>';
    }else {
      $form_markup = "Error: invalid form value, try to reload page or go back to start.";
    }

    return $form_markup;

  }

}
