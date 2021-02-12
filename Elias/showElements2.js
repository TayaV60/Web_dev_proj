    var arrHead = new Array();
    //arrHead = ['', 'Form element', 'Number', 'Text']; // table headers.
    arrHead = ['','','',''];
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





    function addElement0(){ 
        console.log("button pressed....");
        var connectText = document.createElement('div');
        var form0 = document.createElement('form');
        form0.appendChild(connectText);
        form0.setAttribute('id', 'form0');
        connectText.setAttribute('id', 'connectText');
        connectText.setAttribute('style', 'background:#88C')
        var connTextLabel=document.createElement('label');
        connTextLabel.setAttribute('id', 'connTextLabel');
        connTextLabel.setAttribute('for', 'connTextBox');
        connTextLabel.setAttribute('style', 'height:auto;');
        connTextLabel.innerHTML = "<b><br>Connecting Text Box<br><br></b>";
        connectText.appendChild(connTextLabel);
        
        var connTextBox = document.createElement('textarea');
        connTextBox.setAttribute('placeholder', 'Enter connecting text here..');
        connTextBox.setAttribute('id', 'connectText');
        connTextBox.setAttribute('name', 'connectText');
        connTextBox.setAttribute('rows', '5');
        connTextBox.setAttribute('cols', '75');
        connectText.appendChild(connTextBox);
        
        var div = document.getElementById('cont');
        div.appendChild(form0);
        
    }

    

    function addElement1(){ 
        console.log("button 2 pressed....");
        var freeText = document.createElement('div');
        var form1 = document.createElement('form');
        form1.appendChild(freeText);
        form1.setAttribute('id', 'form0');
        form1.setAttribute('method', 'get');
        freeText.setAttribute('id', 'freeText');
        freeText.setAttribute('style', 'background:#AAC;');
        var freeTextLabel=document.createElement('label');
        freeTextLabel.setAttribute('id', 'freeTextLabel');
        freeTextLabel.setAttribute('for', 'freeTextBox');
        freeTextLabel.setAttribute('style', 'heigh=auto;');
        freeTextLabel.innerHTML = "<b><br>Free Text Box<br><br></b>";
        freeText.appendChild(freeTextLabel);
        
        var freeTextBox = document.createElement('textarea');
        freeTextBox.setAttribute('placeholder', 'Leave blank for free text');
        freeTextBox.setAttribute('id', 'freeText');
        freeTextBox.setAttribute('name', 'freeText');
        freeTextBox.setAttribute('rows', '5');
        freeTextBox.setAttribute('cols', '75');
        freeText.appendChild(freeTextBox);
        
        var div = document.getElementById('cont');
        div.appendChild(form1);
    }

    function addElement2(){

    }

    

// {/* <div style="background:#faf;">
//                     <form id="ElementSelect">
//                         <label for="ConnectText">
//                         Connecting Text (the body of the template)
//                         </label>
//                         <br></br>
//                         <textarea placeholder="Enter connecting text here.." id="ConnectText" name="connecttext" rows="5" cols="75"></textarea>
//                     </form>
//                 </div> */}



// function to add new row.        ***********************
    // function addRow() {
    //     var empTab = document.getElementById('empTable');                   // * empTABLE

    //     var rowCnt = empTab.rows.length;    // get the number of rows.
    //     var tr = empTab.insertRow(rowCnt); // table row.
    //     tr = empTab.insertRow(rowCnt);

    //     for (var c = 0; c < arrHead.length; c++) {
    //         var td = document.createElement('td');          // TABLE DEFINITION.
    //         td = tr.insertCell(c);

    //         if (c == 0) {   // if its the first column of the table.
    //             // add a button control.
    //             var button = document.createElement('input');

    //             // set the attributes.
    //             button.setAttribute('type', 'button');
    //             button.setAttribute('value', 'Remove');

    //             // add button's "onclick" event.
    //             button.setAttribute('onclick', 'removeRow(this)');

    //             td.appendChild(button);
    //         }
    //         else {
    //             // the 2nd, 3rd and 4th column, will have textbox.
    //             var ele = document.createElement('input');
    //             ele.setAttribute('type', 'text');
    //             ele.setAttribute('value', '');

    //             td.appendChild(ele);
    //         }
    //     }
    // }            // ********************************************



// function to delete a row.
    function removeRow(oButton) {
        var empTab = document.getElementById('empTable');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // buttton -> td -> tr
    }



    // function to extract and submit table data.
    function submit2() {
        var myTab = document.getElementById('empTable');         // GETS THE TABLE -- ()
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