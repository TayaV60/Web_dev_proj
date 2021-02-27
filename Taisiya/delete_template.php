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
                <a href="create_or_edit.php">Cancel</a>
                <a href="delete_template_submitted.php?id=<?php echo $id?>">Delete</a>
                
            </div>

            
        </div>
    </div>
</div>

</body>

