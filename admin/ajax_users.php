<?php
include("../config.php");
include("../check_access.php");

if(isset($_GET['dosomething']) && $_GET['dosomething']=='add_user')
{
	$error = "";
	if(!isset($_POST['tentaikhoan']) or $_POST['tentaikhoan'] == "") $error = "Bạn chưa nhập username";
	if(!isset($_POST['passwd']) or $_POST['passwd'] == "") $error = "Bạn chưa nhập password";
	if(!isset($_POST['tendaydu']) or $_POST['tendaydu'] == "") $error = "Bạn chưa nhập tên đầy đủ";
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
	$username = $_POST['tentaikhoan'];
	$fullname = $_POST['tendaydu'];
	$passwd = md5($_POST['passwd']);
	$groupid = $_POST['nhom'];
	$do = mysql_query("insert into user (username,fullname,passwd,groupid) values ('{$username}','{$fullname}','{$passwd}','{$groupid}')");

	if($do)
	echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã thêm tài khoản {$username} vào hệ thống !',
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


if(isset($_GET['userid']))
{
	$userId = $_GET['userid'];
	$fullname = getname($userId);
	echo "
<script>
swal({
  title: 'CHÚ Ý',
  text: 'Bạn thật sự muốn xóa tài khoản {$fullname} chứ ?? . ',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Đúng vậy !!!',
  cancelButtonText: 'Để xem lại !!!'
}).then(function () {
	deleteuser({$userId});
  swal(
    'Đã Xóa!',
    'Bạn đã xóa tài khoản {$fullname}.',
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
if(isset($_GET['deleteuser']))
{
	$userId = $_GET['deleteuser'];
	@mysql_query("delete from user where id='{$userId}'");
}
//Sửa tài khoản
if(isset($_POST['idtaikhoan']))
{
  $idtaikhoan = $_POST['idtaikhoan'];
  $sql = mysql_query("select * from user where id='{$idtaikhoan}'");
  $kq = mysql_fetch_array($sql);
  $tentaikhoan = $kq['username'];
  $tendaydu = $kq['fullname'];
  $groupid = $kq['groupid'];
  $passwd = $kq['passwd'];
  $sql_checkbox = mysql_query("select id,ten from usergroup where id!='1'");
  $checkbox = "";
  while($data_checkbox = mysql_fetch_array($sql_checkbox))
  {
    if($data_checkbox['id'] == $groupid)
    $checkbox.="<div class=\"radio-custom\" style=\"display:inline\">
                                <input type=\"radio\" id=\"checkbox{$data_checkbox['id']}\" name=\"nhom\" value=\"{$data_checkbox['id']}\" checked=\"checked\">
                                <label for=\"checkbox{$data_checkbox['id']}\">{$data_checkbox['ten']}</label> 
                              </div>";
  else           $checkbox.="<div class=\"radio-custom\" style=\"display:inline\">
                                <input type=\"radio\" id=\"checkbox{$data_checkbox['id']}\" name=\"nhom\" value=\"{$data_checkbox['id']}\" >
                                <label for=\"checkbox{$data_checkbox['id']}\">{$data_checkbox['ten']}</label> 
                              </div>";                     
  }
  
  echo "

                      <div class=\"panel-body\">
                        
                          <div class=\"form-group mt-lg\">
                            <label class=\"col-sm-3 control-label\">Tên tài khoản</label>
                            <div class=\"col-sm-9\">
                            <input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
                            <input type=\"text\" name=\"edit_idtaikhoan\" value=\"{$idtaikhoan}\" style=\"display:none;\" />
                              <input type=\"text\" name=\"edit_tentaikhoan\" class=\"form-control\" value=\"{$tentaikhoan}\" required/>
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Tên đầy đủ</label>
                            <div class=\"col-sm-9\">
                              <input type=\"text\" name=\"edit_tendaydu\"  class=\"form-control\" value=\"{$tendaydu}\" required/>
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Chức Vụ</label>
                            <div class=\"col-sm-9\">
                              {$checkbox}
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Mật khẩu mới</label>
                            <div class=\"col-sm-9\">
                              <input type=\"password\" name=\"edit_passwd\" class=\"form-control\" />
                            </div>
                          </div>

                          <div class=\"form-group\">
                            
                            <div class=\"col-sm-12\" style=\"text-align: center\">
                              <button class=\"btn btn-primary\">Sửa Tài Khoản</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
                            </div>
                          </div>
                        
                      </div>
      
                  ";
}
if(isset($_POST['token_edit']))
{
  $idtaikhoan = $_POST['edit_idtaikhoan'];
  $tentaikhoan = $_POST['edit_tentaikhoan'];
  $tendaydu = $_POST['edit_tendaydu'];
  $nhom = $_POST['nhom'];
  if(isset($_POST['edit_passwd']) && $_POST['edit_passwd'] !="")
  {
    $passwd = md5($_POST['edit_passwd']);
    $sql ="update user set username='{$tentaikhoan}',passwd='{$passwd}',fullname='{$tendaydu}',groupid='{$nhom}' where id='{$idtaikhoan}'";
  }
  else $sql = "update user set username='{$tentaikhoan}',fullname='{$tendaydu}',groupid='{$nhom}' where id='{$idtaikhoan}'";
  $do = mysql_query($sql);
    if($do)
  echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã sửa thông tin tài khoản {$tentaikhoan} thành công !',
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