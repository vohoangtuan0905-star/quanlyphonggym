<?php
session_start();
require_once ('../../csdl/helper.php');
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Quản lý Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../../style/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../style/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../../style/css/fullcalendar.css" />
<link rel="stylesheet" href="../../style/css/matrix-style.css" />
<link rel="stylesheet" href="../../style/css/matrix-media.css" />
<link href="../../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../../style/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<style>
  #gia-thue td {
  padding: 5px;
  font-weight: bold;
  font-size: 14px;
}
</style>
</head>
<body>

<div id="header">
  <h1><a href="">Perfect Gym Admin</a></h1>
</div>

<?php include '../includes/topheader.php'?>

<?php $page='hoadon-thanhtoan'; include '../includes/sidebar.php'?>

<?php
$id=$_GET['id'];
$qry= "select * from khachhang k left join dichvu d on k.id = d.id where user_id='$id'";
$result=mysqli_query($con,$qry);
while($row=mysqli_fetch_array($result)){
?> 
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i>Trang chủ</a> <a href="payment.php">Hóa đơn</a> <a href="#" class="current">Thanh toán</a> </div>
    <h1>Trang thanh toán hóa đơn</h1>
  </div> 
  <div class="container-fluid" style="margin-top:-38px;">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="fas fa-money"></i> </span>
            <h5>Chi tiết hóa đơn</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span5" style="display: flex; justify-content: center; align-items: center;">
                <table class="">
                  <tbody>
                  <tr>
                      <td><img src="../../style/img/demo/anime.jpg" alt="Gym Logo" width="175"></td>
                    </tr>
                    <tr>
                      <td><h4>Gym Hoàng Tuấn</h4></td>
                    </tr>
                    <tr>
                      <td>Hồ Chí Minh</td>
                    </tr>                   
                    <tr>
                      <td>Sđt : 0818940765</td>
                    </tr>
                    <tr>
                      <td >Email: hoangtuan1234@gmail.com</td>
                    </tr>
                  </tbody>
                </table>
              </div>			  			  
              <div class="span7">
                <table class="table table-bordered table-invoice">
				
                  <tbody>
				  <form action="xuly.php" method="POST">
                    <tr>
                    <tr>
                      <td class="width30">Họ và tên:</td>
                      <input type="hidden" name="Hoten">
                      <td class="width70"><strong><?php echo $row['Hoten']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Dịch vụ:</td>
                      <input type="hidden" name="Dichvu">
                      <td><strong><?php echo $row['Tendv']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Tổng tiền dịch vụ:</td>
                      <input type="hidden" name="Tongtien" value="<?php echo $row['Tongtien'];?>">
                      <td><strong><?php echo $row['Tongtien']; ?></strong></td>
                    </tr>

                    <tr>
                      <td>Số tháng tập:</td>
                      <input type="hidden" name="Kehoach" >
                      <td><strong><?php echo $row['Kehoach']; ?></strong></td>
                    </tr>
                    
                    <tr>
                      <td>Tên huấn luyện viên đã thuê:</td>
                      <?php
                          $id_nhanvien = $row['id_nhanvien'];
                          if ($id_nhanvien) {
                              $query = "SELECT Hoten, Giathue FROM nhanvien WHERE id_nhanvien = $id_nhanvien";
                              $result = mysqli_query($con, $query);
                              $hlv = mysqli_fetch_assoc($result);
                              $ten_hlv = $hlv['Hoten'];
                              $Giathue = $hlv['Giathue'];
                          } else {
                              $ten_hlv = "Không thuê huấn luyện viên";
                              $Giathue = "";
                          }
                      ?>
                      <td><strong><?php echo $ten_hlv; ?></strong></td>
                      <input type="hidden" name="hlv" value="<?php echo $id_nhanvien;?>"></td>
                    </tr>
                    <?php if (!empty($hlv['Giathue'])): ?>
                      <tr>
                        <td>Số tiền thuê:</td>
                        <input type="hidden" name="Giathue" value="<?php echo $hlv['Giathue'];?>">
                        <td><strong><?php echo $hlv['Giathue']; ?>/tháng</strong></td>
                      </tr>
                    <?php endif; ?>
                    
                    <tr>
                      <td>Trạng thái:</td>
                      <?php if ($row['Trangthai'] == 0 || $row['Trangthai'] == ""): ?>
                        <td><strong>Chưa thanh toán</strong></td>
                      <?php else: ?>
                        <input type="hidden" name="Trangthai" value="<?php echo $row['Trangthai']; ?>">
                        <td><strong><?php echo $row['Trangthai']; ?></strong></td>
                      <?php endif; ?>
                    </tr>
                    </tbody>                 
                </table>
              </div>			  
            </div>

            <div class="row-fluid">
              <div class="span12">
				<hr>
                <div class="text-center">

             <input type="hidden" name="id" value="<?php echo $row['user_id'];?>">
      
                  <button class="btn btn-success btn-large" type="SUBMIT" href="">Thanh toán</button> 
				</div>				  
				  </form>
              </div>
            </div>
			
      <?php
}
      ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="../../style/js/excanvas.min.js"></script> 
<script src="../../style/js/jquery.min.js"></script> 
<script src="../../style/js/jquery.ui.custom.js"></script> 
<script src="../../style/js/bootstrap.min.js"></script> 
<script src="../../style/js/jquery.flot.min.js"></script> 
<script src="../../style/js/jquery.flot.resize.min.js"></script> 
<script src="../../style/js/jquery.peity.min.js"></script> 
<script src="../../style/js/fullcalendar.min.js"></script> 
<script src="../../style/js/matrix.js"></script> 
<script src="../../style/js/matrix.dashboard.js"></script> 
<script src="../../style/js/jquery.gritter.min.js"></script> 
<script src="../../style/js/matrix.interface.js"></script> 
<script src="../../style/js/matrix.chat.js"></script> 
<script src="../../style/js/jquery.validate.js"></script> 
<script src="../../style/js/matrix.form_validation.js"></script> 
<script src="../../style/js/jquery.wizard.js"></script> 
<script src="../../style/js/jquery.uniform.js"></script> 
<script src="../../style/js/select2.min.js"></script> 
<script src="../../style/js/matrix.popover.js"></script> 
<script src="../../style/js/jquery.dataTables.min.js"></script> 
<script src="../../style/js/matrix.tables.js"></script> 

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

                        const giaThueDiv = document.getElementById('gia-thue');

                        if (!<?php echo $id_nhanvien; ?>) {
                          giaThueDiv.style.display = 'none';
                        }

                        document.querySelector('[name="hlv"]').addEventListener('change', function() {
                          if (this.value) {
                            giaThueDiv.style.display = 'block';
                          } else {
                            giaThueDiv.style.display = 'none';
                          }
                        });

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>