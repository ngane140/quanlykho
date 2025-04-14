<?php
include('../class/ketnoi.php');
$kho = new quanlikho();
$conn = $kho->connect();
$sdt = intval($_GET['sdt']);
$sql = "SELECT * FROM khachhang WHERE SDT = $sdt LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
    echo json_encode(mysqli_fetch_assoc($result));
} else {
    echo "null";
}
