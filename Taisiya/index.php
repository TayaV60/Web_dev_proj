<?php
include 'page_elements/Page.php';

$page = new Page("Home", "");

print $page->top();

?>

<a href="register.php">Registration</a>

<a href="login.php">Login</a>

<?php

print $page->bottom();?>