<?php
    include_once("connect_db.php");
    class modelProduct{
        function selectSuggestProduct(){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from sanpham ORDER BY RAND() LIMIT 4");
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectAllProduct(){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select * from sanpham");
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectProductbyManager($userid){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,p.SoLuong, p.HinhAnhSP,p.MoTa from SanPham as p left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where IDTaiKhoan =".$userid);
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectOneProduct($id){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("SELECT 
            sanpham.*,(SELECT taikhoan.TenDangNhap FROM taikhoan WHERE taikhoan.IDTaiKhoan = sanpham.IDTaiKhoan) AS TenDangNhap,danhgiasp.PhanHoi,danhgiasp.SoSao,danhgiasp.TongSoSao,danhgiasp.TongSoDanhGia,danhgiasp.TrungBinhSoSao,taikhoan.HoTen,(SELECT SUM(chitietdonhang.SoLuong)FROM chitietdonhang WHERE chitietdonhang.IDSanPham = sanpham.IDSanPham) as SoLuong
            FROM sanpham
            LEFT JOIN danhgiasp ON sanpham.IDSanPham = danhgiasp.IDSanPham
            LEFT JOIN taikhoan ON danhgiasp.IDTaiKhoan = taikhoan.IDTaiKhoan
            WHERE sanpham.IDSanPham ='$id'");
                return $table;
            }else
                return false;
        }

        function selectOneinfProduct($id){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,p.SoLuong, p.HinhAnhSP,p.MoTa from SanPham as p left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where IDSanPham =".$id);
                return $table;
            }else
                return false;
        }


        function selectListProduct($list){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("select p.IDSanPham,d.TenDanhMuc,p.TenSP, p.DonGia, p.NCC,p.SoLuong, p.HinhAnhSP,p.MoTa from SanPham as p left join DanhMucSanPham as d on p.IDDanhMuc = d.IDDanhMuc where IDSanPham in ($list[0], ".end($list).") ");
                return $table;
            }else
                return false;
        }

        function insertProduct($IdUser,$ProdName,$ProdPrice,$file,$ProdCategory,$ProdSupp,$ProdQuan,$ProdDescribe){
            // Client ID of Imgur App 
            $IMGUR_CLIENT_ID = '0a20a75ba1cc56c'; // Thay YOUR_CLIENT_ID bằng client ID của bạn
                $fileType = $file['type'];

                // Kiểm tra định dạng ảnh hợp lệ
                $allowTypes = array('image/jpeg', 'image/png', 'image/gif');
                if (in_array($fileType, $allowTypes)) {
                    // Đọc nội dung của hình ảnh
                    $imageSource = file_get_contents($file['tmp_name']);

                    // Chuẩn bị dữ liệu để gửi lên Imgur
                    $postFields = array(
                        'image' => base64_encode($imageSource)
                    );

                    // Gửi yêu cầu lên Imgur
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
                    $response = curl_exec($ch);
                    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // Kiểm tra kết quả từ Imgur
                    if ($status == 200) {
                        $result = json_decode($response, true);
                        if (!empty($result['data']['link'])) {
                            // Đường link của ảnh trên Imgur
                            $imgurLink = $result['data']['link'];
                            
                        } else {
                            echo "<script>alert('Upload không thành công. Vui lòng thử lại.');</script>";
                        }
                    } else {
                        echo "<script>alert('Lỗi khi gửi yêu cầu lên Imgur. HTTP status code: $status');</script>";
                    }
                } else {
                    echo "<script>alert('Định dạng ảnh không hợp lệ.');</script>";
                }
            
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $result = mysql_query("insert into sanpham(IDTaiKhoan,IDDanhMuc,TenSP,DonGia,NCC,HinhAnhSP,SoLuong,Mota) values($IdUser,$ProdCategory,'$ProdName',$ProdPrice,'$ProdSupp','$imgurLink',$ProdQuan,'$ProdDescribe')");
                return array($result,$status);
            }else
                return false;
        }

        function deleteProduct($id){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("delete from SanPham where IDSanPham ='$id'");
                return $table;
            }else
                return false;
        }

        function updateProduct($IdProd,$ProdName,$ProdPrice,$file,$ProdCategory,$ProdSupp,$ProdDescribe){
            // Client ID of Imgur App
            if($file['size']!=0){
                $IMGUR_CLIENT_ID = '0a20a75ba1cc56c'; // Thay YOUR_CLIENT_ID bằng client ID của bạn
                $fileType = $file['type'];
            
                // Kiểm tra định dạng ảnh hợp lệ
                $allowTypes = array('image/jpeg', 'image/png', 'image/gif');
                if (in_array($fileType, $allowTypes)) {
                    // Đọc nội dung của hình ảnh
                    $imageSource = file_get_contents($file['tmp_name']);

                    // Chuẩn bị dữ liệu để gửi lên Imgur
                    $postFields = array(
                        'image' => base64_encode($imageSource)
                    );

                    // Gửi yêu cầu lên Imgur
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
                    $response = curl_exec($ch);
                    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // Kiểm tra kết quả từ Imgur
                    if ($status == 200) {
                        $result = json_decode($response, true);
                        if (!empty($result['data']['link'])) {
                            // Đường link của ảnh trên Imgur
                            $imgurLink = $result['data']['link'];
                            
                        } else {
                            echo "Upload không thành công. Vui lòng thử lại.";
                            return false;
                        }
                    } else {
                        echo "Lỗi khi gửi yêu cầu lên Imgur. HTTP status code: $status";
                        return false;
                    }
                } else {
                    echo "Định dạng ảnh không hợp lệ.";
                    return false;
                }
                $connect;
                $cn_Product = new clsconnect();
                if($cn_Product->connect($connect)){
                    $result = mysql_query("update sanpham set IDDanhMuc = $ProdCategory,TenSP = '$ProdName',DonGia = $ProdPrice,NCC = '$ProdSupp',HinhAnhSP = '$imgurLink',Mota = '$ProdDescribe' where IDSanPham =".$IdProd);
                    return array($result,$status);
                }else
                    return false;
            }else{
                $status=0;
                $connect;
                $cn_Product = new clsconnect();
                if($cn_Product->connect($connect)){
                    $result = mysql_query("update sanpham set IDDanhMuc = $ProdCategory,TenSP = '$ProdName',DonGia = $ProdPrice,NCC = '$ProdSupp',Mota = '$ProdDescribe' where IDSanPham =".$IdProd);
                    return array($result,$status);
                }else
                    return false;
            }
        }


        function selectSPsearch($search){
            $connect;
            $cn_Product = new clsconnect();
            if($cn_Product->connect($connect)){
                $table = mysql_query("SELECT * FROM sanpham  INNER JOIN danhmucsanpham ON sanpham.IDDanhMuc = danhmucsanpham.IDDanhMuc WHERE TenSP LIKE N'%".$search."%' ORDER BY sanpham.IDDanhMuc DESC");
                $cn_Product->disconnect($connect);
                return $table;
            }else
                return false;
        }

        function selectAllTimKiemGia($giamin, $giamax){
            $connect;
            $p = new clsconnect();
            if($p->connect($connect)){
                $table = mysql_query("select * from sanpham where DonGia between $giamin and $giamax order by DonGia ASC");
                $p->disconnect($connect);
                return $table;
            }else{
                return false;
            }
        }

}
?>