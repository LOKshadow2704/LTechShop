<?php
session_start();
include_once("connect_db.php");
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

    function updateQuantityProd($id){
        $connect;
        $cn_Order = new clsconnect();
        if($cn_Order->connect($connect)){
            $table = mysql_query("update sanpham set SoLuong = SoLuong - 1 where IDSanPham =$id");
            $cn_Order->disconnect($connect);
            return $table;
        }else
            return false;
    }

    function selectOneProduct($id){
        $connect;
        $cn_Product = new clsconnect();
        if($cn_Product->connect($connect)){
            $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,1 as SoLuong, p.HinhAnhSP,p.MoTa , p.IDTaiKhoan as Shop, s.HoTen
            from sanpham as p join taikhoan as s on s.IDTaiKhoan = p.IDTaiKhoan 
            join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where p.IDSanPham = $id");
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
            $table = mysql_query("insert into chitietdonhang value($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , '$TrangThaiThanhToan')");
            $cn_Order->disconnect($connect);
            return $table;
        }else
            return false;
    }
    if($_REQUEST['payment']==2){
        $oderid = lastOder();
        $oderid= mysql_fetch_assoc($oderid);
        $oderid = $oderid['IDDonHang'];
        $IDNguoiMua = $_SESSION['idLogin'];
        $IDLoaiThanhToan = 2;
        $oderProdValues = $_SESSION['oderprod'];
        $_SESSION["idOrder"]=$oderid;
        foreach($oderProdValues as $value) {
            $prod = selectOneProduct($value);
            $row = mysql_fetch_assoc($prod);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
            $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);  
            updateQuantityProd($IDSanPham);
        }
        header("Location: Payment_momo.php");
        exit();
    }if($_REQUEST['payment']==1){
        $oderid = lastOder();
        $oderid= mysql_fetch_assoc($oderid);
        $oderid = $oderid['IDDonHang']+1;
        $IDNguoiMua = $_SESSION['idLogin'];
        $IDLoaiThanhToan = 1;
        $oderProdValues = $_SESSION['oderprod'];
        $_SESSION["idOrder"]=$oderid;
        foreach($oderProdValues as $value) {
            $prod = selectOneProduct($value);
            $row = mysql_fetch_assoc($prod);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
            $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);  
            updateQuantityProd($IDSanPham);
            }
        if($inseroder&&$inseroderD){
            header("Location: http://localhost:81/LTechShop/index.php?succes_cod");
        }else{
            header("Location: http://localhost:81/LTechShop/index.php?faile_cod");
        }

        exit();
    }
    
    