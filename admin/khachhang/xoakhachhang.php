<?php
require_once ('../../csdl/helper.php');
session_start();
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['user_id'])) {
					$user_id = $_POST['user_id'];
					
					// Xóa các bản ghi liên quan trong các bảng con trước
					$sql_diemdanh = 'DELETE FROM diemdanh WHERE user_id = '.$user_id;
					execute($sql_diemdanh);
					
					$sql_hoadon = 'DELETE FROM hoadon WHERE user_id = '.$user_id;
					execute($sql_hoadon);
					
					$sql_thongtinthaydoi = 'DELETE FROM thongtinthaydoi WHERE user_id = '.$user_id;
					execute($sql_thongtinthaydoi);
					
					$sql_vieccanlam = 'DELETE FROM vieccanlam WHERE user_id = '.$user_id;
					execute($sql_vieccanlam);
					
					// Cuối cùng xóa khách hàng
					$sql = 'DELETE FROM khachhang WHERE user_id = '.$user_id;
					execute($sql);
				}
				break;
		}
	}
}
?>
