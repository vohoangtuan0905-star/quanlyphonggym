<?php
require_once 'csdl/helper.php';
$username='huy';
$password='1';
$q=mysqli_query($con, "SELECT n.*, c.TenCV FROM nhanvien n JOIN congviec c ON n.congviec=c.idCv WHERE username='$username' AND password='$password'");
if(!$q){
    echo "Query failed: ".mysqli_error($con)."\n";
} else {
    echo "num_rows=".mysqli_num_rows($q)."\n";
    while($r=mysqli_fetch_assoc($q)){
        print_r($r);
        echo "\n";
    }
}
?>