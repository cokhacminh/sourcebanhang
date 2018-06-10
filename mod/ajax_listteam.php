<?php
include("../config.php");
include("../check_access.php");


if(isset($_GET['dosomething']) && $_GET['dosomething']=='add_team')
{
	$error = "";
	if(!isset($_POST['ten']) or $_POST['ten'] == "") $error = "Bạn chưa nhập tên nhóm";
	if(!isset($_POST['mavandon']) or $_POST['mavandon'] == "") $error = "Bạn chưa nhập mã vận đơn";
	if(isset($error) && $error !="")
	{
		echo "
<script>
swal({
  title: 'CÓ LỖI',
  text: '{$error} . ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
})
</script>
		";
	}
	else
	{
	$ten = $_POST['ten'];
  $mavandon = $_POST['mavandon'];
  $hotline = $_POST['hotline'];
  $idapi = $_POST['select_api'];
	$do = mysql_query("insert into team (ten,leader,mavandon,hotline,idapi) values ('{$ten}','{$id_nhanvien}','{$mavandon}','{$hotline}','{$idapi}')");

	if($do)
  {
  $sql1 = mysql_query("select id from team where leader='{$id_nhanvien}'");
  $kq1 = mysql_fetch_array($sql1);
  $id_team = $kq1['id'];
  @mysql_query("update user set team_id='{$id_team}' where id='{$id_nhanvien}'");
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/team/".$file_name;
  $file = fopen($dir_file,'a');
  $text = $text_date." : ".$fullname." Đã tạo nhóm Sales  {$ten} - Mã vận đơn : {$mavandon} - ID nhóm : #{$id_team}.\n";
  fwrite($file,$text);
  fclose($file);
  
	echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã nhóm SALES {$ten} vào hệ thống !',
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
}


if(isset($_GET['xoateam']))
{
	$teamid = $_GET['xoateam'];
	$a = mysql_query("select ten from team where id='{$teamid}'");
	$b = mysql_fetch_array($a);
	$tenteam = $b['ten'];
	echo "
<script>
swal({
  title: 'CHÚ Ý',
  text: 'Bạn thật sự muốn xóa team {$tenteam} chứ ?? . ',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Đúng vậy !!!',
  cancelButtonText: 'Để xem lại !!!'
}).then(function () {
	deleteteam({$teamid});
  swal(
    'Đã Xóa!',
    'Bạn đã xóa team {$tenteam}.',
    'success'
  ).then(function () {
  	location.reload();})
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Cẩn thận kẻo mất dữ liệu bạn nhé',
      'error'
    )
  }
})
</script>
	";
}
if(isset($_GET['deleteteam']))
{
	$teamid = $_GET['deleteteam'];
	@mysql_query("delete from team where id='{$teamid}'");
}
if(isset($_GET['kickout']))
{
	$userId = $_GET['kickout'];
	$do = mysql_query("update user set team_id='0' where id='{$userId}'");
  $tennhanvien = getname($userId);
  $thongtinnhom = thongtinnhom($id_nhanvien);
  $tennhom = $thongtinnhom['ten'];
  if($do)
    {
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/team/".$file_name;
  $file = fopen($dir_file,'a');
  $text = $text_date." : ".$fullname." Đã xóa {$tennhanvien} ra khỏi nhóm {$tennhom}.\n";
  fwrite($file,$text);
  fclose($file);

  echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã xóa nhân viên {$tennhanvien} ra khỏi nhóm {$tennhom} !',
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

if(isset($_GET['dosomething']) && $_GET['dosomething'] == "edit_team")
{
  
  $ten = $_POST['ten'];
  $mavandon = $_POST['mavandon'];
  $hotline = $_POST['hotline'];
  $idapi = $_POST['select_api'];
  $sql = mysql_query("select ten,mavandon from team where leader='{$id_nhanvien}'");
  $kq = mysql_fetch_array($sql);
  $ten_team_cu = $kq['ten'];
  $mavandon_cu = $kq['mavandon'];
  $hotline_cu = $kq['hotline'];

  $do = mysql_query("update team set ten='{$ten}',mavandon='{$mavandon}',hotline='{$hotline}',idapi='{$idapi}' where leader='{$id_nhanvien}'");
    if($do)
    {
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/team/".$file_name;
  $file = fopen($dir_file,'a');
  $text = $text_date." : ".$fullname." Đã sửa tên nhóm {$ten_team_cu} thành {$ten} - Mã vận đơn {$mavandon_cu} thành {$mavandon} - Hotline {$hotline_cu} thành {$hotline}.\n";
  fwrite($file,$text);
  fclose($file);

  echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã sửa thông tin nhóm {$ten} thành công !',
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
//Thêm nhân viên
if(isset($_GET['dosomething']) && $_GET['dosomething'] == "add_user")
{
  
  $nv_empty = $_POST['nv_empty'];
  $sql = mysql_query("select id,ten from team where leader='{$id_nhanvien}'");
  $kq = mysql_fetch_array($sql);
  $team_id = $kq['id'];
  $tennhom = $kq['ten'];
  $count = count($nv_empty);
   $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/team/".$file_name;
  $file = fopen($dir_file,'a');
  if($count > 0)
  {
    foreach ($nv_empty as $idnhanvien) {
  $do = mysql_query("update user set team_id='{$team_id}' where id='{$idnhanvien}'"); 
  $tennhanvien = getname($idnhanvien);
  $text = $text_date." : ".$fullname." Đã thêm nhân viên {$tennhanvien} vào nhóm {$tennhom}.\n";
  fwrite($file,$text); 
    }
  
   
   }
    if($do)
    {
 
  
  fclose($file);

  echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã sửa thông tin nhóm {$ten} thành công !',
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