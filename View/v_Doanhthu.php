<?php
include_once("./Controller/c_Doanhthu.php");

class viewThongke {
    function showThongke() {
        $Thongke = new controllThongke();
        $table = $Thongke->getThongke();

        if (!$table) {
            echo "ERROR";
        } elseif (mysql_num_rows($table) == 0) {
            echo "0 result";
        } else {
            $data = array(); // Dữ liệu cho Chart.js

            while ($row = mysql_fetch_assoc($table)) {
                $data[] = array(
                    'thang' => $row["thang"],
                    'nam' => $row["nam"],
                    'tongdoanhthu' => $row["tongdoanhthu"]
                );
            }

            // Chuyển đổi dữ liệu sang định dạng JSON cho Chart.js
            $json_data = json_encode($data);
            ?>

            <!DOCTYPE html>
            <html>

            <head>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </head>

            <body>
               
                <div style="width: 80%; margin: auto;">
                    <h3>Thống kê doanh thu</h3>
                    <canvas id="lineChart"></canvas>
                </div>

                <script>
                    $(document).ready(function () {
                        showLineChart();
                    });

                    function showLineChart() {
                        var data = <?php echo $json_data; ?>;

                        var months = data.map(function (item) {
                            return item.thang + '/' + item.nam;
                        });

                        var doanhThu = data.map(function (item) {
                            return item.tongdoanhthu;
                        });

                        var ctx = document.getElementById('lineChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line', // Change to 'line' for a line chart
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Doanh Thu',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    data: doanhThu,
                                    fill: false, // Set to true if you want to fill the area under the line
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
