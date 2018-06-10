<?php
include("../check_access.php");
include("../function/function.php");

if(isset($_GET['dosomething']) && $_GET['dosomething']=='add_user')
{
  $error = "";
  if(!isset($_POST['tentaikhoan']) or $_POST['tentaikhoan'] == "") $error = "Bạn chưa nhập username";
  if(!isset($_POST['passwd']) or $_POST['passwd'] == "") $error = "Bạn chưa nhập password";
  if(!isset($_POST['tendaydu']) or $_POST['tendaydu'] == "") $error = "Bạn chưa nhập tên đầy đủ";
  if(!isset($_POST['mavandon']) or $_POST['mavandon'] == "") $error = "Bạn chưa nhập mã vận đơn";
  $username = $_POST['tentaikhoan'];
  $tendaydu = $_POST['tendaydu'];
  $passwd = md5($_POST['passwd']);
  $chucvu = $_POST['chucvu'];
  $mavandon = $_POST['mavandon'];
  $checkusername = mysql_query("select id from user where username='{$username}'");
  $rows_of_user = mysql_num_rows($checkusername);
  if($rows_of_user > 0)
  $error = "Tên tài khoản {$username} đã tồn tại";
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
.then(function () {
location.reload();
})
</script>
    ";
  }
  else
  {

   
  $do = mysql_query("insert into user (username,fullname,passwd,groupid,mavandon) values ('{$username}','{$tendaydu}','{$passwd}','{$chucvu}','{$mavandon}')");
  if($do)
  {
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/taikhoan/".$file_name;
  $file = fopen($dir_file,'a');
  $idusername = getDataWhere("id","user","username",$username);
  $id = $idusername['id'];
  $text = $text_date." : ".$fullname." Đã thêm tài khoản {$username} - Mã vận đơn : {$mavandon} - ID : {$id}.\n";
  fwrite($file,$text);
  fclose($file);
  
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
  $sql = mysql_query("select * from user where id='{$userId}'");
  $kq = mysql_fetch_array($sql);
  $tentaikhoan = $kq['username'];
  $mavandon = $kq['mavandon'];
	$do = mysql_query("delete from user where id='{$userId}'");
    if($do)
  {
    $date = date("d-m-Y");
    $text_date = date("H:i:s - d/m/Y");
    $file_name = $date.".txt";
    $dir_file = "../admin/logs/quanly/taikhoan/".$file_name;
    $file = fopen($dir_file,'a');
    
    $text = $text_date." : ".$fullname." Đã xóa tài khoản {$tentaikhoan} - Mã vận đơn : {$mavandon} - ID : {$userId}.\n";
    fwrite($file,$text);
    fclose($file);
  }
}
//Sửa tài khoản
if(isset($_POST['idtaikhoan']))
{
  $input_p = "";
  $input_luong = "";
  $idtaikhoan = $_POST['idtaikhoan'];
  $sql = mysql_query("select * from user where id='{$idtaikhoan}'");
  $kq = mysql_fetch_array($sql);
  $tentaikhoan = $kq['username'];
  $tendaydu = $kq['fullname'];
  $groupid = $kq['groupid'];
  $luongcung = $kq['luongcung'];
  $calamviec = $kq['calamviec'];
  if($calamviec == "Ca Sáng")
  {
	  $input_calamviec = "<div class=\"form-group\">
<label class=\"col-sm-3 control-label\">Ca Làm Việc</label>
	<div class=\"col-sm-9\">						
		<div class=\"radio-custom radio-primary col-sm-6\">
		<input type=\"radio\" id=\"radioExample3\" name=\"calamviec\" value=\"Ca Sáng\" checked=\"checked\">																
		<label for=\"radioExample3\"><font color=\"blue\"><b>Ca Sáng</b></font></label>																														
		</div>	
		
		<div class=\"radio-custom radio-success col-sm-6\">															
		<input type=\"radio\" id=\"radioExample4\" name=\"calamviec\" value=\"Ca Tối\">															
		<label for=\"radioExample4\"><font color=\"green\"><b>Ca Tối</b></font></label>
		</div>																
	</div>
</div>";
  }
  else 
  {
	  $input_calamviec = "
	  <div class=\"form-group\">
<label class=\"col-sm-3 control-label\">Ca Làm Việc</label>
	<div class=\"col-sm-9\">						
		<div class=\"radio-custom radio-primary col-sm-6\">
		<input type=\"radio\" id=\"radioExample3\" name=\"calamviec\" value=\"Ca Sáng\">																
		<label for=\"radioExample3\"><font color=\"blue\"><b>Ca Sáng</b></font></label>																														
		</div>	
		
		<div class=\"radio-custom radio-success col-sm-6\">															
		<input type=\"radio\" id=\"radioExample4\" name=\"calamviec\" value=\"Ca Tối\" checked=\"checked\">															
		<label for=\"radioExample4\"><font color=\"green\"><b>Ca Tối</b></font></label>
		</div>																
	</div>
</div>
	  ";
  }
  $chinhanh = $kq['chinhanh'];
  if($chinhanh =="Sài Gòn")
  {
	  $input_chinhanh = "
	  <div class=\"form-group\">
<label class=\"col-sm-3 control-label\">Chi Nhánh</label>
	<div class=\"col-sm-9\">						
		<div class=\"radio-custom radio-primary col-sm-6\">
		<input type=\"radio\" id=\"radioExample1\" name=\"chinhanh\" value=\"Nha Trang\">																
		<label for=\"radioExample1\"><font color=\"blue\"><b>Nha Trang</b></font></label>																														
		</div>	
		
		<div class=\"radio-custom radio-success col-sm-6\">															
		<input type=\"radio\" id=\"radioExample2\" name=\"chinhanh\" value=\"Sài Gòn\" checked=\"checked\">															
		<label for=\"radioExample2\"><font color=\"green\"><b>Sài Gòn</b></font></label>
		</div>																
	</div>
</div>
	  ";
  }
  else
  {
	  $input_chinhanh = "
	  <div class=\"form-group\">
<label class=\"col-sm-3 control-label\">Chi Nhánh</label>
	<div class=\"col-sm-9\">						
		<div class=\"radio-custom radio-primary col-sm-6\">
		<input type=\"radio\" id=\"radioExample1\" name=\"chinhanh\" value=\"Nha Trang\" checked=\"checked\">																
		<label for=\"radioExample1\"><font color=\"blue\"><b>Nha Trang</b></font></label>																														
		</div>	
		
		<div class=\"radio-custom radio-success col-sm-6\">															
		<input type=\"radio\" id=\"radioExample2\" name=\"chinhanh\" value=\"Sài Gòn\">															
		<label for=\"radioExample2\"><font color=\"green\"><b>Sài Gòn</b></font></label>
		</div>																
	</div>
</div>
	  ";
  }
  if($quyenhan['smod'] =="1")
  $input_luong = "<div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Lương Cứng</label>
                            <div class=\"col-sm-9\">
                              <input type=\"number\" name=\"luongcung\"  class=\"form-control\" value=\"{$luongcung}\" required/>
                            </div>
                          </div>";
  //Check Quản Lý
  $check_db_usergroup = getDataWhere("*","usergroup","id",$groupid);
  $group = $check_db_usergroup['ten'];
  $check_permission = $check_db_usergroup['quanlynhanvien'];
  if($check_permission =="1")
    {
      $permission="quanly";
      echo "<script>
alert('Không thể sửa tài khoản cấp Quản Lý . Vui lòng liên hệ Boss để chỉnh sửa');
location.reload();

</script>";
    }
    
	else
  { 
  //Kết Thúc
  $mavandon = $kq['mavandon'];
  $passwd = $kq['passwd'];
  echo "

                      <div class=\"panel-body\">
                        
                          <div class=\"form-group mt-lg\">
                            <label class=\"col-sm-3 control-label\">Tên tài khoản</label>
                            <div class=\"col-sm-9\">
                            <input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
                            <input type=\"text\" name=\"edit_idtaikhoan\" value=\"{$idtaikhoan}\" style=\"display:none;\" />
                              <input type=\"text\" name=\"edit_tentaikhoan\" class=\"form-control\" value=\"{$tentaikhoan}\" disabled/>
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Tên đầy đủ</label>
                            <div class=\"col-sm-9\">
                              <input type=\"text\" name=\"edit_tendaydu\"  class=\"form-control\" value=\"{$tendaydu}\" required/>
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Mã Vận Đơn</label>
                            <div class=\"col-sm-9\">
                              <input type=\"text\" name=\"mavandon\"  class=\"form-control\" value=\"{$mavandon}\" required/>
                            </div>
                          </div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Mật khẩu mới</label>
                            <div class=\"col-sm-9\">
                              <input type=\"password\" name=\"edit_passwd\" class=\"form-control\" />
                            </div>
                          </div>
						  {$input_luong}
							{$input_calamviec}
							{$input_chinhanh}
                          <div class=\"form-group\">
                            
                            <div class=\"col-sm-12\" style=\"text-align: center\">
                              <button class=\"btn btn-primary\">Sửa Tài Khoản</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
                            </div>
                          </div>
							
                      </div>
      
                  ";
                }
}
if(isset($_POST['token_edit']))
{
  $update_luong = "";	
  $idtaikhoan = $_POST['edit_idtaikhoan'];
  $tendaydu = $_POST['edit_tendaydu'];
  $mavandon = $_POST['mavandon'];
  $data = getDataWhere("*","user","id",$idtaikhoan);
  $username_cu = $data['username'];
  $tendaydu_cu = $data['fullname'];
  $mavandon_cu = $data['mavandon'];
  $chinhanh = $_POST['chinhanh'];
  if($quyenhan['smod'] =="1")
  {
	$luongcung = $_POST['luongcung'];
	$update_luong = ",luongcung='{$luongcung}'";
  }
  
  if($chinhanh =="")$chinhanh = "Sài Gòn";
  $calamviec = $_POST['calamviec'];
  if($calamviec == "")$calamviec = "Ca Sáng";
  if(isset($_POST['edit_passwd']) && $_POST['edit_passwd'] !="")
  {
    $passwd = md5($_POST['edit_passwd']);
    $sql ="update user set passwd='{$passwd}',fullname='{$tendaydu}',mavandon='{$mavandon}',chinhanh='{$chinhanh}',calamviec='{$calamviec}'{$update_luong} where id='{$idtaikhoan}'";
  }
  else $sql = "update user set fullname='{$tendaydu}',mavandon='{$mavandon}',chinhanh='{$chinhanh}',calamviec='{$calamviec}'{$update_luong} where id='{$idtaikhoan}'";
  $do = mysql_query($sql);
    if($do)
    {
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/quanly/taikhoan/".$file_name;
  $file = fopen($dir_file,'a');
  $text = $text_date." : ".$fullname." Đã sửa tài khoản {$username_cu} thành {$tentaikhoan} - Mã vận đơn {$mavandon_cu} thành {$mavandon}.\n";
  fwrite($file,$text);
  fclose($file);

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
