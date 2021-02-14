
var htmlBR = document.createElement('br'); 
var elements = 0;
var elemArray = [];

function addSetText(){

    elemArray.push(0);
    elements++;
    htmlBR;

    var div = document.createElement('div');
    //div.setAttribute()
    div.setAttribute('id', elements);

        console.log(elements)

        var form = document.createElement('form');
        form.setAttribute('id', 'form0');
        form.setAttribute('action', '/confirmTemplateSave.php');
        div.appendChild(form)

            var div2 = document.createElement('div');
            div2.setAttribute('class', 'col-md-8');
            div2.setAttribute('id', 'grad');
            //div2.setAttribute('class', 'container')

                var textarea = document.createElement('textarea');
                textarea.setAttribute('placeholder', 'Fill in the connecting text..');  // placeholder
                textarea.setAttribute('id', 'tickbox');
                textarea.setAttribute('name', 'tickbox');
                textarea.setAttribute('rows', '5');
                textarea.setAttribute('cols', '75');
                textarea.setAttribute('form', 'form0');
                div2.appendChild(textarea);

                var div2b = document.createElement('div');
                div2b.setAttribute('class', 'col-md-2');

            var div3 = document.createElement('div');
            div3.setAttribute('class', 'col-md-2');

                var deleteIcon = document.createElement('image');
                deleteIcon.setAttribute('src', 'delete.png');
                deleteIcon.setAttribute('data-src', 'holder.js/200x200');
                deleteIcon.setAttribute('class', 'img-thumbnail');
                deleteIcon.setAttribute('alt', 'altName');

                var delButton = document.createElement('button');
                delButton.setAttribute('type', 'button');
                delButton.setAttribute('class', 'btn btn-danger btn-md');
                delButton.setAttribute('onclick', 'deleteProto(\'' + elements + '\')');
                delButton.innerHTML = "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>";

                // <button type="button" class="btn btn-primary" onclick="addSetText()">Set Text</button>
                
                
                
                //textarea.setAttribute('form', 'form0');
                //delButton.appendChild(deleteIcon);
                div3.appendChild(delButton);

                form.appendChild(div2);
                form.appendChild(div2b);
                form.appendChild(div3);
                var pgbreak = document.createElement('div');
                pgbreak.setAttribute('class', 'page-header');
                pgbreak.setAttribute('style', 'padding-bottom:150px')
                pgbreak.innerHTML = "<div class='col-md-12'></div>";
                div.appendChild(pgbreak);


    var cont = document.getElementById('cont');
    cont.appendChild(div);

}



function addFreeText(){

    elemArray.push(1);
    elements++;
    htmlBR;

    var div = document.createElement('div');
    //div.setAttribute()
    div.setAttribute('id', elements);

        console.log(elements)

        var form = document.createElement('form');
        form.setAttribute('id', 'form0');
        form.setAttribute('action', '/confirmTemplateSave.php');
        div.appendChild(form)

            var div2 = document.createElement('div');
            div2.setAttribute('class', 'col-md-8')
            div2.setAttribute('id', 'grad');
            //div2.setAttribute('class', 'container')

                var textarea = document.createElement('textarea');
                textarea.setAttribute('placeholder', 'Blank for Free Text');  // placeholder
                textarea.setAttribute('disabled', 'disabled');
                textarea.setAttribute('id', 'tickbox');
                textarea.setAttribute('name', 'tickbox');
                textarea.setAttribute('rows', '5');
                textarea.setAttribute('cols', '75');
                textarea.setAttribute('form', 'form0');
                div2.appendChild(textarea);

            var div2b = document.createElement('div');
            div2b.setAttribute('class', 'col-md-2');

            var div3 = document.createElement('div');
            div3.setAttribute('class', 'col-md-2');

                var deleteIcon = document.createElement('image');
                deleteIcon.setAttribute('src', 'delete.png');
                deleteIcon.setAttribute('data-src', 'holder.js/200x200');
                deleteIcon.setAttribute('class', 'img-thumbnail');
                deleteIcon.setAttribute('alt', 'altName');

                var delButton = document.createElement('button');
                delButton.setAttribute('type', 'button');
                delButton.setAttribute('class', 'btn btn-danger btn-md');
                delButton.setAttribute('onclick', 'deleteProto(\'' + elements + '\')');
                delButton.innerHTML = "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>";

                // <button type="button" class="btn btn-primary" onclick="addSetText()">Set Text</button>
                
                
                
                //textarea.setAttribute('form', 'form0');
                //delButton.appendChild(deleteIcon);
                div3.appendChild(delButton);

            form.appendChild(div2);
            form.appendChild(div2b);
            form.appendChild(div3);

            var pgbreak = document.createElement('div');
            pgbreak.setAttribute('class', 'page-header');
            pgbreak.setAttribute('style', 'padding-bottom:150px')
            pgbreak.innerHTML = "<div class='col-md-12'></div>";
            div.appendChild(pgbreak);


    var cont = document.getElementById('cont');
    cont.appendChild(div);
}



function addCheckBox(){

    elemArray.push(2);
    elements++;
    htmlBR;

    var div = document.createElement('div');
    //div.setAttribute()
    div.setAttribute('id', elements);
    // div.setAttribute('style', '');

    // background-image: linear-gradient(red, yellow);

        console.log(elements)

        var form = document.createElement('form');
        form.setAttribute('id', 'form0');
        form.setAttribute('action', '/confirmTemplateSave.php');
        div.appendChild(form)

            var div2 = document.createElement('div');
            div2.setAttribute('class', 'col-md-8')
            div2.setAttribute('id', 'grad');
            //div2.setAttribute('class', 'container')

                var textarea = document.createElement('textarea');
                textarea.setAttribute('placeholder', 'Fill in the text for the checkbox..');  // placeholder
                textarea.setAttribute('id', 'tickbox');
                textarea.setAttribute('name', 'tickbox');
                textarea.setAttribute('rows', '5');
                textarea.setAttribute('cols', '75');
                textarea.setAttribute('form', 'form0');
                div2.appendChild(textarea);

            var div2b = document.createElement('div');
            div2b.setAttribute('class', 'col-md-2');
            // div2b.setAttribute('id', 'grad');
            // background-image: linear-gradient(red, yellow);

                var checkBoxF = document.createElement('button');
                checkBoxF.setAttribute('type', 'button');
                checkBoxF.setAttribute('class', 'btn btn-default btn-lg');
                checkBoxF.setAttribute('disabled', 'disabled');
                
                checkBoxF.innerHTML = "<span class='glyphicon glyphicon-unchecked' aria-hidden='true'></span>";

                div2b.appendChild(checkBoxF);

            var div3 = document.createElement('div');
            div3.setAttribute('class', 'col-md-2');

                // var deleteIcon = document.createElement('image');
                // deleteIcon.setAttribute('src', 'delete.png');
                // deleteIcon.setAttribute('data-src', 'holder.js/200x200');
                // deleteIcon.setAttribute('class', 'img-thumbnail');
                // deleteIcon.setAttribute('alt', 'altName');

                var delButton = document.createElement('button');
                delButton.setAttribute('type', 'button');
                delButton.setAttribute('class', 'btn btn-danger btn-md');
                delButton.setAttribute('onclick', 'deleteProto(\'' + elements + '\')');
                delButton.innerHTML = "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>";

                // <button type="button" class="btn btn-primary" onclick="addSetText()">Set Text</button>
                
                
                
                //textarea.setAttribute('form', 'form0');
                //delButton.appendChild(deleteIcon);
                div3.appendChild(delButton);

                
                form.appendChild(div2);
                form.appendChild(div2b);
                form.appendChild(div3);

                var pgbreak = document.createElement('div');
                pgbreak.setAttribute('class', 'page-header');
                pgbreak.setAttribute('style', 'padding-bottom:150px')
                pgbreak.innerHTML = "<div class='col-md-12'></div>";
                div.appendChild(pgbreak);
                
            // <div class="page-header">
            
            
            var cont = document.getElementById('cont');
            cont.appendChild(div);



}



function addRadio2(){

    elemArray.push(3);
    elements++;
    elements++;
    htmlBR;

    var div = document.createElement('div');
    //div.setAttribute()
    div.setAttribute('id', elements);
    // div.setAttribute('class', 'col-md-8');

        console.log(elements);
        
        
        var form = document.createElement('form');
        form.setAttribute('id', 'form0');
        form.setAttribute('action', '/confirmTemplateSave.php');
        div.appendChild(form);
        
        

            var div2 = document.createElement('div');
            div2.setAttribute('class', 'col-md-8');
            div2.setAttribute('id', 'grad1');
            //div2.setAttribute('class', 'container')

                var textarea = document.createElement('textarea');
                textarea.setAttribute('placeholder', 'Fill in the text for option (1)..');  // placeholder
                textarea.setAttribute('id', 'tickbox');
                textarea.setAttribute('name', 'tickbox');
                textarea.setAttribute('rows', '4');
                textarea.setAttribute('cols', '70');
                textarea.setAttribute('form', 'form0');
                div2.appendChild(textarea);

                

            

            var div2b = document.createElement('div');
            div2b.setAttribute('class', 'col-md-2');

                var checkBoxF2 = document.createElement('button');
                checkBoxF2.setAttribute('type', 'button');
                checkBoxF2.setAttribute('class', 'btn btn-default btn-lg');
                checkBoxF2.setAttribute('disabled', 'disabled');
                
                checkBoxF2.innerHTML = "<span class='glyphicon glyphicon-record' aria-hidden='true'></span>\
                                        <br><br><span class='glyphicon glyphicon-record' aria-hidden='true'></span>";

                div2b.appendChild(checkBoxF2);

                

            var div3 = document.createElement('div');
            div3.setAttribute('class', 'col-md-2');

                // var deleteIcon = document.createElement('image');
                // deleteIcon.setAttribute('src', 'delete.png');
                // deleteIcon.setAttribute('data-src', 'holder.js/200x200');
                // deleteIcon.setAttribute('class', 'img-thumbnail');
                // deleteIcon.setAttribute('alt', 'altName');

                var delButton = document.createElement('button');
                delButton.setAttribute('type', 'button');
                delButton.setAttribute('class', 'btn btn-danger btn-md');
                delButton.setAttribute('onclick', 'deleteTwo(\'' + elements + '\')');
                delButton.innerHTML = "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>";

                // <button type="button" class="btn btn-primary" onclick="addSetText()">Set Text</button>
                
                
                
                //textarea.setAttribute('form', 'form0');
                //delButton.appendChild(deleteIcon);
                div3.appendChild(delButton);

             

            
            form.appendChild(div2);
            // form.appendChild(div2a);
            form.appendChild(div2b);
            form.appendChild(div3);


    var cont = document.getElementById('cont');
    cont.appendChild(div);
    cont.appendChild(htmlBR);

 /////////////////////////////////////////////////////////////

    var divq = document.createElement('div');
    //div.setAttribute()
    divq.setAttribute('id', elements);
    // div.setAttribute('class', 'col-md-8');

        console.log(elements);
        
        
        var formq = document.createElement('form');
        formq.setAttribute('id', 'form0');
        formq.setAttribute('action', '/confirmTemplateSave.php');
        divq.appendChild(formq);
        
        

            var div2q = document.createElement('div');
            div2q.setAttribute('class', 'col-md-8');
            div2q.setAttribute('id', 'grad');
            //div2.setAttribute('class', 'container')

                var textareaq = document.createElement('textarea');
                textareaq.setAttribute('placeholder', 'Fill in the text for option (2)..');  // placeholder
                textareaq.setAttribute('id', 'tickbox');
                textareaq.setAttribute('name', 'tickbox');
                textareaq.setAttribute('rows', '4');
                textareaq.setAttribute('cols', '70');
                textareaq.setAttribute('form', 'form0');
                div2q.appendChild(textareaq);

                
            formq.appendChild(div2q);
            // form.appendChild(div2a);
            // form.appendChild(div2b);
            // form.appendChild(div3);

            var pgbreak = document.createElement('div');
            pgbreak.setAttribute('class', 'page-header');
            pgbreak.setAttribute('style', 'padding-bottom:150px')
            pgbreak.innerHTML = "<div class='col-md-12'></div>";
            divq.appendChild(pgbreak);


    var cont = document.getElementById('cont');
    cont.appendChild(divq);
    cont.appendChild(htmlBR);
}

 
function deleteTwo(element){
    var elno = document.getElementById(element);
    if(element > 0){
        elno.remove();
        elements--;

        var elno2 = document.getElementById(element);
        if(element > 0){
            elno2.remove();
            elements--;
            if(elements < 0){
                elements = 0;
            }
            
            
            console.log(elemArray.pop());
        }
        
        
        console.log(elemArray.pop());
    }
}

// Delete function
function deleteProto(element){
    var elno = document.getElementById(element);
    if(element > 0){
        elno.remove();
        elements--;

        
        console.log(elemArray.pop());
    }
}





// Original Function:
    // var htmlBR = document.createElement('br'); 
    // var elements = 0;

    // var elemArray = [];

    //  function addElement(){
    //     elemArray.push(2);
    //     elements++;
    //     htmlBR;
    //     var div = document.createElement('div');
    //     div.setAttribute('style', 'background:#fcf;');
    //     div.setAttribute('id', elements);

    //         var form = document.createElement('form');
    //         form.setAttribute('id', 'form0');
    //         form.setAttribute('action', '/confirmTemplateSave.php'); //'/divertTemplateArr.php');
    //         div.appendChild(form)

    //             var label = document.createElement('label');
    //             label.innerHTML = "<br><b>Tick Box x1</b><br><br>";
    //             form.appendChild(label);

    //             var textarea = document.createElement('textarea');
    //             textarea.setAttribute('placeholder', 'Text to show next to tickbox goes here');
    //             textarea.setAttribute('id', 'tickbox');
    //             textarea.setAttribute('name', 'tickbox');
    //             textarea.setAttribute('rows', '5');
    //             textarea.setAttribute('cols', '75');
    //             textarea.setAttribute('form', 'form0');
    //             form.appendChild(textarea);
        
    //     var cont = document.getElementById('cont');
    //     cont.appendChild(div);

    //     console.log(elements);
    //     console.log(elemArray);
    // }