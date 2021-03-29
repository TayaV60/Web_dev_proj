<?php
require_once 'coordination/Templates.php';
require_once 'page_elements/Page.php';

$handler = new TemplateFormHandler();
$data = $handler->handleCreateOrEdit();

$page = new Page($data->pageTitle, "Templates");
print $page->top();

?>

<?php if ($data->saved): ?>
    Template '<?=$data->title?>' saved successfully.

    <h3>Contents</h3>
    <pre><?=$data->contents?></pre>

    <h3>Comments</h3>
    <?php foreach ($data->comments as $comment): ?>
        <br>
        <input type='checkbox' disabled checked> <?=$comment?>
    <?php endforeach?>

<?php elseif ($data->errorSaving): ?>

    <?=$data->errorSaving?>

<?php else: ?>

    <div class="template_form_container">
        <div class="template_form">

            <?php if ($data->mode == 'create'): ?>
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
                    value="<?=$data->title?>"
                >
                <?=$data->titleValidationError?>
                <br>

                <label for="contents">Template contents</label>
                <br>
                <textarea rows="10" cols="90" name="contents"><?=$data->contents?></textarea>
                <?=$data->contentsValidationError?>

                <div class="comments">
                    <h4>Template Comments</h4>
                    <a onClick="addComment()">Add comment</a>
                    <ul id="form-comments">
                    <?php foreach ($data->comments as $comment): ?>
                        <li>
                            <input name="comments[]" size="80" type="text" value="<?=$comment?>">
                            <a><img class="icon" src="assets/delete.png" alt="Remove Comment"></a>
                        </li>
                    <?php endforeach?>
                    </ul>
                    <?=$data->commentsValidationError?>
                </div>

                <br>

                <?php if ($data->valid): ?>
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
        const index = formComments.getElementsByTagName('li').length + 1
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
