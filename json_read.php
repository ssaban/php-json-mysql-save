<html>
    <head>
        <title>Read JSON and Store to DB</title>
    </head>
    
<body>
     <?php
    // get location of json object from cmd line or url
    // for example  http://localhost:8888/json_object.json
    if (defined('STDIN')) {
        $json_url = $argv[1];
    } else {
        $json_url = $_GET['json_url'];
    }
    echo "json endpoint to extract is : <p>$json_url <p>";


    // get JSON object from endpoint - use default timeout for file_get_contents
    // and re-try 3 time in case of bad connection 

    $try_cnt=0;
    $max_try=3;
    while ($try_cnt < $max_try  &&($file_contents = file_get_contents ($json_url))===FALSE) $try_cnt++;
    if ($try_cnt >= $max_try) {
        echo "could not get $json_url - exit <p>";
        exit;
    } else {
        echo "got $json_url after $try_cnt re-try <p>";
    }

    //parse json response
    $obj = json_decode($file_contents);
    echo $obj->{'name'} . "<p>";
    echo $obj->{'id'} . "<p>";
    echo $obj->{'value'} . "<p>";
    echo $obj->{'timestamp'} . "<p>";

   // Connect to the DB
   $dbhost = 'localhost:8889';
   $dbuser = 'root';
   $dbpass = 'root';
   $dbname = 'testdb';
   $dbtable = 'json_data';
   $db_handle = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $db_handle ) {
       die('Could not connect to database: ' . mysql_error());
   }
   echo 'Connected to database successfully <p>';
   
   //update the json_info table in the testdb DB with data read from json object
   $db_found = mysql_select_db($dbname , $db_handle);
   if ($db_found) {
        $SQL = "insert into $dbtable  (name, id, value, timestamp) "
                . "values ('".$obj->{'name'}."',"
                . " '".$obj->{'id'}." ', "
                . "' ".$obj->{'value'} ."', "
                . "'".$obj->{'timestamp'}  ."')";
        $result = mysql_query($SQL);
        if(! $result ){
            echo 'Error Code for insert to  ' . $dbtable . ' :' . mysql_error() . ' <p>';
        }else{
            echo "added json_info to database  <p>";
        }

    } else {
        echo "$dbname  Database NOT Found <p>";
    }
?>
</body>
</html>
