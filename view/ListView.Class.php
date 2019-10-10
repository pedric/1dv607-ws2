<?php

/**
* FormView
*
* @package  view
* @author   fl222uw
*/
class ListView {

  private $memberShipList;
  private $verbose_data;
  private $compact_data;

  public function __construct() {
      $this->memberShipList = new MembershipList();
      $this->verbose_data = $this->memberShipList->verboseList();
      $this->compact_data = $this->memberShipList->compactList();
  }

  /**
  * Returns a verbose list as formatted string
  *
  * @return String
  */
  public function getVerboseList() {
    $output = '<div class="listWrapper">';
    $output .= '<div class="toggleListBtn__container"><span class="toggleListBtn" data-show="compactList">Compact list</span><span class="toggleListBtn active" data-show="verboseList">Verbose list (with edit options)</span></div>';

    $output .= '<div class="listContainer verboseList">';
    $output .= '<h4 style="margin-top: 20px;">Verbose list</h4>';
    foreach ($this->verbose_data as $item) {
      $output .= '<div class="listItem">';
      $output .= '<span><strong>' . $item['name'] . '</strong></span>';
      $output .= '<span>, birthNumber: ' . $item['birthNumber'] . '</span>';
      $output .= '<span>, member id: ' . $item['id'] . '</span>';
      $output .= '<a class="button button--small button-primary" href="/?form=editMemberForm&firstName=' . $item['firstName'] .'&lastName=' . $item['lastName'] . '&birthNumber=' . $item['birthNumber'] . '&memberId=' . $item['id'] . '">Edit member</a>';
      $output .= '<a class="button button-alert button--small button-primary" href="/?formtype=deleteMember&memberId=' . $item['id'] . '">Delete member</a>';
      $output .= '<div>';
      foreach ($item['boats'] as $boat){
        $output .= '<div><strong>Boats</strong></div>';
        $output .= '<div><span>' . $boat['type']  . '</span>';
        $output .= '<span> ' . $boat['length'] . ' foot</span>';
        $output .= '<span> (Boat id: ' . $boat['id'] . ')</span>';
        $output .= '<a class="button button--small button-primary" href="/?form=updateBoatForm&id=' . $boat['id'] .'&ownerId=' . $item['id'] . '&type=' . $boat['type'] . '&length=' . $boat['length'] . '">Edit boat</a>';
        $output .= '<a class="button button-alert button--small button-primary" href="/?formtype=deleteBoat&ownerId=' . $item['id'] . '&boatId=' . $boat['id'] . '">Delete boat</a></div>';
      }
      $output .= '<div class="editPanel">';
      $output .= '<a class="button button--small button-primary" href="/?form=addBoatForm&ownerId=' . $item['id'] . '&name=' . $item['name'] . '">Add boat</a>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';

    return $output;
  }

  /**
  * Returns a compact list as formatted string
  *
  * @return String
  */
  public function getCompactList() {
      $output = '<div class="listContainer compactList" style="display:none;">';
      $output .= '<h4 style="margin-top: 20px;">Compact list</h4>';
      foreach ($this->compact_data as $item) {
        $output .= '<div class="listItem">';
        $output .= '<span>' . $item['name'] . '</span>';
        $output .= '<span> ' . $item['num_boats'] . '  Boats</span>';
        $output .= '<span> (member id: ' . $item['id'] . ')</span>';
        $output .= '</div>';
      }
      $output .= '</div>';
      $output .= '</div>';

      return $output;
  }
}
