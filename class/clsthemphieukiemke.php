<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('ketnoi.php');
$kho = new quanlikho();
$conn = $kho->connect();

// Bắt buộc phải có idNguoiDung
$idNguoiDung = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if ($idNguoiDung <= 0) {
    echo "Không có id người dùng!";
    exit(); // Dừng chương trình
}



// Lấy thông tin người dùng
$thongTinNguoiDung = null;
$sql = "SELECT nd.hoTen, l.tenLoaiNguoiDung 
        FROM nguoidung nd 
        JOIN loainguoidung l ON nd.idLoaiNguoiDung = l.idLoaiNguoiDung 
        WHERE nd.idNguoiDung = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idNguoiDung);
$stmt->execute();
$stmt->bind_result($hoTen, $chucVu);
if ($stmt->fetch()) {
    $thongTinNguoiDung = array('hoTen' => $hoTen, 'chucVu' => $chucVu);
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='dangnhap.php';</script>";
    exit();
}
$stmt->close();
// Tạo mã phiếu kiểm kê (chạy ngay khi trang mở)
$sqlMaPhieu = "SELECT COUNT(*) + 1 FROM phieukiemke";
$result = $conn->query($sqlMaPhieu);
$row = $result->fetch_row();
$maPhieu = "PKK" . $row[0];
// Xử lý form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ngayKiemKe = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO phieukiemke (maPhieu, ngayKiemKe, idNguoiDung) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $maPhieu, $ngayKiemKe, $idNguoiDung);
    $stmt->execute();
    $idPhieu = $stmt->insert_id;
    $stmt->close();
    if (!empty($_POST['maNL'])) {
        $uniqueCheck = array(); // để tránh lưu trùng maNL-ngayNhap

foreach ($_POST['maNL'] as $i => $maNL) {
    $slTon = (float)$_POST['soLuongTon'][$i];
    $slThucTe = (float)$_POST['soLuongThucTe'][$i];
    $ngayNhap = $_POST['ngayNhap'][$i];
    $chenhLech = $slThucTe - $slTon;

    $key = $maNL . '-' . $ngayNhap;

    if (!isset($uniqueCheck[$key])) {
        $stmt = $conn->prepare("INSERT INTO kiemke (idPhieuKiemKe, maNL, soLuongThucTe, soLuongChenhLech, soLuongKiemKe, ngayNhap) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isiiis", $idPhieu, $maNL, $slThucTe, $chenhLech, $slTon, $ngayNhap);
        if (!$stmt->execute()) {
            echo "Lỗi SQL: " . $stmt->error;
        }
        $stmt->close();
        // ✅ Cập nhật lại số lượng tồn thực tế của lô này
$stmtUpdate = $conn->prepare("UPDATE nguyenlieu SET soLuongTon = ? WHERE maNL = ? AND ngayNhap = ?");
$stmtUpdate->bind_param("dss", $slThucTe, $maNL, $ngayNhap);
if (!$stmtUpdate->execute()) {
    echo "Lỗi cập nhật tồn kho: " . $stmtUpdate->error;
}
$stmtUpdate->close();

        $uniqueCheck[$key] = true; // đã lưu rồi
    }
}

    }

    echo "<script>alert('Tạo phiếu kiểm kê thành công!'); window.location.href='dskiemke.php';</script>";
    exit;
}

// Lấy danh sách nguyên liệu và tính tổng tồn
$sql = "SELECT maNL, tenNguyenLieu, ngayNhap, soLuongTon 
        FROM nguyenlieu 
        ORDER BY maNL, ngayNhap";

$result = $conn->query($sql);
$nguyenLieus = array();
while ($row = $result->fetch_assoc()) {
    $nguyenLieus[] = array(
        'maNL' => $row['maNL'],
        'tenNguyenLieu' => $row['tenNguyenLieu'],
        'ngayNhap' => $row['ngayNhap'],
        'soLuongTon' => $row['soLuongTon']
    );
}

?>
