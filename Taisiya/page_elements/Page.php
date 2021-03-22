<?php
include 'topmenu.php';
include 'sidemenu.php';

class Page
{
    private $title;
    private $tab_title;

    public function __construct($title, $tab_title, $needsToBeLoggedIn = true)
    {
        $this->title = $title;
        $this->tab_title = $tab_title;
        $loggedIn = $this->isLoggedIn();
        if ($needsToBeLoggedIn && !$loggedIn) {
            header("Location: login_or_register.php");
            exit();
        }
    }

    public function top()
    {
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

                $top_menu
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
        $isLoggedIn = array_key_exists('PHP_AUTH_USER', $_SERVER) && array_key_exists('PHP_AUTH_PW', $_SERVER);
        return $isLoggedIn;
    }
}
