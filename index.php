<!DOCTYPE html>

    <head>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
   
   <title>task2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    </head>
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
<body onLoad="buildHtmlTable('#excelDataTable')">
  <table id="excelDataTable"  class="table table-hover table-striped ">
      
  </table>
  <h2 id="hello">hello</h2>
  


  <script>
        $(document).ready(function() {
    $('#excelDataTable').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );

    


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



</body>
</html>