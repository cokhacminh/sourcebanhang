<?php
include("../config.php");
include("../check_access.php");

if(isset($_GET['dosomething']) && $_GET['dosomething']=='add_user')
{
	$error = "";
	if(!isset($_POST['ten']) or $_POST['ten'] == "") $error = "Bạn chưa nhập tên nhóm";
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
	$quanlynhanvien = ($_POST['quanlynhanvien'] == '1') ? "1" : "0";
  $xuatkho = ($_POST['xuatkho'] == '1') ? "1" : "0";
  $nhapkho = ($_POST['nhapkho'] == '1') ? "1" : "0";
  $banhang = ($_POST['banhang'] == '1') ? "1" : "0";


	$do = mysql_query("insert into usergroup (ten,quanlynhanvien,xuatkho,nhapkho,banhang) values ('{$ten}','{$quanlynhanvien}','{$xuatkho}','{$nhapkho}','{$banhang}')");

	if($do)
	echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã thêm nhóm {$ten} vào hệ thống !',
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
  text: 'Vui lòng kiểm tra dữ lại dữ liệu nhập vào .',
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


if(isset($_GET['idnhom']))
{
	$idnhom = $_GET['idnhom'];
  $data = getDataWhere("ten","usergroup","id",$idnhom);
  $ten = $data['ten'];

	echo "
<script>
swal({
  title: 'CHÚ Ý',
  text: 'Bạn thật sự muốn xóa tài khoản {$ten} chứ ?? . ',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Đúng vậy !!!',
  cancelButtonText: 'Để xem lại !!!'
}).then(function () {
	xoanhomid({$idnhom});
  swal(
    'Đã Xóa!',
    'Bạn đã xóa tài khoản {$ten}.',
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
if(isset($_GET['xoanhomid']))
{
	$idnhom = $_GET['xoanhomid'];
	@mysql_query("delete from usergroup where id='{$idnhom}'");
}
//Sửa tài khoản
if(isset($_POST['idnhom']))
{
  $idnhom = $_POST['idnhom'];
  $sql = mysql_query("select * from usergroup where id='{$idnhom}'");
  $kq = mysql_fetch_array($sql);
  $ten = $kq['ten'];

  
  echo "

                      <div class=\"panel-body\">
                        
                          <div class=\"form-group mt-lg\">
                            <label class=\"col-sm-3 control-label\">Tên Nhóm</label>
                            <div class=\"col-sm-9\">
                            <input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
                            <input type=\"text\" name=\"edit_idnhom\" value=\"{$idnhom}\" style=\"display:none;\" />
                              <input type=\"text\" name=\"edit_ten\" class=\"form-control\" value=\"{$ten}\" required/>
                            </div>
                          </div>

                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Quyền Hạn</label>
                            <div class=\"col-sm-9\">
                              <div class=\"checkbox-custom checkbox-primary\">
                                <input type=\"checkbox\" id=\"checkboxExample1\" name=\"quanlynhanvien\" value=\"1\">
                                <label for=\"checkboxExample1\">QL Nhân Viên</label>
                              </div>
                              <div class=\"checkbox-custom checkbox-success\">
                                <input type=\"checkbox\" id=\"checkboxExample2\" name=\"nhapkho\" value=\"1\">
                                <label for=\"checkboxExample2\">QL Nhập Kho</label>
                              </div>
                              <div class=\"checkbox-custom checkbox-warning\">
                                <input type=\"checkbox\" id=\"checkboxExample3\" name=\"xuatkho\" value=\"1\">
                                <label for=\"checkboxExample3\">QL Xuất Kho</label>
                              </div>
                              <div class=\"checkbox-custom checkbox-danger\">
                                <input type=\"checkbox\" id=\"checkboxExample4\" name=\"banhang\" value=\"1\">
                                <label for=\"checkboxExample4\">Bán Hàng</label>
                              </div>
                            </div>
                          </div>
                          
                          <div class=\"form-group\">
                            
                            <div class=\"col-sm-12\" style=\"text-align: center\">
                              <button class=\"btn btn-primary\">Sửa Nhóm</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
                            </div>
                          </div>
                        
                      </div>
      
                  ";
}
if(isset($_POST['token_edit']))
{
  $id = $_POST['edit_idnhom'];
  $ten = $_POST['edit_ten'];
  $quanlynhanvien = ($_POST['quanlynhanvien'] == '1') ? "1" : "0";
  $xuatkho = ($_POST['xuatkho'] == '1') ? "1" : "0";
  $nhapkho = ($_POST['nhapkho'] == '1') ? "1" : "0";
  $banhang = ($_POST['banhang'] == '1') ? "1" : "0";
  $do = mysql_query("update usergroup set  ten='{$ten}',quanlynhanvien='{$quanlynhanvien}',xuatkho='{$xuatkho}',nhapkho='{$nhapkho}',banhang='{$banhang}' where id='{$id}'");
    if($do)
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