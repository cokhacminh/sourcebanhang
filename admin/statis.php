<?php
include("../config.php");
include("../check_access.php");
$homnay = date("Y-m-d");
$thangnay = date("Y-m");
$dauthang = $thangnay."-01";
//
$monthofyear = date("m");
$year = date("Y");
if($monthofyear =="1")
{
	$lastyear = $year - 1;
	$lastmonth = $lastyear."-12";
}
elseif($monthofyear != "1")
{
	$lastmonthofyear = $monthofyear - 1;
	$lastmonth = $year."-".$lastmonthofyear;
}
//
$time = time();
$timeoflastday = $time - (60*60*24);
$lastday = date("Y-m-d",$timeoflastday);
//Thống kê hôm nay Tổng CTY
$a = mysql_query("select id from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59'");
$tongdon_homnay = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59'");
$data_homnay = mysql_fetch_array($a);
$doanhthu_homnay = $data_homnay['doanhthu'];
//Thống kê hôm nay SG
$a = mysql_query("select id from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59' and id_nhanvien in ( select id from user where chinhanh='Sài Gòn')");
$tongdon_homnay_sg = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59'and id_nhanvien in ( select id from user where chinhanh='Sài Gòn')");
$data_homqua = mysql_fetch_array($a);
$doanhthu_homnay_sg = $data_homqua['doanhthu'];
//Thống kê hôm nay NT
$a = mysql_query("select id from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59' and id_nhanvien in ( select id from user where chinhanh='Nha Trang')");
$tongdon_homnay_nt = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59'and id_nhanvien in ( select id from user where chinhanh='Nha Trang')");
$data_homqua = mysql_fetch_array($a);
$doanhthu_homnay_nt = $data_homqua['doanhthu'];
//Thống kê hôm qua
$a = mysql_query("select id from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59'");
$tongdon_homqua = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59'");
$data_homqua = mysql_fetch_array($a);
$doanhthu_homqua = $data_homqua['doanhthu'];
//Thống kê hôm qua SG
$a = mysql_query("select id from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59' and id_nhanvien in ( select id from user where chinhanh='Sài Gòn')");
$tongdon_homqua_sg = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59'and id_nhanvien in ( select id from user where chinhanh='Sài Gòn')");
$data_homqua = mysql_fetch_array($a);
$doanhthu_homqua_sg = $data_homqua['doanhthu'];
//Thống kê hôm qua NT
$a = mysql_query("select id from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59' and id_nhanvien in ( select id from user where chinhanh='Nha Trang')");
$tongdon_homqua_nt = mysql_num_rows($a);
$a = mysql_query("select sum(tongtien) as doanhthu from donhang where thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59'and id_nhanvien in ( select id from user where chinhanh='Nha Trang')");
$data_homqua = mysql_fetch_array($a);
$doanhthu_homqua_nt = $data_homqua['doanhthu'];

//Thống kê tháng này
$a = mysql_query("select id from donhang where thoigian between '{$thangnay}-01 00:00:00' and '{$thangnay}-31 23:59:59'");
$tongdon_trongthang = mysql_num_rows($a);

$a = mysql_query("select count(id) as tongdonthatbai from donhang where thoigian between '{$thangnay}-01 00:00:00' and '{$thangnay}-31 23:59:59' and status_id in (-1,7,9,11)");
$tongdonthatbai_trongthang = mysql_fetch_array($a);
$tongdonthatbai_thangnay = $tongdonthatbai_trongthang['tongdonthatbai'];

$a = mysql_query("select sum(tongtien) as doanhthu,sum(cod) as doanhthuthucte from donhang where thoigian between '{$thangnay}-01 00:00:00' and '{$homnay} 23:59:59'");
$data_thangnay = mysql_fetch_array($a);
$doanhthu_thangnay = $data_thangnay['doanhthu'];
$doanhthuthucte_thangnay = $data_thangnay['doanhthuthucte'];
//Hàm xử lý top đơn hàng
function topdon($time_start,$time_end)
{
$html = "";
$topdon = "";
$sql_statisday = mysql_query("SELECT COUNT(madonhang) as tongdon,id_nhanvien FROM `donhang` WHERE thoigian BETWEEN '{$time_start} 00:00:00' and '{$time_end} 23:59:59' GROUP BY id_nhanvien ORDER BY tongdon desc");
while($statis_today = mysql_fetch_array($sql_statisday))
{
	$userid = $statis_today['id_nhanvien'];
	$tongdon = $statis_today['tongdon'];
	$tennhanvien = getname($userid);
	$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$tennhanvien}</td><td><font color='red'>{$tongdon} </font>đơn</td></tr>";
}
	$topdon = "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";
	return $topdon;

}
//Hàm xử lý top doanh số
function topdoanhso($time_start,$time_end)
{
$html = "";
$topdon = "";
$sql_statisday = mysql_query("SELECT COUNT(madonhang) as tongdon,id_nhanvien FROM `donhang` WHERE thoigian BETWEEN '{$time_start} 00:00:00' and '{$time_end} 23:59:59' GROUP BY id_nhanvien ORDER BY tongdon desc");
while($statis_today = mysql_fetch_array($sql_statisday))
{
	$userid = $statis_today['id_nhanvien'];
	$tongdon = $statis_today['tongdon'];
	$tennhanvien = getname($userid);
	$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$tennhanvien}</td><td><font color='red'>{$tongdon} </font>đơn</td></tr>";
}
	$topdon = "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";
	return $topdon;

}
//Hàm xử lý top doanh số thực thu
function topdoanhsothucthu($time_start,$time_end)
{
$html = "";
$topdon = "";
$sql_statisday = mysql_query("SELECT COUNT(madonhang) as tongdon,id_nhanvien FROM `donhang` WHERE thoigian BETWEEN '{$time_start} 00:00:00' and '{$time_end} 23:59:59' GROUP BY id_nhanvien ORDER BY tongdon desc");
while($statis_today = mysql_fetch_array($sql_statisday))
{
	$userid = $statis_today['id_nhanvien'];
	$tongdon = $statis_today['tongdon'];
	$tennhanvien = getname($userid);
	$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$tennhanvien}</td><td><font color='red'>{$tongdon} </font>đơn</td></tr>";
}
	$topdon = "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";
	return $topdon;

}

//Top đơn hàng
$topdonhang_homnay = topdon($homnay,$homnay);
$topdonhang_thangnay = topdon($dauthang,$homnay);
//
//Danh sách nhóm
$tongsanpham_theonhom = array("1"=>0,"7"=>0,"8"=>0);//1 -> Váy Đầm ; 7 -> Đồ bộ dài ; 8 -> Đồ bộ ngắn
function listteam($time)
{
	$html = "";
	$html_listteam = "";
	$sql_team = mysql_query("select id,ten from team");
	while($data_team = mysql_fetch_array($sql_team))
	{										
		$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td><button class='btn btn-sm btn-success' onclick=\"viewteam('{$time}-{$data_team['id']}')\">{$data_team['ten']}</button></td></tr>";
	}
		$html_listteam =  "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";  
		echo $html_listteam;
}
//Function tổng tiền hàng
function tongtienhang($thoigian)
{
$sql = mysql_query("select sanpham from donhang where thoigian between '{$thoigian} 00:00:00' and '{$thoigian} 23:59:59'");
while($kq = mysql_fetch_array($sql))
{
	$donhang = $kq['sanpham'];
	$tachdonhang = explode("|",$donhang);
	foreach($tachdonhang as $donhang)
	{
		$tachsanpham = explode("-",$donhang);
		$idsanpham = $tachsanpham[0];
		$soluong = $tachsanpham[1];
		$sql_find_nhomsanpham = mysql_query("select IDnhomsanpham from sanpham where id='{$idsanpham}'");
		$find_nhomsanpham = mysql_fetch_array($sql_find_nhomsanpham);
		$idnhomsanpham = $find_nhomsanpham['IDnhomsanpham'];
		$tongsanpham_theonhom[$idnhomsanpham] += $soluong;
	}
}
$soluongdam = $tongsanpham_theonhom[1];
$soluongdobodai = $tongsanpham_theonhom[7];
$soluongdobongan = $tongsanpham_theonhom[8];
$tienhang_dam = $soluongdam * 31000;
$tienhang_dobodai = $soluongdobodai * 61000;
$tienhang_dobongan = $soluongdobongan * 41000;
$tienhang_homnay = $tienhang_dam + $tienhang_dobodai + $tienhang_dobongan;
return $tienhang_homnay;
}

//Function giá trị hàng bán ra

?>