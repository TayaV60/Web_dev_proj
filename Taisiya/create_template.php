<?php
include 'db_connection.php';

// open database connextion
$conn = OpenCon();

// run queries here...

// close connection
CloseCon($conn);

$DEFAULT_TEMPLATE = "{{Date}}
{{Name of the applicant}}
{{email of the applicant}}

Dear {{name of the applicant}},

Thank you for your application to the position of ((title of the position)). 
We have a large number of applicants for this position and we are sorry to inform you that on this occasion you were not selected for the interview. 

We wish you all the best in your job search. 

Best wishes, 
{{Name of the HR agent}}
{{email to the HR agent}}";

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
                <form action="create_templates_submitted.php" method="post">
                    <label for="title">Create a new template</label><br>
                    <br>
                    <input
                        type="text"
                        name="title"
                        placeholder="Enter the name of your template"
                    >
                    <br>
                    <textarea rows="10" cols="90" name="contents">
<?php echo $DEFAULT_TEMPLATE ?>
                    </textarea>
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

</body>

