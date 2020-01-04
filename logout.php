<?php

unset($_SESSION['login_user']);
unset($_SESSION['username']);
unset($_SESSION['index']);
unset($_SESSION['fId']);
setcookie("user", null, -1);

header('location: index.php');
