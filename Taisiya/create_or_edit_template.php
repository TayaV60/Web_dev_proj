<?php
include 'coordination/Feedback.php';
include 'coordination/Supporting_functions.php';
include 'page_elements/Page.php';

// a FeedbackCoordinator object
$coFeedback = new FeedbackCoordinator();

// A default template to be used if in 'create' mode.
$DEFAULT_TEMPLATE = "{{date}}
{{applicant_name}}
{{applicant_email}}

Dear {{applicant_name}},

Thank you for your application to the position of {{position_title}} at HappyTech.
We wish you all the best in your job search.

Best wishes,
{{interviewer_name}}
{{interviewer_email}}";

// GET variables
$id = getQueryParameter('id');
$mode = getMode($id);

// POST input field variables
$comments = [];
$contents = null;
$title = null;

// form state variables
$valid = false;
$saved = false;
$errorSaving = null;
$titleValidationError = null;
$contentsValidationError = null;
$commentsValidationError = null;

// if user has not posted yet, setup necessary default values
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($mode == 'edit') {
        // if editing, get the existing template from the DB
        $template = $coFeedback->getTemplate($id);
        $contents = $template["contents"];
        $title = $template["title"];
        $comments = $template["comments"];
    } else {
        // if creating, use the default template
        $contents = $DEFAULT_TEMPLATE;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") { // if user has posted

    // extract value of input fields from $_POST
    $contents = $_POST['contents'];
    $title = $_POST['title'];
    if (isset($_POST['comments'])) {
        $comments = $_POST['comments'];
    }

    // validate title
    if (strlen($title) < 2) {
        $titleValidationError = "Title is not valid";
    }

    // validate contents
    if (strlen($contents) < 100) {
        $contentsValidationError = "Insufficient contents";
    }

    // validate comments
    if (!$comments || count($comments) < 1) {
        $commentsValidationError = "Add comments to continue";
    }

    // if all fields are valid, then the form is valid
    if (!$titleValidationError && !$contentsValidationError && !$commentsValidationError) {
        $valid = true;
    }

    // if the form is valid, the submit button will post a "save", so we can try to save
    if ($valid && isset($_POST['save'])) {
        try {
            if ($id && $mode == 'edit') {
                // if there is an id and mode is edit, then try to save using the editTemplate method
                $coFeedback->editTemplate($id, $title, $contents, $comments);
            } else {
                // if not, try to create
                $coFeedback->createTemplate($title, $contents, $comments);
            }
            $saved = true;
        } catch (Exception $e) {
            $errorSaving = "Could not create template.";
        }
    }

}

$pageTitle = 'Create a new template';
if ($mode == 'edit') {
    $pageTitle = 'Edit a new template';
}

$page = new Page($pageTitle, "Templates");
print $page->top();

?>

<?php if ($saved): ?>
    Template '<?=$title?>' saved successfully.

    <h3>Contents</h3>
    <pre><?=$contents?></pre>

    <h3>Comments</h3>
    <?php foreach ($comments as $comment): ?>
        <br>
        <input type='checkbox' disabled checked> <?=$comment?>
    <?php endforeach?>

<?php elseif ($errorSaving): ?>

    <?=$errorSaving?>

<?php else: ?>

    <div class="template_form_container">
        <div class="template_form">

            <?php if ($mode == 'create'): ?>
                <h3>Create a new template</h3>
            <?php else: ?>
                <h3>Edit existing template</h3>
            <?php endif?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']); ?>" method="post">

                <label for="title">Template name</label>
                <br>
                <input
                    type="text"
                    name="title"
                    placeholder="Enter the name of your template"
                    value="<?=$title?>"
                >
                <?=$titleValidationError?>
                <br>

                <label for="contents">Template contents</label>
                <br>
                <textarea rows="10" cols="90" name="contents"><?=$contents?></textarea>
                <?=$contentsValidationError?>

                <div class="comments">
                    <h4>Template Comments</h4>
                    <a onClick="addComment()">Add comment</a>
                    <ul id="form-comments">
                    <?php foreach ($comments as $comment): ?>
                        <li>
                            <input name="comments[]" size="80" type="text" value="<?=$comment?>">
                            <a><img class="icon" src="assets/delete.png" alt="Remove Comment"></a>
                        </li>
                    <?php endforeach?>
                    </ul>
                    <?=$commentsValidationError?>
                </div>

                <br>

                <?php if ($valid): ?>
                    <input type="submit" name="save" value="Save">
                <?php else: ?>
                    <input type="submit" name="check" value="Check">
                <?php endif?>

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

    addRemoveEventListeners()

    </script>

<?php endif?>

<?php print $page->bottom();?>
