<?php
class docapi{
	private function docjson($url){
		$client=curl_init($url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		$response=curl_exec($client);
		$results=json_decode($response);
		return $results;
    }
public function xemdsyeucauxuatsp($url){
        $results=$this->docjson($url);

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
            foreach($results as $data){
            
                
                echo '<tr onclick="window.location=\'chitietyeucauxuatsanpham.php?id='.$data->idYeuCauXuatSP.'\'" style="cursor:pointer;">
                        <td>'.$dem.'</td>
                        <td>YCXSP'.$data->idYeuCauXuatSP.'</td>
                        <td>'.$data->tenKhachHang.'</td>
                        <td>'.$data->ngayYeuCau.'</td>
                        <td>'.$data->trangThai.'</td>
                      </tr>';
    
                $dem++;
                
            }
            echo '</tbody>
                </table>';
            
        }
    }
?>