<?php
  session_start();
  require_once ('../../csdl/helper.php');
    if(!isset($_SESSION['user_id'])) {
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
</head>
<body>
<div id="header">
  <h1><a href="dashboard.html">Gym Admin</a></h1>
</div>
<?php include '../includes/topheader.php'?>
<?php $page='suacongviec'; include '../includes/sidebar.php'?>
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Quản lý thiết bị</a> <a href="#" class="current">Cập nhật thông tin</a> </div>
  <h1>Cập nhật</h1>
</div>
<form role="form" action="index.php" method="POST">
    <?php 
    if (isset($_POST['TenCV'])) {
        // Retrieve form data
        $TenCV = $_POST["TenCV"];    
        $Tratien = $_POST["Tratien"];
         $id = $_POST['id'];

        // Prepare the SQL update query
        $qry = "UPDATE congviec SET TenCV='$TenCV', Tratien='$Tratien' WHERE idCv='$id'";
        $result = mysqli_query($con, $qry);

        if (!$result) {
            // If the query fails, display an error message
            echo "<div class='container-fluid'>";
                echo "<div class='row-fluid'>";
                    echo "<div class='span12'>";
                        echo "<div class='widget-box'>";
                            echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                                echo "<h5>Error Message</h5>";
                            echo "</div>";
                            echo "<div class='widget-content'>";
                                echo "<div class='error_ex'>";
                                    echo "<h1 style='color:maroon;'>Error 404</h1>";
                                    echo "<h3>An error occurred while updating your details</h3>";
                                    echo "<p>Please try again</p>";
                                    echo "<a class='btn btn-warning btn-big' href='edit-equipment.php'>Go Back</a>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        } else {
            // If the query is successful, display a success message
            echo "<div class='container-fluid'>";
                echo "<div class='row-fluid'>";
                    echo "<div class='span12'>";
                        echo "<div class='widget-box'>";
                            echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                                echo "<h5>Thông báo</h5>";
                            echo "</div>";
                            echo "<div class='widget-content'>";
                                echo "<div class='error_ex'>";
                                    echo "<h1>Thành Công</h1>";
                                    echo "<h3>Chi tiết công việc đã được cập nhật!</h3>";
                                    echo "<p>Các chi tiết yêu cầu được cập nhật. Vui lòng bấm vào nút để quay lại.</p>";
                                    echo "<a class='btn btn-inverse btn-big' href='index.php'>Trở về</a>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }

    } else {
        // If no form data is set, show an unauthorized message
        echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='thietbi/index.php'> DASHBOARD </a></h3>";
    }
    ?>
</form>

                                                                 
             </form>
         </div>
</div></div>
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
</body>
</html>
