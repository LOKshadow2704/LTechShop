<?php
    include_once("connect_db.php");
    class modelProduct{
        function selectSuggestProduct(){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from sanpham ORDER BY RAND() LIMIT 4");
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectAllProduct(){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from sanpham");
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }
    }
?>