<?php
include("../check_access.php");
include("../function/function.php");
   if(isset($_POST['themdiachi']))
   {
   	//Thêm tỉnh
   	if($_POST['themdiachi'] == 'tinh')
   	{
   		$tentinh = $_POST['tentinh'];
   		$shortname = CreatShortName($tentinh);
   		$do = mysql_query("insert into add_tinh (ten,shortname) values ('{$tentinh}','{$shortname}')");
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
   		elseif (!isset($_POST['tenhuyen']) or $_POST['tenhuyen'] =="")
   			$error = "Bạn chưa nhập tên huyện";
   		if(!isset($error) or $error =="")
   		{
   			$tenhuyen = $_POST['tenhuyen'];
   			$id_tinh = $_POST['id_tinh'];
   			$dvgh = $_POST['dvgh'];
   			$do = mysql_query("insert into add_huyen (ten,id_tinh) values ('{$tenhuyen}','{$id_tinh}')");
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
	else 
		$do = mysql_query("delete from add_tinh where id='{$id}'");
	if($do)
		echo "
<script>
						swal({
						  title: 'HOÀN TẤT !!',
						  text:' Đã xóa địa điểm này ! ',
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


?>