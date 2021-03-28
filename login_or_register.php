<?php
require_once 'page_elements/Page.php';

$page = new Page("Login or Register", "", false);

print $page->top();

?>

<p>
<div class='links'>
Please either <a class='links' href="register.php">register</a> or <a class='links' href="login.php">login</a>.
</div>
</p>

<?php

print $page->bottom();
