<?php
include("../config.php");
include("../check_access.php");

//Xóa ĐVGH
   if(isset($_POST['deleteid']))
{
	$id = $_POST['deleteid'];
	$a = mysql_query("select * from lichsukhohang where id='{$id}'");
	$b = mysql_fetch_array($a);
	//Thong tin id cu
	$usernamecu = $b['username'];
	$masanpham = $b['masanpham'];
	$ngay = $b['ngay'];
	$thaotac = $b['thaotac'];
	switch ($thaotac) {
		case 'nhapkho':
			$thaotac = "Nhập Hàng";
			break;
		case 'xuatkho':
			$thaotac = "Xuất Hàng";
			break;
	}
	$soluong = $b['soluong'];

	//
	$do = mysql_query("delete from lichsukhohang where id='{$id}'");
	if($do)
	{
 	$date = date("d-m-Y");
	$text_date = date("H:i:s - d/m/Y");
	$file_name = $date.".txt";
	$dir_file = "logs/khohang/".$file_name;
	$file = fopen($dir_file,'a');
 	$text = $text_date." : ".$fullname." đã xóa lịch sử : {$usernamecu} đã {$thaotac} {$masanpham} số lương {$soluong} ngày {$ngay}.\n";
	fwrite($file,$text);
	fclose($file);
		echo "
	}
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã xóa thống kê này ! ',
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
	else echo "
<script>
swal({
  title: 'CÓ LỖI XẢY RA',
  text: 'Vui lòng kiểm tra lại dữ liệu ! ',
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

//Sửa Form Edit sản phẩm
if(isset($_POST['id_history']))
{
	$id = $_POST['id_history'];
	$sql = mysql_query("select * from lichsukhohang where id='{$id}'");
	$kq = mysql_fetch_array($sql);
	$ghichu = $kq['ghichu'];
	$masanpham = $kq['masanpham'];
	$soluong = $kq['soluong'];
	

	echo "
			<form id=\"edit_history\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
											<div class=\"panel-body\">
												
													<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Mã Sản Phẩm</label>
														<div class=\"col-sm-9\">
														<input type=\"text\" name=\"token\" value=\"edit\" style=\"display:none;\" />
														<input type=\"text\" name=\"id\" value=\"{$id}\" style=\"display:none;\" />
															<input type=\"text\" name=\"masanpham\" class=\"form-control\" value=\"{$masanpham}\" required/>
														</div>
													</div>
													<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Số Lượng</label>
														<div class=\"col-sm-9\">
														
															<input type=\"number\" name=\"soluong\" class=\"form-control\" min=\"0\" value=\"{$soluong}\" required/>
														</div>
													</div>
														<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Ghi chú</label>
														<div class=\"col-sm-9\">
															<textarea name=\"edit_ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>
														</div>
													</div>
													<div class=\"form-group\">
														
														<div class=\"col-sm-12\" style=\"text-align: center\">
															<button class=\"btn btn-primary\">Sửa Nhập Kho</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
														</div>
													</div>
												
											</div>
			</form>
									";
}
//Sửa sản phẩm
if(isset($_POST['token']) && $_POST['token'] == "edit")
{
	$id = $_POST['id'];
	$a = mysql_query("select soluong from lichsukhohang where id='{$id}'");
	$b = mysql_fetch_array($a);
	$soluong_cu = $b['soluong'];
	$masanpham = $_POST['masanpham'];
	$soluong = $_POST['soluong'];
	$ghichu = $_POST['ghichu'];
	
    $result = mysql_query("update lichsukhohang set soluong='{$soluong}',ghichu='{$ghichu}' where id='{$id}' ");

if($result)
{
 	$date = date("d-m-Y");
	$text_date = date("H:i:s - d/m/Y");
	$file_name = $date.".txt";
	$dir_file = "logs/khohang/".$file_name;
	$file = fopen($dir_file,'a');
 	$text = "#".$id." ".$text_date." : ".$fullname." Đã thay đổi số lượng từ {$soluong_cu} thành {$soluong} .\n";
	fwrite($file,$text);
	fclose($file);

    		echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã chỉnh sửa thống kê này ! ',
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
    else echo "
<script>
swal({
  title: 'LỖI !!',
  text: 'Vui lòng kiểm tra lại thông tin nhập vào ! ',
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



?>