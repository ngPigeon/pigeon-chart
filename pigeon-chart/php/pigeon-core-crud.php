<?php

//Show All Tables' name in the database
$result = $dbhandle->query("SHOW TABLES FROM $db");

while($row=mysqli_fetch_row($result)){
    //Get the name of the table for checking primary and unique key purpose
    if(strpos($sql, $row[0]) !== false) {
        $table = $row[0];
    }
}

//Remove cookies when web app is loaded
setcookie("priKey", null, -1, "/");

//Check Primary and Unique Key of Table
$rsPriKey = $dbhandle->query("DESCRIBE $table");
while($row=$rsPriKey->fetch_array(MYSQLI_ASSOC)){
    if ($row['Key'] == "PRI") {
        //Store Primary Key as cookie for client side CRUD operation purpose
        setcookie("priKey", $row['Field'], 0, "/");
        $tableDetail[] = $row;
    } else {
        $tableDetail[] = $row;
    }
}

//Set Session Storage for the following process purpose
//Store table name
$_SESSION['table'] = $table;

//Store data for the following checking CRUD operation purpose
$_SESSION['data'] = $data;

//
$_SESSION['tableDetail'] = $tableDetail;

//Store the SELECT SQL query for the following UPDATE query purpose
$_SESSION['selectQuery'] = $sqlQuery->sql;

//Store table detail object into array and pass back to JavaScript
$resultData['keyTable'] = $tableDetail;

?>