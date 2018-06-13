<?php
function tinhhoahong($calamviec,$chinhanh,$doanhthu)
{
	$hoahong_casang = array("150000000","220000000","310000000","375000000","560000000");
	$hoahong_catoi_saigon = array("95000000","130000000","190000000","230000000","350000000");
	$hoahong_catoi_nhatrang = array("85000000","120000000","175000000","210000000","315000000");
	$tile_hoahong = array("0.5","0.6","0.7","0.8","1","1.5");
	if($calamviec == "Ca Sáng")
	$hoahong = $hoahong_casang;
	elseif($calamviec == "Ca Tối" && $chinhanh =="Sài Gòn")
	$hoahong = $hoahong_catoi_saigon;
	elseif($calamviec == "Ca Tối" && $chinhanh =="Nha Trang")
	$hoahong = $hoahong_catoi_nhatrang;
	
	//Bậc 1
	if($doanhthu < $hoahong[0])
		 return $bachoahong = $tile_hoahong[0];
	//Bậc 2
	elseif($doanhthu >= $hoahong[0] && $doanhthu < $hoahong[1])
		return $bachoahong = $tile_hoahong[1];
	//Bậc 3
	elseif($doanhthu >= $hoahong[1] && $doanhthu < $hoahong[2])
		return $bachoahong = $tile_hoahong[2];
		//Bậc 4
	elseif($doanhthu >= $hoahong[2] && $doanhthu < $hoahong[3])
		return $bachoahong = $tile_hoahong[3];
		//Bậc 5
	elseif($doanhthu >= $hoahong[3] && $doanhthu < $hoahong[4])
		return $bachoahong = $tile_hoahong[4];
		//Bậc 6
	elseif($doanhthu >= $hoahong[4])
		return $bachoahong = $tile_hoahong[5];

}
function tinhluong($username,$month){

$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59')");
$tongdonhang_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and status_id in(5,6)");
$tongdonhangthanhcong_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59' and status_id in (-1,7,9,11))");
$tongdonhangthatbai_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and status_id not in (-1,5,6,7,9,11)");
$tongdonhangdanggiao_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select sum(tongtien) as doanhso,sum(cod) as doanhsothucte from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59')");
$data_thangnay = mysql_fetch_array($sql);
$doanhso_thangnay = $data_thangnay['doanhso'];
$doanhso_thucte = $data_thangnay['doanhsothucte'];
//
$donthatbai_dukien1 = round($tongdonhangdanggiao_thangnay * 30 / 100);
$donthatbai_dukien = $tongdonhangthatbai_thangnay + $donthatbai_dukien1;
//
$tilehoan = round($donthatbai_dukien1 / $tongdonhang_thangnay * 100);
//
$sql = mysql_query("select luongcung,calamviec,chinhanh from user where username='{$username}'");
$kq = mysql_fetch_array($sql);
$luongcung = $kq['luongcung'];
$calamviec = $kq['calamviec'];
$chinhanh = $kq['chinhanh'];
$bachoahong = tinhhoahong($calamviec,$chinhanh,$doanhso_thucte);
$hoahong = round($doanhso_thucte * $bachoahong / 100);
$phathoan = $tongdonhangthatbai_thangnay*5000;
}










?>