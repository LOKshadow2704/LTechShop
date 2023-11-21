<?php
    include_once("./Model/m_Order.php");
    class controllOrder{
        function getManagermentSalesOrder(){
            $userid =1;
            $Order = new modelOrder();
            $tableOrder = $Order->selectManagermentSalesOrder($userid);
            return $tableOrder;
        }

        function getPucchaseOrder(){
            $userid =2;
            $Order = new modelOrder();
            $tableOrder = $Order->selectPucchaseOrder($userid);
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
}
?>