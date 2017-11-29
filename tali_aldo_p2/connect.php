<?php

    define('HOST_NAME','host');     //define('HOST_NAME','localhost');;
    define('DB_USERNAME','name');
    define('DB_PASSWORD','pass');
    define('DB_NAME','aldo_tali');

    $connection=mysql_connect(HOST_NAME,DB_USERNAME,DB_PASSWORD) or die("There was a problem connecting to the database: ". mysql_error());
    $db=mysql_select_db(DB_NAME,$connection) or die ("Cannot use the database :". mysql_error());
    
    session_start();

    //defined for the login input variables
    $username='';
    $password='';
   // if (isset($_POST['name']) && $_POST['pass']){
        $username= $_POST['name'];
        $password= $_POST['pass'];
        $username=strtolower($username);
        $password=strtolower($password);
        $_SESSION['username'] = $username;
        $_SESSION['sid'] = $password;
        $queryLogin= mysql_query("SELECT * FROM student WHERE sname= '$username' AND sid='$password'");
        //ideally this should only have 1 row of result
        //$queryResult = mysql_fetch_array($queryLogin) or die(mysql_error());
        $number_of_rows = mysql_num_rows($queryLogin);

        if($number_of_rows > 0){
            echo "$number_of_rows";
            echo "The login was successful. We had missed you "."$username";
            header('Location: welcome.php');
        } else {
            if ("$username" == "" || "$password" == ""){
        ?> <html>
        <div>
           <head>"The submision fields should not be empty"</head>
            <form action="../tali_aldo" method="post">
                <input type="submit" value="OK!"> 
            </form>
        </div>
        </html> <?php
            } else {
            ?> <html>
                <div>
                <head>"The login failed. Probably because the login information was wrong</head>
                    <form action="../tali_aldo" method="post">
                        <input type="submit" value="OK!"> 
                    </form>
                </div>
                </html> <?php
            }
        }
   // }   
?>   
