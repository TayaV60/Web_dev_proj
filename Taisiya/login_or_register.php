<?php
include 'page_elements/Page.php';

$page = new Page("Login or Register", "", false);

print $page->top();

?>

<p>
Please either <a href="register.php">register</a> or <a href="login.php">login</a>.
</p>

<?php

print $page->bottom();
