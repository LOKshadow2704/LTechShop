<?php
    include_once("connect_db.php");
    class modelCompany{
        function selectAllCompany(){
            $connect;
            $cn_comp = new clsconnect();
            if($cn_comp->connect($connect)){
                $tblComp = mysql_query("select * from danhmucsanpham");
                $cn_comp->disconnect($connect);
                return $tblComp;
            }else {
                return false;
            }    
        }
        function selectAllProdByCompany($comp) {
            $connect;
            $p = new clsconnect();
            if($p->connect($connect)) {
                $table = mysql_query("SELECT * FROM sanpham WHERE IDDanhMuc = ".$comp." ORDER BY IDSanPham desc");
                $p->disconnect($connect);
                return $table;
            } else {
                return false;
            }
        }
        
    }
?>