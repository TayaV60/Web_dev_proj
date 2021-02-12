<?php

    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
    
    $newTemplateArray = $_GET;

    foreach ($newTemplateArray as $k => $v) {
        echo "$k => $v"."<br>";
    }
    // header("Location: /confirmTemplateSave.php");

?>