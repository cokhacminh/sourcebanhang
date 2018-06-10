<?php
include("../config.php");
include("../check_access.php");

if(isset($_GET['dosomething']) && $_GET['dosomething']=='add_api')
{
	$error = "";
	if(!isset($_POST['ten']) or $_POST['ten'] == "") $error = "Bạn chưa nhập tên nhóm";
  if(!isset($_POST['maapi']) or $_POST['maapi'] == "") $error = "Bạn chưa nhập mã API";
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
  $maapi = $_POST['maapi'];
	$do = mysql_query("insert into api (ten,maapi) values ('{$ten}','{$maapi}')");

	if($do)
	echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã thêm nhóm {$ten} - Mã API {$maapi} vào hệ thống !',
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
if(isset($_POST['idapi']))
{
  $idapi = $_POST['idapi'];
  $sql = mysql_query("select * from api where id='{$idapi}'");
  $kq = mysql_fetch_array($sql);
  $ten = $kq['ten'];
  $maapi = $kq['maapi'];

  
  echo "

                      <div class=\"panel-body\">
                        
                          <div class=\"form-group mt-lg\">
                            <label class=\"col-sm-3 control-label\">Tên Nhóm</label>
                            <div class=\"col-sm-9\">
                            <input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
                            <input type=\"text\" name=\"edit_idapi\" value=\"{$idapi}\" style=\"display:none;\" />
                              <input type=\"text\" name=\"edit_ten\" class=\"form-control\" value=\"{$ten}\" required/>
                            </div>
                          </div>
                          <div class=\"form-group mt-lg\">
                            <label class=\"col-sm-3 control-label\">Mã API</label>
                            <div class=\"col-sm-9\">
                              <input type=\"text\" name=\"maapi\" class=\"form-control\" value=\"{$maapi}\" required/>
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
  $id = $_POST['edit_idapi'];
  $ten = $_POST['edit_ten'];
  $maapi = $_POST['maapi'];
  $do = mysql_query("update api set  ten='{$ten}',maapi='{$maapi}' where id='{$id}'");
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