<?php
include("../function/function.php");
include("../check_access.php");
include("../function/api.php");
if(isset($_POST['donhang']))
{
	$donhang = $_POST['donhang'];
	$iddonhang = $donhang;
	$query = mysql_query("select * from donhang where id='{$donhang}'");
	$kq = mysql_fetch_array($query);
	$madonhang = $kq['madonhang'];
	$nhanvien = $kq['nhanvien'];
	$tennhanvien = getnamebyusername($nhanvien);
	$khachhang = $kq['khachhang'];
	$diachi = $kq['diachi'];
	$sdt = $kq['sdt'];
	$form_select = taoformselectmasanpham();
	$donvivanchuyen = $kq['donvivanchuyen'];
	$ghichu = $kq['ghichu'];
	$maughichu = taomaughichu();
	$sanpham = $kq['sanpham'];
	$page = $kq['page'];
	//Form select Page
	$sql_page = mysql_query("select * from listpage");
    $option_selectpage = "";
    while ($pagebanhang = mysql_fetch_array($sql_page)) {
        $id = $pagebanhang['id'];
        $tenpage = $pagebanhang['page'];
        if($page == $tenpage)
		$option_selectpage.= "<option value=\"{$id}\" selected = \"selected\">{$tenpage}</option>";
        else	
        $option_selectpage.= "<option value=\"{$id}\">{$tenpage}</option>";
    }
	//Duyệt đơn hàng
	$donhang = "";
	$tach_a = explode("|", $sanpham);
	$dem_a = count($tach_a);
	if($dem_a >=5) $phiship = 0;else $phiship = 30000;
	foreach ($tach_a as $array)
	{
		$tach_b = explode("-", $array);
		$key = $tach_b[0];
		$value = $tach_b[1];
		$xuly_a = laymasanpham($key);
		$sanpham_a = "<div class=\"form-group mt-lg RemoveDiv\" >
						<label class=\"col-sm-3 control-label\">Mua Hàng {$xuly_a}</label>
						<div class=\"col-sm-2\">
							<input type=\"number\" name=\"{$key}\" class=\"form-control\" value=\"{$value}\" min=\"0\" >
						</div>
						<div class=\"col-sm-1\">
							<a class=\"btn btn-danger btn-sm\" onclick=\"removeDiv(this)\">XÓA</a> 
						</div>
						</div>";
												
		$donhang.=$sanpham_a;
	}


	echo "
		<div class=\"panel-body\">
			<div class=\"form-group mt-lg\">
				<label class=\"col-sm-3 control-label\">Khách Hàng</label>
				<div class=\"col-sm-9\">
					<input type=\"text\" name=\"token\" value=\"edit\" style=\"display:none\" />
					<input type=\"text\" name=\"iddonhang\" value=\"{$iddonhang}\" style=\"display:none\" />
					<input type=\"text\" name=\"madonhang\" class=\"form-control\" value=\"{$madonhang}\" style=\"display:none\" disabled/>
					<input type=\"text\" name=\"nhanvien\" class=\"form-control\" value=\"{$tennhanvien}\" style=\"display:none\" disabled>
					<input type=\"text\" name=\"khachhang\" class=\"form-control\" value=\"{$khachhang}\" >
				</div>
			</div>
			<div class=\"form-group mt-lg\">
				<label class=\"col-sm-3 control-label\">Địa Chỉ</label>
				<div class=\"col-sm-9\">
					<input type=\"text\" name=\"diachi\" class=\"form-control\" value=\"{$diachi}\" >
				</div>
			</div>													
			<div class=\"form-group mt-lg\">
				<label class=\"col-sm-3 control-label\">Điện Thoại</label>
				<div class=\"col-sm-9\">
					<input type=\"text\" name=\"sdt\" class=\"form-control\" value=\"{$sdt}\">
				</div>
			</div>
			<div id=\"toAddInput\">{$donhang}</div>
			<div class=\"form-group mt-lg\">
				<label class=\"col-sm-3 control-label\">Thêm Sản PHẩm</label>
				<div class=\"col-sm-8\">
					<select multiple data-plugin-selectTwo class=\"form-control populate\" id=\"SelectToAdd\" style=\"height:70px\">
						{$form_select}
					</select>
				</div>
				<div class=\"col-sm-1\">
					<a class=\"btn btn-danger btn-sm\" onclick=\"addInput()\">THÊM</a> 
				</div>
			</div>
			<div class=\"form-group mt-lg\">
				<label class=\"col-sm-3 control-label\">Phí Ship</label>
				<div class=\"col-sm-9\">
					<input type=\"text\" name=\"phiship\" class=\"form-control\" value=\"{$phiship}\">
				</div>
			</div>
			<div class = \"form-group\">
				<label class=\"col-sm-3 control-label\">Page Bán Hàng</label>
				<div class=\"col-sm-9\">
					<div class=\"input-group btn-group\">
						<span class=\"input-group-addon\">
							<i class=\"fa fa-th-list\"></i>
						</span>
						<select data-plugin class=\"form-control populate\" name=\"page\">
							{$option_selectpage}
						</select>
					</div>
				</div>
			</div>
			<div class = \"form-group\">
				<label class=\"col-sm-3 control-label\">Mẫu Ghi chú</label>
				<div class=\"col-sm-9\">
					<div class=\"input-group btn-group\">
						<span class=\"input-group-addon\">
							<i class=\"fa fa-th-list\"></i>
						</span>
						<select multiple data-plugin class=\"form-control populate\" onchange=\"change_ghichu(this.value)\" style=\"height:70px\">
							{$maughichu}
						</select>
					</div>
				</div>
			</div>
			<div class=\"form-group\">
				<label class=\"col-sm-3 control-label\">Ghi chú</label>
				<div class=\"col-sm-9\" id=\"ghichu\">
					<textarea name=\"ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>
				</div>
			</div>
			<div class=\"form-group\">
				<div class=\"col-sm-12\" style=\"text-align: center\">
					<button class=\"btn btn-primary\">Sửa Đơn Hàng</button> <button class=\"btn btn-danger\" data-dismiss=\"modal\">Hủy</button>
				</div>
			</div>
		</div>
	";
}

if(isset($_POST['token']) && $_POST['token'] == "edit")
{
	unset($_POST['token']);
	$id = $_POST['iddonhang'];unset($_POST['iddonhang']);
	$khachhang = $_POST['khachhang'];unset($_POST['khachhang']);
	$diachi = $_POST['diachi'];unset($_POST['diachi']);
	$sdt = $_POST['sdt'];unset($_POST['sdt']);
	$donvivanchuyen = $_POST['donvivanchuyen'];unset($_POST['donvivanchuyen']);
	$ghichu = $_POST['ghichu'];unset($_POST['ghichu']);
	$phiship = $_POST['phiship'];unset($_POST['phiship']);
	$idpage = $_POST['page'];unset($_POST['page']);
	$tenpage = tenpage($idpage);
	$donhang = "";
	$sanpham = "";
	$tongtien = 0;
	foreach($_POST as $key=>$value)
	{
		$sanpham_a = $key."-".$value;
		if($sanpham =="")$sanpham = $sanpham_a;
		else $sanpham = $sanpham."|".$sanpham_a;
		$sanpham = rtrim($sanpham,"|");

		$thongtinsanpham = thongtinsanpham($key);
		$tensanpham = $thongtinsanpham['tensanpham'];
		$donhang_a = $tensanpham." : <b>".$value." bộ</b>";
		if($donhang =="")$donhang = $donhang_a;
		else $donhang = $donhang."<br />".$donhang_a;
		$masanpham = $thongtinsanpham['masanpham'];
		$gia = giasanpham($masanpham);
		$thanhtien = $gia*$value;
		$tongtien+=$thanhtien;
	}
	$tongtien+=$phiship;

	$do = mysql_query("update donhang set khachhang='{$khachhang}',diachi='{$diachi}',sdt = '{$sdt}', donvivanchuyen = '{$donvivanchuyen}', ghichu = '{$ghichu}', phiship = '{$phiship}',page='{$tenpage}',sanpham='{$sanpham}',donhang='{$donhang}',tongtien='{$tongtien}' where id='{$id}'");
	if(isset($do))echo "		<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  text: 'Chỉnh sửa đơn hàng {$madonhang} thành công ! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
	else echo "

		<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Không thể cập nhật dữ liệu ! ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
}
if(isset($_POST['xacnhandonhang']))
{
	$donhang = $_POST['xacnhandonhang'];
	$do = mysql_query("update donhang set tinhtrang=1,nguoiduyet='{$fullname}' where id='{$donhang}'");
		if(isset($do))echo "		<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  text: 'Chỉnh sửa duyệt đơn hàng {$madonhang} ! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
	else echo "

		<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Không thể cập nhật dữ liệu ! ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
}
if(isset($_POST['token']) && $_POST['token'] =="xoadonhang_api")
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
        "Token: 6904Ae643984e41001aD34D09AAeaA1E4a8B5EE9",
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
if(isset($_POST['token']) && $_POST['token'] =="xoadonhang")
{

	$id = $_POST['donhang'];

	

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
													
if(isset($_POST['addinputid']))
{
	$id = $_POST['addinputid'];
	foreach ($id as $value) {
		$xuly_a = laymasanpham($value);
	echo "<div class=\"form-group mt-lg RemoveDiv\" >
														<label class=\"col-sm-3 control-label\">Mua Hàng {$xuly_a}</label>
														<div class=\"col-sm-2\">
															<input type=\"number\" name=\"{$value}\" class=\"form-control\" value=\"1\" min=\"0\" >
														</div>

														<div class=\"col-sm-1\">
														<a class=\"btn btn-danger btn-sm\" onclick=\"removeDiv(this)\">XÓA</a> 
														</div>
														
														
													</div>	";
	}
	
	
}
//Them mau ghi chu
if(isset($_POST['idghichu']))
{
	$idmaughichu = $_POST['idghichu'];
	$a = mysql_query("select ghichu from ghichu where id='{$idmaughichu}'");
	$b = mysql_fetch_array($a);
	$ghichu = $b['ghichu'];
	echo "<textarea name=\"ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>";
}
//Search hoàn hàng
if(isset($_POST['checkhoanhang']))
{
	$searchdonhang = $_POST['checkhoanhang'];
	$sql = mysql_query("SELECT *  FROM `donhang` WHERE ((`sdt` LIKE '%{$searchdonhang}%') or ( ghtk LIKE '%{$searchdonhang}%') or (madonhang LIKE '{$searchdonhang}')) and hoanhang = '1' ORDER BY `id`  DESC ");
	$count = mysql_num_rows($sql);
	if($count>0)
	{
		echo "<script>
						swal({
						  title: 'ĐƠN HÀNG {$searchdonhang} ĐÃ HOÀN!!',
						  
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>";
	}
	elseif ( $count == 0 )
	{
		echo "<script>
						swal({
						  title: 'ĐƠN HÀNG {$searchdonhang} CHƯA ĐƯỢC HOÀN!!',
						  
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>";
	}
}
//Search đơn hàng
if(isset($_POST['searchdonhang']))
{
	$searchdonhang = $_POST['searchdonhang'];
	$sql = mysql_query("SELECT *  FROM `donhang` WHERE (`sdt` LIKE '%{$searchdonhang}%') or ( ghtk LIKE '%{$searchdonhang}%') or (madonhang LIKE '{$searchdonhang}') ORDER BY `id`  DESC ");
	$count = mysql_num_rows($sql);
	if($count>0)
	{
{
		echo "
		
		<table class=\"table table-bordered table-striped mb-none\" id=\"table-all\">
<thead>
										<tr>
											<th>Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th style=\"text-align: center\">Nhân Viên</th>
											<th style=\"text-align: center\">Khách Hàng</th>
											<th>Địa Chỉ</th>
											<th style=\"text-align: center\">Số Điện Thoại</th>
											<th style=\"min-width: 150px;text-align: center\">Mua Hàng</th>
											<th style=\"min-width: 80px;text-align: center\">Tổng Tiền</th>
											<th style=\"min-width: 80px;text-align: center\">Ghi Chú</th>
											<th style=\"min-width: 110px;text-align: center\">Thao Tác</th>

										</tr>
									</thead>
									<tbody id=\"list_products\">";


while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$ghtk = $do['ghtk'];
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
												$xuly_a = laymasanpham($key);
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
											$status_id = $do['status_id'];
											$trangthaiapi = $api_status_id[$status_id];
											$goihang = $do['goihang'];
		if($quyenhan['smod']=="1")
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
		}
		else
		{
			if($do['goihang'] ==0)$button1 = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-default\">Chưa gói hàng</a><br />";
			else $button1 = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-success\">Đã gói hàng</a><br />";
			$button2 = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk({$id})\">{$trangthaiapi}</a><br />";
			if($ghtk =="")
			$button = $button1.$button2;
		}

			
			$ghichu = $do['ghichu'];
											

echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}<br /><b><font color=\"red\">{$ghtk}</font></b></td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ghichu}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";
}
		echo "
											</tbody>
											</table>";
	}
	}
	else
	{
		echo "<script>
						swal({
						  title: 'KHÔNG TÌM THẤY ĐƠN HÀNG CÓ LIÊN QUAN : {$searchdonhang}!!',
						  
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>";
	}
}

if(isset($_POST['ghtk_id']))
{
	$id = $_POST['ghtk_id'];
	$sql = mysql_query("select ghtk from donhang where id='{$id}'");
	$do = mysql_fetch_array($sql);
	$idghtk = $do['ghtk'];
	$info = api_status($idghtk);
	
}
if(isset($_REQUEST['update_withmadh']))
{
	$mdh = $_REQUEST['update_withmadh'];
	$run = update_status($mdh);
	echo $run;
	die();
}
if(isset($_REQUEST['del_cache']))
{
	$time = $_REQUEST['del_cache'];
	$run = delete_cache($time.'donhang');
	echo json_encode(array('data'=>$run));	
	die();
}
if(isset($_POST['result_total']))
{
	$update = $_POST['date'];
	

	$tachngay = explode("/",$update);
	$ngay = $tachngay[2]."-".$tachngay[1]."-".$tachngay[0];
	if($quyenhan['smod'] =="1")
		{
			$sql = "select  ghtk,madonhang from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND status_id NOT IN (6,9,11) AND ghtk != ''";
			$list = db_cache($sql,'id', $update . 'donhang');	
		}
		elseif($quyenhan['mod'] =="1")
		{
			$sql = mysql_query("select ghtk from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND status_id NOT IN (6,9,11) AND ghtk != ''");	
		}
		elseif($quyenhan['banhang'] =="1")
		{
			$sql = mysql_query("select ghtk from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND status_id NOT IN (6,9,11) AND ghtk != '' and id_nhanvien='{$id_nhanvien}'");	
		}
		echo count($list);
}
if(isset($_REQUEST['id_ghtk_up']))
{
	$ketqua ="";
	$update = $_REQUEST['id_ghtk_up'];
	$tachngay = explode("/",$update);
	$ngay = $tachngay[2]."-".$tachngay[1]."-".$tachngay[0];
	$solan = 0;
	//$page = intval($_REQUEST['page'])+1;
	$page = isset($_REQUEST['page'])?intval($_REQUEST['page']-1):0;

	//$from = $page * 50;
	$per_page = intval($_REQUEST['per_page']);;


	
		if($quyenhan['smod'] =="1")
		{
			//$sql = mysql_query("select ghtk,madonhang from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND  status_id NOT IN (6,99,9,11) AND ghtk !='' LIMIT 0, $per_page");
			$sql = "select ghtk,madonhang from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND  status_id NOT IN (6,11,-1) AND ghtk !=''";	
			$list = db_cache($sql,'id', $update . 'donhang');
		}
		elseif($quyenhan['mod'] =="1")
		{
			$sql = mysql_query("select ghtk,madonhang from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND  status_id NOT IN (6,11,-1) AND ghtk != '' LIMIT 0, $per_page");	
		}
		elseif($quyenhan['banhang'] =="1")
		{
			$sql = mysql_query("select ghtk,madonhang from donhang where ( thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59' ) AND  status_id NOT IN (6,11,-1) AND ghtk != '' and id_nhanvien='{$id_nhanvien}' LIMIT 0, $per_page");	
		}
		
		//$sql = mysql_query("select ghtk from donhang where ( thoigian between '{$thangnay}-01 00:00:00' and '{$homnay} 23:59:59' ) and  status_id !='6' and  status_id !='99' AND status_id !='9' and status_id !='11' and (ghtk != '')");
		$from = intval(count($list)/$per_page);
		foreach(array_slice($list, $page*$per_page, $per_page)  AS $do)
			{
				$ghtk = $do['ghtk'];
			//$update = update_status($ghtk);
			$ketqua = $update;
			$do['id'] = $do['id'];
			$data[] = array(
				'madh' => $do['madonhang'],
				'ghtk' => $do['ghtk']
			);
			}
		echo json_encode(array('data'=>$data));	
		
		
		die();

	
}
if(isset($_POST['api_id']))
{
	$iddonhang = $_POST['api_id'];
	$a = mysql_query("select * from donhang where id='{$iddonhang}'");
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
			$query ="SELECT maapi FROM api WHERE id IN ( SELECT idapi FROM team WHERE id IN ( SELECT team_id FROM user WHERE id IN ( SELECT id_nhanvien FROM donhang WHERE madonhang = '{$madonhang}' )))";
			$sql_api = mysql_query($query);
			$result = mysql_fetch_array($sql_api);
			$maapi = $result['maapi'];
			$array_api = array("maapi"=>$maapi,"id"=>$iddonhang,"madonhang"=>$madonhang,"sdt"=>$sdt,"khachhang"=>$tenkhachhang,"diachi"=>$diachi,"huyen"=>$diachi_huyen,"tinh"=>$diachi_tinh,"hotline"=>$hotline,"tongtien"=>$tongtien,"ghichu"=>$ghichu,"donhang"=>$donhang);
			$xulyapi = dangapi($array_api);
			$array_ketqua = json_decode($xulyapi);
			$ketqua = $array_ketqua->{'note'};
						echo "
				<script>
						swal({
						  title: 'KẾT QUẢ !!',
						  html: '{$ketqua} ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>
	";
	
	
}

//Đăng API Toàn Bộ Đơn

if(isset($_POST['update_apiwithmadh']))
{
	$content = json_decode($_POST['update_apiwithmadh'], true);
	echo dangapi($content);
}

if(isset($_REQUEST['apiall']))
{
	$ketqua ="";
	$thangnay = date("Y-m");
	$homnay = date("Y-m-d");
	$limit = intval($_POST['limit']);
	if($quyenhan['smod'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-04-01 00:00:00' and '{$homnay} 23:59:9') LIMIT 0,$limit");
		}
		elseif($quyenhan['mod'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-04-01 00:00:00' and '{$homnay} 23:59:9') and id_nhanvien in ( select id from user where team_id='{$teamID}')  LIMIT 0,$limit");
			
		}
		elseif($quyenhan['banhang'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-04-01 00:00:00' and '{$homnay} 23:59:9') and id_nhanvien ='{$id_nhanvien}'  LIMIT 0,$limit");
		}
	$i=0;
	while($b = mysql_fetch_array($a))
	{			
			$total = $i++;
			$array_sanpham = array();
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
			$maapi = "2e9A2dc05B275E514C0cBA60b0e2E35B1e4523e0";
			$array_api[] = array("maapi"=>$maapi,"id"=>$iddonhang,"madonhang"=>$madonhang,"sdt"=>$sdt,"khachhang"=>$tenkhachhang,"diachi"=>$diachi,"huyen"=>$diachi_huyen,"tinh"=>$diachi_tinh,"hotline"=>$hotline,"tongtien"=>$tongtien,"ghichu"=>$ghichu,"donhang"=>$donhang);
			
	}	

	$data = array(
		'total' => $total,
		'data'=> $array_api
	);
	echo json_encode($data);
	die();
}
//Kiểm tra đơn có trên GHTK chưa
if(isset($_POST['capnhatmaapi']))
{
	$madonhang = $_POST['capnhatmaapi'];
	echo checkmadonhang($madonhang);
	
	
}
if(isset($_POST['fixapi']))
{
	$ketqua ="";
	$thangnay = date("Y-m");
	$homnay = date("Y-m-d");
	$limit = intval($_POST['limit']);
	if($quyenhan['smod'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-01-01 00:00:00' and '{$homnay} 23:59:9')");// LIMIT 0,$limit
		}
		elseif($quyenhan['mod'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-01-01 00:00:00' and '{$homnay} 23:59:9') and id_nhanvien in ( select id from user where team_id='{$teamID}') ");
		}
		elseif($quyenhan['banhang'] =="1")
		{
			$a = mysql_query("select * from donhang where ghtk ='' and (thoigian between '2018-01-01 00:00:00' and '{$homnay} 23:59:9') and id_nhanvien ='{$id_nhanvien}'");
		}
	$i = 0;
	while($b = mysql_fetch_array($a))
	{		
		$total = $i++;
			
			$data[] =array('madonhang' =>$b['madonhang']);
	}	
		echo json_encode(array('total'=> $total, 'data' => $data));
	
	
}
//
if(isset($_POST['donhang_khachung']))
{
	$donhang = $_POST['donhang_khachung'];
	$iddonhang = $donhang;
	$query = mysql_query("select * from donhang where id='{$iddonhang}'");
	$kq = mysql_fetch_array($query);
	$tamung = $kq['tamung'];
	$smod_check_tamung = $kq['smod'];
	if($tamung > 0 && $smod_check_tamung == 0)
	{
	echo "
		<div class=\"panel-body\">
			<div class=\"form-group mt-lg\" style\"text-align:center\">
				Tiền Khách Ứng :
				
					<input type=\"text\" name=\"token\" value=\"edit\" style=\"display:none\" />
					<input type=\"text\" name=\"xacnhanung\" value=\"{$iddonhang}\" style=\"display:none\" />
					<input type=\"number\" name=\"tamung\" class=\"form-control\" value=\"{$tamung}\" style=\"width:200px;display:inline\" >
				
			</div>
			<div class=\"form-group\">
				<div class=\"col-sm-12\" style=\"text-align: center\">
					<button class=\"btn btn-primary\">Xác Nhận</button> <button class=\"btn btn-danger\" data-dismiss=\"modal\">Hủy</button>
				</div>
			</div>
		</div>
	";
	}
}
if(isset($_POST['xacnhanung']))
{
	$iddonhang = $_POST['xacnhanung'];
	$a = mysql_query("select madonhang from donhang where id='{$iddonhang}'");
	$b = mysql_fetch_array($a);
	$madonhang = $b['madonhang'];
	$tamung = $_POST['tamung'];
	$tientamung = number_format($tamung);
	$do = mysql_query("update donhang set tamung='{$tamung}',smod='{$id_nhanvien}' where id='{$iddonhang}'");
	if($do)
  	{
	  $date = date("d-m-Y");
	  $text_date = date("H:i:s - d/m/Y");
	  $file_name = $date.".txt";
	  $dir_file = "../admin/logs/donhang/".$file_name;
	  $file = fopen($dir_file,'a');
	  $text = $text_date." : ".$fullname." Đã xác nhận khách tạm ứng ".$tientamung." cho đơn hàng {$madonhang} - ID : {$iddonhang}.\n";
	  fwrite($file,$text);
	  fclose($file);
	   echo "
	<script>
	swal({
	  title: 'HOÀN TẤT',
	  text: 'Đã xác nhận khách ứng {$tientamung} cho đơn hàng {$madonhang} !',
	  type: 'success',
	  showCancelButton: false,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'OK !!!'
	})
	.then(function () {
	location.reload();
	})
	</script>
	  ";
	}
  else echo "
<script>
swal({
  title: 'CÓ LỖI',
  text: 'Vui lòng kiểm tra dữ lại dữ liệu nhập vào . ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
})
.then(function () {
location.reload();
})
</script>
    ";
 
}
?>
