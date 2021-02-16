<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

// run queries here...

// close connection
CloseCon($conn);

$DEFAULT_TEMPLATE = "{{date}} 
{{applicant_name}} 
{{applicant_email}} 

Dear {{applicant_name}}, 

Thank you for your application to the position of {{position_title}}. We have a large number of applicants for this position and we are sorry to inform you that on this occasion you were not selected for the interview. 

We wish you all the best in your job search. 

Best wishes, 
{{interviewer_name}} 
{{interviewer_email}}";

?>
<head>
    <link rel="stylesheet" href="forms.css">
</head>    

<body>

<!-- header -->
<div class="header">
    <h1>Happy Tech</h1>
    <h3>HR tool for writing application feedback</h3>
</div>

<!-- horizontal buttons, see code in topmenu.php -->
<?php
include 'topmenu.php';
?>

<!-- container with the vertical buttons and the contents field inside -->
<div class="container">

    <!-- vertical buttons, see code in sidemenu.php -->
    <?php
    include 'sidemenu.php';
    ?>

    <!-- the contents field -->
    <div class="main">
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

