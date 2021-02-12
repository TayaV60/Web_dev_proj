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
        <a href="WireFrame2.php" class="active">Roles</a>
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



    <?php

            $dbUserName = "root";
            $dbPassword = "root";
            $dbServerName = "localhost";
            $dbName = "HappyTech";

            $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

            //echo $conn->connect_errno;
                                                                                    // QUERY

            $roleID = $_GET['roleID'];
            $query = "select roles.roleName, roles.roleID, roles.createDate, roles.endDate, roles.managerID, managers.name, managers.deptID, department.deptName, department.deptID      
                    from roles, managers, department 
                    where roles.roleID = $roleID
                    and managers.deptID = department.deptID 
                    and roles.managerID = managers.managerID;";                    
            $resultObj = $conn->query($query);


            $query2 = "select candidates.roleID, candidates.candName, candidates.applyDate, candidates.processed, roles.roleName
                       from candidates, roles
                       where roles.roleID = candidates.roleID
                       and candidates.roleID = $roleID;";
            $resultObj2 = $conn->query($query2);


            $ech2 = "";  
            $ech = "";  

                if($resultObj->num_rows > 0)
                {
                    while($singleRow = $resultObj->fetch_assoc())
                    {
                        $ech =  "<td><font size='5pt'>".$singleRow['deptName']."</td>
                                    <td><font size='5pt'>".$singleRow['createDate']."</td>
                                    <td><font size='5pt'>".$singleRow['endDate']."</td>
                                    <td><font size='4pt'>".$singleRow['name']."</td>";
                        $ech2 = $singleRow['roleName'];
                    }
                }

            // echo "<pre>";
            // print_r($resultObj->fetch_assoc()['roleName']);
            // echo "</pre>";

        

    ?>

        





    <div class="main">
        <h1><?php echo $ech2; ?></h1>
        <h3 style="text-align:center">Role Details</h3>

        <div class="fakeimg" style="height:auto;">

        

       

            <div>
                <form>
                    <label text="Role Details">
                        <table style="width:80%">
                        <colgroup>
                            <col span="4">
                        </colgroup>
                            <tr>
                                <th style="text-align:left">Department</th>
                                <th style="text-align:left">Date added</th>
                                <th style="text-align:left">End Date</th>
                                <th style="text-align:left">Hiring Manager</th>
                            </tr>
                            <br>
                            <tr style="height:30px"></tr>
                            <tr> 
                                <?php 
                                    echo $ech;
                                    //echo $ech2;
                                ?>
                            </tr>
                        </table>
                </form>
            </div>    
        

            <br>
            <a href="WireFrame2.php"><h5><b>&lt Back</b></h5> </a>
    
        </div>

        <br>
        <h3 style="text-align:center">Applicants</h3>
        <br>

        <div class="fakeimg" style="height:auto;">

            <br><br>

            

            <div>
                <table  style="width:70%">
                    <colgroup>
                        <col span="3">
                    </colgroup>
                    <tr>
                        <th style="text-align:left">Candidate Name</th>
                        <th style="text-align:left">Date Applied</th>
                        <th style="text-align:left">Processed?</th>
                        <th>
                            <form method='get' action='/WireFrame3i.php'>
                                <button type='submit'>New</button>
                                <INPUT type="hidden" name="roleID" value="<?php echo $roleID; ?>">
                            </form>
                        
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align:left"></td>
                        
                        <td style="text-align:left"></td>
                    </tr>

                <?php
                if($resultObj2->num_rows > 0)
                                {
                                    while($singleRow = $resultObj2->fetch_assoc())
                                    {
                                        echo "<tr><td><font size='5pt'>".$singleRow['candName']."</td>
                                                <td>".$singleRow['applyDate']."</td>
                                                <td>".$singleRow['processed']."</td></tr>";
                                    }
                                }

                ?>
                </table>
            
            <p></p>

                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->