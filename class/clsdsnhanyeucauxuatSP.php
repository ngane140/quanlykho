<?php
class qlykho{
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

    public function laycot($sql)
	{
		$link=$this->connect();
		$ketqua = mysql_query($sql, $link);
		$i=mysql_num_rows($ketqua);
		$trave='';
		if($i>0)
		{
			while($row=mysql_fetch_array($ketqua))
			{
				$gt=$row[0];
				$trave=$gt;
			}
		}
		return $trave;
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

    public function xemdsyeucauxuatsp($sql){
        $link=$this->connect();
        $ketqua = mysql_query($sql, $link);
        $i=mysql_num_rows($ketqua);
        if($i>0)
        {
            echo '<table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã yêu cầu</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày yêu cầu</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>';
            $dem=1;
            while($row=mysql_fetch_array($ketqua))
            {
                $idYeuCauXuatSP=$row['idYeuCauXuatSP'];    
                $idKhachHang=$row['idKhachHang'];
                $tenKhachHang = $this->laycot("select hoTen from khachhang kh join yeucauxuatsanpham ycxsp on kh.idKhachHang=ycxsp.idKhachHang where kh.idKhachHang = '$idKhachHang'");
                $ngayYeuCau=$row['ngayYeuCau'];
                $trangThai=$row['trangThai'];
            
                if ($trangThai == 0) {
                    $trangThaiText = "Chờ xử lý";
                } else if($trangThai == 1) {
                    $trangThaiText = "Chờ sản xuất";
                }
                else if($trangThai == 2) {
                    $trangThaiText = "Đã duyệt";
                }
                else {
                    $trangThaiText = "Từ chối";
                }
                
                echo '<tr onclick="window.location=\'chitietyeucauxuatsanpham.php?id='.$idYeuCauXuatSP.'\'" style="cursor:pointer;">
                        <td>'.$dem.'</td>
                        <td>'.$idYeuCauXuatSP.'</td>
                        <td>'.$tenKhachHang.'</td>
                        <td>'.$ngayYeuCau.'</td>
                        <td>'.$trangThaiText.'</td>
                      </tr>';
    
                $dem++;
                
            }
            echo '</tbody>
                </table>';
            
        }
        else
        {
            echo 'Không có dữ liệu';
        }
    
    }

    public function chitietsanpham($sql){
        $link=$this->connect();
		$ketqua = mysql_query($sql,$link);
		$i=mysql_num_rows($ketqua);

		if($i>0)
		{
			$dem=1;
			while($row=mysql_fetch_array($ketqua))
			{
                $maSP = $row['maSP'];
                $laytenSP= $this->laycot("select tensanPham from sanpham sp join chitietyeucauxuatsanpham ct on sp.maSP = ct.maSP where ct.maSP = '$maSP' ");
                $laysoluongSP= $this->laycot("select soLuongXuat from chitietyeucauxuatsanpham where maSP='$maSP'");
                echo ''.$laytenSP.' x số lượng: '.$laysoluongSP.' <br>';
				
			}   
		}
		else
		{
			echo 'Khong co du lieu';
		}
    }
}
?>
