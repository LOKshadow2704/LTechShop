<?php
    class clsconnect{
            function connect(& $connect){
                $servername = "localhost";#đổi thành localhost ở đây và file config
                $username = "root";    #root
                $password = ""; #mâtj khẩu để trống
                $connect = mysql_connect("".$servername."","".$username."","".$password."");
                mysql_set_charset("UTF8");
                if($connect){
                    return mysql_select_db("Legend"); #database mình tự import
                }else{
                    return false;
                }
        }
        function disconnect($connect){
            mysql_close($connect);
        }
    }
?>