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
        <a class="active">Roles - New</a>
        <a href="WireFrame5.php">Templates - Create</a>
        <a href="WireFrame2.php">Roles</a>
        <a href="#" >Feedback WIP</a>
        <a href="WireFrame3.php">Candidates WIP</a>
        
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





    <div class="main">
        <h2>Add New Role</h2>
        <h5>Enter details of the new vacancy</h5>
        <div class="fakeimg" style="height:auto;">

            <form id='saveRole' action='/WireFrame2b.php' method='get'>
                <table style="width:80%"> 
                    <colgroup>
                        <col span="2">
                    </colgroup>
                    
                    <tr>
                        <td>Job Title</td>
                        <td><INPUT type="text" name="Role Name"></td>
                        <td>Hiring Manager</td>
                        <td>
                            <select id='name' name='Manager Name'>
                                <?php

                                    
                                    $dbUserName = "root";
                                    $dbPassword = "root";
                                    $dbServerName = "localhost";
                                    $dbName = "HappyTech";

                                    $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

                                    //echo $conn->connect_errno;
                                                                                                            // QUERY
                                    $query = "select * from managers;";                    

                                    $resultObj1 = $conn->query($query);

                                    $managerName = "";

                                    if($resultObj1->num_rows > 0)
                                    {
                                        while($singleRow = $resultObj1->fetch_assoc())
                                        {
                                            echo "<option value=".$singleRow['managerID'].">".$singleRow['name']."</option> ";
                                        }
                                    }



                                ?>


                            </select>
                        
                        
                        </td>    <!--- select   dropdown  -->
                    </tr>
                    <tr>
                        <td>Feedback after (date)</td>
                        <td><INPUT type="text" name="End Date"></td>
                        
                    </tr>
                    <tr>
                        <td>Created Date:</td>
                        <td><p><?php echo Date("Y-m-d"); ?></p></td>
                        <td><INPUT type="hidden" name="Create Date" value="<?php echo Date("Y-m-d") ?>"></td>
                    </tr>

                </table>
                <input form='saveRole' type='submit' value='Save'>


            <!--   INSERT ENTERED DATE INTO DB  /  USE INITIAL FIELDS  /  REFINE DATA OBJECTS LATER            -->
            <!--****************************************************************************************

                insert into roles(roleName, managerID, endDate, createDate) 
                values('Contracts Clerk', 4, '2021-04-15', curdate());
                        Job Title       Manager  date       today(auto)
            -->

            </form>
            <!-- <form id='saveRole' method='get' action='WireFrame2b.php'>
                <br>
            </form> -->
        

            

    
        </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->