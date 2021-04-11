<?php

require_once 'coordination/Login.php';
require_once 'page_elements/Page.php';

function loginView($data)
{
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

}

class LoginView
{
    public function __construct()
    {
        $this->handler = new LoginFormHandler();
    }

    public function login()
    {
        $data = $this->handler->handleLogin();

        $page = new Page("Login", "Login", false);
        print $page->top();

        loginView($data);

        print $page->bottom();
    }
}
