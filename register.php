<?php
require_once 'coordination/Registration.php';
require_once 'page_elements/Page.php';

$page = new Page("Registration", "", false);

$handler = new RegistrationFormHandler();
$data = $handler->handleRegistration();

print $page->top();

?>

<?php if ($data->saved): ?>
    User '<?=$data->name_surname?>' created successfully. You can now <a href="login.php">login</a>.

<?php elseif ($data->errorSaving): ?>

    <?=$data->errorSaving?>

<?php else: ?>

<div class="user_form_container">
    <div class="user_form">

    <h3>Get registered to start using the app</h3>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">

        <label for="username">Username (must be valid email address)</label>
        <br>
        <input
            type="text"
            name="username"
            placeholder="Enter the username"
            value="<?=$data->username?>"
        >
        <?=$data->usernameValidationError?>

        <br>
        <br>
        <label for="password">Password</label>
        <br>
        <input
            type="password"
            name="password"
            placeholder="Enter the password"
            value="<?=$data->password?>"
        >
        <?=$data->passwordValidationError?>

        <br>
        <br>
        <label for="name_surname">Name and surname of the user</label>
        <br>
        <input
            type="text"
            name="name_surname"
            placeholder="Enter the name and the surname of the user"
            value="<?=$data->name_surname?>"
        >
        <?=$data->namesurnameValidationError?>

        <br>
        <br>
        <?php if ($data->valid): ?>
            <input type="submit" name="save" value="Save">
        <?php else: ?>
            <input type="submit" name="check" value="Check">
        <?php endif?>

    </form>

<?php endif?>

<?php

print $page->bottom();
