<?php
     include_once("connect_db.php");
     class modelOrder{
        function selectManagermentSalesOrder($userid){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("select o.IDDonHang,a.HoTen,a.DiaChi, a.DienThoai, o.NgayDat from donhang as o inner join taikhoan as a on a.IDTaiKhoan = o.IDNguoiMua where o.IDNguoiBan=".$_SESSION['idLogin']);
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectSalesOrder($idorder){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("select p.HinhAnhSP, p.TenSP, d.DonGia, d.SoLuong, d.TrangThaiThanhToan, o.NgayDat from chitietdonhang as d inner join donhang as o on d.IDDonHang = o.IDDonHang inner join sanpham as p on d.IDSanPham = p.IDSanPham inner join loaithanhtoan as ck on d.IDLoaiThanhToan = ck.IDLoaiThanhToan where d.IDDonhang=".$idorder);
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }
         function selectPucchaseOrder(){
             $connect;
             $cn_Order = new clsconnect();  
             if($cn_Order->connect($connect)){
                 $table = mysql_query("select p.HinhAnhSP, p.TenSP, p.DonGia, d.SoLuong, d.TrangThaiThanhToan,o.NgayDat from chitietdonhang as d inner join donhang as o on d.IDDonHang = o.IDDonHang inner join sanpham as p on d.IDSanPham = p.IDSanPham inner join loaithanhtoan as ck on d.IDLoaiThanhToan = ck.IDLoaiThanhToan where IDNguoiMua = ".$_SESSION['idLogin']);
                 $cn_Order->disconnect($connect);
                 return $table;
             }else
                 return false;
         }

         function lastOder(){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("SELECT IDDonHang FROM donhang ORDER BY IDDonHang DESC LIMIT 1;");
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function insertOder($oderid , $IDNguoiBan , $IDNguoiMua ){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("insert into donhang value($oderid , $IDNguoiBan,$IDNguoiMua , CURRENT_DATE)");
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan){
            $connect;
            $cn_Order = new clsconnect();
            if($cn_Order->connect($connect)){
                $table = mysql_query("insert into chitietdonhang value($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan)");
                $cn_Order->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function updateOrder($orderid){
            $connect;
            $cn_Payment = new clsconnect();
            if($cn_Payment->connect($connect)){
                $table = mysql_query("update chitietdonhang set TrangThaiThanhToan = N'Đã thanh toán' where IDDonHang = $orderid ");
                $cn_Payment->disconnect($connect);
                return $table;
            }else
                return false;
        }
    }    
?>  