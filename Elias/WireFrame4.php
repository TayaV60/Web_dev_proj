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
        
        <a href="#" class="active"><em>Feedback Form WIP</em></a>
        <a href="WireFrame3.php">Candidates WIP</a>
        
        <!-- <a href="WireFrame4.php">Demo Template</a> -->
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
        <h2>[ Template Title ]</h2>
        <h5>Feedback Header:</h5>
        <div class="fakeimg" style="height:100px;">
            <table style="width:80%"> 
            <colgroup>
                <col span="2">
                
            </colgroup>
                <tr>
                    <td>Candidate:</td>
                    <td><INPUT type="text" name="Candidate"></td>
                    <td>Reviewer</td>
                    <td><INPUT type="text" name="Reviewer"></td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td><INPUT type="text" name="Position"></td>
                    <td>Date</td>
                    <td><p><?php echo Date("d/m/Y"); ?></p></td>
                </tr>

            </table>
        </div>
        <h5>Select Feedback:</h5>
        <div class="fakeimg" style="height:auto;">


        <?php

            $dbUserName = "root";
            $dbPassword = "root";
            $dbServerName = "localhost";
            $dbName = "HappyTech";
            $conn = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);
            $query4i =    "select elements2.javaStr, elements2.textStr
                        from elements2;";
            $resultObj = $conn->query($query4i);
            
            $funcArr = array();
            $textArr = array();

            if($resultObj->num_rows > 0)
            {
                while($singleRow = $resultObj->fetch_assoc())
                {
                    $funcArr = explode(";", $singleRow['javaStr']);
                    $textArr = explode(";", $singleRow['textStr']);
                }
            }

            // echo $funcArr[0]."  -  ".$funcArr[1]."  -  ".$funcArr[2];
            // echo $textArr[0]."  -  ".$textArr[1]."  -  ".$textArr[2];

            
        ?>

        <div id="cont"></div>

        <script type="text/javascript">
            var obj = <?php echo json_encode($funcArr); ?>;
            var obj2 = <?php echo json_encode($textArr); ?>;
        </script>
        <script type="text/javascript" src="recon.js">
        </script>
        <script>
        reconstruct1(obj, obj2);
        </script>  
            <!-- <input type="button" id="test" value="Read Template" onclick="reconstruct1(obj, obj2)"/> -->
            
        

        </div>
        <br>
    </div>
    </div>

</body>

<!-------------------------------->
<!--          SCRIPT            -->
<!-------------------------------->
<script type="text/javascript" src="recon.js"></script>

<script>                            /* JavaScript */
    var arrHead = new Array();
    arrHead = ['', 'Form element', 'Number', 'Text']; // table headers.

    // first create a TABLE structure by adding few headers.
    function createTable() {
        var empTable = document.createElement('table');
        empTable.setAttribute('id', 'empTable');  // table id.

        var tr = empTable.insertRow(-1);

        for (var h = 0; h < arrHead.length; h++) {
            var th = document.createElement('th'); // the header object.
            th.innerHTML = arrHead[h];
            tr.appendChild(th);
        }

        var div = document.getElementById('cont');
        div.appendChild(empTable);    // add table to a container.
    }



    // function to add new row.
    function addRow() {
        var empTab = document.getElementById('empTable');                   // * empTABLE

        var rowCnt = empTab.rows.length;    // get the number of rows.
        var tr = empTab.insertRow(rowCnt); // table row.
        tr = empTab.insertRow(rowCnt);

        for (var c = 0; c < arrHead.length; c++) {
            var td = document.createElement('td');          // TABLE DEFINITION.
            td = tr.insertCell(c);

            if (c == 0) {   // if its the first column of the table.
                // add a button control.
                var button = document.createElement('input');

                // set the attributes.
                button.setAttribute('type', 'button');
                button.setAttribute('value', 'Remove');

                // add button's "onclick" event.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);
            }
            else {
                // the 2nd, 3rd and 4th column, will have textbox.
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');

                td.appendChild(ele);
            }
        }
    }



    // function to delete a row.
    function removeRow(oButton) {
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // buttton -> td -> tr
    }



    // function to extract and submit table data.
    function submit() {
        var myTab = document.getElementById('empTable');
        var arrValues = new Array();

        // loop through each row of the table.
        for (row = 1; row < myTab.rows.length - 1; row++) {
            // loop through each cell in a row.
            for (c = 0; c < myTab.rows[row].cells.length; c++) {
                var element = myTab.rows.item(row).cells[c];
                if (element.childNodes[0].getAttribute('type') == 'text') {
                    arrValues.push("'" + element.childNodes[0].value + "'");
                }
            }
        }
        
        // finally, show the result in the console.
        console.log(arrValues);
    }
</script>  
<!--  FROM:  www.encodedna.com/javascript/dynamically-add-remove-rows-to-html-table-using-javascript-and-save-data.htm -->

</html>                             <!-- CLOSING HTML TAG -->