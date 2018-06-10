<?php
include("../config.php");
include("../check_access.php");
if(isset($_POST['ten']))
{
	
	$ten = $_POST['ten'];
	$shortname = CreatShortName($ten);
	$sdt = $_POST['sdt'];
	$diachi = $_POST['diachi'];
	if(!isset($_POST['ghichu']))$ghichu = "";
	else $ghichu = $_POST['ghichu'];
	// Nếu người dùng có chọn file để upload
  if($_FILES['logo']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['logo']['type'] == "image/jpeg"
        || $_FILES['logo']['type'] == "image/png"
        || $_FILES['logo']['type'] == "image/jpg"
        || $_FILES['logo']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/logo"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['logo']['tmp_name'];
                $name = $_FILES['logo']['name'];
                $type = $_FILES['logo']['type']; 
                $size = $_FILES['logo']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $shortname.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noimage.png";

    $result = mysql_query("insert into xuongmay (ten,diachi,sdt,logo,ghichu) values ('{$ten}','{$diachi}','{$sdt}','{$hinhanh}','{$ghichu}')");
    if($result)echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã thêm xưởng may : {$ten} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";
    else echo "

<script>
swal({
  title: 'LỖI',
  text: 'Vui lòng kiểm tra lại thông tin ! ',
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
//Xóa ĐVGH
   if(isset($_POST['deleteid']))
{
	$id = $_POST['deleteid'];
	$ten = getNamedvgh($id);
	$do = mysql_query("delete from donvigiaohang where id='{$id}'");
	if($do)
		echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã xóa đơn vị giao hàng : {$ten} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
	";
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
if(isset($_POST['iddvgh']))
{
	$iddvgh = $_POST['iddvgh'];
	$sql = mysql_query("select * from donvigiaohang where id='{$iddvgh}'");
	$kq = mysql_fetch_array($sql);
	$tendvgh = $kq['ten'];
	$logo = $kq['logo'];
	$ghichu = $kq['ghichu'];
	

	echo "

											<div class=\"panel-body\">
												
													<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Tên ĐVGH</label>
														<div class=\"col-sm-9\">
														<input type=\"text\" name=\"token\" value=\"edit\" style=\"display:none;\" />
														<input type=\"text\" name=\"iddonvigiaohang\" value=\"{$iddvgh}\" style=\"display:none;\" />
															<input type=\"text\" name=\"tendonvigiaohang\" class=\"form-control\" value=\"{$tendvgh}\" required/>
														</div>
													</div>
														<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">LOGO Đơn Vị Giao Hàng</label>
														<div class=\"col-sm-9\" style=\"margin-bottom:20px;\">
														<input style=\"display:none;\" type=\"text\" name=\"logocu\" value=\"{$logo}\" >
															<img class=\"hvr-grow\" src=\"{$site_url}/images/logo/{$logo}\" width=\"200px\"  title=\"Hình ảnh sản phẩm {$tendvgh}\" />
														</div>
														<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Tải Ảnh Mới</label>
														<div class=\"col-sm-9\">
															<input type=\"file\" name=\"logomoi\" accept=\"image/*\">
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
															<button class=\"btn btn-primary\">Sửa ĐVGH</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
														</div>
													</div>
												
											</div>
			
									";
}
//Sửa sản phẩm
if(isset($_POST['token']) && $_POST['token'] == "edit")
{
	$iddvgh = $_POST['iddonvigiaohang'];
	$tendvgh = $_POST['tendonvigiaohang'];
	$logocu = $_POST['logocu'];
	if(!isset($_POST['edit_ghichu']))$ghichu = "";
	else $ghichu = $_POST['edit_ghichu'];
	// Nếu người dùng có chọn file để upload
  if($_FILES['logomoi']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['logomoi']['type'] == "image/jpeg"
        || $_FILES['logomoi']['type'] == "image/png"
        || $_FILES['logomoi']['type'] == "image/jpg"
        || $_FILES['logomoi']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/logo"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['logomoi']['tmp_name'];
                $name = $_FILES['logomoi']['name'];
                $type = $_FILES['logomoi']['type']; 
                $size = $_FILES['logomoi']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $masanpham.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = $logocu;

    $result = mysql_query("update donvigiaohang set ten='{$tendvgh}',logo='{$hinhanh}',ghichu='{$ghichu}' where id='{$iddvgh}' ");
    if($result)echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã chỉnh sửa sản phẩm {$tendvgh} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";
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
   if(isset($_POST['themdiachi']))
   {
   	//Thêm tỉnh
   	if($_POST['themdiachi'] == 'tinh')
   	{
   		$tentinh = $_POST['tentinh'];
   		$do = mysql_query("insert into add_tinh (ten) values ('{$tentinh}')");
   		if(!isset($do) or $do =="")$error = "Thêm dữ liệu bị lỗi";
   		if($tentinh =="")$error = "Bạn chưa nhập tên tỉnh";
   		if(isset($do) && $do !="")
   			echo "
<script>
						swal({
						  title: 'HOÀN TẤT',
						  text: 'Đã thêm tỉnh {$tentinh} vào hệ thống ! ',
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
   	//Thêm Huyện
   	elseif($_POST['themdiachi'] == 'huyen')
   	{
   		
   		if(!isset($_POST['id_tinh']) or ($_POST['id_tinh']) =="")
   			$error = "Bạn chưa chọn tỉnh";
   		elseif(!isset($_POST['dvgh']) or $_POST['dvgh'] == "")
   			$error = "Bạn chưa chọn đơn vị giao hàng";
   		elseif (!isset($_POST['tenhuyen']) or $_POST['tenhuyen'] =="")
   			$error = "Bạn chưa nhập tên huyện";
   		if(!isset($error) or $error =="")
   		{
   			$tenhuyen = $_POST['tenhuyen'];
   			$id_tinh = $_POST['id_tinh'];
   			$dvgh = $_POST['dvgh'];
   			$do = mysql_query("insert into add_huyen (ten,id_tinh,donvigiaohang) values ('{$tenhuyen}','{$id_tinh}','{$dvgh}')");
   			if(!isset($do) or $do =="")$error = "Thêm dữ liệu bị lỗi";
   			else echo "
						<script>
						swal({
						  title: 'HOÀN TẤT',
						  text: 'Đã thêm {$tenhuyen} vào hệ thống ! ',
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
						  text: '{$error} ! ',
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
   	//Thêm Xã
   	else
   	{
		if(!isset($_POST['id_huyen']) or ($_POST['id_huyen']) =="")
   			$error = "Bạn chưa chọn huyện";
   		elseif(!isset($_POST['dvgh']) or $_POST['dvgh'] == "")
   			$error = "Bạn chưa chọn đơn vị giao hàng";
   		elseif (!isset($_POST['tenxa']) or $_POST['tenxa'] =="")
   			$error = "Bạn chưa nhập tên xã";
   		if(!isset($error) or $error =="")
   		{
   			$tenxa = $_POST['tenxa'];
   			$id_huyen = $_POST['id_huyen'];
   			$dvgh = $_POST['dvgh'];
   			$do = mysql_query("insert into add_xa (ten,id_huyen,donvigiaohang) values ('{$tenxa}','{$id_huyen}','{$dvgh}')");
   			if(!isset($do) or $do =="")$error = "Thêm dữ liệu bị lỗi";
   			else echo "
						<script>
						swal({
						  title: 'HOÀN TẤT',
						  text: 'Đã thêm {$tenxa} vào hệ thống ! ',
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
   		

   		
   		
   	
   	}
   	//Trả dữ liệu lỗi
   	if($error!="")
   		 echo "
						<script>
						swal({
						  title: 'LỖI !!',
						  text: '{$error} ! ',
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
if(isset($_POST['address']))
{
if($_POST['address'] =="xa")
{
	$tenxa = getNameAddress($_POST['address'],'add_xa');
	if(isset($_POST["delete_add_id"]))
	{
		$id = $_POST['delete_add_id'];
		$tenxa = getNameAddress($id,'add_xa');
		$do = mysql_query("delete from add_xa where id='{$id}'");
		if($do) echo "<script>
						swal({
						  title: 'HOÀN TẤT',
						  text: 'Đã xóa {$tenxa} ra khỏi hệ thống ! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
						else  echo "
						<script>
						swal({
						  title: 'LỖI !!',
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
	

}
elseif($_POST['address'] =="huyen")
{

	if(isset($_POST["delete_add_id"]))
	{
		$id = $_POST['delete_add_id'];
		$tenxa = getNameAddress($id,'add_huyen');
		$sql = mysql_query("select id from add_xa where id='{$id}'");
		$check = mysql_num_rows($sql);
		if($check>0)
			echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Vui lòng xóa các xã bên trong trước khi xóa huyện này ! ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>
		";
		else
		{
		$do = mysql_query("delete from add_huyen where id='{$id}'");
		if($do) echo "<script>
						swal({
						  title: 'HOÀN TẤT',
						  text: 'Đã xóa {$tenxa} ra khỏi hệ thống ! ',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	location.reload();})
						</script>";
						else  echo "
						<script>
						swal({
						  title: 'LỖI !!',
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
	}
}
}
if(isset($_POST['delete_idtinh']))
{
	$id = $_POST['delete_idtinh'];
	$sql = mysql_query("select id from add_huyen where id_tinh='{$id}'");
	$check = mysql_num_rows($sql);
	if($check > 0 )
	{
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text:' Vui lòng xóa các quận/huyện bên trong trước khi xóa tỉnh này ! ',
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
}
?>