<?php
include("../function/function.php");
include("../check_access.php");
if(isset($_POST['madonhang_xk']))
{
	$madonhang_xk = $_POST['madonhang_xk'];
	$a = mysql_query("SELECT * FROM `donhang` WHERE `ghtk` LIKE '%{$madonhang_xk}%'");
	$count = mysql_num_rows($a);
	if($count < 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_xk} không tồn tại trong hệ thống ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
	";
	elseif($count > 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_xk} bị trùng với đơn hàng khác ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
		";
	elseif ($count == 1) {
		$b = mysql_fetch_array($a);
		$check = $b['goihang'];
		if($check == 0)
	{
		$donhang = $b['sanpham'];
		$madonhang = $b['madonhang'];
		$tach = explode("|", $donhang);
		$html = "";
		$error = "";
		foreach($tach as $newarray)
		{
			$tach2 = explode("-", $newarray);
			$key = $tach2[0];
			$value = $tach2[1];
			$a = mysql_query("select masanpham,soluong from sanpham where id='{$key}'");
			$b = mysql_fetch_array($a);
			$masanpham = $b['masanpham'];
			$soluong = $b['soluong'];
			if($soluong < $value)
				$error .= $masanpham." đã hết hàng <br />"; 
			$html.=$masanpham." : ".$value." Cái <br />";
			
		}
		if($error =="")
		echo "
<script>
swal({
  title: '{$madonhang}',
   html:
    '{$html}',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Gói Hàng !!!',
  cancelButtonText: 'Để Xem Lại !!!'
}).then(function () {
	xuatkhohang('{$madonhang}');
  swal(
    'Hoàn Tất!',
    'Bạn đã xác nhận gói đơn hàng {$madonhang} .',
    'success'
  ).then(function () {
  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Kiểm tra kho hàng cho chắc chắn nhé',
      'error'
    )
  }
})
</script>
		";
	else
		echo "
						<script>
						swal({
						  title: '{$madonhang} LỖI !!',
						  html:
    '{$error}',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
						";
	}
	elseif($check == 1 )
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Đơn hàng {$madonhang_xk} đã được gói từ trước rồi',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
	";
	}

}
///////////////////////

if(isset($_POST['madonhang_hoandon']))
{
	$madonhang_hoandon = $_POST['madonhang_hoandon'];
	$a = mysql_query("SELECT * FROM `donhang` WHERE `ghtk` LIKE '%{$madonhang_hoandon}%'");
	$count = mysql_num_rows($a);
	if($count < 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_hoandon} không tồn tại trong hệ thống ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
	";
	elseif($count > 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_hoandon} bị trùng với đơn hàng khác ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
		";
	elseif ($count == 1) {
		$b = mysql_fetch_array($a);
		$check = $b['goihang'];
		if($check == 1)
	{
		$donhang = $b['sanpham'];
		$madonhang = $b['madonhang'];
		$tach = explode("|", $donhang);
		$html = "";
		$error = "";
		foreach($tach as $newarray)
		{
			$tach2 = explode("-", $newarray);
			$key = $tach2[0];
			$value = $tach2[1];
			$a = mysql_query("select masanpham,soluong from sanpham where id='{$key}'");
			$b = mysql_fetch_array($a);
			$masanpham = $b['masanpham'];
			$soluong = $b['soluong'];
			if($soluong < $value)
				$error .= $masanpham." đã hết hàng <br />"; 
			$html.=$masanpham." : ".$value." Cái <br />";
			
		}

		echo "
<script>
swal({
  title: '{$madonhang}',
   html:
    '{$html}',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Hoàn Đơn !!!',
  cancelButtonText: 'Để Xem Lại !!!'
}).then(function () {
	xuatkhohang('{$madonhang}');
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Kiểm tra kho hàng cho chắc chắn nhé',
      'error'
    )
  }
})
</script>
		";
}
	elseif($check == 1 )
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Đơn hàng {$madonhang_xk} đã được gói từ trước rồi',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>
	";
	}

}
//////////////////////
if(isset($_POST['madonhang_xuatkho']))
{
	$date = date("d-m-Y");
	$madonhang_xuatkho = $_POST['madonhang_xuatkho'];
	$sql_check = mysql_query("select goihang from donhang where madonhang='{$madonhang_xuatkho}'");
	$check = mysql_fetch_array($sql_check);
	$text="";
	if($check =="1")
	echo "<script>
						swal({
						  title: 'LỖI !!',
						  text: 'ĐƠN HÀNG ĐÃ ĐƯỢC GÓI',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>";
	else
	{
		$a = mysql_query("select sanpham from donhang where madonhang ='{$madonhang_xuatkho}'");
		$b = mysql_fetch_array($a);
		$donhang = $b['sanpham'];
		$tach = explode("|", $donhang);
		$logs = "";
		$hoantat = mysql_query("update donhang set goihang=1 where madonhang = '{$madonhang_xuatkho}'");
		$insert_date = date("Y-m-d H:i:s");
		@mysql_query("insert into goihang (idnhanvien,thoigian,madonhang) values ('{$id_nhanvien}','{$insert_date}','{$madonhang_xuatkho}')");
		$idgoihang = mysql_insert_id();
		foreach($tach as $newarray)
			{
				$tach2 = explode("-", $newarray);
				$key = $tach2[0];
				$value = $tach2[1];
				$tensanpham = getNameProduct($key);
				$xuatkho_sp = mysql_query("update sanpham set soluong=soluong-{$value} where id='{$key}'");
				if($xuatkho_sp)
				{
					$logs .= $tensanpham." Xuất ".$value." Cái . ";
					@mysql_query("insert into xuathang (idsanpham,soluong,idgoihang) values ('{$key}','{$value}','{$idgoihang}')");
					
				}
				else
				{
					$logs.=$tensanpham." XUẤT LỖI ".$value." Cái . ";
					@mysql_query("update goihang set donloi = '1' where id = '{$idgoihang}'");
					
				}

			}
			if($hoantat)
			{
				  
				  $text_date = date("H:i:s - d/m/Y");
				  $file_name = $date.".txt";
				  $dir_file = "admin/logs/xuatkho/".$file_name;
				  $file = fopen($dir_file,'a');
				  $text = $text_date." : ".$madonhang_xuatkho." đã gói hàng . Chi tiết : ".$logs.".\n";
				  fwrite($file,$text);
				  fclose($file);
				  echo "<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  html:
							'{$madonhang_xuatkho} ĐÃ ĐƯỢC GÓI <br />{$logs}',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>";
			}
			else
			{
				  
				  $text_date = date("H:i:s - d/m/Y");
				  $file_name = $date.".txt";
				  $dir_file = "admin/logs/xuatkho/".$file_name;
				  $file = fopen($dir_file,'a');
				  $text = $text_date." : ".$madonhang_xuatkho." LỖI gói hàng . Chi tiết : ".$logs.".\n";
				  fwrite($file,$text);
				  fclose($file);
echo "<script>
						swal({
						  title: 'LỖI !!',
						  html:
							'{$madonhang_xuatkho} BỊ LỖI <br />{$logs}',
						  
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/smod/xuatkho\")})
						</script>";				  
			}
	}		

}
?>