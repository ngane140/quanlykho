<?php
class docapi{
	private function docjson($url){
		$client=curl_init($url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
		$response=curl_exec($client);
		$results=json_decode($response);
		return $results;
	}
    public function xuatds($url){
        $results=$this->docjson($url);
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
            foreach($results as $data){
            
                echo '<tr onclick="window.location=\'chitietyeucauxuatnguyenlieu.php?id='.$data->idYeuCauXuatNL.'\'" style="cursor:pointer;">
                        <td>'.$dem.'</td>
                        <td>DXNNL'.$data->idYeuCauXuatNL.'</td>
                        <td>'.$data->ngayYeuCau.'</td>
                        <td>'.$data->trangThai.'</td>
                      </tr>';
    
                $dem++;
                
            }
            echo '</tbody>
                </table>
                </div>';
            
        }
    
    
}?>