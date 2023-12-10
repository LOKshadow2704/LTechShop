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
    function selectOneProduct($id){
        $connect;
        $cn_Product = new clsconnect();
        if($cn_Product->connect($connect)){
            $table = mysql_query("SELECT * FROM sanpham JOIN taikhoan ON sanpham.IDTaiKhoan = taikhoan.IDTaiKhoan LEFT JOIN danhgiasp ON sanpham.IDSanPham = danhgiasp.IDSanPham WHERE sanpham.IDSanPham = '$id';");
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
        $oderid = $oderid['IDDonHang']+1;
        $IDNguoiMua = $_SESSION['idLogin'];
        $IDLoaiThanhToan = 2;
        $oderProdValues = $_REQUEST['buynow'];
        $handOder = 0;
        $prevIDShop = 0;
        $_SESSION["idOrder"]=$oderid;
            $cart = selectOneProduct($value);
            $row = mysql_fetch_assoc($cart);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
            $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);  
        
        header("Location: Payment_momo.php");
        exit();
    }if($_REQUEST['payment']==1){
        $oderid = lastOder();
        $oderid= mysql_fetch_assoc($oderid);
        $oderid = $oderid['IDDonHang']+1;
        $IDNguoiMua = $_SESSION['idLogin'];
        $IDLoaiThanhToan = 2;
        $oderProdValues = $_REQUEST['buynow'];
        $handOder = 0;
        $prevIDShop = 0;
        $_SESSION["idOrder"]=$oderid;
            $cart = selectOneProduct($value);
            $row = mysql_fetch_assoc($cart);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
            $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);  
        
        header("Location: http://localhost:81/LTechShop/index.php?succes_cod");
        exit();
    }
    
    