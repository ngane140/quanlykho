<?php
include('ketnoi.php');
session_start();
$kho = new quanlikho();
$conn = $kho->connect();
$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; // Kiểm tra xem session có lưu idNguoiDung không

// Kiểm tra nếu không có idNguoiDung, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}
// Lấy thông tin người dùng từ cơ sở dữ liệu theo id
$sql = "SELECT * FROM nguoidung WHERE idNguoiDung = '$id'";
$result = $kho->connect()->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Không tìm thấy người dùng với id này!";
    exit(); // Dừng nếu không tìm thấy người dùng
}
// Thống kê yêu cầu chờ xử lý
$query1 = "SELECT (SELECT COUNT(*) FROM yeucaunhapnguyenlieu WHERE trangThai = 0) + 
          (SELECT COUNT(*) FROM yeucauxuatnguyenlieu WHERE trangThai = 0) +
          (SELECT COUNT(*) FROM yeucausanxuatsanpham WHERE trangThai = 0) +
          (SELECT COUNT(*) FROM yeucauxuatsanpham WHERE trangThai = 0) as total";
$result1 = $conn->query($query1);
$yeucau = $result1 ? $result1->fetch_assoc() : array('total' => 'Lỗi');

// Thống kê nguyên liệu hết hàng
$query2 = "SELECT COUNT(*) as total FROM (
              SELECT maNL FROM nguyenlieu GROUP BY maNL HAVING SUM(soLuongTon) = 0
          ) as temp";
$result2 = $conn->query($query2);
$nl_hethang = $result2 ? $result2->fetch_assoc() : array('total' => 'Lỗi');

// Thống kê sản phẩm hết hàng
$query3 = "SELECT COUNT(*) as total FROM (
              SELECT maSP FROM sanpham GROUP BY maSP HAVING SUM(soLuong) = 0
          ) as temp";
$result3 = $conn->query($query3);
$sp_hethang = $result3 ? $result3->fetch_assoc() :array('total' => 'Lỗi');

// Thống kê tổng nguyên liệu
$query4 = "SELECT COUNT(DISTINCT maNL) as total FROM nguyenlieu";
$result4 = $conn->query($query4);
$tong_nl = $result4 ? $result4->fetch_assoc() : array('total' => 'Lỗi');

// Thống kê tổng sản phẩm
$query5 = "SELECT COUNT(DISTINCT maSP) as total FROM sanpham";
$result5 = $conn->query($query5);
$tong_sp = $result5 ? $result5->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê tổng nhân viên
$query6 = "SELECT COUNT(*) as total FROM nguoidung WHERE idLoaiNguoiDung = 3";
$result6 = $conn->query($query6);
$tong_nv = $result6 ? $result6->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê yêu cầu xuât SP chờ xử lý
$query7 = "SELECT (SELECT COUNT(*) FROM yeucauxuatsanpham WHERE trangThai = 0) as total";
$result7 = $conn->query($query7);
$yeucauxuat = $result7 ? $result7->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê yêu cầu nhâp NL
$query8 = "SELECT (SELECT COUNT(*) FROM yeucaunhapnguyenlieu WHERE trangThai = 0) as total";
$result8 = $conn->query($query8);
$yeucaunhap = $result8 ? $result8->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê phiếu kiểm kê
$query9 = "SELECT (SELECT COUNT(*) FROM phieukiemke) as total";
$result9 = $conn->query($query9);
$kiemke = $result9 ? $result9->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê yêu cầu sản xuất
$query10 = "SELECT (SELECT COUNT(*) FROM yeucausanxuatsanpham WHERE trangThai = 0) as total";
$result10 = $conn->query($query10);
$yeusx = $result10 ? $result10->fetch_assoc() : array('total' => 'Lỗi');
// Thống kê yêu cầu xuất nguyên liệu
$query11 = "SELECT (SELECT COUNT(*) FROM yeucauxuatnguyenlieu WHERE trangThai = 0) as total";
$result11 = $conn->query($query11);
$yeuxuatnl = $result11 ? $result11->fetch_assoc() : array('total' => 'Lỗi');
?>

