<?php
include("../check_access.php");
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
"99"=>"Lạc Trôi"
);
function api_status($id_ghtk)
{
	//Tìm mã API Đơn Hàng
	$tach_mdh = explode(".",$id_ghtk);
	$mashop = $tach_mdh[0];
	switch($mashop)
	{
		case "S50657":$maapi = "6904Ae643984e41001aD34D09AAeaA1E4a8B5EE9";break;//API SG
		case "S141994":$maapi = "4B3956b7C7741FFfe2B4dFC8497bAA3E2a1eA0bc";break;//API NT
		case "S511629":$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
		default:$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
	}
	$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";

	$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/{$id_ghtk}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => array(
        "Token: {$maapi}",
    ),
));

$response = curl_exec($curl);
$data_ghtk = json_decode($response,TRUE);
curl_close($curl);
$status_ghtk = $data_ghtk['success'];
$order_ghtk = $data_ghtk['order'];
if(!isset($status_ghtk) or $status_ghtk == "0")
{
	echo "<script>
						swal({
						  title: ' KHÔNG TÌM THẤY ĐƠN HÀNG {$id_ghtk}!!',
						  html:'Đơn hàng có thể đã bị xóa trên GHTK',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	})
						</script>";
}
elseif($status_ghtk =="1")
{
	global $api_status_id;
	$status_id = $order_ghtk['status'];
	$status = $api_status_id[$status_id];
	$deliver_message = $order_ghtk['deliver_message'];
	if($deliver_message =="")
		$deliver_message = "Chưa có thông tin cụ thể trên GHTK";
	echo "<script>
						swal({
						  title: ' ĐÃ TÌM THẤY ĐƠN HÀNG {$id_ghtk}!!',
						  html:'Tình trang : <b><font color=\"red\">{$status}</font></b><br />{$deliver_message}',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	})
						</script>";
}
}
function doisoat($id_ghtk)
{
	global $api_status_id;
	$ketqua = "";
	//Tìm mã API Đơn Hàng
	$tach_mdh = explode(".",$id_ghtk);
	$mashop = $tach_mdh[0];
	switch($mashop)
	{
		case "S50657":$maapi = "6904Ae643984e41001aD34D09AAeaA1E4a8B5EE9";break;//API SG
		case "S141994":$maapi = "4B3956b7C7741FFfe2B4dFC8497bAA3E2a1eA0bc";break;//API NT
		case "S511629":$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
		default:$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
	}
	$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/v2/{$id_ghtk}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => array(
        "Token: {$maapi}",
    ),
));

$response = curl_exec($curl);
$data_ghtk = json_decode($response,TRUE);
curl_close($curl);
$status_ghtk = $data_ghtk['success'];
if(!isset($status_ghtk) or $status_ghtk == "0")
{
	$ketqua="<font color='red'>KHÔNG TÌM THẤY ĐƠN HÀNG {$id_ghtk}!!</font>";
}
elseif($status_ghtk =="1")
{
$order_ghtk = $data_ghtk['order'];
$status_id = $order_ghtk['status'];
$showstatus = $api_status_id[$status_id];
$tongtien = $order_ghtk['pick_money'];
$shipcod = $order_ghtk['ship_money'];
if($status_id =="6" or $status_id =="11")
{
	$do = mysql_query("UPDATE donhang SET cod='{$tongtien}',shipcod='{$shipcod}',doisoat='1' where ghtk='{$id_ghtk}'");
	if($do) 
	$ketqua ="Đã đối soát đơn hàng {$id_ghtk}<br/>";
}

else
{
		$ketqua="<font color=\"red\">KHÔNG ĐỐI SOÁT ĐƯỢC ĐƠN HÀNG {$id_ghtk}!!</font>";
}
}
return json_encode(array('status' => 'ok', 'note'=> $ketqua));
}
function update_status($id_ghtk)
{
	
	global $api_status_id;
	$ketqua ="";
	//Tìm mã API Đơn Hàng
	$tach_mdh = explode(".",$id_ghtk);
	$mashop = $tach_mdh[0];
	switch($mashop)
	{
		case "S50657":$maapi = "6904Ae643984e41001aD34D09AAeaA1E4a8B5EE9";break;//API SG
		case "S141994":$maapi = "4B3956b7C7741FFfe2B4dFC8497bAA3E2a1eA0bc";break;//API NT
		case "S511629":$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
		default:$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";break;//API TONG
	}
	$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/v2/{$id_ghtk}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => array(
        "Token: {$maapi}",
    ),
));

$response = curl_exec($curl);
$data_ghtk = json_decode($response,TRUE);
curl_close($curl);
$status_ghtk = $data_ghtk['success'];
if(!isset($status_ghtk) or $status_ghtk == "0")
{
	$ketqua = "<font color=\"red\">{$id_ghtk} đã bị xóa khỏi GHTK</font><br />";
	@mysql_query("UPDATE donhang SET status_id='99' where ghtk='{$id_ghtk}'");
}
elseif($status_ghtk =="1")
{
	$order_ghtk = $data_ghtk['order'];
	$status_id = $order_ghtk['status'];
	$ship_money = $order_ghtk['ship_money'];
	$showstatus = $api_status_id[$status_id];
	$do = mysql_query("UPDATE donhang SET status_id='{$status_id}',ship_money='{$ship_money}' where ghtk='{$id_ghtk}'");
	if($status_id =="6" or $status_id =="11")
	{
		$tongtien = $order_ghtk['pick_money'];
		$shipcod = $order_ghtk['ship_money'];
		$do2 = mysql_query("UPDATE donhang SET cod='{$tongtien}',shipcod='{$shipcod}',doisoat='1' where ghtk='{$id_ghtk}'");
	}
	if($do) 
	$ketqua = $order_ghtk['status_text'] .'- ID : '.$status_id.'<br />';
	
	$ketqua .="Đã cập nhật đơn hàng {$id_ghtk}<br/>";
}
return json_encode(array('status' => 'ok', 'note'=> $ketqua));
}
//Check đơn có tồn tại trên GHTK hay ko 
function checkmadonhang($madonhang)
{
	$ketqua ="";
	$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";//API TONG
	$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://services.giaohangtietkiem.vn/services/shipment/partner_id:{$madonhang}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_HTTPHEADER => array(
        "Token: {$maapi}",
    ),
));

$response = curl_exec($curl);
$data_ghtk = json_decode($response,TRUE);
curl_close($curl);
$status_ghtk = $data_ghtk['success'];
if(!isset($status_ghtk) or $status_ghtk == "0")
{
	$ketqua ="Đơn hàng {$madonhang} chưa đăng API GHTK<br/>";
}
elseif($status_ghtk =="1")
{
	$order_ghtk = $data_ghtk['order'];
	$label_id = $order_ghtk['label_id'];
	$do = mysql_query("UPDATE donhang SET ghtk='{$label_id}' where madonhang='{$madonhang}'");
	if($do) 
	$ketqua = "<font color=\"red\">{$madonhang} đã cập nhật mã GHTK {$label_id}</font><br />";
}
return json_encode(array('status' => 'ok', 'note'=> $ketqua));
}
//Đăng API
function dangapi($array)
{
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
        "Token: 2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0",
        "Content-Length: " . strlen($order),
    ),
));

$response = curl_exec($curl);
$maloi_ghtk = $response;
$data_ghtk = json_decode($response,TRUE);
$status_ghtk = $data_ghtk['success'];
curl_close($curl);
if($status_ghtk == "" or $status_ghtk != "1")
{
	$result="<font color=\"red\"><b>".$array['madonhang']." bị lỗi không đăng API được</b></font><br />";

}
else
{
	$order_ghtk = $data_ghtk['order'];
	$ma_ghtk = $order_ghtk['label'];
	@mysql_query("update donhang set ghtk='{$ma_ghtk}' where madonhang='{$array['madonhang']}' ");
	$result =$array['madonhang']." đăng API thành công<br />";
	
}
return json_encode(array('status' => 'ok', 'note'=> $result));
}
?>