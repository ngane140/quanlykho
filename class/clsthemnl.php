<?php
include("ketnoi.php");
// Lấy giá trị của tham số 'id' từ URL
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Nếu không có 'id', gán giá trị rỗng

// Kiểm tra nếu không có id, chuyển hướng hoặc thông báo lỗi
if (empty($id)) {
    echo "Không có id người dùng!";
    exit(); // Dừng thực thi chương trình
}

// Hàm lấy mã sản phẩm mới
function getNewMaterialCode() {
    $kho = new quanlikho();
    $conn = $kho->connect();

    if ($conn) {
        // Lấy mã sản phẩm cuối cùng
        $sql = "SELECT maNL FROM nguyenlieu WHERE maNL LIKE 'NL%' ORDER BY maNL DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Lấy mã sản phẩm cuối cùng và tăng số lên
            $row = $result->fetch_assoc();
            $lastMaterialCode = $row['maNL'];
            $newId = intval(substr($lastMaterialCode, 2)) + 1; // Lấy phần số từ mã sản phẩm và tăng thêm 1
        } else {
            // Nếu chưa có mã sản phẩm nào, bắt đầu từ 1
            $newId = 1;
        }

        // Tạo mã sản phẩm mới
        $NewMaterialCode = "NL" . str_pad($newId, 3, "0", STR_PAD_LEFT); // Đảm bảo mã có 3 chữ số

        return $NewMaterialCode;
    } else {
        echo "Không thể kết nối cơ sở dữ liệu!";
        return null;
    }
}
$NewMaterialCode = getNewMaterialCode();

// Biến để lưu thông báo lỗi
$errorMessage = '';

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maNL = $NewMaterialCode; // Sử dụng mã sản phẩm tự động tạo
    $tenNguyenLieu = $_POST['tenNguyenLieu'];
    $moTa = $_POST['moTa'];
    $donGia = $_POST['donGia'];
    $donViTinh = $_POST['donViTinh'];
    $soLuongTon = '0';
    $maQR = $_POST['maQR'];
    $trangThai = '0'; // Trạng thái sản phẩm
    $ngayNhap=$_POST['ngayNhap'];
    $HSDChoPhep=$_POST['HSDChoPhep'];

    // Kiểm tra nếu giá sản phẩm nhỏ hơn hoặc bằng 1000
    if ($donGia < 1000) {
        $errorMessage = 'Giá nguyên liệu phải lớn hơn 1000!';
    } else {
        // Tạo đối tượng quản lý sản phẩm và gọi phương thức thêm sản phẩm
        $kho = new quanlikho();
        $conn = $kho->connect();

        if ($conn) {
            // Kiểm tra xem tên sản phẩm có bị trùng không
            $checkMaterial = "SELECT * FROM nguyenlieu WHERE tenNguyenLieu = '$tenNguyenLieu'";
            $checkMaterialResult = $conn->query($checkMaterial);

            if ($checkMaterialResult->num_rows > 0) {
                $errorMessage = 'Tên sản phẩm đã tồn tại trong hệ thống!';
            } else {
                // Câu lệnh SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                $sql = "INSERT INTO nguyenlieu (maNL, tenNguyenLieu, moTa, donGia, donViTinh, soLuongTon,  trangThai,HSDChoPhep) 
                        VALUES ('$maNL', '$tenNguyenLieu', '$moTa', '$donGia', '$donViTinh', '$soLuongTon', '$trangThai','$HSDChoPhep')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Thêm nguyên liệu thành công!'); window.location.href='theodoiNL.php';</script>";
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
