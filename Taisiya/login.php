<?php
require_once 'db/Users.php';
require_once 'page_elements/Page.php';

$page = new Page("Login", "Login", false);
$dbUsers = new DBUsers();

print $page->top();

$error = null;

if (!isset($_SESSION['username'])) {
    // See if a login form was submitted with a username for login
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // get the username
        $username = htmlentities(trim($_POST['username']));
        // get the password
        $password = htmlentities(trim($_POST['password']));

        if (!$username || !$password) {
            $error = "You need to fill in both the username and password.";
        }

        $userverified = $dbUsers->verifyUser($username, $password);

        if ($userverified) {
            $_SESSION['username'] = $username;

            header("Location: index.php");
            exit();
        } else {
            $error = "You need a valid username and password.";
        }
    }
} else {
    header("Location: index.php");
    exit();
}

?>

<?php if ($error): ?>
    <?=$error?>
<?php endif?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>">

        <p> Username: <input type="text" name="username" />
        </p>

        <p> Password: <input type="password" name="password" />
        </p>

        <input type="submit" value="Login" />
    </form>



<?php

print $page->bottom();
