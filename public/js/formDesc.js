/**
 * Created by arond on 08/01/2017.
 */

if(document.getElementsByClassName('formularis') != null){
    for(element in document.getElementsByTagName('span')){
        if(document.getElementsByTagName('span')[element].parentNode != undefined){
            spanText(document.getElementsByTagName('span')[element])
        }
    }
}

function spanText(span) {
    var id = span.parentNode.value;
    if(id == undefined) return false;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200 ){
            span.innerHTML = '   '+this.responseText+'   ';
        }
    };
    xmlhttp.open("GET","getLlibre.php?q="+id,true);
    xmlhttp.send();
}