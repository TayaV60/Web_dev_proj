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
        <a href="WireFrame0.php">Home</a>
        <a href="WireFrame5.php">Templates - Create</a>
        <a href="WireFrame2.php">Roles</a>
        <a href="#" class="active">Templates WIP</a>
        <a href="WireFrame1.php">Feedback WIP</a>
        <a href="WireFrame3.php">Candidates WIP</a>
        
        <a href="WireFrame4.php">Demo Template</a>
        <a href="#" class="right">Human Resources: <b>Candidate Feedback Application</b></a>
    </div>

    <div class="row">
    <div class="side">
        <h3><b>Templates</b></h3>
        <h4>New Template</h4>
    </div>


    <div class="main">
        <h2>Select Elements to include in Template</h2>
        <h5>Build a template</h5>
        <div class="fakeimg" style="height:auto;">
        <br></br>
        <p><em> User selects elements to add to template - area below would start blank and use some JS functions to dynamically add elements to the page: 
            this could be done via a dropdown to select elements stored, encoded, in the database</em>  </P>
        <br></br>
        <!-- (Feedback templates elements test)  -->

        <!-- 5 - 6 buttons to allow the user to select template elements to include -->

        <button type="button" onclick="alert('You pressed the button!')"> Add Free text</button>
        <button type="button" onclick="alert('You pressed the button!')"> Add Connecting Text</button>
        <button type="button" onclick="alert('You pressed the button!')"> Add Tickbox</button>
        <button type="button" onclick="alert('You pressed the button!')"> Add Two-way Radio Button</button>
        <button type="button" onclick="alert('You pressed the button!')"> Add Three-way Radio Button</button>

        <br></br>
    
                <!-- ELEMENT 0   Free text filled           -->

                <div style="background:#faf;">
                    <form id="ElementSelect">
                        <label for="ConnectText">
                        Connecting Text (the body of the template)
                        </label>
                        <br></br>
                        <textarea placeholder="Enter connecting text here.." id="ConnectText" name="connecttext" rows="5" cols="75"></textarea>
                    </form>
                </div>

                

                <!--       Optional free text to fill      -->
                <br></br>
                <div style="background:#fbf;">
                    <form id="ElementSelect">
                        <label for="FreeText">
                        Free Text (to be filled in when providing feedback)
                        </label>
                        <br></br>
                        <textarea placeholder="(Leave blank)" id="FreeText" name="freetext" rows="5" cols="75"></textarea>
                    </form>
                </div>

                <!--       Tickbox        -->
                <br></br>
                <div style="background:#fcf;">
                    <form id="ElementSelect">
                        <label for="TickBox">
                        Tick box x1
                        </label>
                        <br></br>
                        <textarea placeholder="Text to show next to tickbox goes here.." id="TickBox" name="tickbox" rows="5" cols="75"></textarea>
                        
                    </form>
                </div>

                <!--       Radio Button Group        -->
                <br></br>
                <div style="background:#fdf;">
                    <form id="ElementSelect">
                        <label for="FreeText">
                        Set of two radio buttons
                        </label>
                        <br></br>
                        <textarea placeholder="Text to show next to option 1 goes here.." id="TickBox1" name="tickbox1" rows="4" cols="75"></textarea>
                        <br></br>
                        <textarea placeholder="Text to show next to option 2 goes here.." id="TickBox2" name="tickbox2" rows="4" cols="75"></textarea>
                    </form>
                </div>
    
        <!-- (Feedback templates go here + options to create New or Edit)  -->
    
    </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->