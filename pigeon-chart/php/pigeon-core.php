<?php

//Turn off PHP error reporting
error_reporting(0);

include "../configdb.php";

$dbhandle=new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die ("Unable to Connect to the Database");

$db = DATABASE;

$sqlQuery=json_decode(file_get_contents("php://input"));

//Execute this function if sql query is SELECT
if (strpos($sqlQuery->sql, 'SELECT') !== false) {
    
    //Get the SQL query from JSON object
    $sql=$sqlQuery->sql;
    
    //Execute SQL query
    $rs=$dbhandle->query($sql);
    
    if ($dbhandle->error) {
        //Return Database error message
        print_r($dbhandle->error);
    } else {
        //Fetch the row data and store into array
        while($row=$rs->fetch_array(MYSQLI_ASSOC)){
            $data[]=$row;
        }
        
        //Inlcude CRUD core module here if necessary
        //include "../pigeon-core-crud.php";
        
        //Store data object into an array
        $resultData['data'] = $data;
        
        //Return 2D array back to JavaScript with numeric checking
        print json_encode($resultData, JSON_NUMERIC_CHECK);
    }
}




?>