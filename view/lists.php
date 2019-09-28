<?php
$list = new MembershipList();
$verbose_data = $list->verboseList();
$compact_data = $list->compactList();

echo '<div class="listWrapper">';
echo '<div class="toggleListBtn__container"><span class="toggleListBtn active" data-show="compactList">Compact list</span><span class="toggleListBtn" data-show="verboseList">Verbose list (with edit options)</span></div>';

$output = '<div class="listContainer verboseList" style="display:none;">';
$output .= '<h4 style="margin-top: 20px;">Verbose list</h4>';
foreach ($verbose_data as $item) {
  $output .= '<div class="listItem">';
  $output .= '<span>' . $item['name'] . '</span>';
  $output .= '<span> (Member id: ' . $item['id'] . ')</span>';
  $output .= '<a class="button button--small button-primary" href="/?form=editMemberForm&firstName=' . $item['firstName'] .'&lastName=' . $item['lastName'] . '&birthNumber=' . $item['birthNumber'] . '&memberId=' . $item['id'] . '&boats=' . $item['boats'] . '">Edit member</a>';
  $output .= '<a class="button button-alert button--small button-primary" href="/?formtype=deleteMember&memberId=' . $item['id'] . '">Delete member</a>';
  $output .= '<div>';
  foreach ($item['boats'] as $boat){
    $output .= '<div><span>' . $boat['type']  . '</span>';
    $output .= '<span> ' . $boat['length'] . ' foot</span>';
    $output .= '<span> (Boat id: ' . $boat['id'] . ')</span><a class="button button-alert button--small button-primary" href="/?formtype=deleteBoat&ownerId=' . $item['id'] . '&boatId=' . $boat['id'] . '">Delete boat</a></div>';
  }
  $output .= '<div class="editPanel">';
  $output .= '<a class="button button--small button-primary" href="/?form=addBoatForm&ownerId=' . $item['id'] . '&name=' . $item['name'] . '">Add boat</a>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
}
$output .= '</div>';

echo $output;

$output = '';
$output = '<div class="listContainer compactList">';
$output .= '<h4 style="margin-top: 20px;">Compact list</h4>';
foreach ($compact_data as $item) {
  $output .= '<div class="listItem">';
  $output .= '<span>' . $item['name'] . '</span>';
  $output .= '<span> ' . $item['num_boats'] . '  Boats</span>';
  $output .= '<span> (member id: ' . $item['id'] . ')</span>';
  $output .= '</div>';
}
$output .= '</div>';

echo $output;
echo '</div>';
