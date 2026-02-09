<?php session_start();
require_once ('csdl/helper.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Quản lý Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="style/css/bootstrap.min.css" />
		<link rel="stylesheet" href="style/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="style/css/matrix-style.css" />
        <link rel="stylesheet" href="style/css/matrix-login.css" />
        <link href="font-awesome/css/fontawesome.css" rel="stylesheet" />
        <link href="font-awesome/css/all.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    
    <body>
    
        <div id="loginbox">            
            <form id="loginform" method="POST" class="form-vertical" action="#">
            <div class="control-group normal_text"> <h3><img src="style\img\logo.jpg" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="fas fa-user-circle"></i></span><input type="text" name="user" placeholder="Tài khoản" required/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="fas fa-lock"></i></span><input type="password" name="pass" placeholder="Mật khẩu" required />
                        </div>
                    </div>
                </div>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-block btn-large btn-info" title="Log In" name="login" value="Admin Login">Đăng nhập</button>
                </div>
            </form>
            <?php
                if (isset($_POST['login']))
                    {
                        $username = mysqli_real_escape_string($con, $_POST['user']);
                        $password = mysqli_real_escape_string($con, $_POST['pass']);
                        
                        // Kiểm tra đăng nhập admin
                        $admin_query = mysqli_query($con, "SELECT * FROM admin WHERE password='$password' and username='$username'");
                        $admin_row = mysqli_fetch_array($admin_query);
                        $admin_count = mysqli_num_rows($admin_query);
                        
                        // Kiểm tra đăng nhập nhân viên
                        $staff_query = mysqli_query($con, "SELECT n.*, c.TenCV FROM nhanvien n JOIN congviec c ON n.congviec = c.idCv WHERE n.password='$password' AND n.username='$username'");
                        $staff_row = mysqli_fetch_array($staff_query);
                        $staff_count = mysqli_num_rows($staff_query);
                        
                        if ($admin_count > 0) 
                        {			
                            $_SESSION['user_id'] = $admin_row['user_id'];
                            $_SESSION['role'] = 'admin';
                            header('location:admin/admin/index.php');
                            exit();
                        }
                        else if ($staff_count > 0)
                        {
                            $_SESSION['user_id'] = $staff_row['id'];
                            $_SESSION['role'] = 'staff';
                            $_SESSION['congviec'] = $staff_row['TenCV'];
                            header('location:nhanvien/khachhang/index.php');
                            exit();
                        }
                        else
                        {
                            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                            Tài khoản hoặc mật khẩu không đúng!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                            </div>";
                        }
                    }
            ?>
            <div class="pull-left">
            <a href="khachhang/index.php"><h6>Khách hàng đăng nhập</h6></a>
            </div>

            <div class="pull-right">
            <a href="nhanvien/index.php"><h6>Nhân viên đăng nhập</h6></a>
            </div>
            
        </div>
        
        <script src="style/js/jquery.min.js"></script>  
        <script src="style/js/matrix.login.js"></script> 
        <script src="style/js/bootstrap.min.js"></script> 
<script src="style/js/matrix.js"></script>
    </body>
</html>
