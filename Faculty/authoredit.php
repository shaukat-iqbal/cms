<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculty Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "testing");
    if (mysqli_connect_error()) {
        echo "could not connect";
    }
    require_once("FacultyClass.php");
    // $fId = $email = $name = $password = $dob = $qualification = $gender = '';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // TODO: Write Get Action to display record and fill the fields for editing
        $fId = $_SESSION['fId'];
        $facultyIns = new Faculty();
        $faculty = $facultyIns->GetSingleRecord($fId);
        $attendance = $facultyIns->GetAttendance($fId);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // TODO: Write code to Update records based on posted back fields
        $faculty = new Author();
        if ($auth->Update($_POST['name'], $_POST['fId'], $_POST['email'], $_POST['password'])) {
            echo "success";
            header("Location: index.php");
        }
    }
    ?>

</head>

<body>
    <?php
    include_once("navigation.html");
    ?>
    <div class="container  pt-4">
        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Faculty Profile</h4>

            <div class="card-body p-3">
                <form action="" method="post">
                    <input type="hidden" name="fId" value="<?= $fId ?>">

                    <div class="form-group">
                        <label for="name">Faculty Name</label>
                        <input type="text" name="name" class="form-control" readonly id="name" placeholder="Full Name" value="<?= $faculty->name ?>">
                    </div>
                    <!--        TODO: Add Other Fields here!-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" readonly id="email" placeholder="Email" value="<?= $faculty->email ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">dob</label>
                        <input type="date" name="password" class="form-control" readonly id="password" placeholder="password" value="<?= $faculty->dob ?>">
                    </div>
                    <div class="form-group ">
                        <label for="name">Gender</label>
                        <input type="text" name="gender" class="form-control" readonly id="gender" placeholder="gender" value="<?= $faculty->gender ?>">

                    </div>
                    <div class="form-group ">
                        <label for="name">Qualification</label>
                        <input type="text" name="qualification" class="form-control" readonly id="qualification" placeholder="qualification" value="<?= $faculty->qualification ?>">

                    </div>
                    <div class="form-group ">
                        <label for="name">Phone#</label>
                        <input type="text" name="phone" class="form-control" readonly id="phone" placeholder="phone" value="<?= $faculty->phone ?>">

                    </div>
                    <div class="form-group ">
                        <h5 for="name">Attendance Summary</h5>
                        <br>

                        <div class="form-group d-inline-block pr-2">
                            <label for="name" class="d-inline-block">Presents:</label>

                            <input type="number" class="d-inline-block" name="presents" class="form-control" readonly id="presents" placeholder="presents" value="<?= $attendance['presents'] ?>">
                        </div>

                        <div class="form-group d-inline-block">
                            <label for="name" class="d-inline-block">Absents:</label>
                            <input type="number" class="d-inline-block" name="absents" class="form-control " readonly id="absents" placeholder="absents" value="<?= $attendance['absents'] ?>">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>