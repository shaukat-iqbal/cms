<?php
class Student
{
    public $sid;
    public $name;
    public $email;
    public $address;
    public $phone;

    public $pdo;

    public function __construct($sid = null, $name = null, $email = null, $address = null, $phone = null, $emergencyNo = null, $activities = null)
    {

        $this->sid = $sid;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->emergencyNo = $emergencyNo;
        $this->activities = $activities;

        $this->connect();
    }
    public function connect()
    {
        $connString = "mysql:host=localhost" . ";dbname=cms";
        $this->pdo = new PDO($connString, "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMarks($sid, $cid)

    {
        $sql = "select * from marks where cId='$cid' and sId='$sid'";
        $result = $this->pdo->query($sql);
        $row = $result->fetch();
        return $row['marks'];
        # code...
    }

    public function getAssignmentsDetail($sId, $cId)
    {
        $sql = "select * from assignments where cId='$cId' and sId='$sId'";

        $result = $this->pdo->query($sql);
        $assignmentsArr = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $assignmentsArr[$i] = $row;
            $i++;
        }
        return $assignmentsArr;
    }

    public function GetAllRecords()
    {
        $sql = "select * from student";
        // $sql = "SELECT faculty.fId,faculty.name, faculty.dob,faculty.email, task.password, task.subject \n"
        //     . "FROM faculty\n"
        //     . "INNER JOIN authortasks ON faculty.fId=authortasks.eauthor_id\n"
        //     . "INNER JOIN task ON authortasks.tauthor_id=task.fId";

        $result = $this->pdo->query($sql);
        $studentArr = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $student = new Student($row['sid'], $row['name'], $row['email'], $row['address'], $row['phone'], $row['emergencyNo'], $row['activities']);
            $studentArr[$i] = $student;
            $i++;
        }
        return $studentArr;
    }

    public function GetSingleRecord($sid)
    {
        // TODO: Write definition of this method
        $sql = "select * from student where sid = '$sid'";
        $result = $this->pdo->query($sql);
        $row = $result->fetch();
        $student = new Student($row['sid'], $row['name'], $row['email'], $row['address'], $row['phone'], $row['emergencyNo'], $row['activities']);

        return $student;
    }


    public function insert()
    {
        $date = date('y/m/d');
        $sql = "insert into students (sid,name,email,address,phone,inter,matric,password,createdOrModifiedOn) 
    values(null,'$this->name', '$this->email', '$this->address', '$this->phone', '$this->inter', '$this->matric', '$this->password','$date')";

        $count = $this->pdo->exec($sql);
        if ($count > 0) {

            return true;
        }
        return false;
    }
    public  function search($phone)
    {
        $sql = "Select * from students where phone='$phone'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $student = new Student($row['sid'], $row['name'], $row['email'], $row['address'], $row['phone'], $row['inter'], $row['matric'], $row['password']);
            return $student;
        } else {
            return false;
        }
    }

    public function checkEnrollment()
    {
        $month = date('m');
        $year = date('y');
        $query1 = "Select * from tests where test_date between '$year/$month/01' and '$year/$month/31'";
        $result = $this->pdo->query($query1);

        if ($row = $result->fetch()) {
            $test_id = $row['test_id'];

            $_SESSION['test_id'] = $row['test_id'];
            $_SESSION['test_date'] = $row['test_date'];

            $checkEntery = "Select * from enrolledStudents where test_id=$test_id and students_cnic LIKE '$this->phone'";
            $result = $this->pdo->query($checkEntery);
            if ($row = $result->fetch()) {
                return true;
            }
            return false;
        } else {
            return "no test";
        }
    }


    public function checkEnrollmentById($sid)
    {
        $test = new Test();
        $listOfAnnouncedTests = $test->getAnnoncedTests();
        $test_id = $listOfAnnouncedTests[0]->test_id;
        $sql = "select enrolledStudents.test_id  from enrolledStudents join students on students.phone=enrolledStudents.students_cnic where students.sid=$sid and enrolledStudents.test_id=$test_id ";
        $result = $this->pdo->query($sql);

        if ($row = $result->fetch()) {

            $_SESSION['test_id'] = $row['test_id'];
            $_SESSION['test_date'] = $listOfAnnouncedTests[0]->test_date . " " . $listOfAnnouncedTests[0]->test_time;
            return true;
        } else {
            return false;
        }
    }
    public function enroll()
    {

        $test_id = $_SESSION['test_id'];
        $sql = "insert into enrolledStudents (test_id,students_cnic) values ('$test_id','$this->phone')";
        $count = $this->pdo->exec($sql);
        if ($count > 0) {
            return true;
        } else {

            return false;
        }
    }

    public function searchByID($sid)
    {
        $sql = "Select * from students where sid='$sid'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $student = new Student($row['sid'], $row['name'], $row['email'], $row['address'], $row['phone'], $row['inter'], $row['matric'], $row['password']);
            return $student;
        } else {
            return false;
        }
    }
}
