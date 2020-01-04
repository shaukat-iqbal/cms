<?php

$connection = mysqli_connect("localhost", "root", "", "cms");

if (mysqli_connect_error()) {
    // console . log("db connection error");
    die(mysqli_connect_error());
}
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = ($_POST['password']);
    $sql = "select * from faculty where email='$email' and password='$pass'";
    $result = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $row['name'];
        $_SESSION['fId'] = $row['fId'];
        header("Location: ./Faculty/index.php");
    } else {
        echo "0";
        return;
    }
} else {
    echo "not set";
}
