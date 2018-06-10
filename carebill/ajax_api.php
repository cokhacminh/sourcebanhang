<?php
include("../config.php");
include("../check_access.php");
if(isset($_POST['token']) && $_POST['token'] =="xoadonhang")
{
	
	$id = $_POST['donhang'];
	$new = mysql_query("select ghtk from donhang where id='{$id}'");
	$new_a = mysql_fetch_array($new);
	$madonhang = $new_a['ghtk'];
	//////////////////////////
	
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/cancel/{$madonhang}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => array(
        "Token: {$myapi}",
    ),
));

$response = curl_exec($curl);
$data_ghtk = json_decode($response,TRUE);
$status_ghtk = $data_ghtk['success'];
curl_close($curl);


	//////////////////////////
	if($status_ghtk !="true")
	{
		echo "		<script>
						swal({
						  title: 'CÓ LỖI !!',
						  text: 'Không xóa được đơn hàng {$madonhang} trên hệ thống GHTK! ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
	}
	elseif($status_ghtk =="true")
	{
	$do = mysql_query("delete from donhang where id='{$id}'");
	if(isset($do))echo "		<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  text: 'Đã xóa đơn hàng {$madonhang} ! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
}
}

if(isset($_POST['viewtype']))
{
	if($_POST['viewtype'] =="all")
	{
		echo "
		<button style=\"font-size: 17px;\" class=\"btn btn-sm btn-primary\" onclick=\"apiall('all')\">ĐĂNG API TOÀN BỘ ĐƠN HÀNG</button>
		<table class=\"table table-bordered table-striped mb-none\" id=\"table-all\">
<thead>
										<tr>
											<th>Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th style=\"min-width: 120px;text-align: center\">Nhân Viên</th>
											<th style=\"min-width: 120px;text-align: center\">Khách Hàng</th>
											<th>Địa Chỉ</th>
											<th style=\"min-width: 110px;text-align: center\">Số Điện Thoại</th>
											<th style=\"min-width: 130px;text-align: center\">Mua Hàng</th>
											<th style=\"min-width: 80px;text-align: center\">Tổng Tiền</th>
											
											<th style=\"min-width: 110px;text-align: center\">Thao Tác</th>

										</tr>
									</thead>
									<tbody id=\"list_products\">";

$a = mysql_query("select * from donhang where ghtk=''");
while($do = mysql_fetch_array($a))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$khachhang = $do['khachhang'];
											$nhanvien = $do['nhanvien'];
											$tennhanvien = getnamebyusername($nhanvien);
											$diachi = $do['diachi'];
											$sdt = $do['sdt'];
											$sanpham = $do['sanpham'];
											//Duyệt đơn hàng
											$donhang = "";
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												$xuly_a = getNameProduct($key);
												$sanpham_a = $xuly_a." : ".$value." Cái <br />";
												$donhang.=$sanpham_a;

												
											}
											
											$phiship = $do['phiship'];
											$tongtien = number_format($do['tongtien']);
											$donvivanchuyen = $do['donvivanchuyen'];
											$thoigian = $do['thoigian'];
											$time = strtotime($thoigian);
											$ngaygio = date("d/m/Y H:i:s",$time);
											$ghtk = $do['ghtk'];
											$api_log = $do['api_log'];
											if($api_log == "")
											$button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" onclick=\"api({$id})\">Đăng GHTK</a>";
											elseif($api_log !="") $button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-default\">Đơn Lỗi</a>";
											

echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";
}
		echo "
											</tbody>
											</table>";
	}
	elseif($_POST['viewtype'] =="bydate")
	{
		echo "
		<button style=\"font-size: 17px;\" class=\"btn btn-sm btn-primary\" onclick=\"apiall('all')\">ĐĂNG API TOÀN BỘ ĐƠN HÀNG</button>
		<table class=\"table table-bordered table-striped mb-none\" id=\"table-bydate\">
<thead>
										<tr>
											<th>Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th style=\"min-width: 120px;text-align: center\">Nhân Viên</th>
											<th style=\"min-width: 120px;text-align: center\">Khách Hàng</th>
											<th>Địa Chỉ</th>
											<th style=\"min-width: 110px;text-align: center\">Số Điện Thoại</th>
											<th style=\"min-width: 130px;text-align: center\">Mua Hàng</th>
											<th style=\"min-width: 80px;text-align: center\">Tổng Tiền</th>
											
											<th style=\"min-width: 110px;text-align: center\">Thao Tác</th>

										</tr>
									</thead>
									<tbody id=\"list_products\">";
	if(!isset($_POST['viewfromdate']) or $_POST['viewfromdate'] =="")
		$fromdate = "2017-01-01 00:00:00";
	else
		{
			$fromdate = $_POST['viewfromdate'];
			$fromdate = CreatFromDate($fromdate);
		}
	
	if(!isset($_POST['viewtodate']) or $_POST['viewtodate'] =="")
		{
			$today = date("Y-m-d");
			$todate = $today." 23:59:59";	
		}
		else
		{
			$todate = $_POST['viewtodate'];
			$todate = CreatToDate($todate);
		}
	
$a = mysql_query("select * from donhang where ( thoigian between '{$fromdate}' and '{$todate}' ) and ghtk=''");
while($do = mysql_fetch_array($a))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$khachhang = $do['khachhang'];
											$nhanvien = $do['nhanvien'];
											$tennhanvien = getnamebyusername($nhanvien);
											$diachi = $do['diachi'];
											$sdt = $do['sdt'];
											$sanpham = $do['sanpham'];
											//Duyệt đơn hàng
											$donhang = "";
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												$xuly_a = getNameProduct($key);
												$sanpham_a = $xuly_a." : ".$value." Cái <br />";
												$donhang.=$sanpham_a;

												
											}
											
											$phiship = $do['phiship'];
											$tongtien = number_format($do['tongtien']);
											$donvivanchuyen = $do['donvivanchuyen'];
											$thoigian = $do['thoigian'];
											$time = strtotime($thoigian);
											$ngaygio = date("d/m/Y H:i:s",$time);
											$ghtk = $do['ghtk'];
											$api_log = $do['api_log'];
											if($api_log == "")
											$button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" onclick=\"api({$id})\">Đăng GHTK</a><a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" title=\"Xóa Đơn Hàng Này\" onclick=\"xoadonhang({$id})\">Xóa</a>";
											elseif($api_log !="") $button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-default\">Đơn Lỗi</a><a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" title=\"Xóa Đơn Hàng Này\" onclick=\"xoadonhang({$id})\">Xóa</a>";

											

echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";
}
		echo "
											</tbody>
											</table>";
	}
}
/////////////////////////////////////////////
//API
if(isset($_POST['apiall']))
{
	$result = "";
	$apitype = $_POST['apiall'];
	if($apitype =="today")
	{	
		$today = date("Y-m-d");
		$a = mysql_query("select * from donhang where id_nhanvien='{$id_nhanvien}' and ghtk='' and ( thoigian between '{$today} 00:00:00' and '{$today} 23:59:59') and api_log =''");

	}
	elseif($apitype =="all")
	{
		$a = mysql_query("select * from donhang where ghtk='' and api_log =''");

	}

			$array_sanpham = array();
			while ($b = mysql_fetch_array($a))
		{
				
			$id = $b['id'];
			$madonhang = $b['madonhang'];
			$sdt = trim($b['sdt']);
			$tenkhachhang = trim($b['khachhang']);
			$diachi = trim($b['diachi']);
			$tach_diachi = explode("-", $diachi);
			$demkey = count($tach_diachi);
			$key_tinh = $demkey-1;
			$key_huyen = $demkey-2;
			$diachi_huyen = $tach_diachi[$key_huyen];
			if($diachi_huyen =="")$diachi_huyen ="Chưa Nhập";
			$diachi_tinh = $tach_diachi[$key_tinh];
			if($diachi_tinh =="")$diachi_tinh ="Chưa Nhập";
			$donhang = $b['sanpham'];
			$array = explode("|", $donhang);
			foreach ($array as $newarray) {
				$array2 = explode("-", $newarray);
				$idsanpham = $array2[0];
				$masanpham = masanpham($idsanpham);
				$array_sanpham[] = array("name"=>$masanpham,"quantity"=>$array2[1]);
			}
			$donhang = json_encode($array_sanpham);
			$tongtien = $b['tongtien'];
			$ghichu = $b['ghichu'];
			$array_api = array("id"=>$id,"madonhang"=>$madonhang,"sdt"=>$sdt,"khachhang"=>$tenkhachhang,"diachi"=>$diachi,"huyen"=>$diachi_huyen,"tinh"=>$diachi_tinh,"hotline"=>$hotline,"tongtien"=>$tongtien,"ghichu"=>$ghichu,"donhang"=>$donhang);
			$xulyapi = api($array_api);
			$array_sanpham = array();
			$result.=$xulyapi;
			
		}
		echo "
				<script>
						swal({
						  title: 'KẾT QUẢ !!',
						   html: '{$result}! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  		location.reload();})
						</script>
	";

}
if(isset($_POST['apiid']))
{
	$id = $_POST['apiid'];
	$a = mysql_query("select * from donhang where id='{$id}'");
	$b = mysql_fetch_array($a);
				
			$madonhang = $b['madonhang'];
			$sdt = $b['sdt'];
			$sdt = trim($sdt);
			$tenkhachhang = $b['khachhang'];
			$tenkhachhang = trim($tenkhachhang);
			$diachi = $b['diachi'];
			$diachi = trim($diachi);
			$tach_diachi = explode("-", $diachi);
			$demkey = count($tach_diachi);
			$key_tinh = $demkey-1;
			$key_huyen = $demkey-2;
			$diachi_huyen = $tach_diachi[$key_huyen];
			if($diachi_huyen =="" or is_null($diachi_huyen) or $diachi_huyen == " ")
				$diachi_huyen = "Chưa Nhập";
			$diachi_tinh = $tach_diachi[$key_tinh];
			if($diachi_tinh =="" or is_null($diachi_tinh) or $diachi_tinh == " ")
				$diachi_tinh = "Chưa Nhập";
			$donhang = $b['sanpham'];
			$array = explode("|", $donhang);
			foreach ($array as $newarray) {
				$array2 = explode("-", $newarray);
				$idsanpham = $array2[0];
				$masanpham = masanpham($idsanpham);
				$array_sanpham[] = array("name"=>$masanpham,"quantity"=>$array2[1]);
			}
			$donhang = json_encode($array_sanpham);
			$tongtien = $b['tongtien'];
			$ghichu = $b['ghichu'];
			$array_api = array("id"=>$id,"madonhang"=>$madonhang,"sdt"=>$sdt,"khachhang"=>$tenkhachhang,"diachi"=>$diachi,"huyen"=>$diachi_huyen,"tinh"=>$diachi_tinh,"hotline"=>$hotline,"tongtien"=>$tongtien,"ghichu"=>$ghichu,"donhang"=>$donhang);
			$xulyapi = api($array_api);
			echo "
				<script>
						swal({
						  title: 'KẾT QUẢ !!',
						  html: '{$xulyapi}! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  		location.reload();})
						</script>
	";
}
///Đặc Biệt
if(isset($_POST['apiforme']))
{
	
	$a = mysql_query("select * from donhang where ghtk ='' and ( thoigian between '2017-12-23 00:00:00' and '2017-12-23 23:59:59') and api_log =''");
			$array_sanpham = array();
			while ($b = mysql_fetch_array($a)) {
			$id = $b['id'];
			$madonhang = $b['madonhang'];
			$sdt = trim($b['sdt']);
			$tenkhachhang = trim($b['khachhang']);
			$diachi = trim($b['diachi']);
			$tach_diachi = explode("-", $diachi);
			$demkey = count($tach_diachi);
			$key_tinh = $demkey-1;
			$key_huyen = $demkey-2;
			$diachi_huyen = $tach_diachi[$key_huyen];
			if($diachi_huyen =="")$diachi_huyen ="Chưa Nhập";
			$diachi_tinh = $tach_diachi[$key_tinh];
			if($diachi_tinh =="")$diachi_tinh ="Chưa Nhập";
			$donhang = $b['sanpham'];
			$array = explode("|", $donhang);
			foreach ($array as $newarray) {
				$array2 = explode("-", $newarray);
				$idsanpham = $array2[0];
				$masanpham = masanpham($idsanpham);
				$array_sanpham[] = array("name"=>$masanpham,"quantity"=>$array2[1]);
			}
			$donhang = json_encode($array_sanpham);
			$tongtien = $b['tongtien'];
			$ghichu = $b['ghichu'];
			$array_api = array("id"=>$id,"madonhang"=>$madonhang,"sdt"=>$sdt,"khachhang"=>$tenkhachhang,"diachi"=>$diachi,"huyen"=>$diachi_huyen,"tinh"=>$diachi_tinh,"hotline"=>$hotline,"tongtien"=>$tongtien,"ghichu"=>$ghichu,"donhang"=>$donhang);
			$xulyapi = api($array_api);
			$array_sanpham = array();
	}
echo "
				<script>
						swal({
						  title: 'KẾT QUẢ !!',
						  html: '{$xulyapi}! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  		location.reload();})
						</script>
	";	
}

//
function api($array){
$result = "";
global $myapi;
	$order = <<<HTTP_BODY
{
 "products": {$array['donhang']},
    "order": {
        "id": "{$array['madonhang']}",
		"tel": "{$array['sdt']}",
		"name": "{$array['khachhang']}",
		"address": "{$array['diachi']}",
		"district":"{$array['huyen']}",
		"province": "{$array['tinh']}",
        "pick_address": "177 Đường III , Khu dân Cư Khang Điền , P.Phước Long B",
        "pick_tel": "{$array['hotline']}",
		"pick_name":"Thời Trang",
		"pick_money": {$array['tongtien']},
		"pick_province":"Tp.HCM",
		"pick_district":"Quận 9",
        "is_freeship" : 1,
        "note": "{$array['ghichu']}"
        
    }
}
HTTP_BODY;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/order",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $order,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Token: {$myapi}",
        "Content-Length: " . strlen($order),
    ),
));

$response = curl_exec($curl);
$maloi_ghtk = $response;
$data_ghtk = json_decode($response,TRUE);
$status_ghtk = $data_ghtk['success'];
curl_close($curl);
if($status_ghtk == "")
{
	
	@mysql_query("update donhang set api_log='Không Thành Công' where id='{$array['id']}' ");
	$result="<font color='red'><b>".$array['madonhang']." bị lỗi</b></font><br />";

}
else
{
	$order_ghtk = $data_ghtk['order'];
	$ma_ghtk = $order_ghtk['label'];
	@mysql_query("update donhang set ghtk='{$ma_ghtk}' where id='{$array['id']}' ");
	$result =$array['madonhang']." đăng API thành công<br />";
	
}
return $result;
}
//END API
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