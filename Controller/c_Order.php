<?php
     session_start();
    include_once("./Model/m_Order.php");
    class controllOrder{
        function getManagermentSalesOrder(){
            // $userid =1;
            $Order = new modelOrder();
            $tableOrder = $Order->selectManagermentSalesOrder($_SESSION['idLogin']);
            return $tableOrder;
        }

        function getPucchaseOrder(){
            // $userid =2;
            $Order = new modelOrder();
            $tableOrder = $Order->selectPucchaseOrder($_SESSION['idLogin']);
            return $tableOrder;
        }

        function getSalesOrder($idorder){
            //$idorder =1;
            $Order = new modelOrder();
            $tableOrder = $Order->selectSalesOrder($idorder);
            if(!$tableOrder){
                return false;
            }else{
                if(mysql_num_rows($tableOrder)>0){
                    return $tableOrder;
                }else{
                    return 0;
                }
            }
    }

        function updateOrder(){
            $Order = new modelOrder();
            foreach($_SESSION['idOrder'] as $value){
                $result = $Order->updateOrder($value);  
            }
            unset($_SESSION['idOrder']);
            return $result;
        }
// Đã thêm chi tiết sản phẩm
        function getOrderDetail($idorder){
            //$idorder =1;
            $Order = new modelOrder();
            $tableOrder = $Order->selectOrderDetail($idorder);
            return $tableOrder;
            
        }
    
}
?>