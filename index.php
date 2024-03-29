<?php

require_once 'page_elements/Page.php';

$page = new Page("Home", "");

$page->top();

?>

<p>
To start, create a list of current positions using the Roles page. You can create templates for different interview stages using the Templates page.
</p>

<p>
You can then enter applicants using the Applicants page, assigning them to a list of roles.
</p>

<p>
When an applicant does not pass an interview stage, you can generate feedback for that stage using the Generate Feedback page.
</p>

<?php

$page->bottom();
