<?php
            $queryString = $_SERVER['QUERY_STRING'];
            $dataArray = array();
            parse_str($queryString, $dataArray);
            $oderProdValues = isset($dataArray['oder_prod']) ? $dataArray['oder_prod'] : array();
            foreach($oderProdValues as $value) {
                echo "oder_prod value: $value<br>";
            }
            $oderProdValues = isset($dataArray['quan_prod']) ? $dataArray['quan_prod'] : array();
            foreach($oderProdValues as $value) {
                echo "quan_prod value: $value<br>";
            }