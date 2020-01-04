<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Time Table| CMS</title>


    <?php
    require_once("FacultyClass.php");
    $auth = new Faculty();
    $fId = $_SESSION['fId'];
    $timeTableRows = $auth->getTimeTable($fId);

    ?>

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
                <div class="container mt-5 ">
                    <h4 class="mb-3">Time Table</h4>
                    <table class="table border ">
                        <thead class="thead-dark">

                            <tr>
                                <th>Day</th>
                                <th>Subject Name</th>
                                <th>Section</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($timeTableRows as $row) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $row[0] ?>
                                    </td>

                                    <td>
                                        <?= $row[1] ?>
                                    </td>
                                    <td>
                                        <?= $row[2] ?>
                                    </td>
                                    <td>
                                        <?= $row[3] ?>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>