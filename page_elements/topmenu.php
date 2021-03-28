<?php
// horizontal menu link buttons
function topMenu($title) {
    $tabs = [
        "Templates" => "templates",
        "Applicants" => "applicants",
        "Roles" => "roles",
    ];
    $menu = "<div class='horizontal'>";
    foreach($tabs as $tab_title => $tab_file) {
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
