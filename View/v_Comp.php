<?php
    include ("Controller/C_Comp.php");
    class ViewCompany{
        function viewAllCompany(){
            $company = new controllCompany();
            $tblCompany = $company->getAllCompany();
            if($tblCompany){
                if(mysql_num_rows($tblCompany)>0){
                    echo "<div class='company'>";
                    echo"<h4>Danh mục sản phẩm</h4> <br>";
                    while($r = mysql_fetch_assoc($tblCompany)){
                    echo "<a href='index.php?Comp=".$r["IDDanhMuc"]."'>".$r["TenDanhMuc"]."</a><br><br>";
                }
            }else{
                echo "không có sản phẩm";
                }echo"</div>";
        }else{
            echo "Không có giá trị";
            }
        }

        function viewAllProdByCompany($comp) {
            $p = new controllCompany();
            $tblProduct = $p->getAllProdByCompany($comp);
            if(mysql_num_rows($tblProduct) > 0) {
                $count = 0;
                echo"<div class='price'>";
                echo"<h3 >Tìm theo giá</h3>";
                echo"<form class='form-inline' onsubmit='return validateForm()'>";
                    // echo"<label for='giamin'>Từ giá:</label>";
                    echo"<input type='number' class='form-control' id='min_price'  name='giamin'>";
                    
                    // echo"<label for='giamax'>Đến giá:</label>";
                    echo"<input type='number' class='form-control' id='max_price'  name='giamax'>";
                    echo"<button type='submit' class='btn btn-default' >Tìm</button>";
                echo"</form>";
                echo"</div>";
                echo "<div class='pro_search'>";
                while($row = mysql_fetch_assoc($tblProduct)) {
                    if($count == 0) {
                        echo "<ul>"; 
                    }
                    echo "<li> <a href='index.php?pi=".$row['IDSanPham']."'>";
                    echo "<br>";
                    echo "<img width=280px height=200px src=".$row['HinhAnhSP'].">";
                    echo "<br> <p style='color: black'><b>".$row["TenSP"]."</b></p>";  
                    echo "<br><br>";
                    echo  "<p style= 'color: red'>".number_format($row["DonGia"],0 , ",",".")." VNĐ</p>";
                    echo "<br><br> </a></li>";
                    $count++;
                    if($count % 4 == 0 ) {
                        echo "</ul>";
                        $count = 0;
                    }
                }
                echo"</div>";
            } else {
                echo "không có sản phẩm";
            }
        }
    }
?>