<?php
require_once("function.php");

//Danh sách đơn hàng thành công
function danhsachticket($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from ticket where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59'");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from ticket where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and id_nhanvien = '{$id_nhanvien}'");

$array = array();
while($do = mysql_fetch_array($sql))
{
	$id_donhang = $do['id_donhang'];
	$madonhang = laymadonhang($id_donhang);
	$nguoiyeucau = getname($do['id_nhanvien']);
	$thoigian = $do['thoigian'];
	$yeucau = $do['ghichu'];
	$trangthai = $do['trangthai'];
	$smod = $do['smod'];
	$nguoixuly = getname($smod);
	if($trangthai == "Đã Xử Lý" && $smod !="")
	$button = "Người xử lý <br/><font color='red'><b>".$nguoixuly."</b></font>";
	elseif($trangthai =="Chưa Xử Lý" && !isset($quyenhan['smod']))
	$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\">{$trangthai}</a>";
	elseif($trangthai =="Chưa Xử Lý" && $quyenhan['smod'] =="1") 
	$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onlick=\"xuly($id_donhang)\">Xử Lý</a>";
	

$array[] = array("thoigian"=>$thoigian,"madonhang"=>$madonhang,"nguoiyeucau"=>$nguoiyeucau,"yeucau"=>$yeucau,"tinhtrang"=>$button);
}
$result = json_encode($array);
return $result;	
}
						
?>