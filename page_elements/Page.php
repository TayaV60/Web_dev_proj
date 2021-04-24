<?php

require_once 'db/Users.php';

//starts the session
session_start();

/*
This class is used on every page. It generates the header using the provided
$title, and generates the navigation menus, highlighting the tab that
matches the $tab_title. If $needsToBeLoggedIn is true (which is its
default value), then it will also check to see if a 'username' session
exists and redirect to login_or_register.php if it does not. If logged in,
then the user's "name_surname" will be displayed on the right of the top menu.

In most cases, this class is instantiated inside the public method of a view
class, except in the few cases where a page does not have a view class (because it
is too simple to need one - for example index.php).
 */
class Page
{
    private $title;
    private $tab_title;

    // if $needsToBeLoggedIn and not logged in, constructor redirects to login_or_register.php,
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

    // displays the top of the page
    public function top()
    {
        $logout = '';
        if ($this->loggedIn) {
            $user = $this->dbUsers->getUserByUsername($_SESSION['username']);
            $name = $user["name_surname"];
            $logout = "
                <a class='logoutlink' href='logout.php'>Logout, $name.</a>
            ";
        }

        $top_menu = $this->topMenu($this->tab_title, $logout);
        $side_menu = $this->sideMenu($this->tab_title);
        $to_return = "
            <html>
            <head>
                <link rel='stylesheet' href='forms.css'>
                <title>$this->title</title>
            </head>

            <body>

                <div class='header'>
                    <h1><a href='index.php' >HappyTech</a></h1>
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

    // displays the bottom of the page
    public function bottom()
    {
        return "
                    </div>
                </div>
            </body>
        ";
    }

    // checks to see if logged in
    private function isLoggedIn()
    {
        $isLoggedIn = array_key_exists('username', $_SESSION);
        return $isLoggedIn;
    }

    // displays the side menu
    private function sideMenu($title)
    {
        $tabs = [
            "Generate feedback" => "generate_feedback",
            "Send feedback" => "send_feedback",
        ];
        $menu = "<div class='vertical'>";
        foreach ($tabs as $tab_title => $tab_file) {
            if ($tab_title == $title) {
                $linkClass = "current_tab";
            } else {
                $linkClass = "";
            }
            $menu .= "<a class='$linkClass' href='$tab_file.php'>$tab_title</a>";
        }
        $menu .= "</div>";
        return $menu;
    }

    // displays the top menu
    private function topMenu($title, $logout)
    {
        $tabs = [
            "Templates" => "templates",
            "Applicants" => "applicants",
            "Roles" => "roles",
        ];
        $menu = "<div class='horizontal'>";
        foreach ($tabs as $tab_title => $tab_file) {
            $linkClass = "page_link";
            if ($tab_title == $title) {
                $linkClass .= " current_tab";
            }
            $menu .= "<a class='$linkClass' href='$tab_file.php'>$tab_title</a>";
        }
        $menu .= $logout;
        $menu .= "</div>";
        return $menu;
    }

}
