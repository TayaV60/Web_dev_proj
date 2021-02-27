<?php
include 'db/Templates.php';
include 'page_elements/Page.php';

$page = new Page("Edit template", "Templates");
print $page->top();

$dbTemplates = new DBTemplates();

$id=$_GET['id'];

$template = $dbTemplates->getTemplate($id);
$contents = $template["contents"];
$title = $template["title"];
$comments = explode("::::", $template["comments"]);

?>
<div class="template_form_container">
    <div class="template_form">
        <h3>Create a new template</h3>
        <form action="edit_template_submitted.php?id=<?php echo $id?>" method="post">

            <label for="title">Template name</label>
            <br>
            <input
                type="text"
                name="title"
                value="<?php echo $title ?>"
                placeholder="Enter the name of your template"
            >
            <br>
            <label for="contents">Template contents</label>
            <br>
            <textarea rows="10" cols="90" name="contents">
<?php echo $contents ?>
            </textarea>
            <div class="comments">
                <h4>Template Comments</h4>
                <a onClick="addComment()">Add comment</a>
                <ul id="form-comments">
                <?php
                    foreach ($comments as $comment) {
                        echo "<li>
                            <input name=\"comments[]\" size=\"80\" type=\"text\" value=\"$comment\">
                            <a><img class=\"icon\" src=\"assets/delete.png\" alt=\"Remove Comment\"></a>
                        </li>";
                    }
                ?>
                </ul>
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
