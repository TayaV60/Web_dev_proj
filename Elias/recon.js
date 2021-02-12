




function reconstruct1(elemNo, textArr){
    
    console.log(elemNo, textArr);
    for(i in elemNo){
        console.log(i);
        if (elemNo[i] == 0){
            addElement0(textArr[i]);
        }
        if(elemNo[i] == 1){
            addElement1(textArr[i]);
        }
        if(elemNo[i] == 2){
            addElement2(textArr[i]);
        }
    }
    
}


function addElement0(text){ 
    console.log("Add Connecting text - text = " + text);
    var div = document.createElement('div');
    var label = document.createElement('label');
    label.innerHTML = "<br><b>"+ text + "</b><br><br>";
    div.appendChild(label);
    cont.appendChild(div);

    //print(text);
    
}


function addElement1(text){ 
    console.log("Add Free Text - text = ..[usually blank but optional].." + text);
    var div = document.createElement('div');
    var label = document.createElement('label');
    label.innerHTML = "<br><b>"+ text + "</b><br><br>";
    div.appendChild(label);
    cont.appendChild(div);
    //print(text);
}

function addElement2(text){
    console.log("Add Tick box - text = " + text);
    var div = document.createElement('div');
    var label = document.createElement('label');
    //label.setAttribute('style', '')
    label.innerHTML = "<br><div style='padding-right:150px;'><b>"+ text + "</div></b><span></span><input name='CheckRight[]' type='checkbox'><br><br>";
    div.appendChild(label);
    cont.appendChild(div);
    //print(text);    
}



// var htmlBR = document.createElement('br'); 
//     var elements = 0;

//     var elemArray = [];

// function addElement2(text){
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
//             label.innerHTML = "<br><b>"+ text + "</b><br><br>";
//             form.appendChild(label);

//             var textarea = document.createElement('textarea');
//             textarea.setAttribute('placeholder', text);
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