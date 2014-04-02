<html>
    <head>
        <title>Create DB for json object storage</title>
    </head>
    
<body>
     <?php
   // Connect to the DB
   $dbhost = 'localhost:8889';
   $dbuser = 'root';
   $dbpass = 'root';

   $dbname = 'testdb';
   $dbtable = 'json_data';
  

  $dbhandle = mysql_connect($dbhost, $dbuser, $dbpass) 
     or die('Unable to connect: ' . mysql_error());

  echo "connected !";

  // create db name $dbname 
  $sql = 'CREATE Database ' . $dbname ;
  $db_created = mysql_query($sql,$dbhandle);
   
  if (! $db_created){
     echo 'Error Code for creating ' . $dbname . ' :' . mysql_error() . ' <p>';
  }else {
      echo "Database $dbname created successfully <p>";
  }

  // select $dbname and create table to be used for storing info extracted from json objects
  mysql_select_db( $dbname );

  $sql = 'CREATE TABLE ' . $dbtable  .'( '.
       'id INT, '.
       'name VARCHAR(30), '.
       'value VARCHAR(30), '.
       'timestamp DATETIME, '.
       'primary key (id, name ))';

   $db_table_create = mysql_query($sql,$dbhandle);
   if (! $db_table_create){
     echo 'Error Code for creating table ' . $dbtable . ' :' . mysql_error();
  }
   mysql_close($dbhandle);

?>
</body>
</html>
