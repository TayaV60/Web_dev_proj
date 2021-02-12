<?php

echo "<pre>"; 
$divertion = ($_GET['dept']);
echo "</pre>";

header("Location: /WireFrame2.php?dept=".$divertion);

?>