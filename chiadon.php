<?php 
include("db.php");
$array_list_user = array();
$a = mysql_query("select id from user where groupid ='7'");
while($b = mysql_fetch_array($a))
{
	$array_list_user[$b['id']] = 0;	
}

$time = time();
$lastdaytime = $time - (60*60*24);
$lastday = date("Y-m-d",$lastdaytime);
$thismonth = date("Y-m");
//
foreach ($array_list_user as $id_nhanvien => $value) {
	$sql_count_bill = mysql_query("select count(madonhang) as total_bill from donhang where thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59' and carebill='{$id_nhanvien}'");
	$count_bill = mysql_fetch_array($sql_count_bill);
	$total_bill = $count_bill['total_bill'];
	$array_list_user[$id_nhanvien] = $total_bill;
}
arsort($array_list_user);
$key_max = key($array_list_user);
$maximum = $array_list_user[$key_max];
unset($mysql_fetch_array[$key_max]);
$last_key = count($array_list_user)-1;

///
$success = 0;
$error = 0;
$lan1 = mysql_query("select id from donhang where thoigian between '2018-05-01 00:00:00' and '2018-05-18 23:59:59' and carebill is null");
$total = mysql_num_rows($lan1);
$i = 0;
while($i <= $total)
{
	$sql_rand = mysql_query("select id from donhang where carebill IS NULL and thoigian between '2018-05-01 00:00:00' and '2018-05-18 23:59:59' order by RAND() limit 1");
	$rand = mysql_fetch_array($sql_rand);
	$id_donhang = $rand['id'];
	foreach ($array_list_user as $id_nhanvien => $value) {
		if($value < $maximum)
		{
			$do = mysql_query("update donhang set carebill = '{$id_nhanvien}' where id='{$id_donhang}'");
			$array_list_user[$id_nhanvien] = $value + 1;
			echo $id_nhanvien." - ".$array_list_user[$id_nhanvien]."<br />";
			break;
		}
		}
	$new_array = $array_list_user;
	rsort($new_array);
	if($new_array[$last_key] == $maximum) $maximum++;

	
	$i++;
	if($do) $success++;
	else $error++;
}
echo "Thanh cong : ".$success."<br />That bai : ".$error."<br />";
echo "Array Old : <br />";
print_r($array_list_user);
echo "<br />";
echo "Array New : <br />";
print_r($new_array);
echo "<br />";
echo "Maximum : ".$maximum."<br />";
echo "Last Key :".$last_key."<br />";
echo "Total Rows :".$total."<br />";
echo "Last Value : ".$new_array[$last_key];



?>