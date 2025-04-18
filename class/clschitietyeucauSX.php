<?php
include('ketnoi.php');

$idYCSX = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($idYCSX)) {
    echo "Không có ID yêu cầu !";
    exit();
}

$kho = new quanlikho();
$conn = $kho->connect();

// === Lấy thông tin chung của yêu cầu xuất sản phẩm ===
$sqlThongTin = "SELECT idYeuCauSXSP,ngayYeuCau from yeucausanxuatsanpham
                WHERE idYeuCauSXSP = ?";
$stmt = $conn->prepare($sqlThongTin);
$stmt->bind_param("i", $idYCSX);
$stmt->execute();
$stmt->bind_result($maYC, $ngayYC);
$stmt->fetch();
$thongTin = array(
    'idYeuCauSXSP' => $maYC,
    'ngayYeuCau' => $ngayYC,
);
$stmt->close();

// === Lấy danh sách chi tiết sản phẩm xuất ===
$sqlChiTiet = "SELECT ctx.maSP,sp.tensanPham, ctx.soLuongSX,sp.donViTinh,sp.donGia
               FROM chitietyeucausanxuatsanpham ctx
               JOIN sanpham sp ON ctx.maSP = sp.maSP
               WHERE ctx.idYeuCauSXSP = ?";
$stmt2 = $conn->prepare($sqlChiTiet);
$stmt2->bind_param("i", $idYCSX);

$stmt2->execute();
$stmt2->bind_result($maSP,$tenSP, $soLuong,$donViTinh,$donGia);
$chiTietSP = array();

while ($stmt2->fetch()) {
    $chiTietSP[] = array(
        'maSP'=>$maSP,
        'tensanPham' => $tenSP,
        'soLuongSX' => $soLuong,
        'donViTinh'=>$donViTinh,
        'donGia'=>$donGia
    );
}
$stmt2->close();
?>
