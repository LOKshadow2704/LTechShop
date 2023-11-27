<?php
       include_once("connect_db.php");
       class modelThongke{
        function selecThongke($userid){
            $connect;
            $cn_Thongke = new clsconnect();
            if($cn_Thongke->connect($connect)){
                $table = mysql_query("SELECT MONTH(Ngaydat) as thang, YEAR(Ngaydat) as nam, SUM(d.SoLuong*d.DonGia) as tongdoanhthu
                FROM donhang as o inner join chitietdonhang as d on o.IDDonhang = d.IDDonhang 
                inner join taikhoan as a on a.IDTaiKhoan = o.IDNguoiMua 
                where o.IDNguoiban=".$userid." GROUP BY YEAR(Ngaydat), MONTH(Ngaydat) ORDER BY nam ASC, thang ASC");
                $cn_Thongke->disconnect($connect);
                return $table;
            }else
                return false;
        }
       }
?>