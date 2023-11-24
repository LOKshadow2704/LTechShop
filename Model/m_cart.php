<?php
include_once("connect_db.php");

class modelCart {
    function selectCart($userid){
        $connect;
        $cn_cart = new clsconnect();
        if($cn_cart->connect($connect)){
            $table = mysql_query("select p.IDSanPham ,p.HinhAnhSP, p.TenSP, c.SoLuong, p.DonGia 
                                from giohang as c inner join sanpham as p on c.IDSanPham = p.IDSanPham inner
                                join taikhoan as a on c.IDTaiKhoan = a.IDTaiKhoan".$userid);
            $cn_cart->disconnect($connect); 
            return $table;
        }
        else
            return false;
    }
}

?>
