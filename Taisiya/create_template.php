<?php
include 'page_elements/Page.php';

$page = new Page("Create a new template", "Templates");
print $page->top();

$DEFAULT_TEMPLATE = "{{date}} 
{{applicant_name}} 
{{applicant_email}} 

Dear {{applicant_name}}, 

Thank you for your application to the position of {{position_title}} at HappyTech. 
We wish you all the best in your job search. 

Best wishes, 
{{interviewer_name}} 
{{interviewer_email}}";

?>
<div class="template_form_container">
    <div class="template_form">
        <h3>Create a new template</h3>
        <form action="create_templates_submitted.php" method="post">

            <label for="title">Template name</label>
            <br>
            <input
                type="text"
                name="title"
                placeholder="Enter the name of your template"
            >
            <br>
            <label for="contents">Template contents</label>
            <br>
            <textarea rows="10" cols="90" name="contents">
<?php echo $DEFAULT_TEMPLATE ?>
            </textarea>
            <div class="comments">
                <h4>Template Comments</h4>
                <a onClick="addComment()">Add comment</a>
                <ul id="form-comments"></ul>
            </div>
            <br>
            <input type="submit" name="newtemplate" value="Save">
            <a href="templates.php">Cancel</a>
        </form>
    </div>

    <div class="avialable_templates">
        <h3>Available template variables</h3>
        <ul>
            <li>{{applicant_email}} </li>
            <li>{{applicant_name}} </li>
            <li>{{date}} </li>
            <li>{{interviewer_email}}</li>
            <li>{{interviewer_name}}</li>
            <li>{{position_title}}</li>
        </ul>
    </div>
</div>

<?php

include 'page_elements/Comments.php';

print $page->bottom();
