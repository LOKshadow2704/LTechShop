<?php
       include_once("connect_db.php");
       class modelSalesProduct{
        function selecSalesProduct($userid){
            $connect;
            $cn_SalesProduct = new clsconnect();
            if($cn_SalesProduct->connect($connect)){
                $table = mysql_query("SELECT p.TenSP, SUM(d.SoLuong) as SoLuong FROM chitietdonhang as d 
                inner join donhang as o on d.IDDonHang = o.IDDonHang 
                inner join sanpham as p on d.IDSanPham = p.IDSanPham where o.IDNguoiBan = ".$userid." GROUP BY p.TenSP");
                $cn_SalesProduct->disconnect($connect);
                return $table;
            }else
                return false;
        }
       }
?>