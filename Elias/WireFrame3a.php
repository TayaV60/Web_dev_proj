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
        <a href="#" >Feedback WIP</a>
        <a class="active">New Applicant</a>
        
        <a href="WireFrame4.php">Demo Template</a>
        <a href="#" class="right">Human Resources: <b>Candidate Feedback Application</b></a>
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


    <?php
                                                                                    //  CONNECT TO DATABASE
                $dbUserName = "root";
                $dbPassword = "root";
                $dbServerName = "localhost";
                $dbName = "HappyTech";

                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

                //echo $conn->connect_errno;
                                                                                        // QUERY
                $query = "select roles.roleID, roles.roleName        
                        from roles";                    

                $resultObj = $conn->query($query);

                // if($resultObj2->num_rows > 0)
                //     {
                //         while($singleRow = $resultObj2->fetch_assoc())
                //         {
                //             echo "<option value=".$singleRow['deptID'].">".$singleRow['deptName']."</option> ";
                //         }
                //     }


    ?>


    <div class="main">
        <h2>Add Applicant</h2>
        <h5>Enter Details of New Candidate</h5>
        <div class="fakeimg" style="height:auto;">

            <form id='saveCand' action='/WireFrame3j.php' method='get'>
                <table style="width:80%"> 
                    <colgroup>
                        <col span="2">
                        
                    </colgroup>
                    <tr>
                        <td>Candidate Name:</td>
                        <td><INPUT type="text" name="Candidate"></td>
                        <td>Role Applied For:</td>

                        <td>
                        
                        <?php
                            //echo "<form action='divertDept.php' method='get'>";
                            //echo "<label> Select Department "."  "."</label>";

                            echo "<select id='depp' name='dept'>";

                            $deptName = "";

                            if($resultObj->num_rows > 0)
                            {
                                while($singleRow = $resultObj->fetch_assoc())
                                {
                                    echo "<option value=".$singleRow['roleID'].">".$singleRow['roleName']."  # ".$singleRow['roleID']."</option> ";
                                }
                            }
                        
                            echo "</select>";
                    
                            //echo "<input type='submit' value='Select'>";
                    
                        //echo "</form>";
                        ?>
                        </td>

                    </tr>
                    <tr>
                        <td>Candidate File:</td>
                        <td><INPUT type="text" name="Docs"></td>
                        <td>Date</td>
                        <td><p><?php echo Date("d/m/Y"); ?></p></td>
                    </tr>

                    </table>
                    <input form='saveCand' type='submit' value='Save'>
            </form>
        
    
        </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->