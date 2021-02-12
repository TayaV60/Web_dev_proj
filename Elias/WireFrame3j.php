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


    <div class="main">
        <h2>Add Applicant</h2>
        <h5>Enter Details of New Candidate</h5>
        <div class="fakeimg" style="height:auto;">

        <?php   
                $dbUserName = "root";               // Database details
                $dbPassword = "root";               
                $dbServerName = "localhost";
                $dbName = "HappyTech";

                $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);  // Database connection 
            

                $stmt = $conn->prepare("INSERT INTO candidates(candName, candDocs, roleID, applyDate) VALUES(?, ?, ?, ?)");
                
                $todayDate = Date("Y-m-d");

                //echo $_GET['End_Date'];
                $cleanDate = ConvertDate($_GET['End_Date']);
                echo $cleanDate;

                $candNo = 1;

                $query2 = "select count(*) from candidates";                    
                $resultObj2 = $conn->query($query2);

                if($resultObj2->num_rows > 0)
                {
                    while($singleRow = $resultObj2->fetch_assoc())
                    {
                        
                        $candNo = $candNo + $singleRow['count(*)'];
                        
                    }
                }
                echo $candNo;
                $cand = explode(" ", $_GET['Candidate']);
                echo $cand[0][0];
                echo $cand[1][0];
                $candDocs = $cand[0][0].$cand[1][0].$candNo;

                $stmt->bind_param('ssss', $_GET['Candidate'], $candDocs, $_GET['dept'], $todayDate);
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

                $conn->close();
                $stmt->close();
            
            ?>

            <h2> Candidate Saved </h2>
        
    
        </div>
        
        
    </div>
    </div>

    

</body>






</html>                             <!-- CLOSING HTML TAG -->