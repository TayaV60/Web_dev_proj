<?php

require_once 'coordination/Templates.php';
require_once 'page_elements/Page.php';

function deleteView($data)
{
    ?>
<div class="template_form_container">

    <?php if ($data->deleted): ?>

        Template <?=$data->title?> has been deleted.

    <?php elseif ($data->deletionError): ?>

        <?=$data->deletionError?>

    <?php else: ?>

        <div class="template_form">
            <h3>Are you sure you want to delete this template?</h3>
            <h4>Template name</h4>
            <?=$data->title?>"
            <h4>Template contents</h4>
            <pre><?=$data->contents?></pre>
            <h4>Template Comments</h4>
            <ul>
            <?php foreach ($data->comments as $comment): ?>
                <li>
                    <input type='checkbox' disabled checked><?=$comment?>
                </li>
            <?php endforeach?>
            </ul>
            <a href="templates.php">Cancel</a>
            <a href="delete_template.php?id=<?=$data->id?>&confirmed=true">Delete</a>
        </div>

    <?php endif?>

</div>
<?php
}

function createOrEditView($data)
{
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

<?php
}

function listView($data)
{
    ?>

<a class='links' href="create_or_edit_template.php">Create new template</a>
<br>
<br>
<table>
    <thead>
        <tr>
            <th>Template</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->templates as $template): ?>
            <tr>
                <td>
                    <?=$template["title"]?>
                </td>
                <td>
                    <a href="create_or_edit_template.php?id=<?=$template["id"]?>" title="Edit <?=$template["title"]?>" >
                        <img class="icon" src="assets/edit.png" alt="Edit">
                    </a>
                </td>
                <td>
                    <a href="delete_template.php?id=<?=$template["id"]?>" title="Delete <?=$template["title"]?>" >
                        <img class="icon" src="assets/delete.png" alt="Delete">
                    </a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>
<?php
}

class TemplateView
{
    public function __construct()
    {
        $this->handler = new TemplateFormHandler();
    }

    public function createOrEdit()
    {
        $data = $this->handler->handleCreateOrEdit();

        $page = new Page($data->pageTitle, "Templates");
        print $page->top();

        createOrEditView($data);

        print $page->bottom();
    }

    public function delete()
    {
        $data = $this->handler->handleDelete();

        $page = new Page("Delete template", "Templates");
        print $page->top();

        deleteView($data);

        print $page->bottom();
    }

    function list() {
        $data = $this->handler->handleList();

        $page = new Page("List existing templates", "Templates");
        print $page->top();

        listView($data);

        print $page->bottom();
    }
}
