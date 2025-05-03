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
               WHERE ctx.idYeuCauNhapNL = ? GROUP BY maNL";
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

class nvkho{
    public function connect()
	{
		$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			echo 'Không kết nối được cơ sở dữ liệu';
			exit();	
		}
		else
		{
			mysql_select_db("qlkho",$con);
			mysql_query("SET NAMES UTF8",$con);
			return $con;	
		}
	}
    public function themxoasua($sql){
		$link=$this->connect();
		if(mysql_query($sql,$link)){
			return 1;
		}
		else{
			return 0;
		}
	}
    public function laycot($sql, $trave_mang = false) {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        
        if(!$trave_mang) {
            // Trả về giá trị đơn như cũ
            if($i > 0) {
                $row = mysql_fetch_array($ketqua);
                return $row[0];
            }
            return '';
        } else {
            // Trả về mảng kết quả đầu tiên
            if($i > 0) {
                return mysql_fetch_assoc($ketqua);
            }
            return array();
        }
    }
    public function laydanhsach($sql) {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $danhsach = array();
        
        if(mysql_num_rows($ketqua) > 0) {
            while($row = mysql_fetch_assoc($ketqua)) {
                $danhsach[] = $row;
            }
        }
        
        return $danhsach;
    }
}
?>
