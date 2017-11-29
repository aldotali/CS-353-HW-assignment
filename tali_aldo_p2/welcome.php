<html>
    <head>
        Welcome <?php 
            session_start();  
            $username = $_SESSION['username'];
            $_SESSION['username'] = "$username";
            echo "$username"
            ?> 
    </head>
    <body>
        <div>
            <table id="applications" border='1'>
                <tr>
                    <th>Company Id</th>
                    <th>Company Name</th>
                    <th>Company quota</th>
                </tr>
                <?php
                         define('HOST_NAME','host');     //define('HOST_NAME','localhost');;
                        define('DB_USERNAME','name');
                        define('DB_PASSWORD','pass');
                        define('DB_NAME','aldo_tali');
                        $connection=mysql_connect(HOST_NAME,DB_USERNAME,DB_PASSWORD) or die("There was a problem connecting to the database: ". mysql_error());
                        $db=mysql_select_db(DB_NAME,$connection) or die ("Cannot use the database :". mysql_error());
                        $sid = $_SESSION['sid'];
                        $_SESSION['sid'] = "$sid";
                        $queryLogin= mysql_query("SELECT * FROM apply NATURAL JOIN company NATURAL JOIN student WHERE sid = '$sid'");
                        $size=mysql_numrows($queryLogin);
                        if ($size > 0){
                             $queryResult = mysql_fetch_array($queryLogin) or die(mysql_error());
                        }
                        $_SESSION['size'] = $size;
                        $i = 0;
                        while ($i < $size) {
                                $cid=mysql_result($queryLogin,$i,"cid");
                                $cname=mysql_result($queryLogin,$i,"cname");
                                $quota=mysql_result($queryLogin,$i,"quota");
                                ?><tr><th><?php echo "$cid"?></th>
                                <th><?php echo "$cname"?></th>
                                <th><?php echo "$quota"?></th>
                                <th><?php $link = '<a href="cancel.php?row=' . "$cid" . "\""; echo("$link".'>Cancel</a>');?></th>
                                </tr><?php
                                $i = $i + 1;
                        }
?>
            </table>
        </div>
        <br><br>
        <div>
           <?php $link = '<a href="applyPage.php'. "\""; echo("$link".'>Apply For New Company</a>');?>
        </div>
        <div>
        <form action="index.html" method="post">
        <input type="submit" value="Log out">
        </form>
        </div>
    </body>   
</html>

