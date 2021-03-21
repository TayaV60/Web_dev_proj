<?php
include 'page_elements/Page.php';
include 'db/Users.php';

$dbUsers = new DBUsers();

$page = new Page("Home", "");

$username = null;
$password = null;
$name_surname = null;

$valid = false;
$saved = false;
$errorSaving = null;
$usernameValidationError = null;
$passwordValidationError = null;
$namesurnameValidationError = null;

function usernameValidation($username)
{
    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $username)) {
        return false;
    }
    return true;
}

function passwordValidation($password)
{
    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
        return false;
    }
    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name_surname = $_POST['name_surname'];

    if (usernameValidation($username) == false) {
        $usernameValidationError = "The username format is incorrect";
    }

    if (passwordValidation($password) == false) {
        $passwordValidationError = "The password is weak";
    }

    if (strlen($name_surname) < 1) {
        $namesurnameValidationError = "Please enter your name and surname";
    }

    if (!$usernameValidationError && !$passwordValidationError && !$namesurnameValidationError) {
        $valid = true;
    }

    if ($valid && isset($_POST['save'])) {
        try {
            $dbUsers->createUser($username, $password, $name_surname);
            $saved = true;
        } catch (Exception $e) {
            $message = $e->getMessage();
            $errorSaving = "Could not create user $message.";
        }
    }
}

$page = new Page("Home", "Create user");

print $page->top();

?>

<?php if ($saved): ?>
    User '<?=$name_surname?>' created successfully.

<?php elseif ($errorSaving): ?>

    <?=$errorSaving?>

<?php else: ?>

<div class="user_form_container">
    <div class="user_form">

    <h3>Get registered to start using the app</h3>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">

        <label for="username">Username</label>
        <br>
        <input
            type="text"
            name="username"
            placeholder="Enter the username"
            value="<?=$username?>"
        >
        <?=$usernameValidationError?>

        <br>
        <br>
        <label for="password">Password</label>
        <br>
        <input
            type="text"
            name="password"
            placeholder="Enter the password"
            value="<?=$password?>"
        >
        <?=$passwordValidationError?>

        <br>
        <br>
        <label for="name_surname">Name and surname of the user</label>
        <br>
        <input
            type="text"
            name="name_surname"
            placeholder="Enter the name and the surname of the user"
            value="<?=$name_surname?>"
        >
        <?=$namesurnameValidationError?>

        <br>
        <br>
        <?php if ($valid): ?>
            <input type="submit" name="save" value="Save">
        <?php else: ?>
            <input type="submit" name="check" value="Check">
        <?php endif?>

    </form>

<?php endif?>

<?php

print $page->bottom();?>