<?php
session_start();
include_once("connect_db.php");

class modelCart{
    function selectCart($userid){
        $connect;
        $cn_cart = new clsconnect();
        if($cn_cart->connect($connect)){
            $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,c.SoLuong, p.HinhAnhSP,p.MoTa , p.IDTaiKhoan as Shop, s.HoTen
                                from giohang as c inner join sanpham as p on c.IDSanPham = p.IDSanPham join taikhoan as s on s.IDTaiKhoan = p.IDTaiKhoan 
                                inner join taikhoan as a on c.IDTaiKhoan = a.IDTaiKhoan 
                                left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where a.IDTaiKhoan = ".$userid." ORDER BY Shop");
            $cn_cart->disconnect($connect); 
            return $table;
        }
        else
            return false;
    }

    function updateCart($Quantity,$productId){
        $connect;
        $cn_cart = new clsconnect();
        if($cn_cart->connect($connect)){
            $table = mysql_query("UPDATE giohang SET SoLuong = $Quantity WHERE IDTaiKhoan =".$_SESSION['idLogin']." and IDSanPham = ".$productId);
            $cn_cart->disconnect($connect); 
            return $table;
        }
        else    
            return false;
    }


    function deleteCartItem($productId){
        $connect;
        $cn_Cart = new clsconnect();
        if($cn_Cart->connect($connect)){
            $table = mysql_query("delete from giohang where IDSanPham ='$productId' and IDTaiKhoan =".$_SESSION['idLogin']);
            return $table;
        }else
            return false;
    }

    function insertCartItem($productId){
        $connect;
        $cn_Cart = new clsconnect();
        if($cn_Cart->connect($connect)){
            $table = mysql_query("INSERT INTO giohang (IDTaiKhoan, IDSanPham, SoLuong) 
                                    VALUES (".$_SESSION['idLogin'].", $productId, 1)
                                    ON DUPLICATE KEY UPDATE SoLuong = SoLuong + 1;");
            return $table;
        }else
            return false;
    }

    function selectCartItem($productId){
        $connect;
        $cn_Cart = new clsconnect();
        if($cn_Cart->connect($connect)){
            $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,c.SoLuong, p.HinhAnhSP,p.MoTa , p.IDTaiKhoan as Shop, s.HoTen
            from giohang as c inner join sanpham as p on c.IDSanPham = p.IDSanPham join taikhoan as s on s.IDTaiKhoan = p.IDTaiKhoan 
            inner join taikhoan as a on c.IDTaiKhoan = a.IDTaiKhoan 
            left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where c.IDSanPham =$productId and a.IDTaiKhoan = ".$_SESSION['idLogin']);
            return $table;
        }else
            return false;
    }
}

?>
