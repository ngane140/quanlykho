<?php
include('ketnoi.php');

$idYCX = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($idYCX)) {
    echo "Không có ID yêu cầu xuất sản phẩm!";
    exit();
}

$kho = new quanlikho();
$conn = $kho->connect();

// === Lấy thông tin chung của yêu cầu xuất sản phẩm ===
$sqlThongTin = "SELECT ycx.idYeuCauXuatSP, ycx.ngayYeuCau, kh.hoTen,kh.SDT,kh.email,kh.diaChi
                FROM yeucauxuatsanpham ycx
                JOIN khachhang kh ON ycx.idKhachHang = kh.idKhachHang
                WHERE ycx.idYeuCauXuatSP = ?";
$stmt = $conn->prepare($sqlThongTin);
$stmt->bind_param("i", $idYCX);
$stmt->execute();
$stmt->bind_result($maYC, $ngayYC, $tenKH, $SDT, $email,$diaChi);
$stmt->fetch();
$thongTin = array(
    'idYeuCauXuatSP' => $maYC,
    'ngayYeuCau' => $ngayYC,
    'hoTen' => $tenKH,
    'email' => $email,
    'SDT'=>$SDT,
    'diaChi' => $diaChi
);
$stmt->close();

// === Lấy danh sách chi tiết sản phẩm xuất ===
$sqlChiTiet = "SELECT ctx.maSP,sp.tensanPham, ctx.soLuongXuat,sp.donViTinh,sp.donGia
               FROM chitietyeucauxuatsanpham ctx
               JOIN sanpham sp ON ctx.maSP = sp.maSP
               WHERE ctx.idYeuCauXuatSP = ?";
$stmt2 = $conn->prepare($sqlChiTiet);
$stmt2->bind_param("i", $idYCX);

$stmt2->execute();
$stmt2->bind_result($maSP,$tenSP, $soLuong,$donViTinh,$donGia);
$chiTietSP = array();

while ($stmt2->fetch()) {
    $chiTietSP[] = array(
        'maSP'=>$maSP,
        'tensanPham' => $tenSP,
        'soLuongXuat' => $soLuong,
        'donViTinh'=>$donViTinh,
        'donGia'=>$donGia
    );
}
$stmt2->close();
?>
