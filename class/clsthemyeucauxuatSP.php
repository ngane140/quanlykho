<?php
include('../class/ketnoi.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$kho = new quanlikho();
$conn = $kho->connect();
$idNguoiDung = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['idNguoiDung']) ? (int)$_POST['idNguoiDung'] : 0);

if ($idNguoiDung <= 0) {
    echo "Không có id người dùng nha!";
    exit();
}

// Lấy mã yêu cầu tiếp theo
$sql = "SELECT MAX(idYeuCauXuatSP) as maxID FROM yeucauxuatsanpham";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$nextID = $row['maxID'] + 1;
$maYC = "YCXSP" . str_pad($nextID, 2, '0', STR_PAD_LEFT);
$ngayTao = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tenKH = isset($_POST['tenKH']) ? $_POST['tenKH'] : '';
   

    // Kiểm tra khách hàng
    $khach = mysqli_query($conn, "SELECT idKhachHang FROM khachhang WHERE hoTen = '$tenKH'");
    if (!$khach || mysqli_num_rows($khach) == 0) {
        echo "Không tìm thấy khách hàng!";
        exit;
    }

    $row = mysqli_fetch_assoc($khach);
    $idKH = $row['idKhachHang'];

    // Lấy danh sách sản phẩm từ chuỗi JSON
    $products = json_decode($_POST['products'], true);
    if (!is_array($products) || empty($products)) {
        echo "Dữ liệu sản phẩm không hợp lệ!";
        exit;
    }

    // Thêm vào bảng yêu cầu
    $ngayYC = date("Y-m-d H:i:s");
    mysqli_query($conn, "INSERT INTO yeucauxuatsanpham (idKhachHang,ngayYeuCau, trangThai) VALUES ('$idKH','$ngayYC', 0)");
    $idYC = mysqli_insert_id($conn);

    // Thêm chi tiết
    foreach ($products as $p) {
        $maSP = mysqli_real_escape_string($conn, $p['maSP']);
        $soLuong = intval($p['soLuong']);
        if ($soLuong <= 0 || empty($maSP)) {
            echo "Thông tin sản phẩm không hợp lệ!";
            exit;
        }

        $sqlDetail = "INSERT INTO chitietyeucauxuatsanpham (idYeuCauXuatSP, maSP, soLuongXuat) 
                      VALUES ($idYC, '$maSP', $soLuong)";
        if (!mysqli_query($conn, $sqlDetail)) {
            echo "Lỗi khi lưu chi tiết yêu cầu sản phẩm: " . mysqli_error($conn);
            exit;
        }
    }

    echo "success";
    exit;
}
