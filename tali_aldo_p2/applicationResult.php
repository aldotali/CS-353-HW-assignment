<?php
     define('HOST_NAME','host');     //define('HOST_NAME','localhost');;
    define('DB_USERNAME','name');
    define('DB_PASSWORD','pass');
    define('DB_NAME','aldo_tali');
    session_start();
    $Cid = $_POST['CID'];
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];
    $_SESSION['insertion'] = "";
    $_SESSION['CID'] = "";
    $_SESSION['CID'] = $Cid;
    $connection=mysql_connect(HOST_NAME,DB_USERNAME,DB_PASSWORD) or die("There was a problem connecting to the database: ". mysql_error());
    $db=mysql_select_db(DB_NAME,$connection) or die ("Cannot use the database :". mysql_error());

    $noAppl= mysql_query("SELECT COUNT(*) AS count FROM apply AS A WHERE A.sid = '$sid' "); 
    $result = mysql_fetch_array($noAppl) or die(mysql_error());
    
    if ($result['count'] < 3){
        $insertApplication= mysql_query("INSERT INTO `apply`(`sid`, `cid`) VALUES ('$sid', '$Cid');");
        if($insertApplication){
            $_SESSION['insertion'] = "success";
            header("Location: applyPage.php");
        } else {
            $_SESSION['insertion'] = "fail";
            header("Location: applyPage.php");
        }
    } else {
        ?><head> <?php echo ("Sorry the maximum number of applications is 3");
        ?><br><br> </head>
        <form action="welcome.php" method="post">
        <input type="submit" value="HomePage">
        </form><?php       
    }
?> 
