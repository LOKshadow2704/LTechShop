<?php
    class clsconnect{
            function connect(& $connect){
                $servername = "192.168.1.64";
                $username = "ltechshop";
                $password = "123Legend";
                $connect = mysql_connect("".$servername."","".$username."","".$password."");
                mysql_set_charset("UTF8");
                if($connect){
                    return mysql_select_db("test_web");
                }else{
                    return false;
                }
        }
        function disconnect($connect){
            mysql_close($connect);
        }
    }
?>