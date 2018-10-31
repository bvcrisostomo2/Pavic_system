<?php
include('advocate_session.php');

if(isset($_POST['edit_child'])) {
  $child_id = $_POST['child_id'];
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
  if ($_FILES['id_picture']['size'] != 0) {
    $id_picture = addslashes(file_get_contents($_FILES['id_picture']['tmp_name']));
    $isset_id_picture = ",id_picture='{$id_picture}'";
  }else{
    $isset_id_picture = "";
  }
  if ($_FILES['family_picture']['size'] != 0) {
    $family_picture = addslashes(file_get_contents($_FILES['family_picture']['tmp_name']));
    $isset_family_picture = ",family_picture='{$family_picture}'";
  }else{
    $isset_family_picture = "";
  }
  if ($_FILES['medical_history']['size'] != 0) {
    $medical_history = addslashes(file_get_contents($_FILES['medical_history']['tmp_name']));
    $medical_history_mime_type = $_FILES['medical_history']['type'];
    $medical_history_file_name = $_FILES['medical_history']['name'];
    $isset_medical_history = ",medical_history='{$medical_history}',medical_history_mime_type='$medical_history_mime_type',medical_history_file_name='$medical_history_file_name'";
  }else{
    $isset_medical_history = "";
  }

  $sql = "UPDATE pavic_children SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',siblings='$siblings',birthday='$birthday',sex='$sex',school='$school',school_address='$school_address',grade_level='$grade_level',cause_of_blindness=$cause_of_blindness,vision_left='$vision_left',vision_right='$vision_right',additional_disabilities='$additional_disabilities',special_needs_owned='$special_needs_owned',learning_tools_owned='$learning_tools_owned',physical_therapy='$physical_therapy',occupational_therapy='$occupational_therapy',speech_therapy='$speech_therapy',other_needs='$other_needs' $isset_id_picture $isset_family_picture $isset_medical_history WHERE child_id = $child_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../profile.php');

  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=2&child_id='.$child_id);
  }

  $mysqli->close();
}
?>
