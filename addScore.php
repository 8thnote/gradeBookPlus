<?php
require_once('connection.php');

// Query Students' Names
$students_query = "SELECT first, last, id FROM students ORDER BY last ASC";
$students = mysql_query($students_query, $data) or die(mysql_error());
$student = mysql_fetch_assoc($students);
// Query Subject List
$subjects_query = "SELECT name, id FROM subjects ORDER BY name ASC";
$subjects = mysql_query($subjects_query, $data) or die(mysql_error());
$subject = mysql_fetch_assoc($subjects);
// Process Add Score Request
if (isset($_POST['score'])) {
	mysql_query("INSERT INTO exams (student_id, score, subject_id, notes) VALUES ( ".$_POST['student_id']." , ".$_POST['score']." , ".$_POST['subject_id']." , '".$_POST['notes']."')", $data);
	header('location: index.php?student_id='.$_POST['student_id']);
}
?>
<html lang="en">
<head>	
	<title>ExamBook Plus</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="libs/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="libs/style.css">
	<style>
		textarea { display: block; }
		.pull-right { margin: 8px; }
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
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading"><h2>Add a Score</h2></div>
					<div class="panel-body">
						<form method="POST" action="addScore.php">
							<select name="student_id">
								<?php do { ?>
									<option value="<?php echo $student['id'] ?>"><?php echo $student['first'] ?></option>
								<?php } while ($student = mysql_fetch_assoc($students)); ?>
							</select> got a
							<input type="number" min="0" max="100" name="score"> in 
							<select name="subject_id">
								<?php do { ?>
									<option value="<?php echo $subject['id'] ?>"><?php echo $subject['name'] ?></option>
								<?php } while ($subject = mysql_fetch_assoc($subjects)); ?>
							</select>
							<h4>Notes</h4>
							<textarea rows="3" cols="30" name="notes"> </textarea>
							<a href="index.php" class="btn-danger btn pull-right">Cancel</a>
							<input type="submit" class="pull-right btn btn-primary">
							
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>