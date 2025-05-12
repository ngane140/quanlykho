<?php
session_start(); // Đảm bảo session được khởi tạo
include('ketnoi.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$kho = new quanlikho();
$conn = $kho->connect();
// $idNguoiDung = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['idNguoiDung']) ? (int)$_POST['idNguoiDung'] : 0);

// if ($idNguoiDung <= 0) {
//     echo "Không có id người dùng nha!";
//     exit();
// }
$idNguoiDung = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : 0;
if (empty($idNguoiDung)) {
    echo "Không có id người dùng nha!";
    exit();
}


// Lấy mã yêu cầu tiếp theo
$sql = "SELECT MAX(idYeuCauXuatNL) as maxID FROM yeucauxuatnguyenlieu";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$nextID = $row['maxID'] + 1;
$maYC = "YCXNL" . str_pad($nextID, 2, '0', STR_PAD_LEFT);
$ngayTao = date("Y-m-d H:i:s");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Lấy danh sách sản phẩm từ chuỗi JSON
    $products = json_decode($_POST['products'], true);
    if (!is_array($products) || empty($products)) {
        echo "Dữ liệu Nguyên liệu không hợp lệ!";
        exit;
    }

    // Thêm vào bảng yêu cầu
    $ngayYC = date("Y-m-d H:i:s");
    mysqli_query($conn, "INSERT INTO yeucauxuatnguyenlieu (ngayYeuCau, trangThai) VALUES ('$ngayYC', 0)");
    $idYC = mysqli_insert_id($conn);

    // Thêm chi tiết
    foreach ($products as $p) {
        $maNL = mysqli_real_escape_string($conn, $p['maNL']);
        $soLuong = intval($p['soLuong']);
        if ($soLuong <= 0 || empty($maNL)) {
            echo "Thông tin Nguyên Liệu không hợp lệ!";
            exit;
        }

        $sqlDetail = "INSERT INTO chitietyeucauxuatnguyenlieu (idYeuCauXuatNL, maNL, soLuongXuat) 
                      VALUES ($idYC, '$maNL', $soLuong)";
        if (!mysqli_query($conn, $sqlDetail)) {
            echo "Lỗi khi lưu chi tiết yêu cầu sản phẩm: " . mysqli_error($conn);
            exit;
        }
    }

    echo "success";
    exit;
}
