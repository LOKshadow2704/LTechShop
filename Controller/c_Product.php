<?php
    include_once("./Model/m_Product.php");
    class controllProduct{
        function getAllProduct(){
            $Product = new modelProduct();
            $tableProduct = $Product->selectAllProduct();
            return $tableProduct;
        }

        function getSuggestProduct(){
            $Product = new modelProduct();
            $tableProduct = $Product->selectSuggestProduct();
            return $tableProduct;
        }

        function getProductbyManager(){
            $userid =1;
            $Product = new modelProduct();
            $tableProduct = $Product->selectProductbyManager($userid);
            return $tableProduct;
        }
    }
?>