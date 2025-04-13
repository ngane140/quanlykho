<?php
include('ketnoi.php');

// Lấy ID phiếu kiểm kê từ URL
$idPhieu = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($idPhieu)) {
    echo "Không có ID phiếu kiểm kê!";
    exit();
}

$kho = new quanlikho();
$conn = $kho->connect();

// ======= Lấy thông tin chung của phiếu kiểm kê =======
$sqlThongTin = "SELECT  pk.maPhieu, pk.ngayKiemKe,l.tenLoaiNguoiDung, nd.hoTen AS nguoiKiemKe
                FROM phieukiemke pk
                JOIN nguoidung nd ON pk.idNguoiDung = nd.idNguoiDung
               JOIN loainguoidung l ON nd.idLoaiNguoiDung = l.idLoaiNguoiDung
                WHERE pk.idPhieuKiemKe = ?";
$stmt = $conn->prepare($sqlThongTin);
$stmt->bind_param("i", $idPhieu);
$stmt->execute();
$stmt->bind_result($maPhieu, $ngayKiemKe,$chucvu, $nguoiKiemKe);
$stmt->fetch();
$thongTin = array(
    'maPhieu' => $maPhieu,
    'ngayKiemKe' => $ngayKiemKe,
    'tenLoaiNguoiDung'=>$chucvu,
    'hoTen' => $nguoiKiemKe
    
);
$stmt->close();

// ======= Lấy danh sách chi tiết nguyên liệu kiểm kê =======
$sqlChiTiet = "SELECT nl.tenNguyenLieu, k.soLuongKiemKe, k.soLuongThucTe, 
                      k.soLuongChenhLech, k.ngayNhap
               FROM kiemke k
               JOIN nguyenlieu nl ON k.maNL = nl.maNL
               WHERE k.idPhieuKiemKe = ?";
$stmt2 = $conn->prepare($sqlChiTiet);
$stmt2->bind_param("i", $idPhieu);
$stmt2->execute();
$stmt2->bind_result($tenNL, $slKK, $slTT, $chenhLech, $ngayNhap);
$resultChiTiet = array();
$checkTrung = array();

while ($stmt2->fetch()) {
    $key = $tenNL . $slKK . $slTT . $chenhLech . $ngayNhap;
    if (!in_array($key, $checkTrung)) {
        $checkTrung[] = $key;
        $resultChiTiet[] = array(
            'tenNguyenLieu' => $tenNL,
            'soLuongKiemKe' => $slKK,
            'soLuongThucTe' => $slTT,
            'soLuongChenhLech' => $chenhLech,
            'ngayNhap' => $ngayNhap
        );
    }
}
$stmt2->close();

?>
