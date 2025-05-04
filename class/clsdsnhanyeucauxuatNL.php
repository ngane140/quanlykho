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
    public function themxoasua($sql){
		$link=$this->connect();
		if(mysql_query($sql,$link)){
			return 1;
		}
		else{
			return 0;
		}
	}

    public function xemdsyeucauxuatnl($sql){
        $link=$this->connect();
        $ketqua = mysql_query($sql, $link);
        $i=mysql_num_rows($ketqua);
        if($i>0)
        {
            echo '<div class="scrollable-table">
            <table class="product-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã yêu cầu</th>
                    <th>Ngày yêu cầu</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>';
            $dem=1;
            while($row=mysql_fetch_array($ketqua))
            {
                $idYeuCauXuatnl=$row['idYeuCauXuatNL'];  
                $ngayYeuCau=$row['ngayYeuCau'];
                $trangThai=$row['trangThai'];
            
                if ($trangThai == 0) {
                    $trangThaiText = "Chờ xử lý";
                } else if($trangThai == 1) {
                    $trangThaiText = "Chờ nhập nguyên liệu";
                }
                else if($trangThai == 2) {
                    $trangThaiText = "Đã duyệt";
                }
                else {
                    $trangThaiText = "Từ chối";
                }
                
                echo '<tr onclick="window.location=\'chitietyeucauxuatnguyenlieu.php?id='.$idYeuCauXuatnl.'\'" style="cursor:pointer;">
                        <td>'.$dem.'</td>
                        <td>'.$idYeuCauXuatnl.'</td>
                        <td>'.$ngayYeuCau.'</td>
                        <td>'.$trangThaiText.'</td>
                      </tr>';
    
                $dem++;
                
            }
            echo '</tbody>
                </table>
                </div>';
            
        }
        else
        {
            echo 'Không có dữ liệu';
        }
    
    }

    public function chitietnguyenlieu($sql){
        $link=$this->connect();
		$ketqua = mysql_query($sql,$link);
		$i=mysql_num_rows($ketqua);

		if($i>0)
		{
			$dem=1;
            echo ' <table class="product-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã nguyên liệu</th>
                        <th>Tên nguyên liệu</th>
                        <th>Số lượng xuất</th>
                    </tr>
                </thead>
                <tbody>';
			while($row=mysql_fetch_array($ketqua))
			{
                
                $manl = $row['maNL'];
                $laytennl= $this->laycot("select tennguyenlieu from nguyenlieu nl join chitietyeucauxuatnguyenlieu ct on nl.manl = ct.manl where ct.manl = '$manl' ");
                $laysoluongnl= $row['soLuongXuat'];
            
                echo '<tr>
                        <td>'.$dem.'</td>
                        <td >'.$manl.'</td>
                        <td >'.$laytennl.'</td>
                        <td>'.$laysoluongnl.'</td>
                    </tr>';
				$dem++;

			}   
            echo '</tbody>
            </table>';
		}
		else
		{
			echo 'Khong co du lieu';
		}
    }
}
?>
