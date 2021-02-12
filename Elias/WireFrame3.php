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
        <a href="WireFrame2.php">Roles</a>
        <a href="WireFrame1.php">Feedback</a>
        <a href="WireFrame3.php">Templates</a>
        <a href="#" class="active">Candidates</a>
        
        <a href="WireFrame4.php">Demo Template</a>
        <a href="#" class="right">Human Resources: <b>Candidate Feedback Application</b></a>
    </div>

    <div class="row">
    <div class="side">
        <h3><b>Applicants</b></h3>
        <h5><em>Departments:</em></h5>
        <p>Sales</p>
        <p>Finance</p>
        <p>Design</p>
        <p>Admin</p>
    </div>


    <div class="main">
        <h2>Candidates</h2>
        <h5>Choose a candidate to begin feedback</h5>
        <div class="fakeimg" style="height:auto;">
            <?php                                               /*       PHP       */

                $dbUserName = "root";
                $dbPassword = "root";
                $dbServerName = "localhost";
                $dbName = "HappyTech";

                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

                $query3 = "select candidates.candID, candidates.candName, roles.roleName, candidates.applyDate, candidates.processed
                from candidates, roles
                where roles.roleID = candidates.roleID;";
                $resultObj3 = $conn->query($query3);
                



                    
            ?>

            <div>
                <table  style="width:90%">
                    <colgroup>
                        <col span="5">
                    </colgroup>
                    <tr>
                        <th style="text-align:left">ID  #</th>
                        <th style="text-align:left">Name</th>
                        <th style="text-align:left">Role</th>
                        <th style="text-align:left">Date of Application</th>
                        <th style="text-align:center">Processed?</th> 
                        <th>
                            <form method='get' action='/WireFrame3i.php'>
                                <button type='submit'>New</button>
                                <!-- <INPUT type="hidden" name="roleID" value="<?php //echo $roleID; ?>"> -->
                            </form>
                        
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align:left"></td>
                        
                        <td style="text-align:left"></td>
                    </tr>

                <?php
                if($resultObj3->num_rows > 0)
                                {
                                    while($singleRow = $resultObj3->fetch_assoc())
                                    {
                                        echo "<tr><td><font size='4pt'>".$singleRow['candID']."</td>
                                                <td><font size='5pt'>".$singleRow['candName']."</td>
                                                <td><font size='5pt'>".$singleRow['roleName']."</td>
                                                <td><font size='4pt'>".$singleRow['applyDate']."</td>
                                                <td style='text-align:center'><font size='4pt'>".$singleRow['processed']."</td></tr>";
                                    }
                                }

                ?>
                </table>
            
            <p></p>

                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>



        </div> 
        <p><b>To Do:  Add links to table / add filters / finish+check path w. new candidate</b></p>
        <br>
    </div>
    </div>

</body>

</html>                             <!-- CLOSING HTML TAG -->