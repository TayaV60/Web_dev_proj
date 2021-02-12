<!DOCTYPE html>
<html lang="en">                    <!-- OPENING HTML TAG -->


<!-------------------------------->
<!--          HEAD              -->
<!-------------------------------->

<head>
    <title>Page Title - in chrome tab</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!------------------------------- >         These link to the div sections in the body:
    <--          STYLE              -->
    <!------------------------------- >         body / .header / .header h1 / navbar / row / side / footer etc. -->

    <link rel="stylesheet" href="HTech_Style.css">
    
</head>


<!-------------------------------->
<!--          BODY              -->
<!-------------------------------->

<body>

    <div class="header">
        <h1>HappyTech</h1>
        
    </div>

    <div class="navbar">
        <a class="active">Home</a>
        <a href="WireFrame5.php">Templates - Create</a>
        <a href="WireFrame2.php">Roles</a>
        <a href="#" >Feedback WIP</a>
        <a href="WireFrame3.php">Candidates WIP</a>
        
        <a href="WireFrame4.php">Demo Template</a>
        <a href="#" class="right">Human Resources: <b>Candidate Feedback Application</a>
    </div>

    <div class="row">
    <div class="side">
        <h3><b>Templates</b></h3>
        <h5><em>Departments:</em></h5>
        <p>Accounts</p>
        <p>Sales</p>
        <p>Marketing</p>
        <p>Operations</p>
        <p>Research</p>
    </div>


    <div class="main">
        <h2>Confirm Template</h2>
        <h5>Press save to proceed</h5>
        <div class="fakeimg" style="height:auto;">

            <?php                   
                    echo "<pre>";
                    print_r($_GET);
                    echo "</pre>";

                    foreach ($_GET as $k => $v) {
                        if($k == "connectText"){ 
                            echo '<div style="background:#faf;">
                            <form id="ElementSelect">
                                <label for="ConnectText">
                                Connecting Text (the body of the template)
                                </label>
                                <br></br>
                                <textarea placeholder="Enter connecting text here.." id="ConnectText" name="connecttext" rows="5" cols="75">'.$v.'</textarea>
                            </form>
                        </div>';


                        }
                        if($k == "freeText"){
                            echo '<br></br>
                            <div style="background:#fbf;">
                                <form id="ElementSelect">
                                    <label for="FreeText">
                                    Free Text (to be filled in when providing feedback)
                                    </label>
                                    <br></br>
                                    <label id="FreeText" name="freetext"><h5>'.$v.'</h5><input type="checkbox" disabled="true"</textarea>
                                </form>
                            </div>';
                        }
                        if($k == "tickbox"){
                            echo '<br></br>
                            <div style="background:#fcf;">
                                <form id="ElementSelect">
                                    <label for="TickBox">
                                    Tick box x1
                                    </label>
                                    <br></br>
                                    <textarea id="TickBox" name="tickbox" rows="5" cols="75">'.$v.'</textarea>
                                    
                                </form>
                            </div>';
                        }
                        // echo ($k == "connectText");
                        // echo ($k == "freeText");
                        // echo ($k == "tickbox");
                        // echo $v;

                    }
                    // header("Location: /confirmTemplateSave.php");
            ?>
        
        <a href="WireFrame5.php" class="active">Confirm Template</a>
    
        </div>
      
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->