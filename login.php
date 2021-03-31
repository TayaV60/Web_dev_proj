<?php
require_once 'coordination/Login.php';
require_once 'page_elements/Page.php';

$page = new Page("Login", "Login", false);
$dbUsers = new DBUsers();

print $page->top();

$handler = new LoginFormHandler();
$data = $handler->handleLogin();

?>

<?php if ($data->error): ?>
    <?=$data->error?>
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
