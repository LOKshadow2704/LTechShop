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
            if(!$tableProduct){
                return false;
            }else{
                if(mysql_num_rows($tableProduct)>0){
                    return $tableProduct;
                }else{
                    return 0;
                }
            }
        }
    }
?>