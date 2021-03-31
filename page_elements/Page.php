<?php

require_once 'db/Users.php';

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

        $top_menu = $this->topMenu($this->tab_title);
        $side_menu = $this->sideMenu($this->tab_title);
        $to_return = "
            <html>
            <head>
                <link rel='stylesheet' href='forms.css'>
                <title>$this->title</title>
            </head>

            <body>

                <div class='header'>
                    <h1><a href='index.php' class='titlelinks' >HappyTech</a></h1>
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

    private function topMenu($title)
    {
        $tabs = [
            "Templates" => "templates",
            "Applicants" => "applicants",
            "Roles" => "roles",
        ];
        $menu = "<div class='horizontal'>";
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

}
