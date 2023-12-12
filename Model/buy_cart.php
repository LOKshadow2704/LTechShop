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

    function updateQuantityProd($id,$soluong){
        $connect;
        $cn_Order = new clsconnect();
        if($cn_Order->connect($connect)){
            $table = mysql_query("update sanpham set SoLuong = SoLuong - $soluong where IDSanPham =$id");
            $cn_Order->disconnect($connect);
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
    function deleteCartItem($productId){
        $connect;
        $cn_Cart = new clsconnect();
        if($cn_Cart->connect($connect)){
            $table = mysql_query("delete from giohang where IDSanPham ='$productId' and IDTaiKhoan =".$_SESSION['idLogin']);
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
        $oderProdValues = $_SESSION['oderprod']; //Gồm các mã sản phẩm
        $handOder = 0;
        $prevIDShop = 0;
        $_SESSION["idOrder"]=array();
        foreach($oderProdValues as $value) {
            $cart = selectCartItem($value);
            $row = mysql_fetch_assoc($cart);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            if($IDNguoiBan !=$IDNguoiMua){
                if($prevIDShop!=$IDNguoiBan ){
                    $oderid = $oderid + 1;
                    $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
                    array_push($_SESSION["idOrder"], $oderid);
                    if(!$inseroder){
                        echo "fail 1";
                    }else{
                        
                        $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);
                        deleteCartItem($IDSanPham);
                        if(!$inseroderD){
                            echo "fail detail 2";
                        }
                    }
                    updateQuantityProd($IDSanPham,$SoLuong);
                    $prevIDShop=$IDNguoiBan;
                }else{
                    $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);  
                    deleteCartItem($IDSanPham);
                    updateQuantityProd($IDSanPham,$SoLuong);
                    if(!$inseroderD){
                        echo "fail detail 3".$IDNguoiBan;
                    };
                }
            }else{
                echo "<script>alert('Khong the mua san pham cua chinh minh'); window.location.replace('http://localhost:81/LTechShop/index.php?faile_cod');</script>";
                exit();
            }
        }
        header("Location: Payment_momo.php");
        exit();
    }if($_REQUEST['payment']==1){
        $oderid = lastOder();
        $oderid= mysql_fetch_assoc($oderid);
        $oderid = $oderid['IDDonHang'];
        $IDNguoiMua = $_SESSION['idLogin'];
        $IDLoaiThanhToan = 1;
        $oderProdValues = $_SESSION['oderprod'];
        $handOder = 0;
        $prevIDShop = 0;
        $_SESSION["idOrder"]=array();
        foreach($oderProdValues as $value) {
            $cart = selectCartItem($value);
            $row = mysql_fetch_assoc($cart);
            $IDNguoiBan = $row['Shop'];
            $IDSanPham = $row['IDSanPham'];
            $SoLuong = $row['SoLuong'];
            $DonGia = $row['DonGia'];
            $TrangThaiThanhToan='Chưa thanh toán';
            if($IDNguoiBan !=$IDNguoiMua){
                if($prevIDShop!=$IDNguoiBan ){
                    $oderid = $oderid + 1;
                    
                    $inseroder = insertOder( $oderid , $IDNguoiBan , $IDNguoiMua );
                    array_push($_SESSION["idOrder"], $oderid);
                    if(!$inseroder){
                        echo "fail 1";
                    }else{
                        $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);
                        deleteCartItem($IDSanPham);
                        if(!$inseroderD){
                            echo "fail detail 2";
                        }
                    }
                    updateQuantityProd($IDSanPham,$SoLuong);
                    $prevIDShop=$IDNguoiBan;
                }else{
                    $inseroderD= insertOderDetail($oderid , $IDLoaiThanhToan , $IDSanPham , $SoLuong , $DonGia , $TrangThaiThanhToan);
                    deleteCartItem($IDSanPham);  
                    updateQuantityProd($IDSanPham,$SoLuong);
                    if(!$inseroderD){
                        echo "fail detail 3".$IDNguoiBan;
                    };
                }

            }else{
                echo "<script>alert('Khong the mua san pham cua chinh minh'); window.location.replace('http://localhost:81/LTechShop/index.php?faile_cod');</script>";
            }
        }
        if($inseroder&&$inseroderD){
            header("Location: http://localhost:81/LTechShop/index.php?succes_cod");
        }else{
            header("Refresh:0; url = http://localhost:81/LTechShop/index.php?faile_cod");
        }
    }
    
    