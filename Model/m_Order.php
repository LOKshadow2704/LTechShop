<?php
     include_once("connect_db.php");
     class modelOrder{
        function selectManagermentSalesOrder($userid){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("select o.IDDonHang,a.HoTen,a.DiaChi, a.DienThoai from donhang as o inner join taikhoan as a on a.IDTaiKhoan = o.IDNguoiMua where IDNguoiBan= ".$userid);
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectSalesOrder($idorder){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("select p.HinhAnhSP, p.TenSP, p.DonGia, d.TrangThaiThanhToan from chitietdonhang as d inner join donhang as o on d.IDDonHang = o.IDDonHang inner join sanpham as p on d.IDSanPham = p.IDSanPham inner join loaithanhtoan as ck on d.IDLoaiThanhToan = ck.IDLoaiThanhToan where d.IDDonhang=".$idorder);
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }
         function selectPucchaseOrder($userid){
             $connect;
             $cn_Order = new clsconnect();  
             if($cn_Order->connect($connect)){
                 $table = mysql_query("select p.HinhAnhSP, p.TenSP, p.DonGia, d.TrangThaiThanhToan from chitietdonhang as d inner join donhang as o on d.IDDonHang = o.IDDonHang inner join sanpham as p on d.IDSanPham = p.IDSanPham inner join loaithanhtoan as ck on d.IDLoaiThanhToan = ck.IDLoaiThanhToan where IDNguoiMua = ".$userid);
                 $cn_Order->disconnect($connect);
                 return $table;
             }else
                 return false;
         }

        /*function selectDetailOrder($idorder){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("select d.IDDonHang, p.HinhAnhSP, p.TenSP, p.DonGia, d.TrangThaiThanhToan,  from chitietdonhang as d inner join donhang as o on d.IDDonHang = o.IDDonHang inner join sanpham as p on d.IDSanPham = p.IDSanPham inner join loaithanhtoan as ck on d.IDLoaiThanhToan = ck.IDLoaiThanhToan where d.IDDonhang=".$idorder);
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }*/
    }    
?>  