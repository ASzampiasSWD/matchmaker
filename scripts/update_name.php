<?php
  include '../functions.php';

  if ($_POST['currentAnonymousValue'] == 1) {
    updateAnonymousValue(0, $_POST['person_id']);
  } else {
    updateAnonymousValue(1, $_POST['person_id']);
  }

  updateButtonClicks($_POST['person_id']);
  header('Refresh: 0; URL = ../index.php?amazoncardcode=' . $_POST['url_code']);

?>
