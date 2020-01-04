<?php
require_once("FacultyClass.php");
$faculty = new Faculty();
if (isset($_POST['aId'])) {
    $aId = $_POST['aId'];
    $marks = $_POST['marks'];
    $result = $faculty->updateAssignmentMarks($aId, $marks);

    if ($result = true) echo "1";
    else echo "0";
} else {

    $cId = $_POST['cId'];
    $sId = $_POST['sId'];
    $marks = $_POST['marks'];
    $result = $faculty->updateFinalMarks($sId, $cId, $marks);

    if ($result = true) echo "1";
    else echo "0";
}
