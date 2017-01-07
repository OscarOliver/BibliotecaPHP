/**
 * Created by Aaron on 18/12/2016.
 */
function descripcio(str) {

    if(str.length == 0){
        document.getElementById("titolLlibre").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200 ){
                document.getElementById("titolLlibre").innerHTML = '   '+this.responseText+'   ';
            }
        };
        xmlhttp.open("GET","getLlibre.php?q="+str,true);
        xmlhttp.send();
    }

}

function displayDateRangeForReport(option) {
    switch (option) {
        case 0:
            console.log("case 1");
        case 1:
            console.log("case 2");
            document.getElementById('dateRangePeriodReport').style.display='none'; break;
        case 2:
            console.log("case 3");
            document.getElementById('dateRangePeriodReport').style.display='block'; break;
    }
}

function onClickEdit(element){
    var id = element.parentNode.firstChild.textContent;
    var content = element.innerHTML;
    element.innerHTML = '';
    var input = document.createElement('input');
    input.name = 'elementEdit';
    input.placeholder = content;
    input.required = true;
    var inputSubmit = document.createElement('input');
    inputSubmit.type = 'submit';
    inputSubmit.name = 'elementEdit';
    if (element.className == ''){
        element.className = 'editing';
        editing = true;
        element.appendChild(input);
        element.appendChild(inputSubmit);
        element.onclick = '';
    }

}