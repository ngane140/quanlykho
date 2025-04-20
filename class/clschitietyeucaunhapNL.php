<?php
include('ketnoi.php');

$idYCNNL = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($idYCNNL)) {
    echo "Không có ID yêu cầu !";
    exit();
}

$kho = new quanlikho();
$conn = $kho->connect();

// === Lấy thông tin chung của yêu cầu xuất sản phẩm ===
$sqlThongTin = "SELECT idYeuCauNhapNL,ngayYeuCau from yeucaunhapnguyenlieu
                WHERE idYeuCauNhapNL = ?";
$stmt = $conn->prepare($sqlThongTin);
$stmt->bind_param("i", $idYCNNL);
$stmt->execute();
$stmt->bind_result($maYC, $ngayYC);
$stmt->fetch();
$thongTin = array(
    'idYeuCauNhapNL' => $maYC,
    'ngayYeuCau' => $ngayYC,
);
$stmt->close();

// === Lấy danh sách chi tiết sản phẩm xuất ===
$sqlChiTiet = "SELECT ctx.maNL,nl.tenNguyenLieu, ctx.soLuongNhap,nl.donViTinh,nl.donGia
               FROM chitietyecaunhapnguyenlieu ctx
               JOIN nguyenlieu nl ON ctx.maNL = nl.maNL
               WHERE ctx.idYeuCauNhapNL = ?";
$stmt2 = $conn->prepare($sqlChiTiet);
$stmt2->bind_param("i", $idYCNNL);

$stmt2->execute();
$stmt2->bind_result($maNL,$tenNL, $soLuong,$donViTinh,$donGia);
$chiTietSP = array();

while ($stmt2->fetch()) {
    $chiTietSP[] = array(
        'maNL'=>$maNL,
        'tenNguyenLieu' => $tenNL,
        'soLuongNhap' => $soLuong,
        'donViTinh'=>$donViTinh,
        'donGia'=>$donGia
    );
}
$stmt2->close();
?>
