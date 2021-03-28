<?php
// horizontal menu link buttons
function sideMenu($title) {
    $tabs = [
        "Generate feedback" => "generate_feedback",
        "Send feedback" => "send_feedback",
    ];
    $menu = "<div class='vertical'>";
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
