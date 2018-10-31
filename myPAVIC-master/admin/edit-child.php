<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_children WHERE child_id = ".$_GET['child_id'].";";

$result = $mysqli->query($sql);

if($result->num_rows == 1){
  $row = $result->fetch_assoc();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Child - PAVIC</title>

    <?php include('includes/links.php'); ?>
  </head>

  <body cz-shortcut-listen="true">

    <?php include 'includes/navbar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="overview.php">Overview</a></li>
            <?php if ($admin_info['head']) { ?>
            <li><a href="administrators.php">Administrators</a></li>
            <?php } ?>
            <li><a href="children.php">Children</a></li>
            <li class="active"><a href="#">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><a href="advocates.php">Advocates</a> / <a href="advocate-profile.php?advocate_id=<?php echo $_GET['advocate_id']; ?>">Advocate Profile</a> / Edit Child</h1>
          <div class="row">
            <div class="col-xs-12">
              <form class="" action="php/do_edit_child.php" method="post"  enctype="multipart/form-data">
                <input type="text" name="child_id" value="<?php echo $_GET['child_id']; ?>" hidden>
                <input type="text" name="advocate_id" value="<?php echo $_GET['advocate_id']; ?>" hidden>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-primary">
                      <div class="panel-heading">A. Child and Family Personal Data</div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Child's ID Picture</h4>
                          </div>

                          <div class="col-md-9">
                            <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"><img src="<?php echo "data:image/png;base64, ".base64_encode($row['id_picture']); ?>" alt=""></div>
                              <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="id_picture"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Child's Name</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="first_name">First Name:</label>
                                  <input required type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="middle_name">Middle Name:</label>
                                  <input required type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="last_name">Last Name:</label>
                                  <input required type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <?php
                            $siblings = explode(';', $row['siblings']);
                            $number_of_siblings = sizeof($siblings) - 1;
                          ?>
                          <div class="col-md-3 master-label align-middle">
                            <h4>Names of Brothers and Sisters</h4>
                          </div>
                          <div class="col-md-9">
                            <button type="button" name="addSiblingButton" id="addSiblingButton" class="btn btn-default">Add Sibling</button>
                            <button type="button" name="removeSiblingButton" id="removeSiblingButton" class="btn btn-warning" <?php echo $number_of_siblings == 0? "disabled" : ""?>>Remove Sibling</button>
                            <br><br>
                            <span id="appendSiblingHere"></span>
                            <?php
                              for ($i=0; $i < $number_of_siblings; $i++) {
                            ?>
                            <div class="form-group appendedSiblings">
                              <label for="sibling_name"><?php echo $i + 1; ?>. Full Name:</label>
                              <input required type="text" name="sibling_name_<?php echo $i + 1; ?>" id="sibling_name_<?php echo $i + 1; ?>" value="<?php echo $siblings[$i]; ?>" class="form-control">
                            </div>
                            <?php
                              }
                            ?>
                            <input required type="text" name="number_of_siblings" id="number_of_siblings" value="<?php echo $number_of_siblings; ?>" hidden/>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Family Picture</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"><img src="<?php echo "data:image/png;base64, ".base64_encode($row['family_picture']); ?>" alt=""></div>
                              <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="family_picture"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-primary">
                      <div class="panel-heading">B. The Child's Data</div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Date of Birth</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <input required type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $row['birthday']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Sex</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="radio">
                                <label><input required type="radio" name="sex" value="Male" <?php echo $row['sex'] == 'Male'? "checked" : ""; ?>>Male</label>
                              </div>
                              <div class="radio">
                                <label><input required type="radio" name="sex" value="Female" <?php echo $row['sex'] == 'Female'? "checked" : ""; ?>>Female</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>School</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <input required type="text" class="form-control" id="school" name="school" value="<?php echo $row['school']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Address of School</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <input required type="text" class="form-control" id="school_address" name="school_address" value="<?php echo $row['school_address']; ?>">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Grade Level</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control" name="grade_level" required>
                                <option value="" disabled>Choose Level</option>
                                <option value="Kindergarten" <?php echo $row['grade_level'] == "Kindergarten"? "selected" : ""; ?>>Kindergarten</option>
                                <option value="Pre-School" <?php echo $row['grade_level'] == "Pre-School"? "selected" : ""; ?>>Pre-School</option>
                                <option value="Grade 1" <?php echo $row['grade_level'] == "Grade 1"? "selected" : ""; ?>>Grade 1</option>
                                <option value="Grade 2" <?php echo $row['grade_level'] == "Grade 2"? "selected" : ""; ?>>Grade 2</option>
                                <option value="Grade 3" <?php echo $row['grade_level'] == "Grade 3"? "selected" : ""; ?>>Grade 3</option>
                                <option value="Grade 4" <?php echo $row['grade_level'] == "Grade 4"? "selected" : ""; ?>>Grade 4</option>
                                <option value="Grade 5" <?php echo $row['grade_level'] == "Grade 5"? "selected" : ""; ?>>Grade 5</option>
                                <option value="Grade 6" <?php echo $row['grade_level'] == "Grade 6"? "selected" : ""; ?>>Grade 6</option>
                                <option value="Grade 7" <?php echo $row['grade_level'] == "Grade 7"? "selected" : ""; ?>>Grade 7</option>
                                <option value="Grade 8" <?php echo $row['grade_level'] == "Grade 8"? "selected" : ""; ?>>Grade 8</option>
                                <option value="Grade 9" <?php echo $row['grade_level'] == "Grade 9"? "selected" : ""; ?>>Grade 9</option>
                                <option value="Grade 10" <?php echo $row['grade_level'] == "Grade 10"? "selected" : ""; ?>>Grade 10</option>
                                <option value="Grade 11" <?php echo $row['grade_level'] == "Grade 11"? "selected" : ""; ?>>Grade 11</option>
                                <option value="Grade 12" <?php echo $row['grade_level'] == "Grade 12"? "selected" : ""; ?>>Grade 12</option>
                                <option value="College" <?php echo $row['grade_level'] == "College"? "selected" : ""; ?>>College</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <?php
                            $sql = "SELECT * FROM pavic_cause_of_blindness";

                            $result = $mysqli->query($sql);

                            $cause_of_blindness = [];
                            while($row_2 = $result->fetch_assoc()){
                              $cause_of_blindness[] = $row_2;
                            }
                          ?>
                          <div class="col-md-3 master-label align-middle">
                            <h4>Cause of Blindness</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <select class="form-control" name="cause_of_blindness" required>
                                <option value="" disabled>Choose Cause of Blindness</option>
                                <?php
                                  for ($i=0; $i < sizeof($cause_of_blindness); $i++) {
                                ?>
                                  <option value="<?php echo $cause_of_blindness[$i]['id'] ?>" <?php echo $cause_of_blindness[$i]['id'] == $row['cause_of_blindness']? "selected" : ""; ?>><?php echo $cause_of_blindness[$i]['cause'] ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Vision</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <table class="table" id="vision">
                                <tbody>
                                  <tr>
                                    <td>
                                      <label for="left"><small>Left</small></label>
                                    </td>
                                    <td id="left">
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_left" value="Totally Blind" <?php echo $row['vision_left'] == "Totally Blind"? "checked" : ""; ?>>Totally Blind</label>
                                      </div>
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_left" value="Low Vision" <?php echo $row['vision_left'] == "Low Vision"? "checked" : ""; ?>>Low Vision</label>
                                      </div>
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_left" value="Normal" <?php echo $row['vision_left'] == "Normal"? "checked" : ""; ?>>Normal</label>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <label for="right"><small>Right</small></label>
                                    </td>
                                    <td id="right">
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_right" value="Totally Blind" <?php echo $row['vision_right'] == "Totally Blind"? "checked" : ""; ?>>Totally Blind</label>
                                      </div>
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_right" value="Low Vision" <?php echo $row['vision_right'] == "Low Vision"? "checked" : ""; ?>>Low Vision</label>
                                      </div>
                                      <div class="radio">
                                        <label class="checkbox-inline"><input required type="radio" name="vision_right" value="Normal" <?php echo $row['vision_right'] == "Normal"? "checked" : ""; ?>>Normal</label>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Additional Disabilities</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <textarea name="additional_disabilities" id="additional_isabilities" rows="3" cols="40" class="form-control" placeholder="Please Indicate"><?php echo $row['additional_disabilities']; ?></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Scanned Medical History</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-exists" data-provides="fileinput">
                              <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="medical_history"></span>
                              <span class="fileinput-filename"><?php echo $row['medical_history_file_name']; ?></span>
                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-primary">
                      <div class="panel-heading">C. Needs of the Child</div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Special Needs</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <label for="">Owned:</label>
                              <table class="table" id="specialNeeds">
                                <tbody>
                                  <tr>
                                    <td>
                                      <label for="adaptive_lens"><small>Adaptive Lens</small></label>
                                    </td>
                                    <td id="adaptive_lens">
                                      <label class="radio-inline"><input required type="radio" name="adaptive_lens" value="Adaptive Lens" <?php echo substr_count($row['special_needs_owned'], "Adaptive Lens") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="adaptive_lens" value=";" <?php echo substr_count($row['special_needs_owned'], "Adaptive Lens") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="artificial_eyes"><small>Artificial Eyes</small></label>
                                    </td>
                                    <td id="artificial_eyes">
                                      <label class="radio-inline"><input required type="radio" name="artificial_eyes" value="Artificial Eyes" <?php echo substr_count($row['special_needs_owned'], "Artificial Eyes") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="artificial_eyes" value=";" <?php echo substr_count($row['special_needs_owned'], "Artificial Eyes") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="white_cane"><small>White Cane</small></label>
                                    </td>
                                    <td id="white_cane">
                                      <label class="radio-inline"><input required type="radio" name="white_cane" value="White Cane" <?php echo substr_count($row['special_needs_owned'], "White Cane") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="white_cane" value=";" <?php echo substr_count($row['special_needs_owned'], "White Cane") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="wheel_chair"><small>Wheel Chair</small></label>
                                    </td>
                                    <td id="wheel_chair">
                                      <label class="radio-inline"><input required type="radio" name="wheel_chair" value="Wheel Chair" <?php echo substr_count($row['special_needs_owned'], "Wheel Chair") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="wheel_chair" value=";" <?php echo substr_count($row['special_needs_owned'], "Wheel Chair") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="hearing_id"><small>Hearing Aid</small></label>
                                    </td>
                                    <td id="hearing_id">
                                      <label class="radio-inline"><input required type="radio" name="hearing_id" value="Hearing Aid" <?php echo substr_count($row['special_needs_owned'], "Hearing Aid") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="hearing_id" value=";" <?php echo substr_count($row['special_needs_owned'], "Hearing Aid") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Learning Tools</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <label for="">Owned:</label>
                              <table class="table" id="learningTools">
                                <tbody>
                                  <tr>
                                    <td>
                                      <label for="stylus"><small>Stylus</small></label>
                                    </td>
                                    <td id="stylus">
                                      <label class="radio-inline"><input required type="radio" name="stylus" value="Stylus" <?php echo substr_count($row['learning_tools_owned'], "Stylus") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="stylus" value=";" <?php echo substr_count($row['learning_tools_owned'], "Stylus") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <label for="computer"><small>Computer w/ screen reading program</small></label>
                                    </td>
                                    <td id="computer">
                                      <label class="radio-inline"><input required type="radio" name="computer" value="Computer w/ screen reading program" <?php echo substr_count($row['learning_tools_owned'], "Computer w/ screen reading program") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="computer" value=";" <?php echo substr_count($row['learning_tools_owned'], "Computer w/ screen reading program") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="cctv"><small>CCTV</small></label>
                                    </td>
                                    <td id="cctv">
                                      <label class="radio-inline"><input required type="radio" name="cctv" value="CCTV" <?php echo substr_count($row['learning_tools_owned'], "CCTV") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="cctv" value=";" <?php echo substr_count($row['learning_tools_owned'], "CCTV") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="largePrints"><small>Large Prints</small></label>
                                    </td>
                                    <td id="largePrints">
                                      <label class="radio-inline"><input required type="radio" name="largePrints" value="Large Prints" <?php echo substr_count($row['learning_tools_owned'], "Large Prints") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="largePrints" value=";" <?php echo substr_count($row['learning_tools_owned'], "Large Prints") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="abacus"><small>Abacus</small></label>
                                    </td>
                                    <td id="abacus">
                                      <label class="radio-inline"><input required type="radio" name="abacus" value="Abacus" <?php echo substr_count($row['learning_tools_owned'], "Abacus") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="abacus" value=";" <?php echo substr_count($row['learning_tools_owned'], "Abacus") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="brailer"><small>Brailer</small></label>
                                    </td>
                                    <td id="brailer">
                                      <label class="radio-inline"><input required type="radio" name="brailer" value="Brailer" <?php echo substr_count($row['learning_tools_owned'], "Brailer") == 0? "" : "checked"; ?>>Yes</label>
                                      <label class="radio-inline"><input required type="radio" name="brailer" value=";" <?php echo substr_count($row['learning_tools_owned'], "Brailer") == 0? "checked" : ""; ?>>No</label>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Therapy Service</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <table class="table" id="therapyService">
                                <tbody>
                                  <tr>
                                    <td>
                                      <label for="physicalTherapy"><small>Physical Therapy</small></label>
                                    </td>
                                    <td id="physicalTherapy">
                                      <label class="radio-inline"><input required type="radio" name="physical_therapy" value="PAVIC Program" <?php echo $row['physical_therapy'] == "PAVIC Program"? "checked": ""; ?>>PAVIC Program</label>
                                      <label class="radio-inline"><input required type="radio" name="physical_therapy" value="Self Pay" <?php echo $row['physical_therapy'] == "Self Pay"? "checked": ""; ?>>Self Pay</label>
                                      <label class="radio-inline"><input required type="radio" name="physical_therapy" value="No Therapy" <?php echo $row['physical_therapy'] == "No Therapy"? "checked": ""; ?>>No Therapy</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="occupationalTherapy"><small>Occupational Therapy</small></label>
                                    </td>
                                    <td id="occupationalTherapy">
                                      <label class="radio-inline"><input required type="radio" name="occupational_therapy" value="PAVIC Program" <?php echo $row['occupational_therapy'] == "PAVIC Program"? "checked": ""; ?>>PAVIC Program</label>
                                      <label class="radio-inline"><input required type="radio" name="occupational_therapy" value="Self Pay" <?php echo $row['occupational_therapy'] == "Self Pay"? "checked": ""; ?>>Self Pay</label>
                                      <label class="radio-inline"><input required type="radio" name="occupational_therapy" value="No Therapy" <?php echo $row['occupational_therapy'] == "No Therapy"? "checked": ""; ?>>No Therapy</label>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>
                                      <label for="speechTherapy"><small>Speech Therapy</small></label>
                                    </td>
                                    <td id="speechTherapy">
                                      <label class="radio-inline"><input required type="radio" name="speech_therapy" value="PAVIC Program" <?php echo $row['speech_therapy'] == "PAVIC Program"? "checked": ""; ?>>PAVIC Program</label>
                                      <label class="radio-inline"><input required type="radio" name="speech_therapy" value="Self Pay" <?php echo $row['speech_therapy'] == "Self Pay"? "checked": ""; ?>>Self Pay</label>
                                      <label class="radio-inline"><input required type="radio" name="speech_therapy" value="No Therapy" <?php echo $row['speech_therapy'] == "No Therapy"? "checked": ""; ?>>No Therapy</label>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 master-label align-middle">
                            <h4>Other Conditions and Needs</h4>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <textarea name="other_needs" id="other_needs" rows="3" cols="40" class="form-control" placeholder="Please Indicate"><?php echo $row['other_needs']; ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <input type="submit" name="edit_child" value="Save" class="btn btn-primary bttn">
                      <a class="btn btn-danger bttn" href="profile.php">Cancel</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
