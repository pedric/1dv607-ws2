<?php
include_once 'partials/header.php';
include_once 'controller/appcontroller.php';
include_once 'controller/formHandler.php';

if (isset($alert)) {
  echo '<div class="alert">' . $alert . '</div>';
}
?>
<div style="background:#000;">
  <header class="container">
    <ul>
      <li><a href="/?form=addMemberForm">add Member</a></li>
      <li><a href="/">List view</a></li>
    </ul>
  </header>
</div>
<?php
echo '<div class="container">';

if($form) {
  include_once 'view/' . $form . '.php';
}
include_once 'view/lists.php';
echo '</div>';
include_once 'partials/footer.php';
