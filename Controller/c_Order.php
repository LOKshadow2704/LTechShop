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

        function getSalesOrder(){
            $idorder =1;
            $Order = new modelOrder();
            $tableOrder = $Order->selectSalesOrder($idorder);
            return $tableOrder;
        }
    }
?>