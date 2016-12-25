/**
 * Created by Aaron on 18/12/2016.
 */
function descripcio(str) {

    console.log('test');
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