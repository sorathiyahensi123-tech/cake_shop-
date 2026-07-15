<?php
require_once('../config.php');
$res = mysqli_query($conn, 'SHOW TABLES');
echo "TABLES:\n";
while($row = mysqli_fetch_array($res)) { 
    echo $row[0]."\n"; 
}
echo "==============\n";
echo "ADMIN TABLE COLS:\n";
$res2 = mysqli_query($conn, 'DESCRIBE cake_shop_admin_registrations');
if($res2) {
    while($row = mysqli_fetch_array($res2)) { echo $row['Field']." - ".$row['Type']."\n"; }
}
?>
