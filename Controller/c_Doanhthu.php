<?php
include_once "./Model/m_Doanhthu.php";
class controllThongke
{
    public function getThongke()
    {
        $userid = $_SESSION['idLogin'];
        $Thongke = new modelThongke();
        $tableThongke = $Thongke->selecThongke($userid);
        return $tableThongke;
    }
}
