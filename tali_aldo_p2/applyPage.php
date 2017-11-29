<html>
    <head>
        <b>
        Below you can find a list of the companies available for you to apply</b>
    </head>
    <br><br>
    <?php 
   define('HOST_NAME','host');     //define('HOST_NAME','localhost');;
    define('DB_USERNAME','name');
    define('DB_PASSWORD','pass');
    define('DB_NAME','aldo_tali');

    session_start();
    $sid = "";
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];
    if ($size >= 3){
        echo ("Sorry the maximum number of applications is 3");
        ?><br><br>
        <form action="welcome.php" method="post">
        <input type="submit" value="GoBack">
        </form>
        <?php
    } else { ?>
        <body>
        <div>
        <table id="applications" border='1'>
            <tr>
                <th>Company Id</th>
                <th>Company Name</th>
                <th>Company quota</th>
            </tr>
<?php 
    
    //}else {
    $connection=mysql_connect(HOST_NAME,DB_USERNAME,DB_PASSWORD) or die("There was a problem connecting to the database: ". mysql_error());
    $db=mysql_select_db(DB_NAME,$connection) or die ("Cannot use the database :". mysql_error());
    $availableCompanies= mysql_query("SELECT * FROM company D WHERE D.cid not in (
                                        SELECT C.cid from company as C, (
                                            SELECT C.cid, (SELECT COUNT(*) FROM apply AS A WHERE A.cid = C.cid) as count
                                                    FROM company AS C
                                            ) as P WHERE C.quota <= P.count AND C.cid = P.cid
                                    ) AND D.cid NOT IN
                                    (
                                        SELECT F.cid from apply as F WHERE F.sid = '$sid'
                                    )");
    $queryResult = mysql_fetch_array($availableCompanies) or die(mysql_error());
    $size=mysql_numrows($availableCompanies);
    $i = 0;
    while ($i < $size) {
            $cid=mysql_result($availableCompanies,$i,"cid");
            $cname=mysql_result($availableCompanies,$i,"cname");
            $quota=mysql_result($availableCompanies,$i,"quota");
            ?><tr><th><?php echo "$cid"?></th>
            <th><?php echo "$cname"?></th>
            <th><?php echo "$quota"?></th>
            </tr><?php
            $i = $i + 1;
    }
?>

        </table>
        </div>
         <br><br>
         <div> 
             <form action="applicationResult.php" method="post">
                Company Id:  <input type="text" name="CID">
                <input type="submit" value="Submit"> 
            </form>
         </div>
         <?php
        $sid = $_SESSION['sid'];
         if (isset($_SESSION['insertion']) && isset($_SESSION['CID'])){
             $temp = $_SESSION['insertion'];
             $coid = $_SESSION['CID'];
                ?>  <div>
                    <h3><?php 
                    if ($temp == "success"){
                        $_SESSION['insertion'] = "";
                        echo "You Succesfully Applied to : " ."$coid";?> </h3><?php
                    } else if ($temp == "fail"){
                        $_SESSION['insertion']="";
                        echo "You could not apply to : " ."$coid";?> </h3> <?php
                    } else {}?>
                </div> <?php
    
         }
    }
?>
        <div>
        <form action="index.html" method="post">
        <input type="submit" value="Log out">
        </form>
        </div>
        <div>
        <form action="welcome.php" method="post">
        <input type="submit" value="HomePage">
        </form>
        </div>
    </body>   
</html>
