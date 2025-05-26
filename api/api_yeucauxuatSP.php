<?php
require_once '../class/clsdsnhanyeucauxuatSP.php';
header('Content-Type: application/json');
$p = new qlykho();
$p->xuatds("select * from yeucauxuatsanpham ORDER BY trangThai ASC, ngayYeuCau DESC");
?>