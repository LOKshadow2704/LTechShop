<?php
session_start();
    include_once("./Model/m_SalesProduct.php");
    class controllSalesProduct{
        function getSalesProduct(){
            $Thongke = new  modelSalesProduct();
            $tableThongke = $Thongke->selecSalesProduct($_SESSION['idLogin']);
            return $tableThongke;
        }
    }
?>