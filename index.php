<?php
require_once('connection.php');

// Query Student's Scores
$scores_query = "SELECT exams.id as exam_id, notes, subjects.name as subject_name, students.id as student_id, score, notes ";
$scores_query .= "FROM exams JOIN subjects ON exams.subject_id = subjects.id ";
$scores_query .= "JOIN students ON students.id = exams.student_id ";
if (isset($_GET['student_id'])){
	$scores_query .= "WHERE exams.student_id = ".$_GET['student_id'];
}
$scores = mysql_query($scores_query, $data) or die(mysql_error());
$score = mysql_fetch_assoc($scores);
// Query Students' Names
$students_query = "SELECT first, last, id FROM students ORDER BY last DESC";
$students = mysql_query($students_query, $data) or die(mysql_error());
$student = mysql_fetch_assoc($students);
// Process Delete Requests
if($_GET['action'] == "delete"){
	mysql_query('DELETE FROM exams WHERE id = '.$_GET['id']);
	header('location: index.php?student_id='.$_GET['student_id']);
}
// Toggle the Table View
if(isset($_GET['student_id'])){ $showOrNot = "block"; } else { $showOrNot = "none"; }


?>
<html lang="en">
<head>	
	<title>ExamBook Plus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="libs/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="libs/style.css">
	<style>
		.highlighted { background-color:#ccc; font-weight: bold; }
	</style>
	<script type="text/javascript" src="libs/jq.js"></script>
	<script type="text/javascript" src="libs/bootstrap.js"></script>
</head>
<body>
	<header class="navbar navbar-inverse">	
		<div class="container">
			<span class="navbar-brand">ExamBook Plus</span>
		</div>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<h3>Students</h3>
				<div class="list-group">
					<?php do { ?>
					<a href="index.php?student_id=<?php echo $student['id']; ?>" class="list-group-item
					<?php if($_GET['student_id'] == $student['id']) { echo "highlighted"; } ?>
					"><?php echo $student['last']; ?>, <?php echo $student['first']; ?></a>
					<?php } while ($student = mysql_fetch_assoc($students));?>
				</div>
				<a href="addScore.php" class="btn btn-primary">Add a Score</a>
			</div>
			<div class="col-sm-9">
				<table class="table table-striped" style="display:<?php echo $showOrNot; ?>;">
					<tr>
						<th>Exam ID</th>
						<th>Subject</th>
						<th>Score</th>
						<th>Status (Passed/Failed)</th>
						<th>Teacher's Notes</th>
						<th>Remove</th>
					</tr>
					<?php do {
						if ($score['score'] >= 60) { $status = "Passed"; } else { $status = "Failed"; }
						print "<tr><td>".$score['exam_id']."</td>";
						print "<td>".$score['subject_name']."</td><td>".$score['score']."</td>";
						print "<td>".$status."</td><td>".$score['notes'];
						print "</td><td><a class='btn btn-danger btn-sm' href='index.php?action=delete&id=".$score['exam_id']."&student_id=".$score['student_id']."'>x</a></td></tr>";
					} while ($score = mysql_fetch_assoc($scores)); ?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<!--                        __                    
    ____                   / _|                   
   / __ \  __ _  ___  ___ | |_ ___ _ __ _ __  ____
  / / _` |/ _` |/ _ \/ _ \|  _/ _ \ '__| '_ \|_  /
 | | (_| | (_| |  __/ (_) | ||  __/ |  | | | |/ / 
  \ \__,_|\__, |\___|\___/|_| \___|_|  |_| |_/___|
   \____/  __/ |                                  
          |___/            www.geofernz.com                        

 -->