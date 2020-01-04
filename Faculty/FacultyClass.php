<?php
require_once("../config.php");

class Faculty
{
    public $fId, $name, $dob, $email, $gender, $password, $qualification, $phone;
    private $pdo;


    public function __construct($fId = null, $name = null, $dob = null, $gender = null, $qualification = null, $email = null, $password = null, $phone = null)
    {
        $connString = "mysql:host=localhost;dbname=cms";
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($fId != null) {
            $this->fId = $fId;
            $this->name = $name;
            $this->dob = $dob;
            $this->gender = $gender;
            $this->qualification = $qualification;
            $this->email = $email;
            $this->password = $password;
            $this->phone = $phone;
        }
    }

    /*
     * Function takes Faculty attributes to insert into database
     * Function returns true on successful insertion, otherwise false
     */
    // public function Insert($name, $dob, $email, $password, $subject_id)
    // {
    //     // TODO: Write Definition to insert record into database
    //     $pass = ($password);
    //     $sql = "INSERT INTO faculty (fId, name, email, dob, password) VALUES (NULL, '$name', '$email', '$dob', '$pass')";
    //     $count = $this->pdo->exec($sql);
    //     $fId = $this->pdo->lastInsertId();

    //     if ($count > 0) {
    //         // need to assign subject to athor
    //         if ($this->assignSubject($subject_id, $fId))
    //             return true;
    //     }
    //     return false;
    // }

    public function getTimeTable($fId)
    {
        # code...
        $sql = "SELECT t.day,c.name,s.name as sectionName,t.time FROM `timetable` as t join section as s on t.sectionId=s.sectionId join course as c on c.cid=t.cid where t.fId=1 order by day";
        $result = $this->pdo->query($sql);
        $timetable = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $timeTableRow = array($row['day'], $row['name'], $row['sectionName'], $row['time']);

            $timetable[$i] = $timeTableRow;
            $i++;
        }
        return $timetable;
    }


    /*
     * Function takes Faculty attributes to update record in database
     * Function returns true on successful update otherwise false
     */
    public function Update($name, $dob, $email, $password)
    {
        $pass = ($password);
        // TODO: Write Definition of this method
        $sql = "UPDATE faculty SET name = '$name', email = '$email', password= '$pass' WHERE dob = '$dob'";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }
    public function updateFinalMarks($sId, $cId, $marks)
    {
        // TODO: Write Definition of this method
        $sql = "UPDATE marks SET marks = '$marks' WHERE cId = '$cId' and sId='$sId'";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        else {
            $sql = "INSERT INTO `marks` (`cId`, `sId`, `marks`) VALUES ('$cId', '$sId', '$marks')";
            $count = $this->pdo->exec($sql);
            if ($count > 0)
                return true;
        }
        return false;
    }

    public function addAssignmentMarks($cId, $sId, $assignmentNo, $marks)
    {
        $sql = "INSERT INTO `assignments` (`aId`, `sId`, `cId`, `assignmentNo`, `marks`) VALUES (NULL, '$sId','$cId','$assignmentNo', '$marks')";

        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function updateAssignmentMarks($aId, $marks)
    {
        // TODO: Write Definition of this method
        $sql = "UPDATE assignments SET marks = '$marks' WHERE aId = '$aId'";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;

        return false;
    }

    /*
     * This function returns faculty objects Array
     */
    public function GetAllRecords()
    {
        $sql = "select * from faculty";
        // $sql = "SELECT faculty.fId,faculty.name, faculty.dob,faculty.email, task.password, task.subject \n"
        //     . "FROM faculty\n"
        //     . "INNER JOIN authortasks ON faculty.fId=authortasks.eauthor_id\n"
        //     . "INNER JOIN task ON authortasks.tauthor_id=task.fId";

        $result = $this->pdo->query($sql);
        $autharr = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $autharr[$i] = new Faculty($row['fId'], $row['name'], $row['dob'], $row['email'], $row['password']);
            $i++;
        }
        return $autharr;
    }


    /*
     * This function returns single Object of this class
     * Search Criteria: fId
     */
    public function GetSingleRecord($fId)
    {
        // TODO: Write definition of this method
        $sql = "select * from faculty where fId = '$fId'";
        $result = $this->pdo->query($sql);
        $authObj = null;
        while ($row = $result->fetch()) {

            $authObj = new Faculty($row['fId'], $row['name'], $row['dob'], $row['gender'], $row['qualification'], $row['email'], $row['password'], $row['phone']);
        }
        return $authObj;
    }

    public function GetAttendance($fId)
    {
        // TODO: Write definition of this method
        $sql = "SELECT COUNT(*) as count FROM `facultyattendance` where fId = '$fId' GROUP BY status";
        $res = array();

        $result = $this->pdo->query($sql);
        $row = $result->fetch();

        $res["absents"] = $row['count'];

        $row = $result->fetch();
        $res["presents"] = $row['count'];

        return $res;
    }

    public function getAssignedCourses($fId)
    {
        // TODO: Write definition of this method
        $sql = "SELECT name, ci.cId, sectionId FROM `courseinstructor` as ci join course as c on c.cid=ci.cId where fId='$fId'";
        $result = $this->pdo->query($sql);
        $courses = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $courses[$i] = $row;
            $i++;
        }

        return $courses;
    }


    public function getEnrolledStudents($source)
    {
        // TODO: Write definition of this method
        $cid = explode("*", $source)[0];
        $sectionId = explode("*", $source)[1];
        $sql = "SELECT en.sid,name,email FROM `enrolled` as en join student as std on std.sid=en.sid where en.cid='$cid' and en.sectionId='$sectionId'";
        $result = $this->pdo->query($sql);
        $enrolled = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $enrolled[$i] = $row;
            $i++;
        }

        return $enrolled;
    }

    /*
     * Delete single Record
     */
    public function Delete($fId)
    {
        // TODO: Write Definition of this method
        $sql = "DELETE from faculty WHERE fId = $fId";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }
}
