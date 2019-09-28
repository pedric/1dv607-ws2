<?php
include './model/Member.Class.php';
include './model/MembershipList.Class.php';
include './model/Boat.Class.php';

$form = false;
if (isset($_REQUEST['form'])) {
  $form = $_REQUEST['form'];
}

include './partials/header.php';
// include './controller/appcontroller.php';
include './controller/formHandler.php';

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
      include './view/' . $form . '.php';
    }
    include './view/lists.php';
    ?>
    </div>
  <script src="/assets/js/main.js"></script>
  </body>
</html>
