<?php
session_start();
require_once ('../../csdl/helper.php');
if(!isset($_SESSION['user_id'])){
header('location:../../index.php');	
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
<link href="../../font-awesome/css/all.css" rel="stylesheet" />
<link href="../../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../../style/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include '../includes/topheader.php'?>

<?php $page="khachhang"; include '../includes/sidebar.php'?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Trở về" class="tip-bottom"><i class="fas fa-home"></i>Trang chủ</a> <a href="#" class="current">Thành viên đã đăng ký</a> </div>
    <h1 class="text-center">Danh sách thành viên đã đăng ký<i class="fas fa-group"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Bảng khách hàng</h5>
                      <form id="custom-search-form" role="search" method="POST" action="timkiem.php" class="form-search form-horizontal pull-right">
                <div class="input-append span12">
                    <input type="text" class="search-query" placeholder="Search" name="search" required>
                    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                </div>
            </form>
          </div>         
          <div class='widget-content nopadding'>


	  <?php

      $qry="SELECT k.user_id, k.Hoten, k.Sdt, k.Diachi, k.Kehoach,k.Taikhoan, k.Gioitinh, d.Tendv, k.Ngaybd, k.Ngaykt, k.Tongtien, k.Trangthai, DATEDIFF(k.Ngaykt, CURDATE()), IF(DATEDIFF(k.Ngaykt, CURDATE()) <= 0,'hết hạn','hoạt động') AS ngày FROM khachhang k JOIN Dichvu d on k.id = d.id";
      $cnt = 1;
        $result=mysqli_query($con,$qry);

        
          echo"<table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Họ và tên</th>
                  <th>Tài khoản</th>
                  <th>Giới tính</th>
                  <th>Số điện thoại</th>
                  <th>Ngày đăng ký</th>
                  <th>Địa chỉ</th>
                  <th>Tên dịch vụ</th>
                  <th>Thời gian</th>
                  <th>Thời gian còn lại</th>
                  <th>Trạng thái</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){
            echo"<tbody> 
               
                <td><div class='text-center'>".$cnt."</div></td>
                <td><div class='text-center'>".$row['Hoten']."</div></td>
                <td><div class='text-center'>".$row['Taikhoan']."</div></td>
                <td><div class='text-center'>".$row['Gioitinh']."</div></td>
                <td><div class='text-center'>".$row['Sdt']."</div></td>
                <td><div class='text-center'>".$row['Ngaybd']."</div></td>
                <td><div class='text-center'>".$row['Diachi']."</div></td>
                <td><div class='text-center'>".$row['Tendv']."</div></td>
                <td><div class='text-center'>".$row['Kehoach']." tháng</div></td>
                <td><div class='text-center'>".$row['DATEDIFF(k.Ngaykt, CURDATE())']." ngày</div></td>
                <td><div class='text-center'>".$row['ngày']."</div></td>
                <td><div class='text-center'><a href='' onclick='khach_hang_list(".$row['user_id'].")' style='color:#F66;'><i class='fas fa-trash'></i>Xoá</a></div></td>
                <td><div class='text-center'><a href='suakhachhang.php?id=".$row['user_id']."' style='color:#FFD700'><i class='fas fa-edit'></i>Sửa</a></div></td>
              </tbody>";
          $cnt++;  }
            ?>

            </table>
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

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

<script type="text/javascript">
				function khach_hang_list(user_id) {
					// Tránh trường hợp click nhiều lần
					if($(this).data('isDeleting')) {
						return;
					}

					var option = confirm('Bạn có chắc chắn muốn xoá khách hàng này không?')
					if(!option) {
						return;
					}

					// Đánh dấu đang xóa
					$(this).data('isDeleting', true);

					$.post('xoakhachhang.php', {
						'user_id': user_id,
						'action': 'delete'
					}, function(data) {
						location.reload();
					}).fail(function() {
						alert('Có lỗi xảy ra khi xóa khách hàng!');
						$(this).data('isDeleting', false);
					});
				}
			</script>
</body>
</html>
