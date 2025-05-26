<?php
session_start();
include('ketnoi.php'); 

$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 

if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
$kho = new quanlikho(); 
$conn = $kho->connect(); 


$danhsach = array();
$sql = "SELECT * FROM yeucausanxuatsanpham 
        ORDER BY ngayYeuCau DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhsach[] = $row;
    }
}
?>