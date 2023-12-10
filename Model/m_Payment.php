<?php
    include_once("connect_db.php");
    class modelPayment{
        function selectAllPayment(){
            $connect;
            $cn_Payment = new clsconnect();
            if($cn_Payment->connect($connect)){
                $table = mysql_query("select * from loaithanhtoan");
                $cn_Payment->disconnect($connect);
                return $table;
            }else
                return false;
        }

        
    }
?>