<?php
include('advocate_session.php');

if(isset($_POST['add_child'])) {
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];
  $last_name = $_POST['last_name'];
  $siblings = "";
  for ($i=0; $i < $_POST['number_of_siblings']; $i++) {
    $siblings .= $_POST['sibling_name_'.($i + 1)].";";
  }
  $birthday = $_POST['birthday'];
  $sex = $_POST['sex'];
  $school = $_POST['school'];
  $school_address = $_POST['school_address'];
  $grade_level = $_POST['grade_level'];
  $cause_of_blindness = $_POST['cause_of_blindness'];
  $vision_left = $_POST['vision_left'];
  $vision_right = $_POST['vision_right'];
  $additional_disabilities = $_POST['additional_disabilities'];
  $special_needs_owned = ($_POST['adaptive_lens'] == ";"? "" : $_POST['adaptive_lens'].";").($_POST['artificial_eyes'] == ";"? "" : $_POST['artificial_eyes'].";").($_POST['white_cane'] == ";"? "" : $_POST['white_cane'].";").($_POST['wheel_chair'] == ";"? "" : $_POST['wheel_chair'].";").($_POST['hearing_id'] == ";"? "" : $_POST['hearing_id'].";");
  $learning_tools_owned = ($_POST['stylus'] == ";"? "" : $_POST['stylus'].";").($_POST['computer'] == ";"? "" : $_POST['computer'].";").($_POST['cctv'] == ";"? "" : $_POST['cctv'].";").($_POST['largePrints'] == ";"? "" : $_POST['largePrints'].";").($_POST['abacus'] == ";"? "" : $_POST['abacus'].";").($_POST['brailer'] == ";"? "" : $_POST['brailer'].";");
  $physical_therapy = $_POST['physical_therapy'];
  $occupational_therapy = $_POST['occupational_therapy'];
  $speech_therapy = $_POST['speech_therapy'];
  $other_needs = $_POST['other_needs'];
  $id_picture = addslashes(file_get_contents($_FILES['id_picture']['tmp_name']));
  $family_picture = addslashes(file_get_contents($_FILES['family_picture']['tmp_name']));
  $medical_history = addslashes(file_get_contents($_FILES['medical_history']['tmp_name']));
  $medical_history_mime_type = $_FILES['medical_history']['type'];
  $medical_history_file_name = $_FILES['medical_history']['name'];

  $sql = "INSERT INTO pavic_children(advocate_id, first_name, middle_name, last_name, siblings, birthday, sex, school, school_address, grade_level, cause_of_blindness, vision_left, vision_right, additional_disabilities, special_needs_owned, learning_tools_owned, physical_therapy, occupational_therapy, speech_therapy, other_needs, id_picture, family_picture, medical_history,medical_history_mime_type, medical_history_file_name) VALUES ($advocate_id, '$first_name', '$middle_name', '$last_name', '$siblings', '$birthday', '$sex', '$school', '$school_address', '$grade_level', '$cause_of_blindness', '$vision_left', '$vision_right', '$additional_disabilities', '$special_needs_owned', '$learning_tools_owned', '$physical_therapy', '$occupational_therapy', '$speech_therapy', '$other_needs', '{$id_picture}', '{$family_picture}', '{$medical_history}', '$medical_history_mime_type', '$medical_history_file_name')";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../profile.php');

  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=1');
  }

  $mysqli->close();
}
?>
