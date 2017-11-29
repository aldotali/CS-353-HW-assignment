<?php

    define('HOST_NAME','host');     //define('HOST_NAME','localhost');;
    define('DB_USERNAME','name');
    define('DB_PASSWORD','pass');
    define('DB_NAME','aldo_tali');
    $connection=mysql_connect(HOST_NAME,DB_USERNAME,DB_PASSWORD) or die("There was a problem connecting to the database: ". mysql_error());
    $db=mysql_select_db(DB_NAME,$connection) or die ("Cannot use the database :". mysql_error());
    session_start();
    $row ="";
    $sid = "";
    $sid = $_SESSION['sid'];
    $row =$_GET['row'];
    $deleteApplication = mysql_query("DELETE FROM apply  WHERE sid = '$sid' AND cid = '$row'");
    if (mysql_error()){
        echo ("Something went wrong with the Deletion of that tuple sorry!");
    }else {
        echo("Deletion was successful!");
    }
    echo("You can go back to the previous page from here");
?> <html>
    <form action="welcome.php" method="post">
    <input type="submit" value="GoBack">
    </form>
    </html> 
