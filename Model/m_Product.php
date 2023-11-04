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

        function selectProductbyManager($userid){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC, p.HinhAnhSP,p.MoTa from SanPham as p left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where IDTaiKhoan =".$userid);
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }
    }
?>