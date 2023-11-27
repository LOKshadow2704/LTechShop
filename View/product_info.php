<?php
    include_once("./Controller/c_Product.php");
    class viewProductinfo{
        function viewOneProduct(){
            $Product = new controllProduct();
            $tableProduct = $Product -> getOneProduct();
            if(!$tableProduct){
                echo("Have some error");
            }elseif($tableProduct==0){
                    echo("0 result");
            }else{
                echo "<div class='product_info'>";
                echo "<h1>Chi tiết sản phẩm</h1>";

                while($row = mysql_fetch_assoc($tableProduct)) { 
                    if($count == 0) {
                        echo "<ul>"; 
                    }
                    
                    // image sp
                    echo "<br>";
                    echo "
                        <div class='product-body'>
                            <img class='product_left' src=".$row['HinhAnhSP'].">
                            <div class='product-right'>
                                <div class='product-name'>
                                    <div class='sp-'>   
                                        <p class='sp-title'>yêu thích</p>
                                    </div>
                                    <p class='product-title'>".$row["TenSP"]."</p>
                                </div>

                                <div class='product-range'>
                                    <div class='product-range-star'>
                                        <p class='range'>4.7</p>
                                        <p class='star'>⭐⭐⭐⭐⭐</p>
                                    </div>

                                    <div class='product-range-reviews'>
                                        <p>3,1k</p>
                                        <p style='color: rgb(160, 160, 160);'>Đánh giá</p>
                                    </div>

                                    <div class='product-range-bought'>
                                        <p>43k</p>
                                        <p style='color: rgb(160, 160, 160);'>Đã bán</p>
                                    </div>
                                </div>

                                <div class='product-discount'>
                                    <p class='product-price'>".number_format($row["DonGia"],0 , ",",".")." VNĐ</p>
                                    <del class='price-discount'>9.640.000</del>
                                </div>

                                <div>
                                <div class='product-quantity'>
                                <p style='font-size: 14px; color: rgb(163, 163, 163)'>Số lượng</p>

                                
                                <p style='font-size: 14px; color: rgb(163, 163, 163)'>2542 sản phẩm có sẵn</p>
                           </div>
                           <input type='number' name='amount' id='amount' value='1' class='product-input-amount'>

                            <div class='buy-cart'>
                                
                                    <a href='#'><button class='button-add__cart add' role='button'>Thêm giỏ hàng</button></a>
                                
                                
                                    <a href='index.php?buy=".$_REQUEST['pi']."'><button class='button-add__cart add' role='button'>Mua hàng</button></a> 
                                
                            </div>
                                </div>
                            </div>
                        </div>
                    ";


                    /**
                     * button quantity
                     * 
                     *  <div class='buy-amount'>
                                    <button class='minus-btn' id='minus-btn'>
                                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className='w-6 h-6'>
                                            <path strokeLinecap='round' strokeLinejoin='round' d='M19.5 12h-15' />
                                        </svg>
                                    </button>
                                    <input type='number' name='amount' id='amount' value='1' class='product-input-amount'>
                                    <button class='plus-tn' onclick='handlePlus()'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className='w-6 h-6'>
                                            <path strokeLinecap='round' strokeLinejoin='round' d='M12 4.5v15m7.5-7.5h-15' />
                                        </svg>
                                    </button>
                                </div>
                     */


                    // mô tả sp
                    echo "<br><br>";
                    echo "<h2 class='product-description'>Mô tả sản phẩm</h2>";
                    echo "<br> <p style='color: black''text-align: right'><b>".$row["Mota"]."</b></p>";  
                    echo "<br><br>";


                    /*<a href="" class="btn btn-primary">Mua hàng</a>*/

                    //sao đánh giá
                    echo"<h3 class='title-1'>Đánh giá sản phẩm</h3>";
                    echo "<br> <p style='color: black; text-align: center; font-size: 20px;'>".$row["PhanHoi"]."</p>";  

                    // đánh giá sao cho sp
                    echo"<div class='center'>
                            <div class='stars'>
                            <input type='radio' id='five' name='rate' value='5'>
                            <label for='five'></label>
                            <input type='radio' id='four' name='rate' value='4'>
                            <label for='four'></label>
                            <input type='radio' id='three' name='rate' value='3'>
                            <label for='three'></label>
                            <input type='radio' id='two' name='rate' value='2'>
                            <label for='two'></label>
                            <input type='radio' id='one' name='rate' value='1'>
                            <label for='one'></label>
                            <span class='result'></span>
                            </div>
                        </div>";
                    echo "<br><br> <a href='#'></li>";
                    $count++;
                    if($count % 4 == 0 ) {
                        echo "</ul>";
                        $count = 0;
                    }
                }
                echo"</div>";
                }
            }
        }

?>