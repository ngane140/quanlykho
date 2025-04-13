<?php
class quanlikho
{
    private $host = 'localhost';
    private $username = 'root';  // Thay đổi tên người dùng nếu cần
    private $password = '';      // Thay đổi mật khẩu nếu cần
    private $database = 'qlkho'; // Thay đổi tên cơ sở dữ liệu

    public function connect()
    {
        // Tạo kết nối cơ sở dữ liệu
        $con = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($con->connect_error) {
            die('Không thể kết nối cơ sở dữ liệu: ' . $con->connect_error);
        }

        $con->set_charset("utf8"); // Thiết lập UTF-8
        return $con;
    }

    public function themxoasua($sql)
    {
        $link = $this->connect();
        if ($link->query($sql) === TRUE) {
            return 1; // Thêm thành công
        } else {
            return 0; // Có lỗi xảy ra
        }
    }
    public function laycot($sql)
    {
        $link = $this->connect();
        $result = $link->query($sql);
        $return = '';

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $return = $row[0]; // Lấy giá trị cột đầu tiên (có thể thay đổi tùy cột bạn cần)
            }
        }

        return $return;
    }

}
?>
