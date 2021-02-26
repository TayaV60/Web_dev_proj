<?php
// horizontal menu link buttons
function topMenu($title) {
    $tabs = [
        "Templates" => "create_or_edit",
        "Applicants" => "applicants",
        "Roles" => "roles",
    ];
    print "<div class='horizontal'>";
    foreach($tabs as $tab_title => $tab_file) {
        if ($tab_title == $title) {
            $linkClass = "current_tab";
        } else {
            $linkClass = "";
        }
        print "<a class='$linkClass' href='$tab_file.php'>$tab_title</a>";
    }
    print "</div>";
}
