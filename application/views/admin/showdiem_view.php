<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*include('left_view.php');*/
?>
<html>
<head><meta charset="utf-8"/>
    <link rel="stylesheet" href="<?php echo base_url()?>jquery/jquery-ui.css"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url()?>jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url()?>jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>Chart.js/Chart.min.js"></script>

</head>
<title>bảng điểm</title></head><div id="container-fluid"><body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="">Bảng điểm của <?php echo $diem[0]['Name']; ?></a>
                <a class="navbar-brand" href="<?php echo base_url ().'check_mark';?>">Tra điểm lại</a>
            </div>

        </div>
    </nav>
    <div class=”row”>
        <div class="col-md-12">  <h5 style="color: blue"> <?php function rank($rank,$diem){
            foreach ($rank as $rank){
                if($rank['maso_hocsinh']==$diem[0]['maso_hocsinh']){
                 $val=$rank['rank']; return $val;}
            }}
            echo "Điểm 1 tiết xếp hạng&nbsp".rank($rank_1_tiet,$diem).";&nbsp";
           echo "Điểm thi xếp hạng&nbsp".rank($rank_thi,$diem).";&nbsp";
            echo "Điểm TB cả năm xếp hạng&nbsp".rank($rank_diem_phay,$diem).";&nbsp";
                ?></h5>
        <p style="color: red">Bảng điểm mang tính chất tham khảo</p></div>
        <p><div class="col-md-12"><table class='table table-bordered'><tr><th class='success'>Môn học</th><th class='success'>Điểm miệng</th>
        <th class='success'>Điểm 15 phút</th><th class='success'>Điểm 1 tiết</th><th class='success'>Điểm thi</th><th class='success'>Điểm TB</th><th class='success'>Cả năm</th></tr>
        <?php $mang=array('diem_mieng','diem_15','diem_1_tiet','diem_thi','diem_phay','tbm_canam');
        //diem mon su
        for($i=0;$i<=$count-1;$i++){if($diem[$i]['ten_monhoc']=='Lịch sử'){ echo "<tr><td class='warning'>".$diem[$i]['ten_monhoc']."</td>";
            for($j=0;$j<=5;$j++){echo "<td class='warning'>".str_replace(".",",","{$diem[$i][$mang[$j]]}")."</td>";}}
            //diem tat ca cac mon
        //for($i=0;$i<=$count-1;$i++){echo "<tr><td class='warning'>".$diem[$i]['ten_monhoc']."</td>";//diem tat ca cac mon
      // for($j=0;$j<=4;$j++){echo "<td class='warning'>".str_replace(".",",","{$diem[$i][$mang[$j]]}")."</td>";}
     }?>
        </table></div>
        <div class="col-md-6"> <canvas id="chartJSContainer" width="100" height="50"></canvas></div>
        <script>
            var options = {
                type: 'line',
                data: {
                    labels: ["5", "6", "6,5", "7,5", "8,5", "9,5"],
                    datasets: [
                        {
                            label: 'Xu hướng phân bố điểm thi trong lớp',
                            data: <?php foreach ($chart as $chart){
                            echo "[".$chart["muc1"].",".$chart["muc2"].",".$chart["muc3"].",".$chart["muc4"].",".$chart["muc5"].",".$chart["muc6"].","."]";
                        }?>,
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)']
                        }

                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                reverse: false
                            }
                        }]
                    }
                }
            }

            var ctx = document.getElementById('chartJSContainer').getContext('2d');
            new Chart(ctx, options);
        </script></p></div>

</div>
</body>
</html>
