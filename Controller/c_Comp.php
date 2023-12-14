<?php
    include("Model/m_Comp.php");
	class controllCompany{
		function getAllCompany(){
			$company = new modelCompany();
			$tablecompany = $company->selectAllCompany();
			return $tablecompany;
		}
		function getAllProdByCompany($comp) {
            $p = new modelCompany();
            $tblProduct = $p->selectAllProdByCompany($comp);
            return $tblProduct;
        }

	}

?>