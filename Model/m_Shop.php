<?php
    include_once("connect_db.php");
    class modelShop{
        function selectSuggestShop(){
            $connect;
            $cn_shop = new clsconnect();
            if($cn_shop->connect($connect)){
                $table = mysql_query("select * from taikhoan ORDER BY RAND() LIMIT 4");
                $cn_shop->disconnect($connect);
                return $table;
            }else
                return false;
        }
    }
?>