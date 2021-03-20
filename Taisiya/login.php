<?php
include 'page_elements/Page.php';
include 'db/Users.php';

$page = new Page("Login", "Login");
$dbUsers = new DBUsers();

print $page->top();

if (!isset($_SERVER['PHP_AUTH_USER']) &&
    !isset($_SERVER['PHP_AUTH_PW'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="ARU"');
    echo 'You pressed Cancel button';
    exit;
} else {

    // get the username
    $username = trim($_SERVER['PHP_AUTH_USER']);
    // get the password
    $password = trim($_SERVER['PHP_AUTH_PW']);

    if (!$username || !$password) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="ARU"');
        exit("You need to fill in both the username and password.");

    } else {
        $userverified = $dbUsers->verifyUser($username, $password);
        if ($userverified) {
            echo "<p>Hello {$username}. Your password is {$password}.</p>";
        } else {
            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="ARU"');
            exit("You need a valid username and password.");
        }

    }
}
?>

<?php

print $page->bottom();?>
