function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body ><table border="1">');
    //mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</table></body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

function CalculateTime(first, second, target_id){

    first      = document.getElementsByName(first).value;
    second     = document.getElementsByName(second).value;

    first      = new Date(first);
    second     = new Date(second);
    result     = second - first;

    document.getElementsByName(target_id).value = result;
    console.log(first, second, target_id, result);
    //console.log("hello");
}