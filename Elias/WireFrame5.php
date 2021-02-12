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

<body onload="createTable()">

    <div class="header">
        <h1>HappyTech</h1>
        
    </div>

    <div class="navbar">
        <a href="WireFrame0.php" >Home</a>
        <a href="#" class="active"><em>Templates</em></a>
        <a href="WireFrame3.php">Candidates</a>
        <a href="WireFrame2.php">Roles</a>
        <p class="right" style="text-align:right;color:white;padding-right:30px">Human Resources: <b>Candidate Feedback Application</b></p>
    </div>

    <div class="row">
    <div class="side">
        <h3><b>Templates</b></h3>
        <h5><em>Departments:</em></h5>
        <p>Sales</p>
        <p>Finance</p>
        <p>Design</p>
        <p>Admin</p>
    </div>


    <div class="main">
        <h2>[ Template Builder ]</h2>
        <h5>Template Info</h5>
        <div class="fakeimg" style="height:100px;">
            <table style="width:80%"> 
            <colgroup>
                <col span="2">
                
            </colgroup>
                <tr>
                    <td>Template Title</td>
                    <td><INPUT type="text" name="Candidate"></td>
                    <td>User</td>
                    <td><INPUT type="text" name="Reviewer"></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td><INPUT type="text" name="Position"></td>
                    <td>Today</td>
                    <td><p style="background:#FFF"><?php echo Date("d/m/Y"); ?></p></td>
                </tr>

            </table>
        </div>
        <h5>Select Template Elements</h5>
        <div class="fakeimg" style="height:auto;">
            <br>
            <p>
            <input type="button" id="addRow" value="Add Connecting Text" onclick="addElement0()" />
            <input type="button" id="addRow" value="Add Free Text Box" onclick="addElement1()" />
            <input type="button" id="addRow" value="Add Tick Box" onclick="addElement2()" />
            </p>
            <div id="cont"></div>   <!--the container to add the table.-->
            <p><input type="submit" form="form0" value="Submit Data" action="submit" /></p>
            <p><input type="button" id="test" value="Test / Debug" onclick="deleteProto()" /></p>
        </div>
        <br>
    </div>
    </div>

</body>

<!-------------------------------->
<!--          SCRIPT            -->
<!-------------------------------->


<script type="text/javascript" src="showElements.js">                            /* JavaScript */

    
</script>  
<!--  FROM:  www.encodedna.com/javascript/dynamically-add-remove-rows-to-html-table-using-javascript-and-save-data.htm -->

</html>                             <!-- CLOSING HTML TAG -->