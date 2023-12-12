<?php
    include_once("./Controller/c_Product.php");
    class viewProductinfo{
        function viewOneProduct($id){
            $Product = new controllProduct();
            $tableProduct = $Product -> getOneProduct($id);
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
                                        <p class='sp-title'>Yêu thích</p>
                                    </div>
                                    <p class='product-title'  >".$row["TenSP"]."</p>
                                </div>

                                <div class='product-range'>
                                    <div class='product-range-star'>
                                        <p class='range'>".$row["TrungBinhSoSao"]."</p>
                                        <ul class='list-inline'>";          
                                                $TrungBinhSoSao = 1;
                                                while ($TrungBinhSoSao <= 5) {
                                                    if ($row["TrungBinhSoSao"] < $TrungBinhSoSao) {
                                                        echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star-empty' style='color: #FFFF00;'></span></li>";
                                                    } else {
                                                        echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star' style='color: #FFFF00;'></span></li>";
                                                    }
                                                    $TrungBinhSoSao++;
                                                }
                                            echo "</ul>
                                    </div>
                                    <div class='product-range-reviews'>
                                        <p>".$row["TongSoDanhGia"]."</p>
                                        <p style='color: rgb(160, 160, 160);'>Đánh giá</p>
                                    </div>
                                
                                    <div class='product-range-bought'>
                                        <p>".$row['SoLuong']."</p>
                                        <p style='color: rgb(160, 160, 160);'>Đã bán</p>
                                    </div>
                                </div>

                                <div class='product-discount'>
                                    <p class='product-price'>".number_format($row["DonGia"]-$row["PhanTramGiamGia"]*$row["DonGia"],0, ",",".")." VNĐ</p>
                                    <del class='price-discount'>".number_format($row["DonGia"],0 , ",",".")." VNĐ</del>
                                </div>

                                <div>
                                <div class='product-quantity'>
                                <p style='font-size: 14px; color: rgb(163, 163, 163)'>Số lượng</p>
                                <p style='font-size: 14px; color: rgb(163, 163, 163)'>".$row["SoLuong"]."</p>
                           </div>

                           <input type='number' name='amount' id='amount' value='1' class='product-input-amount'>
                        
                            <div class='buy-cart'>
                                <a href='index.php?buy=$id'><button class='button-add__cart add' role='button'>Thêm giỏ hàng</button></a>
                                <a href='index.php?buy=$id'><button class='button-add__cart add' role='button'>Mua hàng</button></a> 
                                <button type='button' class='product_compare' data-toggle='modal' data-target='#myModal' onclick='add_compare($id)'>So sánh</button>

                                 </div>
                                </div>
                            </div>
                        </div>
                    ";
                     // Modal Compare Product
                    echo "
                 <div class='container'>

                    <!-- Modal -->
                    <div class='modal fade' id='myModal' role='dialog' >
                      <div class='modal-dialog modal-lg'>
                        <!-- Modal content-->
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'><span id= 'title_compare'</span></h4>
                          </div>
                          <div class='modal-body'>
                            <table class='table table-hover' id = 'row_compare'>
                                <thead>
                                    <tr>
                                        <th>Ảnh </th>
                                        <th>Tên </th>
                                        <th>Gía </th>
                                        <th>Mô tả </th>
                                        <th>Xem sản phẩm</th>
                                        <th>Xóa sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      
                                </tbody>
                            </table>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                    ";
                     //sản phẩm của shop
                    echo "<br><br>";
                    echo "
                        <div class='product_shop'>
                            <h2 class='productshop'>Sản phẩm của shop:</h2>
                            <h3 style='color: black''text-align: right'><b>".$row["TenDangNhap"]."</b></h3>
                        </div>
                    ";
                    // mô tả sp
                    echo "<br><br>";
                    echo "<h2 class='product-description'>Mô tả sản phẩm</h2>";
                    echo "<br> <p class='product-description1' style='color: black''text-align: right' ><b>".$row["Mota"]."</b></p>";  
                    echo "<br><br>";
                     // Đánh giá product
                     echo "
                     <h2 class='product__review-title'>ĐÁNH GIÁ SẢN PHẨM</h2>
 
                     <div class='product__review'>
                         <div class='review__star'>
                             <div class='review__star-right'>
                                 <div class='star-top'>
                                     <p class='star-number'>".$row["TrungBinhSoSao"]."</p>
                                     <p class='star-title'>trên 5</p>
                                 </div>
                                 
                                 <p class='star-bottom'>
                                    <ul class='list-inline'>";          
                                        $TrungBinhSoSao = 1;
                                        while ($TrungBinhSoSao <= 5) {
                                            if ($row["TrungBinhSoSao"] < $TrungBinhSoSao) {
                                                echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star-empty' style='color: #FFFF00;'></span></li>";
                                            } else {
                                                echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star' style='color: #FFFF00;'></span></li>";
                                            }
                                            $TrungBinhSoSao++;
                                        }
                                    echo "</ul>
                                 </p>
                             </div>   
                             
                             <div class='review__star-left'>
                                 <div class='start-all'>
                                     <p class='star-item firts'>Tất cả</p>
                                     <p class='star-item'>5 Sao (12,5k)</p>
                                     <p class='star-item'>4 Sao (829)</p>
                                     <p class='star-item'>3 Sao (299)</p>
                                     <p class='star-item'>2 Sao (88)</p>
                                     <p class='star-item'>1 Sao (136)</p>
                                 </div>
 
                                 <div class='star-comment'>
                                     <p class='comment-item firts'>Có Bình Luận (5,5k)</p>
                                     <p class='comment-item'>Có Hình Ảnh / Video (3,7k)</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     ";
                     //sửa lại phần này
                     // User Comment
                     mysql_data_seek($tableProduct, 0);
                         $comments = array(); // Khởi tạo mảng trước khi sử dụng
                         while ($row = mysql_fetch_assoc($tableProduct)) {
                             $comment = array(
                                 "HoTen" => $row["HoTen"],
                                 "PhanHoi" => $row["PhanHoi"],
                                 "SoSao" => $row["SoSao"],
                             );
                             $comments[] = $comment;
                         }
                         echo "<div class='comment-container'>";
                         foreach ($comments as $row) {
                             echo "
                                 <div class='comment'>
                                     <div class='comment-left'>
                                         <p class='avatar'></p>
                                     </div>
                     
                                     <div class='comment-right'>
                                         <p class='user_name'>" . $row["HoTen"] . "</p>
                                         <ul class='list-inline'>";
                             $SoSao = 1;
                             while ($SoSao <= 5) {
                                 if ($row["SoSao"] < $SoSao) {
                                     echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star-empty' style='color: yellow;'></span></li>";
                                 } else {
                                     echo "<li class='list-inline-item'><span class='glyphicon glyphicon-star' style='color: yellow;'></span></li>";
                                 }
                                 $SoSao++;
                             }
                             echo "</ul>
                                         <p class='user_date'>2023-11-08 15:10</p>
                     
                                         <div class='user_info_product'>
                                             <p>Màu sắc: </p>
                                             <p> Đẹp</p>
                                         </div>
                                         <div class='user_info_product'>
                                             <p>Đúng với mô tả: </p>
                                             <p>tốt</p>
                                         </div>
                                         <div class='user_info_product'>
                                             <p>Chất liệu:</p>
                                             <p>tốt</p>
                                         </div>
                                         <p>" . $row["PhanHoi"] . "</p>
                     
                                         <div class='image_product'>
                                             <img class='image_product_review' src='https://down-vn.img.susercontent.com/file/64d0a80d60192db2267febb126dbad0e' alt='Girl in a jacket'>
                                             <img class='image_product_review' src='https://down-vn.img.susercontent.com/file/dcd6720923dab1e225ca8090e20d31a4' alt='Girl in a jacket'>
                                             <img class='image_product_review' src='https://down-vn.img.susercontent.com/file/b2a178d242499c30c5b6994478049d0d' alt='Girl in a jacket'>
                                             <img class='image_product_review' src='https://down-vn.img.susercontent.com/file/2a52108053a3fb4419ce817e18602b82' alt='Girl in a jacket'>
                                         </div>
                                         
                                     </div>                          
                                 </div>
                             ";
                         }
                         echo "</div>";
               $count++;
               if ($count % 4 == 0) {
                   echo "</ul>";
                   $count = 0;
               } elseif ($count == 1) {
                   break;
               }
           
           }
           echo"</div>";
           }
       }
   }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        function delete_compare(id) {
        if (localStorage.getItem('compare') != null) {
        var data = JSON.parse(localStorage.getItem('compare'));
        var index = data.findIndex(item => item.id === id);
        data.splice(index, 1);
        localStorage.setItem('compare', JSON.stringify(data)); 
        document.getElementById("row_compare" + id).remove();
    }
}
$(document).ready(function() {
    viewed_compare();
    function viewed_compare() {
        if (localStorage.getItem('compare') != null) {
            var data = JSON.parse(localStorage.getItem('compare'));
            for (i = 0; i < data.length; i++) {
                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var content = data[i].content;
                var id = data[i].id;

                $('#row_compare').find('tbody').append(
                    '<tr id="row_compare' + id + '">' +
                    '<td><img width="200px" width="100%" src="' + image + '"></td>' +
                    '<td>' + name + '</td>' +
                    '<td>' + price + '</td>' +
                    '<td>'+ content+'</td>' +
                    '<td><a href="index.php?pi=' + id + '">Xem sản phẩm</a></td>' +
                    '<td onclick="delete_compare(' + id + ')"><a style="cursor:pointer;">Xóa so sánh</a></td>' +
                    '</tr>'
                );
            }
        }
    }

});
function add_compare($id) {
    document.getElementById('title_compare').innerText = 'Chỉ cho phép so sánh tối đa 2 sản phẩm';  
    var id =$id;
    var image = document.querySelector('.product_left').src;
    var name = document.querySelector('.product-title').innerText;
    var price = document.querySelector('.product-price').innerText;
    var content = document.querySelector('.product-description1').innerText;
    
    var newItem = {
        'id': id,
        'image': image,
        'name': name,
        'price': price,
        'content': content
    };
    if (localStorage.getItem('compare') == null) {
        localStorage.setItem('compare', '[]');
    }
    var old_data = JSON.parse(localStorage.getItem('compare'));
    var matches = old_data.filter(obj => obj.id == id);

    if (matches.length === 0 && old_data.length < 2) {
        old_data.push(newItem);
        $('#row_compare').find('tbody').append(
                '<tr id="row_compare' + id + '">' +
                '<td><img width="200px" width="100%" src="' + image + '"></td>' +
                '<td>' + newItem.name + '</td>' +
                '<td>' + newItem.price + '</td>' +
                '<td>'+ newItem.content +'</td>' +
                '<td><a href="index.php?pi=' + id + '"></a>Xem sản phẩm</td>' +
                '<td onclick="delete_compare(' + id + ')"><a style="cursor:pointer;">Xóa so sánh</a></td>' +
                '</tr>'
        );
        localStorage.setItem('compare', JSON.stringify(old_data));
        $("#myModal").modal();
    }
}
    </script>
</body>
</html> -->
