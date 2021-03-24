<?php
//start the session because Page is not included (which usually starts the session)
session_start();

unset($_SESSION['username']);

header('Location:login_or_register.php');
exit();
