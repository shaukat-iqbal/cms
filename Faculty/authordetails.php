<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>


    <?php

    include_once("navbar.html");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="m-0 pl-0 pr-2">
                <?php
                include_once("sidebar.html");
                ?>
            </div>
            <div class="col-md-10">

                <?php
                require_once("./../Student/StudentClass.php");

                $sid = $_GET['sid'];

                // TODO: Display Employee Details
                $std = new Student();
                $student = $std->GetSingleRecord($sid);
                if ($student != null) {
                ?>
                    <div class="container  mt-5">

                        <div class="card m-auto" style="width: 50%;">
                            <h4 class="card-header text-center">Student Personal Info</h4>

                            <div class="card-body p-3">


                                <div class="form-group  ">
                                    <label for="name">Full Name</label>
                                    <input name="name" class="form-control" readonly id="name" value="<?= $student->name ?>">
                                </div>

                                <div class="form-group  ">
                                    <label for="name">Email</label>
                                    <input name="email" class="form-control" readonly id="email" value="<?= $student->email ?>">

                                </div>
                                <div class="form-group ">
                                    <label for="name">Phone#</label>
                                    <input type="text" name="phone" class="form-control" readonly id="phone" placeholder="phone" value="<?= $student->phone ?>">

                                </div>
                                <div class="form-group ">
                                    <label for="name">Address</label>
                                    <br>
                                    <textarea readonly name="address" id="" cols="50" rows="5"> <?= $student->address ?>   
                        </textarea>

                                </div>
                                <div class="form-group ">
                                    <label for="name">Emergency Number</label>
                                    <input type="text" name="emergencyNo" class="form-control" readonly id="emergencyNo" placeholder="emergencyNo" value="<?= $student->emergencyNo ?>">

                                </div>
                                <div class="form-group ">
                                    <label for="name">Activities</label>
                                    <br>
                                    <textarea readonly name="activities" id="" cols="50" rows="3"> <?= $student->activities ?>   
                        </textarea>

                                </div>

                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>