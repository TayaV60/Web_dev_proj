<?php
include 'page_elements/Page.php';

$page = new Page("Create a new applicant", "Applicants");
print $page->top();
print $page->bottom();
