<?php
require_once '../class/clsdsnhanyeucauxuatNL.php';
header('Content-Type: application/json');
$p = new qlykho();
$p->xuatds("SELECT * FROM yeucauxuatnguyenlieu ORDER BY trangThai ASC, ngayYeuCau DESC");
?>