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

        function selectoneShop($tk){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from sanpham join taikhoan on sanpham.IDTaiKhoan = taikhoan.IDTaiKhoan where sanpham.IDTaiKhoan ='$tk'");
                return $table;
            }else
                return false;
        }

        function selectShop($tk){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from taikhoan where taikhoan.IDTaiKhoan ='$tk'");
                return $table;
            }else
                return false;
        }
    }
?>