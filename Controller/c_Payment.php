<?php
include_once "./Model/m_Payment.php";
class controllPayment
{
    public function getAllPayment()
    {
        $Payment = new modelPayment();
        $tablePayment = $Payment->selectAllPayment();
        return $tablePayment;
    }
}
