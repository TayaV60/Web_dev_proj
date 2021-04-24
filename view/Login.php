<?php

require_once 'coordination/Login.php';
require_once 'page_elements/Page.php';

// a view class for the login pages
class LoginView
{

    // constructor instantiates a LoginFormHandler
    public function __construct()
    {
        $this->handler = new LoginFormHandler();
    }

    // creates the page for logging in after calling the handler's handleLogin method
    public function login()
    {
        $data = $this->handler->handleLogin();

        $page = new Page("Login", "Login", false);
        print $page->top();

        loginView($data);

        print $page->bottom();
    }
}

/* -------------------------------------- SUPPORTING PHP TEMPLATING FUNCTIONS --------------------------------------  */
/* -------------------------------------- (see views/README.md for more info) --------------------------------------  */

// displays the login form
function loginView($data)
{
    ?>
    <?php if ($data->error): ?>
        <div class="invalid">
            <?=$data->error?>
        </div>
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
