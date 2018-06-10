<?php
	function getname($userid){
        $sql = mysql_query("select fullname from user where id='{$userid}'");
        $data = mysql_fetch_array($sql);
        return $data['fullname'];
    }
$thang = date("m");
$nam = date("Y");
if($thang == "1")
{
	$lastyear = $nam - 1;
	$lastmonth = $nam."-12";
	$lastmonth_html = "12/".$nam;
}
else
{
	$thangtruoc = $thang - 1;
	$lastmonth = $nam."-".$thangtruoc;
	$lastmonth_html = $thangtruoc."/".$nam;
}

$homnay = date("Y-m-d");
$thangnay = date("Y-m");
$dauthang = $thangnay."-01";
//Danh sách nhân viên và tổng nhân viên
$a = mysql_query("select * from user where groupid !=3 ");
$array_list_nhanvien = mysql_fetch_array($a);
$tongnhanvien = mysql_num_rows($a);
//Tổng đơn hàng trong ngày

$a = mysql_query("select id from donhang where (thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59')");
$tongdon_homnay = mysql_num_rows($a);
$b = mysql_query("select id from donhang where ghtk='' and  (thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59')");
$tongdon_homnay_uncheck = mysql_num_rows($b);
//Tổng đơn hàng trong tháng
$a = mysql_query("select id from donhang where (thoigian between '{$thangnay}-01 00:00:00' and '{$thangnay}-31 23:59:59')");
$tongdon_trongthang = mysql_num_rows($a);
$b = mysql_query("select id from donhang where (thoigian between '{$thangnay}-01 00:00:00' and '{$thangnay}-31 23:59:59')");
$tongdon_trongthang_uncheck = mysql_num_rows($b);

//Tổng Doanh Thu ngày
$sql_tongdoanhthu = mysql_query("select sum(tongtien) as tongdoanhthu from donhang where thoigian between '{$homnay} 00:00:00' and '{$homnay} 23:59:59'");	
$data_tongdoanhthu = mysql_fetch_array($sql_tongdoanhthu);
$tongdoanhthu = $data_tongdoanhthu['tongdoanhthu'];
//Tổng doanh thu tháng
$sql_tongdoanhthu_thang = mysql_query("select sum(tongtien) as tongdoanhthu from donhang where thoigian between '{$thangnay}-01 00:00:00' and '{$thangnay}-31 23:59:59'");	
$data_tongdoanhthu_thang = mysql_fetch_array($sql_tongdoanhthu_thang);
$tongdoanhthu_thang = $data_tongdoanhthu_thang['tongdoanhthu'];
//Tổng doanh thu thực thu tháng
$sql_tongdoanhthuthucthu_thang = mysql_query("select sum(cod) as tongdoanhthu from donhang where thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59'");	
$data_tongdoanhthuthucthu_thang = mysql_fetch_array($sql_tongdoanhthuthucthu_thang);
$tongdoanhthuthucthu_thang = $data_tongdoanhthuthucthu_thang['tongdoanhthu'];
//Top ngày
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
$topdonhang_homnay = topdon($homnay,$homnay);
$topdonhang_thangnay = topdon($dauthang,$homnay);
?>
	