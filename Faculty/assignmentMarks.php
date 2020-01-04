
<?php
require_once("FacultyClass.php");
$faculty = new Faculty();
$cId = $_POST['cId'];
$sId = $_POST['sId'];
$assignmentNo = $_POST['assignmentNo'];
$marks = $_POST['marks'];
$result = $faculty->addAssignmentMarks($cId, $sId, $assignmentNo, $marks);
echo 1;
// if ($result = true) echo "1";
// else echo "0";
