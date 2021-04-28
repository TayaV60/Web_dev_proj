<?php

require_once 'coordination/Registration.php';
require_once 'page_elements/Page.php';

// a view class for the registration pages
class RegistrationView
{
    public function __construct()
    {
        $this->handler = new RegistrationFormHandler();
    }
    // creates the page for registration of a new user after calling the handler's handleRegistration method
    public function register()
    {
        $data = $this->handler->handleRegistration();

        $page = new Page("Registration", "", false);
        $page->top();

        registerView($data);

        $page->bottom();
    }
}

/* -------------------------------------- SUPPORTING PHP TEMPLATING FUNCTIONS --------------------------------------  */
/* -------------------------------------- (see views/README.md for more info) --------------------------------------  */

// displays the registration form
function registerView($data)
{
    ?>
<?php if ($data->saved): ?>
    User '<?=$data->name_surname?>' created successfully. You can now <a href="login.php">login</a>.
<?php elseif ($data->errorSaving): ?>

    <div class="errorsaving">
    <?=$data->errorSaving?>
    </div>

<?php else: ?>

<div class="user_form_container">
    <div class="user_form">

    <h3>Get registered to start using the app</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">

        <label for="username">Username must be a valid email address</label>
        <br>
        <br>
        <input
            type="text"
            name="username"
            placeholder="Enter the username"
            value="<?=$data->username?>"
        >
        <div class="invalid">
            <?=$data->usernameValidationError?>
        </div>
        <br>
        <br>
        <label for="password">Password must contain numbers and letters</label>
        <br>
        <br>
        <input
            type="password"
            name="password"
            placeholder="Enter the password"
            value="<?=$data->password?>"
        >
        <div class="invalid">
            <?=$data->passwordValidationError?>
        </div>
        <br>
        <br>
        <label for="name_surname">Name and surname of the user</label>
        <br>
        <br>
        <input
            type="text"
            name="name_surname"
            placeholder="Enter the name and the surname of the user"
            value="<?=$data->name_surname?>"
        >
        <div class="invalid">
            <?=$data->namesurnameValidationError?>
        </div>
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
}
