<?php
    session_start();
    include_once("./Model/m_Payment.php");
    class controllPayment{
        function getAllPayment(){
            $Payment = new modelPayment();
            $tablePayment = $Payment->selectAllPayment();
            return $tablePayment;
        }
}

?>