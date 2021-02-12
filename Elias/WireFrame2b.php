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
        <a class="active">Role Saved!</a>
        
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
        <h2>Select Template</h2>
        <h5>Choose a template to begin feedback</h5>
        <div class="fakeimg" style="height:auto;">

            
        <br><br><h2> <em>  Role Saved </em>  </h2>

            <?php   
                $dbUserName = "root";               // Database details
                $dbPassword = "root";               
                $dbServerName = "localhost";
                $dbName = "HappyTech";

                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);  // Database connection 
            

                $stmt = $conn->prepare("INSERT INTO roles(roleName, managerID, endDate, createDate) VALUES(?, ?, ?, ?)");
                
                $todayDate = Date("Y-m-d");
                //echo $_GET['End_Date'];
                $cleanDate = ConvertDate($_GET['End_Date']);
                echo $cleanDate;




                $stmt->bind_param('ssss', $_GET['Role_Name'], $_GET['Manager_Name'], $cleanDate, $todayDate);
                $stmt->execute();
                $conn->close();
                $stmt->close();

                echo "<pre>";
                print_r($_GET);
                echo "</pre>";


                $testDate = "03/04/2021";
                $testDate2= "03.04.2021";

                function ConvertDate($dateStr){
                    if($dateStr[2] == '.' || $dateStr[2] == '/'){
                        return $dateStr[6].$dateStr[7].$dateStr[8].$dateStr[9]."-".$dateStr[3].$dateStr[4]."-".$dateStr[0].$dateStr[1];
                    }
                }

                //ConvertDate($testDate);
            
            ?>

        
        <a href="WireFrame2.php" class="active">Back to Roles</a>
    
        </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->