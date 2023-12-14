<?php 
    include_once("./Controller/c_SalesProduct.php"); 

    class viewSalesProduct { 
        function showSalesProduct() { 
            $SalesProduct = new controllSalesProduct(); 
            $table = $SalesProduct->getSalesProduct(); 

            if(!$table) { 
                echo "ERROR"; 
            } elseif(mysql_num_rows($table) == 0) { 
                echo "0 result"; 
            } else { 
                $data = array(); 

                while($row = mysql_fetch_assoc($table)) { 
                    $data[] = array( 
                        'TenSP' => $row["TenSP"], 
                        'SoLuong' => $row["SoLuong"]
                    ); 
                } 

                // Named function to use in usort

                // Convert data to JSON format for Chart.js
                $json_data = json_encode($data);
            ?> 

            <!DOCTYPE html> 
            <html> 

            <head> 
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
            </head> 

            <body> 
                <div style="width: 80%; ">
                    <h3>Thống kê sản phẩm đã bán</h3>
                    <canvas id="barChart"></canvas> 
                </div> 

                <script> 
                    $(document).ready(function () { 
                        showBarChart(); 
                    }); 

                    function showBarChart() { 
                        var data = <?php echo $json_data; ?>; 

                        var products = data.map(function (item) { 
                            return item.TenSP; 
                        }); 

                        var quantities = data.map(function (item) { 
                            return item.SoLuong; 
                        }); 

                        var ctx = document.getElementById('barChart').getContext('2d'); 
                        var myChart = new Chart(ctx, { 
                            type: 'bar', 
                            data: { 
                                labels: products, 
                                datasets: [{ 
                                    label: 'Số lượng', 
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                                    borderColor: 'rgba(75, 192, 192, 1)', 
                                    borderWidth: 1, 
                                    data: quantities, 
                                }] 
                            }, 
                            options: { 
                                scales: { 
                                    y: { 
                                        beginAtZero: true 
                                    } 
                                } 
                            } 
                        }); 
                    } 
                </script> 
            </body> 

            </html>

<?php 
            } 
        } 
    } 
?>
