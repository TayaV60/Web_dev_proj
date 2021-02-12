<!DOCTYPE html>
<html lang="en">                    <!-- OPENING HTML TAG -->


<!-------------------------------->
<!--          HEAD              -->
<!-------------------------------->

<head>
    <title>Page Title - in chrome tab</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-------------------------------->
    <!--          STYLE             -->
    <!------------------------------- >

    *    These link to the div sections in the body:
    *    body / .header / .header h1 / navbar / row / side / footer etc.
    -->

    <link rel="stylesheet" href="HTech_Style.css">
    <style>
        table{
            border-collapse:collapse;
            border:1px solid #FF0000;
            padding-right:40px
            }

            table td{
            border:1px solid #000040;
            padding-right:20px;
            padding-left:15px;
            padding-top:5px;
            }
            table th{
            border:1px solid #000040;
            padding-right:25px;
            padding-left:20px;
            padding-top:5px;
            }
    </style>
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
        <a href="#"class="active"><em>Roles</em></a>
        <a href="WireFrame1.php">Feedback</a>
        <a href="WireFrame3.php">Templates</a>
        <a href="WireFrame3.php">Candidates</a>
        <a href="WireFrame4.php">Demo Template</a>
        
        <a href="#" class="right">Human Resources: <b>Candidate Feedback Application</b></a>
    </div>

    



    <div class="row">
    <div class="side">
        <h3><b>Roles</b></h3>
        <h5><em>Departments:</em></h5>
        <p>Sales</p>
        <p>Finance</p>
        <p>Design</p>
        <p>Admin</p>
    </div>


    <div class="main">
        <h2>Roles</h2>
        <h5>Select role to provide feedback for all applicants:</h5>
        <div class="fakeimg" style="height:auto; width:auto;">
            <?php
                                                                                    //  CONNECT TO DATABASE
                $dbUserName = "root";
                $dbPassword = "root";
                $dbServerName = "localhost";
                $dbName = "HappyTech";

                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

                //echo $conn->connect_errno;
                                                                                        // QUERY
                $query = "select roles.roleName, managers.name, department.deptName        
                        from roles, managers, department 
                        where managers.deptID = department.deptID 
                        and roles.managerID= managers.managerID;";                    

                $resultObj = $conn->query($query);
                
                // Department query                                                 // QUERY2 department ID & Name
                $query2 = "select deptID, deptName from department";                        
                $resultObj2 = $conn->query($query2);

                //
                $dept = $_GET['dept'];

                
                
                
        if ($dept){                                                                     // QUERY3 roles with dept
            $query3 = "select roles.roleName, roles.roleID, roles.createDate, roles.endDate, managers.name, department.deptName 
            from roles, managers, department 
            where managers.deptID = department.deptID 
            and roles.managerID= managers.managerID
            and department.deptID = $dept
            order by roles.endDate, managers.name;"; 

        }
                
        else{
            $query3 = "select roles.roleName, roles.roleID, roles.createDate, roles.endDate, managers.name, department.deptName 
                    from roles, managers, department 
                    where managers.deptID = department.deptID 
                    and roles.managerID= managers.managerID
                    order by roles.endDate, department.deptID;"; 
        }
                $resultObj3 = $conn->query($query3);
                
                echo "<form action='divertDept.php' method='get'>";
                    echo "<label> Select Department "."  "."</label>";

                    echo "<select id='depp' name='dept'>";

                    $deptName = "";

                    if($resultObj2->num_rows > 0)
                    {
                        while($singleRow = $resultObj2->fetch_assoc())
                        {
                            echo "<option value=".$singleRow['deptID'].">".$singleRow['deptName']."</option> ";
                        }
                    }
                
                    echo "</select>";
            
                    echo "<input type='submit' value='Select'>";
            
                echo "</form>";

                echo "<form method='get' action='/WireFrame2a.php'>";
                    echo "<br><label> Add new vacancy"."    "."</label>";
                    echo "<button type='submit'>New</button>";
                echo "</form>";
            

                
                // if($dept){
                //     $deptName = $resultObj3->fetch_assoc();
                //     $deptName = $deptName['deptName'];
                // }

                // Dept2a query                                 //  QUERY to show dept name as title
                if($dept){
                    $query2a = "select deptName from department where department.deptID = $dept";
                    $resultObj2a = $conn->query($query2a);
                    $topRow = $resultObj2a->fetch_assoc();
                    $deptName = $topRow['deptName'];

                    echo "<h2>$deptName</h2>";
                    // SHOWS 'Show All' BUTTON IF DEPT SELECTED:
                    if ($dept){echo "<form method='get' action='/WireFrame2.php'><button type='submit'>Show All</button></form>";}
                }
                else{echo "<h2>Showing All Vacancies</h2>";}
            
                

                if($resultObj3->num_rows > 0)
                {
                    echo "<table style='width:90%'>
                            <tr>
                                    <th><h3>Created</h3></th>
                                    <th><h3>Role</th>
                                    <th><h3>Hiring Manager</th>
                                    <th><h3>Department</th>
                                    <th><h3>End Date</h3></th>
                                    
                            </tr>";

                    while($singleRow = $resultObj3->fetch_assoc())
                    {
                            echo "<tr>";
                                echo "<td>".$singleRow['createDate']."</td>";  //

                                echo "<td><a href='WireFrame2c.php?roleID=".$singleRow['roleID']."'>".$singleRow['roleName']."</a></td>";

                                echo "<td>".$singleRow['name']."</td>";
                                echo "<td>".$singleRow['deptName']."</td>";
                                echo "<td>".$singleRow['endDate']."</td>";  //
                                
                                //echo "<td></td>";
                                //echo "<td><td>";
                            echo "</tr>";
                            
                    }
                }
                echo "</table>";                               //print_r($resultObj->num_rows);
                $resultObj->close();
                $conn->close();
        
            ?>
            <p><em>NEXT:  add link to click to View/'Edit Role' - update db ;  NO DELETE - just set to date passed and not display (unless admin??)</em><br></br></p>
            <p><em>'Role' column will be link to the page for the role with all candidates</em></p>
            <p><em>From there user can pick candidate and give feedback (tick the boxes etc.)</em></p>
        </div>
        <br>
    </div>
    </div>

</body>

</html>                             <!-- CLOSING HTML TAG -->