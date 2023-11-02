<?php
    include_once("./Model/m_Shop.php");
    class controllShop{
        function getSuggestShop(){
            $shop = new modelShop();
            $tableShop = $shop->selectSuggestShop();
            return $tableShop;
        }
    }
?>