<?php
include("../config.php");
include("../check_access.php");

//Sửa sản phẩm
if(isset($_GET['thaotac']) && $_GET['thaotac'] =="nhapkho")
{
	$idsanpham = $_POST['idsanpham'];
	$thaotac = $_GET['thaotac'];
	$sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
	$kq = mysql_fetch_array($sql);
	$tensanpham = $kq['ten'];
	$masanpham = $kq['masanpham'];
	$soluong = $kq['soluong'];
	$ghichu = $kq['ghichu'];

	echo "

											<div class=\"panel-body\">
												
														
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Mã Sản Phẩm</label>
														<div class=\"col-sm-9\">
															<input type=\"text\" style=\"display:none\" name=\"token\"  class=\"form-control\" value=\"nhapkho\"/>
															<input type=\"text\" style=\"display:none\" name=\"idsanpham\"  class=\"form-control\" value=\"{$idsanpham}\"/>
															<input type=\"text\" style=\"display:none\" name=\"thaotac\"  class=\"form-control\" value=\"{$thaotac}\"/>
															<input type=\"text\" style=\"text-transform: uppercase;\" name=\"masanpham\"  class=\"form-control\" value=\"{$masanpham}\" required/>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Tồn Kho</label>
														<div class=\"col-sm-9\">
															<input style=\"border:none;background:none;box-shadow:none;color:red;font-size:25px;font-weight:700\" type=\"text\" name=\"tonkho\" class=\"form-control\" value=\"{$soluong} Cái\" disabled />
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Nhập Thêm</label>
														<div class=\"col-sm-9\">
														<input type=\"number\" name=\"soluong\" class=\"form-control\" min=\"1\" required=\"\" placeholder=\"Điền số lượng hàng cần nhập thêm\" />
																
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Ghi chú</label>
														<div class=\"col-sm-9\">
															<textarea name=\"ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>
														</div>
													</div>
													<div class=\"form-group\">
														
														<div class=\"col-sm-12\" style=\"text-align: center\">
															<button class=\"btn btn-primary\">Nhập Thêm Sản Phẩm</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
														</div>
													</div>
												
											</div>
			
									";
}
if(isset($_GET['thaotac']) && $_GET['thaotac'] =="xuatkho")
{
	$idsanpham = $_POST['idsanpham'];
	$thaotac = $_GET['thaotac'];
	$sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
	$kq = mysql_fetch_array($sql);
	$tensanpham = $kq['ten'];
	$masanpham = $kq['masanpham'];
	$soluong = $kq['soluong'];

	echo "

											<div class=\"panel-body\">
												
														
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Mã Sản Phẩm</label>
														<div class=\"col-sm-9\">
															<input type=\"text\" style=\"display:none\" name=\"token\"  class=\"form-control\" value=\"xuatkho\"/>
															<input type=\"text\" style=\"display:none\" name=\"idsanpham\"  class=\"form-control\" value=\"{$idsanpham}\"/>
															<input type=\"text\" style=\"display:none\" name=\"thaotac\"  class=\"form-control\" value=\"{$thaotac}\"/>
															<input type=\"text\" style=\"text-transform: uppercase;\" name=\"masanpham\"  class=\"form-control\" value=\"{$masanpham}\" required/>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Tồn Kho</label>
														<div class=\"col-sm-9\">
															<input style=\"border:none;background:none;box-shadow:none;color:red;font-size:25px;font-weight:700\" type=\"text\" name=\"tonkho\" class=\"form-control\" value=\"{$soluong} Cái\" disabled />
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Xuất Đi</label>
														<div class=\"col-sm-9\">
														<input type=\"number\" name=\"soluong\" class=\"form-control\" min=\"1\" max=\"{$soluong}\" required=\"\" placeholder=\"Điền số lượng hàng xuất kho\" />
																
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Ghi chú</label>
														<div class=\"col-sm-9\">
															<textarea name=\"ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>
														</div>
													</div>
													<div class=\"form-group\">
														
														<div class=\"col-sm-12\" style=\"text-align: center\">
															<button class=\"btn btn-primary\">Xuất Kho</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
														</div>
													</div>
												
											</div>
			
									";
}
if(isset($_POST['token']))
{
	$idsanpham = $_POST['idsanpham'];
	$sqlkt = mysql_query("select soluong from sanpham where id='{$idsanpham}' ");
	$kiemtrakho = mysql_fetch_array($sqlkt);
	$soluong_kho = $kiemtrakho['soluong'];
	$soluong = $_POST['soluong'];
	$thaotac = $_POST['token'];
	$masanpham = $_POST['masanpham'];
	if(!isset($_POST['ghichu']) or $_POST['ghichu'] == "") $ghichu = "";
	else $ghichu = $_POST['ghichu'];
	if($thaotac =="nhapkho")
	{
		
		if($quyenhan['nhapkho'] =="1")
		{

			$nhapkho = mysql_query("update sanpham set soluong = soluong + {$soluong} where id='{$idsanpham}'");	
			$date = date("d-m-Y");
			$text_date = date("H:i:s - d/m/Y");
			$file_name = $date.".txt";
			$dir_file = "../admin/logs/khohang/nhaphang-".$file_name;
			$file = fopen($dir_file,'a');
	 		$text = $text_date." : ".$fullname." đã nhập thêm {$soluong} sản phẩm {$masanpham} vào kho.\n";
			fwrite($file,$text);
			fclose($file);
			echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã nhập thêm {$soluong} sản phẩm {$masanpham} ! ',
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
		elseif($quyenhan['nhapkho'] =="1")

		echo "
<script>
swal({
  title: 'CÓ LỖI XẢY RA',
  text: 'Tài khoản của bạn không được quyền nhập kho sản phẩm {$is_nhapkho} ! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";	

	}
	
	elseif ($thaotac =="xuatkho")
	{
		if($soluong > $soluong_kho)
			echo "<script>
swal({
  title: 'LỖI !!',
  text: 'Số lượng hàng xuất kho phải nhỏ hơn số lượng hàng tồn kho ! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>";
		else
		
			$nhapkho = mysql_query("update sanpham set soluong = soluong - {$soluong} where id='{$idsanpham}'");
		
	}
	//Lưu lại lịch sử nhập kho
	$ngay = date('Y-m-d');
	$gio = date('H:i:s');
	$luutru = mysql_query("insert into nhapkho (ngay,gio,username,masanpham,soluong,ghichu,thaotac) values ('{$ngay}','{$gio}','{$username}','{$masanpham}','{$soluong}','{$ghichu}','{$thaotac}') ");
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