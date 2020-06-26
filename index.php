<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    
    <script>
        $(document).ready( function () {
    $('#excelDataTable').DataTable();
    } );
    </script>
    </head>

<body onLoad="buildHtmlTable('#excelDataTable')">
  <table id="excelDataTable" border="1" class="table table-hover table-striped ">
      
  </table>
</body>


</html>


<?php


    $ch = curl_init();
    $user = "1";
    $url='https://jsonplaceholder.typicode.com/users/';
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($ch,CURLOPT_HEADER, true); //if you want headers

$output=curl_exec($ch);

curl_close($ch);

?>

<script>

    var data = <?php echo $output ?>;
    var data1 =[];


    for(i=0;i<data.length;i++)
    {
    
    data1.push(
        {"Name": data[i].name,
        "Username": data[i].username,
        "Email": data[i].email,
        "City": data[i].address.city
    }
    );
    }

    var myList = data1;

// Builds the HTML Table out of myList.
function buildHtmlTable(selector) {
  var columns = addAllColumnHeaders(myList, selector);

  for (var i = 0; i < myList.length; i++) {
    var row$ = $('<tr/>');
    for (var colIndex = 0; colIndex < columns.length; colIndex++) {
      var cellValue = myList[i][columns[colIndex]];
      if (cellValue == null) cellValue = "";
      row$.append($('<td/>').html(cellValue));
    }
    $(selector).append(row$);
  }
}

// Adds a header row to the table and returns the set of columns.
// Need to do union of keys from all records as some records may not contain
// all records.
function addAllColumnHeaders(myList, selector) {
  var columnSet = [];
  var headerTr$ = $('<tr/>');

  for (var i = 0; i < myList.length; i++) {
    var rowHash = myList[i];
    for (var key in rowHash) {
      if ($.inArray(key, columnSet) == -1) {
        columnSet.push(key);
        headerTr$.append($('<th/>').html(key));
      }
    }
  }
  $(selector).append(headerTr$);

  return columnSet;
}
    
</script>