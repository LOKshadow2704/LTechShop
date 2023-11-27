<?php
    include_once("./Model/m_SalesProduct.php");
    class controllSalesProduct{
        function getSalesProduct(){
            $userid =1;
            $Thongke = new  modelSalesProduct();
            $tableThongke = $Thongke->selecSalesProduct($userid);
            return $tableThongke;
        }
    }
?>