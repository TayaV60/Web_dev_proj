<?php
include 'db/Templates.php';

$dbTemplates = new DBTemplates();

$id=$_GET['id'];

$template = $dbTemplates->getTemplate($id);
$contents = $template["contents"];
$title = $template["title"];
$comments = explode("::::", $template["comments"]);

?>
<head>
    <link rel="stylesheet" href="forms.css">
</head>    

<body>

<div class="header">
    <h1>Happy Tech</h1>
    <h3>HR tool for writing application feedback</h3>
</div>

<!-- horizontal buttons, see code in topmenu.php -->
<?php
include 'topmenu.php';
topMenu("Templates");
?>

<div class="container">
    <!-- vertical buttons, see code in sidemenu.php -->
    <?php
    include 'sidemenu.php';
    sideMenu("");
    ?>

    <div class="main">
    <div class="main">
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
                    <a href="create_or_edit.php">Cancel</a>
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
    </div>
</div>

<script>

const formComments = document.getElementById("form-comments")

function addRemoveEventListeners() {
    const formCommentLis = formComments.getElementsByTagName('li')

    for (const li of formCommentLis) {
        const a = li.getElementsByTagName("a")[0];
        a.addEventListener('click', function() {
            li.remove();
        })
    }
}

function addComment() {
    const index = formComments.getElementsByTagName('li').length
    formComments.innerHTML += `
    <li>
        <input name="comments[]" size="80" type="text" value="Candidate comment ${index}">
        <a><img class="icon" src="assets/delete.png" alt="Remove Comment"></a>
    </li>`;
    addRemoveEventListeners()
}

function removeComment() {
    console.log('Remove', this)
}

if (formComments.getElementsByTagName('li').length < 1) {
    addComment()
}

addRemoveEventListeners()

</script>

</body>

