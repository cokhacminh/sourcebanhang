<?php
include("../function/function.php");
include("../check_access.php");

//////////////////////
if(isset($_POST['madonhang_hoanhang']))
{
	$logs = "";
	$today = date("Y-m-d");
	$date_insert = date("Y-m-d H:i:s");
	$madonhang = $_POST['madonhang_hoanhang'];
	$dobodai = $_POST['dobodai'];
	$vaydam = $_POST['vaydam'];
	$dobongan = $_POST['dobongan'];
	$sql = mysql_query("select madonhang,hoanhang from donhang where madonhang='{$madonhang}'");
	$kq = mysql_fetch_array($sql);
	$hoanhang = $kq['hoanhang'];
	if(!is_numeric($dobodai) or $dobodai <0 or !is_numeric($vaydam) or $vaydam <0 or !is_numeric($dobongan) or $dobongan <0)
	{
		echo "
	<script>
						swal({
						  title: 'CÓ LỖI !!',
						  html:
							'VUI LÒNG NHẬP CHÍNH XÁC SỐ LƯỢNG HÀNG HOÀN',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/hoanhang\")})
						</script>
";
	}
	else
	{
	if($hoanhang =="1")
	echo "
	<script>
						swal({
						  title: 'CÓ LỖI !!',
						  html:
							'{$madonhang} ĐÃ ĐƯỢC KIỂM HOÀN TỪ TRƯỚC',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/hoanhang\")})
						</script>
";
	elseif($hoanhang =="0")
	{
		$error = "";
		$finish = "";
		if($dobodai >0 )
		{
			$b = mysql_query("insert into hoanhang (nhanvien,thoigian,madonhang,soluong,sanpham) values ('{$fullname}','{$date_insert}','{$madonhang}','{$dobodai}','Đồ Bộ Dài')");
			if(!isset($b))
			$error .= "SQL Insert Đồ Bộ Dài hoàn {$dobodai} bộ bị lỗi ";
			$finish .= " Đồ Bộ Dài hoàn ".$dobodai." bộ <br/>";
		}
		if($vaydam >0 )
		{
			$b = mysql_query("insert into hoanhang (nhanvien,thoigian,madonhang,soluong,sanpham) values ('{$fullname}','{$date_insert}','{$madonhang}','{$vaydam}','Váy Đầm')");
			if(!isset($b))
			$error .= "SQL Insert Váy Đầm hoàn {$vaydam} bộ bị lỗi ";
			$finish .= " Váy Đầm hoàn ".$vaydam." bộ <br/>";
		}
		if($dobongan >0 )
		{
			$b = mysql_query("insert into hoanhang (nhanvien,thoigian,madonhang,soluong,sanpham) values ('{$fullname}','{$date_insert}','{$madonhang}','{$dobongan}','Đồ Bộ Ngắn')");
			if(!isset($b))
			$error .= "SQL Insert Đồ Bộ Ngắn hoàn {$dobongan} bộ bị lỗi ";
			$finish .= " Đồ Bộ Ngắn hoàn ".$dobongan." bộ <br/>";
		}
		$a = mysql_query("update donhang set hoanhang='1' where madonhang='{$madonhang}'");
		
		if(!isset($a))
			$error .= "SQL Cập nhật đơn hàng {$madonhang} bị lỗi";
		if($error =="")
		{
			echo "<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  html:
							'ĐÃ KIỂM HOÀN ĐƠN HÀNG {$madonhang} <br/>{$finish}',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/hoanhang\")})
						</script>";	
		}
		else
		{
				  $file_name = $today.".txt";
				  $dir_file = "admin/logs/xuatkho/".$file_name;
				  $text_date = date("H:i:s d-m-Y");
				  $file = fopen($dir_file,'a');
				  $text = $text_date." : ".$madonhang.$error."\n";
				  fwrite($file,$text);
				  fclose($file);
				  echo "<script>
						swal({
						  title: 'CÓ LỖI !!',
						  html:
							'{$madonhang} KIỂM HOÀN THẤT BẠI<br/>
								{$error}',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/hoanhang\")})
						</script>";
		}	
		
	}
	
	}
}
?>