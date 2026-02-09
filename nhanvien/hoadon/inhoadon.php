<?php
session_start();
require_once ('../../csdl/helper.php');
if(($_SESSION['congviec']) != "Quản lý" AND $_SESSION['congviec'] != "Thu ngân"){
header('location:../index.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];
$sql = "SELECT * FROM hoadon h join khachhang k on h.user_id = k.user_id WHERE h.id = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$Hoten = $row['Hoten'];
// $user_id = $row['user_id'];
$tongtien = $row['tongtien'];
$ngaythanhtoan = $row['ngaythanhtoan'];
$ghichu = $row['ghichu'];
}?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Quản lý Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js">
</script>
<link rel="stylesheet" href="../../style/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../style/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../../style/css/uniform.css" />
<link rel="stylesheet" href="../../style/css/select2.css" />
<link rel="stylesheet" href="../../style/css/matrix-style.css" />
<link rel="stylesheet" href="../../style/css/matrix-media.css" />
<link href="../../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../../font-awesome/css/all.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .invoice {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 700px;
        }

        .invoice .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice .header h1 {
            font-size: 30px;
        }

        .invoice .header p {
            font-size: 18px;
        }

        .invoice .customer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice .customer-info div {
            width: 50%;
        }

        .invoice .customer-info h3 {
            margin-bottom: 5px;
            font-size: 20px;
        }

        .invoice .customer-info p {
            font-size: 18px;
        }

        .invoice .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice .table th,
        .invoice .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .invoice .table th {
            background-color: #f0f0f0;
            font-size: 18px;
        }

        .invoice .table td {
            font-size: 16px;
        }

        .invoice .total {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 20px;
        }

        .invoice .total p {
            font-size: 24px;
            margin-right: 20px;
        }
    </style>
</head>
<body>

    <div class="invoice">
        <div class="header">
            <div>
                <h1>Hóa đơn</h1>
                <p>Ngày thanh toán: <?php echo $ngaythanhtoan; ?></p>
            </div>
            <img src="../../style/img/demo/anime.jpg" style="width:100px; height:100px" alt="Logo">
        </div>
        
        <div class="customer-info">
            <div>
                <h3>Thông tin phòng tập</h3>
                <p><strong>Gym Hoàng Tuấn</strong></p>
                <p>Địa chỉ: Hồ Chí Minh</p>
                <p>SĐT: 0818940765</p>
                <p>Email: hoangtuan1234@gmail.com</p>
            </div>
            <div>
                <h3>Thông tin khách hàng</h3>
                <p><strong><?php echo $Hoten; ?></strong></p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Dịch vụ</th>
                    <th>Đơn giá</th>
                    <th>Thời gian</th>
                    <th>Huấn luyện viên</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select k.Tongtien,k.Hoten, k.Kehoach, k.id_nhanvien,d.Tendv, d.Gia, n.Hoten as Hotennv, h.tongtien, h.ngaythanhtoan from khachhang k left join dichvu d on k.id = d.id LEFT JOIN hoadon h on k.user_id = h.user_id LEFT JOIN nhanvien n on k.id_nhanvien = n.id_nhanvien where h.id= '$id'";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $Hoten = $row['Hoten'];
                    $Gia = $row['Gia'];
                    $Kehoach = $row['Kehoach'];
                    $Hotennv = $row['Hotennv'];
                    $total = $row['Tongtien'];
                    $Dichvu = $row['Tendv'];

                        if($row['id_nhanvien'] == 0){
                            $thue = 0;
                        }
                        else{
                            $thue = 400000;
                        }
                        $tien = $total + $thue;
                    echo "<tr>
                            <td>$Dichvu</td>
                            <td>$Gia</td>
                            <td>$Kehoach</td>
                            <td>$Hotennv</td>
                            <td>$tien</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="total">
            <p>Tổng tiền: <?php echo $tien; ?></p>
        </div>
        <button class="btn btn-danger" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>
<script src="../../style/js/jquery.min.js"></script> 
<script src="../../style/js/jquery.ui.custom.js"></script> 
<script src="../../style/js/bootstrap.min.js"></script> 
<script src="../../style/js/jquery.uniform.js"></script> 
<script src="../../style/js/select2.min.js"></script> 
<script src="../../style/js/jquery.dataTables.min.js"></script> 
<script src="../../style/js/matrix.js"></script> 
<script src="../../style/js/matrix.tables.js"></script>
</body>
</html>
