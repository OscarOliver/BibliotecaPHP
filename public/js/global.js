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
        case 1:
            document.getElementById('dateRangePeriodReport').style.display='none'; break;
        case 2:
            document.getElementById('dateRangePeriodReport').style.display='block'; break;
    }
}

function displayUserSelection(option) {
    switch (option) {
        case 0:
        case 2:
            document.getElementById('seleccionarUsuari').style.display='none'; break;
        case 1:
            document.getElementById('seleccionarUsuari').style.display='block'; break;
    }
}