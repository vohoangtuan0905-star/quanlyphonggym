<?php
session_start();
require_once ('../../csdl/helper.php');
if(($_SESSION['congviec']) != "Quản lý" AND $_SESSION['congviec'] != "Thu ngân"){
    header('location:../index.php');	
    exit();
}

if(isset($_POST['id'])){
    try {
        $con->begin_transaction();

        $iduser = $_POST['id'];
        $dv = isset($_POST["Tongtien"]) ? (int)$_POST["Tongtien"] : 0;
        $hlv_id = isset($_POST["hlv"]) ? (int)$_POST["hlv"] : 0;
        $Giathue = isset($_POST["Giathue"]) ? (int)$_POST["Giathue"] : 0;
        $ngaythanhtoan = date('Y-m-d');
        $ghichu = 'Đã thanh toán';
        
        // Tính tổng tiền
        $tien = $dv + $Giathue;
        
        // Thêm hóa đơn mới
        $qry = "INSERT INTO hoadon(user_id, tongtien, ngaythanhtoan, ghichu) 
                VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($qry);
        $stmt->bind_param("iiss", $iduser, $tien, $ngaythanhtoan, $ghichu);
        $stmt->execute();

        // Cập nhật thông tin khách hàng
        $sql = "UPDATE khachhang 
                SET Trangthai = '1', 
                    Loinhac = '0', 
                    id_nhanvien = ?, 
                    TT = 1,
                    ngaythue = CASE WHEN ? > 0 THEN ? ELSE ngaythue END,
                    ngayktthue = CASE WHEN ? > 0 THEN DATE_ADD(?, INTERVAL 1 MONTH) ELSE ngayktthue END
                WHERE user_id = ?";
        
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iisssi", $hlv_id, $hlv_id, $ngaythanhtoan, $hlv_id, $ngaythanhtoan, $iduser);
        $stmt->execute();

        $con->commit();
        
        header('Location:index.php');
        exit();
    } catch (Exception $e) {
        $con->rollback();
        echo "Có lỗi xảy ra: " . $e->getMessage();
        exit();
    }

}
