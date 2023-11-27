<?php
    include_once("./Model/m_Shop.php");
    class controllShop{
        function getSuggestShop(){
            $shop = new modelShop();
            $tableShop = $shop->selectSuggestShop();
            return $tableShop;
        }
        function getoneShop($tk){
            $Product = new modelShop();
            $tableProduct = $Product->selectoneShop($tk);
            return $tableProduct;
        }

        function getShop($iduser){
            $Product = new modelShop();
            $tableProduct = $Product->selectShop($iduser);
            return $tableProduct;
        }
    }
?>