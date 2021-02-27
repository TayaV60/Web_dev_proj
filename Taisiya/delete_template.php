<?php
include 'db/Templates.php';
include 'page_elements/Page.php';

$page = new Page("Delete template", "Templates");
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
        <h3>Are you sure you want to delete this template?</h3>
        <form>
            <label for="title">Template name</label>
            <br>
            <input
                type="text"
                name="title"
                value="<?php echo $title ?>"
                
            >
            <br>
            <label for="contents">Template contents</label>
            <br>
            <textarea rows="10" cols="90" name="contents">
<?php echo $contents ?>
            </textarea>
            <div class="comments">
                <h4>Template Comments</h4>
                <?php
                foreach ($comments as $value) {
                    echo "<br><input type='checkbox' disabled checked>$value</li>";
                }
                ?>
            </div>
            <br>
        </form>
        <a href="templates.php">Cancel</a>
        <a href="delete_template_submitted.php?id=<?php echo $id?>">Delete</a>
        
    </div>
</div>
<?php

print $page->bottom();
