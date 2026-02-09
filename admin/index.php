<?php
session_start();
// Đường dẫn này ĐÚNG
require_once ('../csdl/helper.php'); 

if(!isset($_SESSION['user_id'])){
    // Đường dẫn này ĐÚNG
    header('location:../index.php');	
}
$qry="SELECT Kehoach, count(*) as number FROM khachhang GROUP BY Kehoach";
$result=mysqli_query($con,$qry);
$qry="SELECT Gioitinh, count(*) as enumber FROM khachhang GROUP BY Gioitinh";
$result3=mysqli_query($con,$qry);
$qry="SELECT Congviec, count(*) as snumber FROM nhanvien GROUP BY Congviec";
$result5=mysqli_query($con,$qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Quản lý Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="../style/css/bootstrap.min.css" />
<link rel="stylesheet" href="../style/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../style/css/fullcalendar.css" />
<link rel="stylesheet" href="../style/css/matrix-style.css" />
<link rel="stylesheet" href="../style/css/matrix-media.css" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../style/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});

          function drawChart1() {
            var data = new google.visualization.arrayToDataTable([
              ['', 'Số khách hàng sử dụng'],

              <?php
                $query="SELECT Kehoach, count(*) as number FROM khachhang GROUP BY Kehoach";
                $res=mysqli_query($con,$query);
                while($data=mysqli_fetch_array($res)){
                  $Kehoach=$data['Kehoach'];
                  $number=$data['number'];
               ?>
               ['<?php echo $Kehoach;?>',<?php echo $number;?>],   
               <?php   
                }
               ?> 
            ]);

            var container = document.getElementById('top_x_div');
            var w = container ? container.clientWidth : 700;

            var options = {
              width: w,
              height: 290,
              legend: { position: 'none' },
              bars: 'vertical', 
              axes: {
                x: { 0: { side: 'top', label: 'Gói tập(tháng)'} }
              },
              bar: { groupWidth: "100%" }
            };

            var chart = new google.charts.Bar(container);
            chart.draw(data, options);
          }

      /* drawing trigger moved after both chart functions are defined */
        </script>
<script type="text/javascript">
      // Second chart (horizontal bars)
      function drawChart2() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Tổng tiền',],          
        <?php
          $query1 = "SELECT SUM(tongtien) as numberone FROM hoadon; ";

            $rezz=mysqli_query($con,$query1);
            while($data=mysqli_fetch_array($rezz)){
              $Kehoach='Tổng thu nhập';
              $numberone=$data['numberone'];

           ?>
           ['<?php echo $Kehoach;?>',<?php echo $numberone;?>,],   
           <?php   
            }
           ?> 
        <?php
          $query10 = "SELECT Soluong, SUM(Tongtien) as numbert FROM thietbi";
            $res1000=mysqli_query($con,$query10);
            while($data=mysqli_fetch_array($res1000)){
              $expenses='Số tiền chi trả mua thiết bị';
              $numbert=$data['numbert'];             
           ?>
           ['<?php echo $expenses;?>',<?php echo $numbert;?>,],   
           <?php   
            }
           ?> 
        <?php
          $query11 = "SELECT SUM(Tongtien) as numbert1 FROM luong";
            $res1001=mysqli_query($con,$query11);
            while($data=mysqli_fetch_array($res1001)){
              $expenses1='Số tiền lương chi trả';
              $numbert1=$data['numbert1'];             
           ?>
           ['<?php echo $expenses1;?>',<?php echo $numbert1;?>,],   
           <?php   
            }
           ?>          
        ]);

        var container = document.getElementById('top_y_div');
        var w = container ? container.clientWidth : 700;

        var options = {
          width: w,
          height: 180,
          legend: { position: 'none' },
          bars: 'horizontal',
          axes: { x: { 0: { side: 'top', label: 'Số tiền ' } } },
          bar: { groupWidth: "100%" }
        };
        var chart = new google.charts.Bar(container);
        chart.draw(data, options);
      }
      // drawChart2 will be called by the resize handler set earlier (drawChart1's callback)
    </script>
  <script type="text/javascript">
    // After both drawChart1 and drawChart2 are defined, draw them and attach resize handler
    google.charts.setOnLoadCallback(function(){
      drawChart1();
      if (typeof drawChart2 === 'function') drawChart2();
      var resizeTimer;
      window.addEventListener('resize', function(){
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function(){ drawChart1(); if (typeof drawChart2 === 'function') drawChart2(); }, 250);
      });
    });
  </script>
</head>
<body>

<div id="header">
  <h1></h1>
</div>

<?php include 'includes/topheader.php'?>
<?php $page='trangchu'; include 'includes/sidebar.php'?>

<div id="content">

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="fa fa-home"></i>Trang chủ</a></div>
  </div>

  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls span"> <a href="index.php" style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php include'khachhang/slkhachhang.php'?></span>Khách hàng đã đăng ký</a> </li>
        <li class="bg_lo span3"> <a href="khachhang/index.php" style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"><?php include'khachhang/khachhanghoatdong.php'?></span>khách hàng đang hoạt động</a> </li>
        <li class="bg_lg span3"> <a href="hoadon/index.php" style="font-size: 16px;"> <i class="fa fa-dollar-sign"></i> Doanh thu: <?php include'khachhang/tongtienchitra.php' ?> đ</a> </li>
        <li class="bg_lb span2"> <a href="thongbao/index.php" style="font-size: 16px;"> <i class="fas fa-bullhorn"></i><span class="label label-important"><?php include'thongbao/sl-thongbao.php'?></span>Announcements </a> </li>
      </ul>
    </div>
    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Thống kê số lượng đăng ký gói tập </h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span8">
              <div id="top_x_div" style="width: 100%; height: 290px;"></div>
            </div>
            <div class="span4">
              <ul class="site-stats">
                <li class="bg_lh"><i class="fas fa-users"></i> <strong><?php include 'khachhang/slkhachhang.php';?></strong> <small>Số lượng khách hàng</small></li>
                <li class="bg_lg"><i class="fas fa-user-clock"></i> <strong><?php include 'nhanvien/slnhanvien.php';?></strong> <small>Số lượng nhân viên</small></li>
                <li class="bg_ls"><i class="fas fa-dumbbell"></i> <strong><?php include 'thietbi/slthietbi.php';?></strong> <small>Số lượng thiết bị</small></li>
                <li class="bg_ly"><i class="fas fa-file-invoice-dollar"></i> <strong>$<?php include 'khachhang/tongtienchitra.php';?></strong> <small>Tổng doanh thu</small></li>
                <li class="bg_lr"><i class="fas fa-user-ninja"></i> <strong><?php include 'khachhang/khachhanghoatdong.php';?></strong> <small>Khách hàng đang hoạt động</small></li>
                <li class="bg_lb"><i class="fas fa-calendar-check"></i> <strong><?php include 'thongbao/sl-thongbao.php';?></strong> <small>Số lượng thông báo</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Thống kê thu nhập và chi phí</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div id="top_y_div" style="width: 100%; height: 180px;"></div>
            </div>            
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Thông báo phòng tập</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>

              <?php
                $qry="SELECT * FROM thongbao";
                $result=mysqli_query($con,$qry);
                  
                while($row=mysqli_fetch_array($result)){
                  // SỬA LỖI: Đường dẫn ảnh 1 cấp (../) - Đường dẫn này ĐÚNG
                  echo"<div class='user-thumb'> <img width='70' height='40' alt='User' src='../style/img/demo/av1.jpg'> </div>";
                  echo"<div class='article-post'>"; 
                  echo"<span class='user-info'> By: System Administrator / Date: ".$row['Ngaydangbai']." </span>";
                  echo"<p><a href='#'>".$row['Noidung']."</a> </p>";
                }
                echo"</div>";
                echo"</li>";
              ?>

              <a href="thongbao/index.php"><button class="btn btn-warning btn-mini">View All</button></a>
              </li>
            </ul>
          </div>
        </div>  
      </div>
      <div class="span6">
      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="fas fa-tasks"></i></span>
            <h5>Danh sách việc khách hàng đang thực hiện</h5>
          </div>
          <div class="widget-content">
            <div class="todo">
              <ul>
              <?php
                // SỬA LỖI: Sửa lại logic lồng vòng lặp của bạn
                $qry_viec = "SELECT k.Hoten, v.Nhiemvu, v.Status 
                             FROM vieccanlam v
                             JOIN khachhang k ON k.user_id = v.user_id";
                $result_viec = mysqli_query($con, $qry_viec);

                if (mysqli_num_rows($result_viec) > 0) {
                    while($row_viec = mysqli_fetch_array($result_viec)){
                        echo "<li class='clearfix'>";                                                                        
                        echo "<div class='txt'>";
                        echo htmlspecialchars($row_viec["Hoten"]) . " : ";
                        echo htmlspecialchars($row_viec["Nhiemvu"]) . " ";
                        if ($row_viec["Status"] == "Hoàn Thành") {
                            echo '<span class="by label label-info">Hoàn thành</span>';
                        } else {
                            echo '<span class="by label label-success">Đang thực hiện</span>';
                        }
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>Không có việc cần làm nào.</li>";
                }
                echo"</ul>"; // Di chuyển ra ngoài vòng lặp
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
       
      </div>
    </div>
  </div>
</div>

<style>
#piechart {
  width: 100% !important; 
  max-width: 100%;
  height: 280px;  
  margin-left:auto; 
  margin-right:auto;
}
</style>

<script src="../style/js/excanvas.min.js"></script>
<script src="../style/js/jquery.min.js"></script> 
<script src="../style/js/jquery.ui.custom.js"></script> 
<script src="../style/js/bootstrap.min.js"></script> 
<script src="../style/js/jquery.flot.min.js"></script> 
<script src="../style/js/jquery.flot.resize.min.js"></script> 
<script src="../style/js/jquery.peity.min.js"></script> 
<script src="../style/js/fullcalendar.min.js"></script> 
<script src="../style/js/matrix.js"></script> 
<script src="../style/js/matrix.dashboard.js"></script> 
<script src="../style/js/jquery.gritter.min.js"></script> 
<script src="../style/js/matrix.interface.js"></script> 
<script src="../style/js/matrix.chat.js"></script> 
<script src="../style/js/jquery.validate.js"></script> 
<script src="../style/js/matrix.form_validation.js"></script> 
<script src="../style/js/jquery.wizard.js"></script> 
<script src="../style/js/jquery.uniform.js"></script> 
<script src="../style/js/select2.min.js"></script> 
<script src="../style/js/matrix.popover.js"></script> 
<script src="../style/js/jquery.dataTables.min.js"></script> 
<script src="../style/js/matrix.tables.js"></script> 

<script type="text/javascript">
  function goPage (newURL) {
      if (newURL != "") {
          if (newURL == "-" ) {
              resetMenu();            
          }          
          else {  
            document.location.href = newURL;
          }
      }
  }
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>