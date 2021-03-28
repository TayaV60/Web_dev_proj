<?php
require_once 'db/Users.php';
require_once 'sidemenu.php';
require_once 'topmenu.php';

//start the session
session_start();

class Page
{
    private $title;
    private $tab_title;

    public function __construct($title, $tab_title, $needsToBeLoggedIn = true)
    {
        $this->title = $title;
        $this->tab_title = $tab_title;
        $this->loggedIn = $this->isLoggedIn();
        $this->dbUsers = new DBUsers();
        if ($needsToBeLoggedIn && !$this->loggedIn) {
            header("Location: login_or_register.php");
            exit();
        }
    }

    public function top()
    {
        $logout = '';
        if ($this->loggedIn) {
            $user = $this->dbUsers->getUserByUsername($_SESSION['username']);
            $name = $user["name_surname"];
            $logout = "
                <span>Welcome, $name. <a class='links' href='logout.php'>Logout</a><span>
            ";
        }

        $top_menu = topMenu($this->tab_title);
        $side_menu = sideMenu($this->tab_title);
        $to_return = "
            <html>
            <head>
                <link rel='stylesheet' href='forms.css'>
                <title>$this->title</title>
            </head>

            <body>

                <div class='header'>
                    <h1>Happy Tech</h1>
                    <h3>HR tool for writing application feedback</h3>
                </div>
                $top_menu $logout
                <div class='container'>
                    $side_menu
                    <!-- the contents field -->
                    <div class='main'>
        ";
        return $to_return;
    }

    public function bottom()
    {
        return "
                    </div>
                </div>
            </body>
        ";
    }

    private function isLoggedIn()
    {
        $isLoggedIn = array_key_exists('username', $_SESSION);
        return $isLoggedIn;
    }
}
