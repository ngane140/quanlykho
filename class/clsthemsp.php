<?php
session_start();
include("ketnoi.php");

$id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : ''; 


if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); 
}
// Hàm lấy mã sản phẩm mới
function getNewProductCode() {
    $kho = new quanlikho();
    $conn = $kho->connect();

    if ($conn) {
        // Lấy mã sản phẩm cuối cùng
        $sql = "SELECT maSP FROM sanpham WHERE maSP LIKE 'SP%' ORDER BY maSP DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Lấy mã sản phẩm cuối cùng và tăng số lên
            $row = $result->fetch_assoc();
            $lastProductCode = $row['maSP'];
            $newId = intval(substr($lastProductCode, 2)) + 1; // Lấy phần số từ mã sản phẩm và tăng thêm 1
        } else {
            // Nếu chưa có mã sản phẩm nào, bắt đầu từ 1
            $newId = 1;
        }

        // Tạo mã sản phẩm mới
        $newProductCode = "SP" . str_pad($newId, 3, "0", STR_PAD_LEFT); // Đảm bảo mã có 3 chữ số

        return $newProductCode;
    } else {
        echo "Không thể kết nối cơ sở dữ liệu!";
        return null;
    }
}
$newProductCode = getNewProductCode();

// Biến để lưu thông báo lỗi
$errorMessage = '';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maSP = $newProductCode; // Sử dụng mã sản phẩm tự động tạo
    $tensanPham = $_POST['tensanPham'];
    $moTa = $_POST['moTa'];
    $donGia = $_POST['donGia'];
    $donViTinh = $_POST['donViTinh'];
    $soLuong = '0';
    $maQR = $_POST['maQR'];
    $trangThai = '0'; // Trạng thái sản phẩm
    $ngaySanXuat=$_POST['ngaySanXuat'];
    $HSDChoPhep=$_POST['HSDChoPhep'];

    // Kiểm tra nếu giá sản phẩm nhỏ hơn hoặc bằng 1000
    if ($donGia < 1000) {
        $errorMessage = 'Giá sản phẩm phải lớn hơn 1000!';
    } else {
        // Tạo đối tượng quản lý sản phẩm và gọi phương thức thêm sản phẩm
        $kho = new quanlikho();
        $conn = $kho->connect();

        if ($conn) {
            // Kiểm tra xem tên sản phẩm có bị trùng không
            $checkProduct = "SELECT * FROM sanpham WHERE tensanPham = '$tensanPham'";
            $checkProductResult = $conn->query($checkProduct);

            if ($checkProductResult->num_rows > 0) {
                $errorMessage = 'Tên sản phẩm đã tồn tại trong hệ thống!';
            } else {
                // Câu lệnh SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                $sql = "INSERT INTO sanpham (maSP, tensanPham, moTa, donGia, donViTinh, soLuong,  trangThai,HSDChoPhep) 
                        VALUES ('$maSP', '$tensanPham', '$moTa', '$donGia', '$donViTinh', '$soLuong', '$trangThai','$HSDChoPhep')";

                if ($conn->query($sql) === TRUE) {
                    $nguyenlieuArr = $_POST['nguyenlieu'];
                    $soLuongArr = $_POST['soLuongNL'];
                    $donViTinhArr = $_POST['donViTinhNL'];

                    for ($i = 0; $i < count($nguyenlieuArr); $i++) {
                        $maNL = $conn->real_escape_string($nguyenlieuArr[$i]);
                        $soLuong = floatval($soLuongArr[$i]);
                        $donViTinh = $conn->real_escape_string($donViTinhArr[$i]);

                        $insertNLSP = "INSERT INTO nguyenlieu_sanpham (maSP, maNL, donViTinh, soLuong)
                                    VALUES ('$maSP', '$maNL', '$donViTinh', '$soLuong')";
                        $conn->query($insertNLSP);
                    }

                    echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='theodoisp.php';</script>";
                } else {
                    $errorMessage = "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            $errorMessage = "Không thể kết nối cơ sở dữ liệu!";
        }
    }
}
?>
