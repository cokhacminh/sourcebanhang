<?php
require_once("function.php");
$api_status_id = array(
"0"=>"Chưa tiếp nhận",
"-1"=>"Đã Hủy",
"1"=>"Chưa tiếp nhận",
"2"=>"Đã tiếp nhận",
"3"=>"Đã lấy hàng/Đã nhập kho",
"4"=>"Đã điều phối giao hàng/Đang giao hàng",
"5"=>"Đã giao hàng/Chưa đối soát",
"6"=>"Đã Đối Soát",
"7"=>"Không lấy được hàng",
"8"=>"Hoãn lấy hàng",
"9"=>"Không giao được hàng",
"10"=>"Delay giao hàng",
"11"=>"Đã đối soát trả hàng",
"12"=>"Đang lấy hàng",
"20"=>"Đang trả hàng",
"21"=>"Đã trả hàng",
"123"=>"Shipper báo đã lấy hàng",
"127"=>"Shipber báo không lấy được hàng",
"128"=>"Shiper báo delay lấy hàng",
"45"=>"Shiper báo đã giao hàng",
"49"=>"Shiper báo không giao được hàng",
"410"=>"Shiper báo delay giao hàng",
"99"=>"SHOP HUỶ"
);
function danhsachdonhang($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59'");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and id_nhanvien in (select id from user where team_id = '{$teamID}')");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and id_nhanvien = '{$id_nhanvien}'");
$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$phiship = $do['phiship'];
$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$goihang = $do['goihang'];
$ghtk = $do['ghtk'];
$page = $do['page'];
$status_id = $do['status_id'];
$tongtien = number_format($do['tongtien']);
$tamung = $do['tamung'];
$smod_check_tamung = $do['smod'];
$ten_smod_check_tamung = getname($smod_check_tamung);
$trangthaiapi = $api_status_id[$status_id];

if($quyenhan['smod'] =="1")
{
	//Button Gói Hàng	
	if($do['goihang'] ==0)$button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default'>Chưa gói hàng</a><br />";
	else $button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-success'>Đã gói hàng</a><br />";
	//Button Trạng Thái Đơn Hàng
	if($ghtk =="")
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default' onclick='api_id({$id})'>Đăng API</a><br />";
	else
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-primary' onclick='info_ghtk({$id})'>{$trangthaiapi}</a><br />";
	//Button Chỉnh Sửa / Xoá / Huỷ
	if($ghtk =="")
		$button3 = "<a data-toggle=\"modal\" data-target=\"#Form_edit_donhang\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-success\" onclick=\"suadonhang('{$id}')\"> Sửa</a><a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhang({$id})'>Xóa</a>";
	elseif($ghtk !="" and $goihang =="0") $button3 = "<a data-toggle=\"modal\" data-target=\"#Form_edit_donhang\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-success\" onclick=\"suadonhang('{$id}')\"> Sửa</a><a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhangapi({$id})'>Xóa Đơn</a>";
	elseif($ghtk !="" and $goihang =="1") $button3 = "<a data-toggle=\"modal\" data-target=\"#Form_edit_donhang\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-success\" onclick=\"suadonhang('{$id}')\"> Sửa</a><a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='huydonhang({$id})'>Huỷ Đơn</a>";
	$button = $button1.$button2.$button3;
	//Button Tạm Ứng
	if($tamung !=0)
	{
		if($smod_check_tamung == 0)
			$button_tamung = "<a data-toggle=\"modal\" data-target=\"#Form_khachung\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-danger\" onclick=\"xacnhanung('{$id}')\"> Xác Nhận</a>";
		else
			$button_tamung = "Nguời xác nhận : <b><font color=\"red\">".$ten_smod_check_tamung."</font></b>";	
	}
	else
		$button_tamung = "";

}
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
{
	//Button Gói Hàng	
	if($do['goihang'] ==0)$button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default'>Chưa gói hàng</a><br />";
	else $button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-success'>Đã gói hàng</a><br />";
	//Button Trạng Thái Đơn Hàng
	if($ghtk =="")
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default' onclick='api_id({$id})'>Đăng API</a><br />";
	else
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-primary' onclick='info_ghtk({$id})'>{$trangthaiapi}</a><br />";
	//Button Chỉnh Sửa / Xoá / Huỷ
	if($ghtk =="")
		$button3 = "<a data-toggle=\"modal\" data-target=\"#Form_edit_donhang\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-success\" onclick=\"suadonhang('{$id}')\"> Sửa</a><a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhang({$id})'>Xóa</a>";
	elseif($ghtk !="" and $goihang =="0") $button3 = "<a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhangapi({$id})'>Xóa Đơn</a>";
	$button = $button1.$button2.$button3;	
	//Button Tạm Ứng
	if($tamung !=0)
	{
		if($smod_check_tamung == 0)
			$button_tamung = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default'>CHƯA DUYỆT</a>";
		else
			$button_tamung = "Nguời xác nhận : <b><font color=\"red\">".$ten_smod_check_tamung."</font></b>";	
	}
	else
		$button_tamung = "";
	
	
}
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
{
	//Button Gói Hàng	
	if($do['goihang'] ==0)$button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default'>Chưa gói hàng</a><br />";
	else $button1 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-success'>Đã gói hàng</a><br />";
	//Button Trạng Thái Đơn Hàng
	if($ghtk =="")
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default' onclick='api_id({$id})'>Đăng API</a><br />";
	else
		$button2 = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-primary' onclick='info_ghtk({$id})'>{$trangthaiapi}</a><br />";
	//Button Chỉnh Sửa / Xoá / Huỷ
	if($ghtk =="")
		$button3 = "<a data-toggle=\"modal\" data-target=\"#Form_edit_donhang\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-success\" onclick=\"suadonhang('{$id}')\"> Sửa</a><a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhang({$id})'>Xóa</a>";
	elseif($ghtk !="" and $goihang =="0") $button3 = "<a href='#' class='hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger' onclick='xoadonhangapi({$id})'>Xóa Đơn</a>";
	$button4 = "<br><a data-toggle=\"modal\" data-target=\"#Form_guihotro\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-sm btn-warning\" onclick=\"sendticket('{$id}')\"> YÊU CẦU HỖ TRỢ</a>";
	$button = $button1.$button2.$button3.$button4;
	//Button Tạm Ứng
	if($tamung !=0)
	{
		if($smod_check_tamung == 0)
			$button_tamung = "<a class='mb-xs mt-xs mr-xs btn btn-sm btn-default'>CHƯA DUYỆT</a>";
		else
			$button_tamung = "Nguời xác nhận : <b><font color=\"red\">".$ten_smod_check_tamung."</font></b>";	
	}
	else
		$button_tamung = "";
		
}

if($tamung == 0)
$khachungtruoc = "";
else
$khachungtruoc = "Khách ứng : <b><font color=\"red\">".number_format($tamung)."</font></b>";
$tongtien .= "<br />".$khachungtruoc."<br />".$button_tamung;
$ghichu = $do['ghichu'];
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b><font color='red'>{$ghtk}</font></b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"page"=>$page,"ghichu"=>$ghichu,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}
//Danh sách đơn hàng thành công
function danhsachdonhang_thanhcong($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,6)");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,6) and id_nhanvien in (select id from user where team_id = '{$teamID}')");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,6) and id_nhanvien = '{$id_nhanvien}'");

$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$shipcod = $do['shipcod'];
$cod = $do['cod'];
$doanhso = $cod - $shipcod;
$doisoat = "<div style='text-align:right;font-size:15px;'>Thu hộ : ".number_format($cod)."<br />"."Phí ship : ".number_format($shipcod)."<br />"."<b>Doanh số : ".number_format($doanhso)."</b></div>";
$tongtien = number_format($do['tongtien']);
$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$ghtk = $do['ghtk'];
$status_id = $do['status_id'];
$trangthaiapi = $api_status_id[$status_id];
//Button Gói Hàng
$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk('{$ghtk}')\">{$trangthaiapi}</a>";
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b>{$ghtk}</b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"doisoat"=>$doisoat,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}
//Danh sách đơn hàng thất bại
function danhsachdonhang_thatbai($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (-1,7,9,11,21,127,49)");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (-1,7,9,11,21,127,49) and id_nhanvien in (select id from user where team_id = '{$teamID}')");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (-1,7,9,11,21,127,49) and id_nhanvien = '{$id_nhanvien}'");
$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$shipcod = $do['shipcod'];
if($shipcod == 0)$shipcod = "Chưa Đối Soát";
else $shipcod = number_format($shipcod);
$doisoat = "<b>".$shipcod."</b>";
$tongtien = number_format($do['tongtien']);
$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$ghtk = $do['ghtk'];
$status_id = $do['status_id'];
$trangthaiapi = $api_status_id[$status_id];
//Button Gói Hàng
$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk('{$ghtk}')\">{$trangthaiapi}</a>";
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b>{$ghtk}</b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"doisoat"=>$doisoat,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}
//Danh sách đơn hàng chờ đối soát
function danhsachdonhang_chodoisoat($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,9)");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,9) and id_nhanvien in (select id from user where team_id = '{$teamID}')");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,9) and id_nhanvien = '{$id_nhanvien}'");
$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$shipcod = $do['shipcod'];
$cod = $do['cod'];
$doanhso = $cod - $shipcod;
$doisoat = "<b>".number_format($shipcod)."</b>";
$tongtien = number_format($do['tongtien']);

$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$ghtk = $do['ghtk'];
$status_id = $do['status_id'];
$trangthaiapi = $api_status_id[$status_id];
//Button Gói Hàng
$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk('{$ghtk}')\">{$trangthaiapi}</a>";
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b>{$ghtk}</b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"doisoat"=>$doisoat,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}

//Danh sách đơn hàng đang giao
function danhsachdonhang_danggiao($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id not in (5,6,9,11,99,-1)");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id not in (5,6,9,11,99,-1) and id_nhanvien in (select id from user where team_id = '{$teamID}')");
if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and status_id in (5,6,9,11,99,-1) and id_nhanvien = '{$id_nhanvien}'");
$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$tongtien = number_format($do['tongtien']);
$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$ghtk = $do['ghtk'];
$page = $do['page'];
$ghichu = $do['ghichu'];
$status_id = $do['status_id'];
$trangthaiapi = $api_status_id[$status_id];
//Button Gói Hàng
$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk('{$ghtk}')\">{$trangthaiapi}</a>";
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b>{$ghtk}</b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"page"=>$page,"ghichu"=>$ghichu,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}
function danhsachdonhang_dangapi($fromtime,$totime){
	global $api_status_id;
	global $quyenhan;
	global $id_nhanvien;
	global $teamID;
if($quyenhan['smod']=="1")	
$sql = mysql_query("select * from donhang where ghtk = '' and ( thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' )");
elseif(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && $quyenhan['mod'] =="1")
{
$sql = mysql_query("select * from donhang where ghtk = '' and ( thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' ) and id_nhanvien in (select id from user where team_id = '{$teamID}')");

}	

if(($quyenhan['smod']=="0" or $quyenhan['smod'] == "") && ($quyenhan['mod'] =="0" or $quyenhan['mod'] =="") && $quyenhan['banhang'] =="1")	
$sql = mysql_query("select * from donhang where ghtk = '' and ( thoigian between '{$fromtime} 00:00:00' and '{$totime} 23:59:59' and id_nhanvien = '{$id_nhanvien}')");

$array = array();
while($do = mysql_fetch_array($sql))
{
	$id = $do['id'];
	$madonhang = $do['madonhang'];
	$tenkhachhang = $do['khachhang'];
	$nhanvien = $do['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$diachi = $do['diachi'];
	$sdt = $do['sdt'];
	$khachhang = "<div style='text-align:left;font-size:15px;'>Tên : ".$tenkhachhang."<br />"."Đ/c :".$diachi."<br />"."SDT : <b><font color='red' size='4'>".$sdt."</font></b></div>";
	$showdonhang = "";
	$donhang = $do['donhang'];
	$tachdonhang = explode("|", $donhang);
	foreach ($tachdonhang as $value) {
	$showdonhang.=$value."<br />";
	}
$phiship = $do['phiship'];
$tongtien = number_format($do['tongtien']);
$thoigian = $do['thoigian'];
$time = strtotime($thoigian);
$ngaygio = date("d/m/Y H:i:s",$time);
$goihang = $do['goihang'];
$ghtk = $do['ghtk'];
$page = $do['page'];
$status_id = $do['status_id'];
$trangthaiapi = $api_status_id[$status_id];
//Button Gói Hàng
$button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" onclick=\"api_id({$id})\">Đăng GHTK</a>";
$ghichu = $do['ghichu'];
$array[] = array("ngaygio"=>$ngaygio,"madonhang"=>"{$madonhang}<br /><b><font color='red'>{$ghtk}</font></b>","nhanvien"=>$tennhanvien,"khachhang"=>$khachhang,"showdonhang"=>$showdonhang,"tongtien"=>$tongtien,"page"=>$page,"ghichu"=>$ghichu,"thaotac"=>$button);
}
$result = json_encode($array);
return $result;	
}									
?>