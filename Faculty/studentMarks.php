<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Marks</title>

    <?php
    require_once("./../Student/StudentClass.php");
    $student = new Student();
    $cId = $_GET['cId'];
    $sId = $_GET['sId'];
    $finalMarks = $student->getMarks($sId, $cId);
    $assignments = $student->getAssignmentsDetail($sId, $cId);
    ?>

    <script>
        $().ready(
            () => {

                $("#editFinalMarks").on("click", () => {
                    $("#editFinalMarks").attr("hidden", true);
                    $("#finalMarks").attr("readonly", false);
                    $("#updateFinalMarks").attr("hidden", false);

                })



                $("#updateFinalMarks").on("click", () => {

                    let updatedMarks = $("#finalMarks").val();
                    if (updatedMarks < 0) {
                        alert("InValid marks entered");
                        return;
                    }
                    $.post("./updateMarks.php", {
                            cId: $("#cId").val(),
                            sId: $("#sId").val(),
                            marks: updatedMarks
                        },
                        (data) => {
                            $("#editFinalMarks").attr("hidden", false);
                            $("#finalMarks").attr("readonly", true);
                            $("#updateFinalMarks").attr("hidden", true);

                        }
                    );

                })


            }
        );

        function editAssignmentMarks(aId) {
            $("#" + aId + " input[name=aMarks]").attr("readonly", false);
            $("#" + aId + " button[name=editAMarks]").attr("hidden", true);
            $("#" + aId + " button[name=updateAMarks]").attr("hidden", false);

        }

        function updateAssignmentMarks(aId) {
            let updatedMarks = $("#" + aId + " input[name=aMarks]").val();
            if (updatedMarks < 0) return;
            $.post("./updateMarks.php", {
                    aId: aId,
                    marks: updatedMarks
                },
                (data) => {
                    if (data == 1) {
                        $("#" + aId + " input[name=aMarks]").attr("readonly", true);
                        $("#" + aId + " button[name=editAMarks]").attr("hidden", false);
                        $("#" + aId + " button[name=updateAMarks]").attr("hidden", true);

                    } else {
                        alert("Could not update")
                    }

                }
            );



        }

        function addAssignmentMarks(cId, sId, assignmentNo) {
            let marks = $("#nMarks").val();
            if (marks < 0) {
                alert("Please enter positive value");
                return;
            };
            $.post("./assignmentMarks.php", {
                    cId: cId,
                    sId: sId,
                    assignmentNo: assignmentNo,
                    marks: marks
                },
                (data) => {
                    if (data == 1) {
                        location.reload();

                    } else {
                        alert("Could not update")
                    }

                }
            );

        }

        function sendGetReq() {
            let s = document.getElementById("course").value;
            window.location = "http://localhost:8080/webproject/faculty/index.php?source=" + s;
        }
    </script>

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
                <div class="container mt-5">
                    <div class="border rounded ">
                        <input type="hidden" id="cId" value="<?= $cId ?>">
                        <input type="hidden" id="sId" value="<?= $sId ?>">
                        <h4 class="text-center text-white pt-3 m-0 bg-dark border rounded border-dark">Final Grades</h4>
                        <div class="pt-3 d-flex justify-content-around">
                            <div class="d-inline-block">
                                <label class="d-inline-block">Subject Name: </label>
                                <label class="d-inline-block"><strong>Physics</strong></label>
                            </div>

                            <div class="d-inline-block">
                                <label class="d-inline-block">Marks: </label>

                                <input class="d-inline-block" name="finalMarks" id="finalMarks" readonly type="number" value="<?= $finalMarks ?>">
                            </div>
                            <div class="d-inline-block" style="width: 100px">
                                <button class="btn btn-secondary btn-sm " id="editFinalMarks">Edit</button>
                                <button class="btn btn-primary btn-sm " hidden id="updateFinalMarks">Update</button>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mt-5">

                        <h4 class="text-center text-white pt-3 m-0 bg-dark border rounded border-dark">Assignments</h4>
                        <?php
                        foreach ($assignments as $assignment) {
                        ?>
                            <div class="pt-3 d-flex justify-content-around" id="<?= $assignment['aId'] ?>">
                                <div class="d-inline-block">
                                    <label class="d-inline-block">Assignment#: </label>
                                    <label class="d-inline-block"><strong><?= $assignment['assignmentNo'] ?></strong></label>
                                </div>

                                <div class="d-inline-block">
                                    <label class="d-inline-block">Marks: </label>
                                    <input class="d-inline-block" name="aMarks" id="aMarks" readonly type="number" value="<?= $assignment['marks'] ?>">

                                </div>
                                <div class="d-inline-block" style="width: 100px">
                                    <button class="btn btn-secondary btn-sm " name="editAMarks" onclick="editAssignmentMarks(<?= $assignment['aId'] ?>)">Edit</button>
                                    <button class="btn btn-primary btn-sm " name="updateAMarks" hidden onclick="updateAssignmentMarks(<?= $assignment['aId'] ?>)" id="updateAssignmentMarks">Update</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <h6 class="text-center pt-2">Add new Assignment</h6>
                        <div class="pt-3 d-flex justify-content-around" id="#newAssignment">
                            <div class="d-inline-block">
                                <label class="d-inline-block">Assignment#: </label>
                                <label class="d-inline-block"><strong><?= count($assignments) + 1 ?></strong></label>
                            </div>

                            <div class="d-inline-block">
                                <label class="d-inline-block">Marks: </label>
                                <input class="d-inline-block" name="nMarks" id="nMarks" type="number" value="0">

                            </div>
                            <div class="d-inline-block" style="width: 100px">
                                <button class="btn btn-secondary btn-sm " name="editAMarks" onclick="addAssignmentMarks('<?= $cId ?>','<?= $sId ?>','<?= count($assignments) + 1 ?>')">Insert</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>