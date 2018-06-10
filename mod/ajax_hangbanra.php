<?php
include("../config.php");
include("../check_access.php");

function hangbantheongay($date){

						$newarray = array();
						$newarray = "";
						$tonghangxuat = 0;
						$a = mysql_query("select * from donhang where thoigian between '{$date} 00:00:00' and '{$date} 23:59:59'");
						while($b = mysql_fetch_array($a))
						{
							$sanpham = $b['sanpham'];

							
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												if(isset($newarray[$key]) or $newarray[$key] != 0)
												{
													$oldval = $newarray[$key];
													$newval = $oldval + $value;
													$newarray[$key] = $newval;
												
												}
												else	
												$newarray[$key] = $value;
												$tonghangxuat += $value;
											
												
											}

						
						
						}
							arsort($newarray);
						if($newarray != "")
						{
						
						echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>Tổng Hàng : {$tonghangxuat} cái</p>
										<hr />
								";
						foreach ($newarray as $key => $value) {
							$xuly_a = getNameProduct($key);
							echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>{$xuly_a} : {$value} cái</p>
										<hr />
								";
						}		
						}
											
}
function xemtheongay($from,$to){

						$newarray = array();
						$newarray = "";
						$tonghangxuat = 0;
						$a = mysql_query("select * from donhang where thoigian between '{$from} 00:00:00' and '{$to} 23:59:59'");
						while($b = mysql_fetch_array($a))
						{
							$sanpham = $b['sanpham'];

							
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												if(isset($newarray[$key]) or $newarray[$key] != 0)
												{
													$oldval = $newarray[$key];
													$newval = $oldval + $value;
													$newarray[$key] = $newval;
												
												}
												else	
												$newarray[$key] = $value;
												$tonghangxuat += $value;
											
												
											}

						
						
						}
							arsort($newarray);
						if($newarray != "")
						{
						
						echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>Tổng Hàng : {$tonghangxuat} cái</p>
										<hr />
								";
						foreach ($newarray as $key => $value) {
							$xuly_a = getNameProduct($key);
							echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>{$xuly_a} : {$value} cái</p>
										<hr />
								";
						}		
						}
											
}
if(isset($_POST['xemthongke']))
{
	if($_POST['xemthongke'] =="homnay")
	{
		$date = date("Y-m-d");
		$result = hangbantheongay($date);
	}
	if($_POST['xemthongke'] =="homqua")
	{
		$time = time();
		$time = $time - (60*60*24);
		$date = date("Y-m-d",$time);
		$result = hangbantheongay($date);
	}
		if($_POST['xemthongke'] =="thangnay")
	{
		$month = date("Y-m");
		$from = $month."-1";
		$to = date("Y-m-d");
		$result = xemtheongay($from,$to);
	}	
}
if(isset($_POST['tungay']) && isset($_POST['denngay']))
{
	$time = time();
	$month = date("Y-m");
if($_POST['tungay'] =="")
	$from = $month."-1";
else
{
	$from = $_POST['tungay'];
	$tungay = CreatFromDate($from);
	
}
if($_POST['denngay'] =="")
{
	$denngay = date("Y-m-d");
	$denngay = $denngay." 23:59:59";
	
}
else
{
	$to = $_POST['denngay'];
	$denngay = CreatToDate($to);
	
}
$result = xemtheongay($tungay,$denngay);
echo $tungay."-".$denngay;
}






?>
<?php
if($quyenhan['mod'] != "1")
echo "<script>
swal({
  title: 'Bạn không có quyền truy cập trang này',
  type: 'warning',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Thoát Ra'
}).then(function () {
  window.location = \"{$site_url}/template/errors.php\"
})
  
</script>";
?>	