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


    var htmlBR = document.createElement('br'); 
    var elements = 0;

    var elemArray = [];

    function addElement0(){ 
        elemArray.push(0);
        elements++;
        console.log("button pressed....");
        var connectText = document.createElement('div');
        connectText.setAttribute('id', elements);
        var form0 = document.createElement('form');
        form0.setAttribute('action', '/confirmTemplateSave.php'); //'/divertTemplateArr.php');
        connectText.appendChild(form0);
        form0.setAttribute('id', 'form0');
        //connectText.setAttribute('id', 'connectText');
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
        connTextBox.setAttribute('form', 'form0');
        connTextBox.setAttribute('rows', '5');
        connTextBox.setAttribute('cols', '75');
        connectText.appendChild(connTextBox);
        
        var div = document.getElementById('cont');
        div.appendChild(connectText);

        console.log(elements);
        console.log(elemArray);
        
    }

    

    function addElement1(){ 
        elemArray.push(1);
        elements++;
        console.log("button 2 pressed....");
        var freeText = document.createElement('div');
        freeText.setAttribute('id', elements);
        var form1 = document.createElement('form');
        form1.setAttribute('action', '/confirmTemplateSave.php'); //'/divertTemplateArr.php');
        freeText.appendChild(form1);
        
        form1.setAttribute('id', 'form0');
        form1.setAttribute('method', 'get');
        //freeText.setAttribute('id', 'freeText');
        freeText.setAttribute('style', 'background:#AAC;');
        var freeTextLabel=document.createElement('label');
        freeTextLabel.setAttribute('id', 'freeTextLabel');                           //'freeTextLabel'
        freeTextLabel.setAttribute('for', 'freeTextBox');
        freeTextLabel.setAttribute('style', 'height=auto;');
        freeTextLabel.innerHTML = "<b><br>Free Text Box<br><br></b>";
        freeText.appendChild(freeTextLabel);
        
        var freeTextBox = document.createElement('textarea');
        freeTextBox.setAttribute('placeholder', 'Leave blank for free text');
        freeTextBox.setAttribute('id', 'freeText');                                       // 'freeText'
        freeTextBox.setAttribute('name', 'freeText');
        freeTextBox.setAttribute('rows', '5');
        freeTextBox.setAttribute('cols', '75');
        freeTextBox.setAttribute('form', 'form0');
        freeText.appendChild(freeTextBox);
        
        var div = document.getElementById('cont');
        div.appendChild(freeText);

        console.log(elements);
        console.log(elemArray);
    }
                                // THIS FUNCTION IS A GOOD EXAMPLE - IT'S INDENTED PROPERLY AND SHOULD BE EASIER TO FIGURE OUT - TWO MORE ARE NEEDED: Radio Button x2 and x3
    function addElement2(){
        elemArray.push(2);
        elements++;
        htmlBR;
        var div = document.createElement('div');
        div.setAttribute('style', 'background:#fcf;');
        div.setAttribute('id', elements);

            var form = document.createElement('form');
            form.setAttribute('id', 'form0');
            form.setAttribute('action', '/confirmTemplateSave.php'); //'/divertTemplateArr.php');
            div.appendChild(form)

                var label = document.createElement('label');
                label.innerHTML = "<br><b>Tick Box x1</b><br><br>";
                form.appendChild(label);

                var textarea = document.createElement('textarea');
                textarea.setAttribute('placeholder', 'Text to show next to tickbox goes here');
                textarea.setAttribute('id', 'tickbox');
                textarea.setAttribute('name', 'tickbox');
                textarea.setAttribute('rows', '5');
                textarea.setAttribute('cols', '75');
                textarea.setAttribute('form', 'form0');
                form.appendChild(textarea);
        
        var cont = document.getElementById('cont');               // 'cont' IS A CONTAINER IN WireFrame5.php TO HOLD THE ELEMENTS ADDED WITH THESE FUNCTIONS
        cont.appendChild(div);

        console.log(elements);
        console.log(elemArray);
             

    }
/*
<!--       Tickbox        -->
                <br></br>
                <div style="background:#fcf;">
                    <form id="ElementSelect">
                        <label for="TickBox">
                        Tick box x1
                        </label>
                        <br></br>
                        <textarea placeholder="Text to show next to tickbox goes here.." id="TickBox" name="tickbox" rows="5" cols="75"></textarea>
                        
                    </form>
                </div>

*/

    function deleteProto(){
        var elno = document.getElementById(elements);
        if(elements > 0){
            elno.remove();
            elements--;
            
            console.log(elemArray.pop());
        }
    }

    function getElemArr(){
        return elemArray;
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
