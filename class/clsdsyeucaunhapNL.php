<?php
session_start();
include_once('ketnoi.php'); 
$kho = new quanlikho(); 

$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 


if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
$conn = $kho->connect(); 
// Truy vấn để lấy danh sách nhân viên kho từ cơ sở dữ liệu

$danhsach = array();
$sql = "SELECT *
FROM yeucaunhapnguyenlieu
ORDER BY trangThai ASC , ngayYeuCau DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $danhsach[] = $row;
    }
}
?>