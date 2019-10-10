<?php
/* Include header + all classes used for application */
include 'model/Member.Class.php';
include 'model/MembershipList.Class.php';
include 'model/Boat.Class.php';
include 'partials/header.php';
include 'controller/form.Class.php';
include 'view/ListView.Class.php';
include 'view/FormView.Class.php';

/* If a form is submitted the Form class will handle the request */
if(isset($_REQUEST['formtype'])) {
  $form_type = $_REQUEST['formtype'];
  $submittedForm = new Form($form_type);
  $submittedForm->handleFormSubmission($form_type);
  $alertMessage = $submittedForm->getAlertMessage($form_type);
  /* Form class generates a feedback message of the operation to the user (from form submission) */
  echo '<div class="alert">' . $alertMessage . '</div>';
}

?>
    <div class="header-wrapper">
      <header class="container">
        <ul>
          <li><a href="/?form=addMemberForm">add Member</a></li>
          <li><a href="/">List view</a></li>
        </ul>
      </header>
    </div>
    <div class="container">
      <?php
      /* If a type of form is passed as a url-parameter it will get rendered in the FormView class */
      if(isset($_REQUEST['form'])) {
        $form = $_REQUEST['form'];
        $form = new FormView($form);
        $markup = $form->getForm();
        echo $markup;
      }
      /* Get lists markup from the ListView class */
      $list = new ListView();
      $compact_list = $list->getVerboseList();
      $verbose_list = $list->getCompactList();
      echo $compact_list;
      echo $verbose_list;

      ?>
    </div>
    <script src="/assets/js/main.js"></script>
  </body>
</html>
