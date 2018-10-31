<?php
include 'php/admin_session.php';

if (isset($_GET['report_id']) && $_GET['report_id'] != 0) {
  $sql = "SELECT * FROM pavic_reports WHERE report_id = ".$_GET['report_id'];

  $result = $mysqli->query($sql);
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $sexCount = json_decode($row['sex'], true);
      $regionCount = json_decode($row['region'], true);
      $causeCount = json_decode($row['cause_of_blindness'], true);
      $visionLeftCount = json_decode($row['vision_left'], true);
      $visionRightCount = json_decode($row['vision_right'], true);
      $totallyBlindCount = json_decode($row['totally_blind'], true);
      $lowVisionCount = json_decode($row['low_vision'], true);
      $normalVisionCount = json_decode($row['normal_vision'], true);
      $comments = $row['comments'];
      $asof = date("F d, Y h:i a", strtotime($row['timestamp']));
    }
  }

}else{
  //payed advocates
  $sql = "SELECT * FROM pavic_advocates t1 WHERE CURDATE() <= (SELECT t2.expiration FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id AND t2.expiration IS NOT NULL ORDER BY t2.advocates_payment_id DESC LIMIT 1);";

  $result = $mysqli->query($sql);
  $advocates_ids = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $advocates_ids[] = $row['advocate_id'];
    }
  }

  $advocates_ids = implode(",",$advocates_ids);

  //sex
  $sql = "SELECT sex, COUNT(1) sexCount FROM pavic_children WHERE advocate_id IN($advocates_ids) GROUP BY sex";

  $result = $mysqli->query($sql);
  $sexCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $sexCount[] = $row;
    }
  }

  //region
  $sql = "SELECT t2.region, COUNT(1) regionCount FROM pavic_children t1, pavic_advocates t2 WHERE t1.advocate_id IN($advocates_ids) AND t1.advocate_id = t2.advocate_id GROUP BY t2.region";

  $result = $mysqli->query($sql);
  $regionCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $regionCount[] = $row;
    }
  }

  //cause
  $sql = "SELECT t2.cause, COUNT(1) causeCount FROM pavic_children t1, pavic_cause_of_blindness t2 WHERE t1.advocate_id IN($advocates_ids) AND t2.id = t1.cause_of_blindness GROUP BY t2.cause";

  $result = $mysqli->query($sql);
  $causeCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $causeCount[] = $row;
    }
  }

  //left eye
  $sql = "SELECT vision_left, COUNT(1) visionLeftCount FROM pavic_children WHERE advocate_id IN($advocates_ids) GROUP BY vision_left";

  $result = $mysqli->query($sql);
  $visionLeftCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $visionLeftCount[] = $row;
    }
  }

  //right eye
  $sql = "SELECT vision_right, COUNT(1) visionRightCount FROM pavic_children WHERE advocate_id IN($advocates_ids) GROUP BY vision_right";

  $result = $mysqli->query($sql);
  $visionRightCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $visionRightCount[] = $row;
    }
  }

  //totally blind
  $sql = "SELECT 'Left' eye, COUNT(1) totallyBlindCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Totally Blind' AND vision_right <> 'Totally Blind' UNION ALL SELECT 'Right' eye, COUNT(1) totallyBlindCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_right = 'Totally Blind' AND vision_left <> 'Totally Blind' UNION ALL SELECT 'Both' eye, COUNT(1) totallyBlindCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Totally Blind' AND vision_right = 'Totally Blind'";

  $result = $mysqli->query($sql);
  $totallyBlindCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $totallyBlindCount[] = $row;
    }
  }

  //low vision
  $sql = "SELECT 'Left' eye, COUNT(1) lowVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Low Vision' AND vision_right <> 'Low Vision' UNION ALL SELECT 'Right' eye, COUNT(1) lowVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_right = 'Low Vision' AND vision_left <> 'Low Vision' UNION ALL SELECT 'Both' eye, COUNT(1) lowVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Low Vision' AND vision_right = 'Low Vision'";

  $result = $mysqli->query($sql);
  $lowVisionCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $lowVisionCount[] = $row;
    }
  }

  //normal vision
  $sql = "SELECT 'Left' eye, COUNT(1) normalVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Normal' AND vision_right <> 'Normal' UNION ALL SELECT 'Right' eye, COUNT(1) normalVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_right = 'Normal' AND vision_left <> 'Normal' UNION ALL SELECT 'Both' eye, COUNT(1) normalVisionCount FROM pavic_children WHERE advocate_id IN($advocates_ids) AND vision_left = 'Normal' AND vision_right = 'Normal'";

  $result = $mysqli->query($sql);
  $normalVisionCount = [];
  if(isset($result->num_rows)){
    while($row = $result->fetch_assoc()){
      $normalVisionCount[] = $row;
    }
  }

  $asof = date("F d, Y h:i a");

}
$sql = "SELECT * FROM pavic_reports ORDER BY timestamp DESC;";

$result = $mysqli->query($sql);
$reports = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $reports[] = $row;
  }
}

$sql = "SELECT * FROM pavic_regions";

$result = $mysqli->query($sql);

$regions = "";
while($row = $result->fetch_assoc()){
  $region = $row['long_name'];
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Report created.';
      break;
    case 2:
      $message = 'Report deleted.';
      break;
    default:
      # code...
      break;
  }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reports - PAVIC</title>

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
            <li><a href="advocates.php">Advocates</a></li>
            <li class="active"><a href="#">Reports</a></li>

            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Reports</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <div class="row">
                <div class="col-sm-12">
                  <h4>
                    <form action="reports.php" method="get" class="form-inline">
                      <div class="form-group">
                        <label for="report_id">Reports as of </label>
                        <select name="report_id" class="form-control" id="report_id">
                        <option value="0"><?php echo date("F d, Y h:i a"); ?> (Now)</option>
                        <?php for ($i=0; $i < sizeof($reports); $i++) { ?>
                          <option value="<?php echo $reports[$i]['report_id'] ?>" <?php echo isset($_GET['report_id']) && $_GET['report_id'] != 0? $_GET['report_id'] == $reports[$i]['report_id']? "selected" : "" : ""; ?>><?php echo date("F d, Y h:i a", strtotime($reports[$i]['timestamp'])) ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <!-- <input type="submit" name="" value="Show Report" class="btn btn-primary"> -->
                    </form>

                  </h4>
                  <h4>
                    <?php if(!isset($_GET['report_id']) || $_GET['report_id'] == 0){ ?><a href="#" data-toggle="modal" data-target="#report_modal" class="btn btn-primary">Create Report</a><?php }else{ ?><div class="pull-right"><a href="#" class="btn btn-primary" id="download_button">Download Report</a> <a href="php/do_remove_report.php?report_id=<?php echo $_GET['report_id']; ?>" class="btn btn-danger">Delete Report</a></div><?php } ?>
                  </h4>
                </div>
              </div>
              <br>
              <div id="report">
                <div id="report_part1">
                  <h3 class="page-header" id="report-name">Report as of <?php echo $asof; ?> <?php echo (!isset($_GET['report_id']) || $_GET['report_id'] == 0)? ' (Now)' : ''; ?></h3>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="sexChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="regionChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                </div>
                  <br>
                <div id="report_part2">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="causeChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                </div>
                  <br>
                <div id="report_part3">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="visionLeftChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="visionRightChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                </div>
                  <br>
                <div id="report_part4">
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="totallyBlindChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="lowVisionChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <div id="normalVisionChart" style="height: 300px; width: 100%;"></div>
                    </div>
                  </div>
                </div>
                <div id="report_part5">
                  <?php if(isset($_GET['report_id']) && $_GET['report_id'] != 0){ ?>
                    <div class="panel panel-default">
                      <div class="panel-heading">Report Comments</div>
                      <div class="panel-body">
                        <?php echo $comments; ?>
                      </div>
                    </div>
                    <?php } ?>
                </div>
              </div>
              <div id="editor"></div>
              <!-- <br><br>
              <div class="row">
                <div class="col-sm-12">
                  <h3 class="page-header">Generated Reports</h3>
                  <table id="reports_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Comments</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Remove</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for ($i=0; $i < sizeof($reports); $i++) { ?>
                      <tr <?php echo isset($_GET['report_id'])? $_GET['report_id'] == $reports[$i]['report_id']? 'class="active"' : '' : '' ?>>
                        <td><?php echo date("Y-m-d h:i:s a", strtotime($reports[$i]['timestamp'])); ?></td>
                        <td><?php echo $reports[$i]['comments']; ?></td>
                        <td class="text-center"><a href="reports.php?report_id=<?php echo $reports[$i]['report_id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        <td class="text-center"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></a></td>
                        <td class="text-center"><a href="php/do_remove_report.php?report_id=<?php echo $reports[$i]['report_id'] ?>"><i class="fa fa-times" aria-hidden="true"></a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="report_modal" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Report</h4>
          </div>
          <div class="modal-body">
            <form action="php/do_create_report.php" method="post">
              <textarea name="sex" rows="8" cols="80" hidden><?php echo json_encode($sexCount); ?></textarea>
              <textarea name="region" rows="8" cols="80" hidden><?php echo json_encode($regionCount); ?></textarea>
              <textarea name="cause_of_blindness" rows="8" cols="80" hidden><?php echo json_encode($causeCount); ?></textarea>
              <textarea name="vision_left" rows="8" cols="80" hidden><?php echo json_encode($visionLeftCount); ?></textarea>
              <textarea name="vision_right" rows="8" cols="80" hidden><?php echo json_encode($visionRightCount); ?></textarea>
              <textarea name="totally_blind" rows="8" cols="80" hidden><?php echo json_encode($totallyBlindCount); ?></textarea>
              <textarea name="low_vision" rows="8" cols="80" hidden><?php echo json_encode($lowVisionCount); ?></textarea>
              <textarea name="normal_vision" rows="8" cols="80" hidden><?php echo json_encode($normalVisionCount); ?></textarea>
              <textarea name="comments"class="form-control" rows="5" placeholder="Enter comments..."></textarea>
              <br>
              <div class="text-center">
                <input type="submit" name="create_report" value="Create Report" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

     <canvas id="report-canvas"></canvas>

    <?php include('includes/scripts.php'); ?>

    <script type="text/javascript">
      $(document).ready(function() {

        var sexChart = new CanvasJS.Chart("sexChart",
        	{
        		title:{
        			text: "Sex"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($sexCount); $i++) {
                    echo '{ y:'.$sexCount[$i]['sexCount'].',legendText: "'.$sexCount[$i]['sex'].'", label: "'.$sexCount[$i]['sex'].'"}'.($i+1 < sizeof($sexCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          sexChart.render();

        var causeChart = new CanvasJS.Chart("causeChart",
        	{
        		title:{
        			text: "Cause of Blindness"
        		},
        		// legend:{
        		// 	verticalAlign: "center",
        		// 	horizontalAlign: "left",
        		// 	fontSize: 20,
        		// 	fontFamily: "Helvetica"
        		// },
        		theme: "theme2",
        		data: [
        		{
        			type: "bar",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($causeCount); $i++) {
                    echo '{ y:'.$causeCount[$i]['causeCount'].',legendText: "'.$causeCount[$i]['cause'].'", label: "'.$causeCount[$i]['cause'].'"}'.($i+1 < sizeof($causeCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          causeChart.render();

        var regionChart = new CanvasJS.Chart("regionChart",
        	{
        		title:{
        			text: "Region"
        		},
        		// legend:{
        		// 	verticalAlign: "center",
        		// 	horizontalAlign: "left",
        		// 	fontSize: 20,
        		// 	fontFamily: "Helvetica"
        		// },
        		theme: "theme2",
        		data: [
        		{
        			type: "bar",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($regionCount); $i++) {
                    $sql = "SELECT * FROM pavic_regions WHERE region_id = ".$regionCount[$i]['region'];

                    $result = $mysqli->query($sql);

                    $regions = "";
                    while($row = $result->fetch_assoc()){
                      $region = $row['short_name'];
                    }
                    echo '{ y:'.$regionCount[$i]['regionCount'].',legendText: "'.$region.'", label: "'.$region.'"}'.($i+1 < sizeof($regionCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          regionChart.render();

        var visionLeftChart = new CanvasJS.Chart("visionLeftChart",
        	{
        		title:{
        			text: "Vision Left"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($visionLeftCount); $i++) {
                    echo '{ y:'.$visionLeftCount[$i]['visionLeftCount'].',legendText: "'.$visionLeftCount[$i]['vision_left'].'", label: "'.$visionLeftCount[$i]['vision_left'].'"}'.($i+1 < sizeof($visionLeftCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          visionLeftChart.render();

        var visionRightChart = new CanvasJS.Chart("visionRightChart",
        	{
        		title:{
        			text: "Vision Right"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($visionRightCount); $i++) {
                    echo '{ y:'.$visionRightCount[$i]['visionRightCount'].',legendText: "'.$visionRightCount[$i]['vision_right'].'", label: "'.$visionRightCount[$i]['vision_right'].'"}'.($i+1 < sizeof($visionRightCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          visionRightChart.render();

        var totallyBlindChart = new CanvasJS.Chart("totallyBlindChart",
        	{
        		title:{
        			text: "Totally Blind"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($totallyBlindCount); $i++) {
                    echo '{ y:'.$totallyBlindCount[$i]['totallyBlindCount'].',legendText: "'.$totallyBlindCount[$i]['eye'].'", label: "'.$totallyBlindCount[$i]['eye'].'"}'.($i+1 < sizeof($totallyBlindCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          totallyBlindChart.render();

        var lowVisionChart = new CanvasJS.Chart("lowVisionChart",
        	{
        		title:{
        			text: "Low Vision"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($lowVisionCount); $i++) {
                    echo '{ y:'.$lowVisionCount[$i]['lowVisionCount'].',legendText: "'.$lowVisionCount[$i]['eye'].'", label: "'.$lowVisionCount[$i]['eye'].'"}'.($i+1 < sizeof($lowVisionCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          lowVisionChart.render();

        var normalVisionChart = new CanvasJS.Chart("normalVisionChart",
        	{
        		title:{
        			text: "Normal Vision"
        		},
        		legend:{
        			verticalAlign: "center",
        			horizontalAlign: "left",
        			fontSize: 20,
        			fontFamily: "Helvetica"
        		},
        		theme: "theme2",
        		data: [
        		{
        			type: "pie",
        			indexLabelFontFamily: "Garamond",
        			indexLabelFontSize: 20,
        			indexLabel: "{label} ({y})",
        			startAngle:-20,
        			showInLegend: true,
        			toolTipContent:"{legendText} ({y})",
        			dataPoints: [
                <?php
                  for ($i=0; $i < sizeof($normalVisionCount); $i++) {
                    echo '{ y:'.$normalVisionCount[$i]['normalVisionCount'].',legendText: "'.$normalVisionCount[$i]['eye'].'", label: "'.$normalVisionCount[$i]['eye'].'"}'.($i+1 < sizeof($normalVisionCount)? ',' : '');
                  }
                ?>
        			]
        		}
        		]
        	});
          normalVisionChart.render();
      });
    </script>
  </body>
</html>
