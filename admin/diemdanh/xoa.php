<!-- <?php
require_once ('../../csdl/helper.php');
session_start();

if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

$user_id = $_GET['id'];

$sql = "DELETE FROM diemdanh WHERE user_id='".$_GET["id"]."'";
$result=mysqli_query($con,$sql);
if ($con->query($sql) === TRUE) {
    $dem = 1;
    $sql1 = "UPDATE khachhang SET Diemdanh = Diemdanh - '$dem' where user_id='$user_id'";
    $con->query($sql1) ;
      
    ?>
<script type="text/javascript">
window.location="index.php";
</script>
<?php
} else {
   
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="diemdanh/index.php";
</script>
<?php
}
?> --><?php
session_start();