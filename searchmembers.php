<?php
include("db.php");
include("config.php");
//lay từ khóa cần tìm kiếm
if(isset($_GET['sdt_khachhang']) && $_GET['sdt_khachhang'] != "")
{
 $sdt = $_GET['sdt_khachhang'];
 $a = mysql_query("select * from khachhang where sdt = '{$sdt}'");
 $b = mysql_fetch_array($a);
 $c = $b['ten'];
 if(isset($c) or $c !="")
 {
 	echo "
											<div class=\"form-group\">
												<label class=\"col-md-3 control-label\">Tên Khách Hàng</label>
												<div class=\"col-md-6\">
													<div class=\"input-group input-group-icon\">
														<span class=\"input-group-addon\">
															<span class=\"icon\"><i class=\"fa fa-user\"></i></span>
														</span>
														<input name=\"tenkhachhang\" type=\"text\" class=\"form-control\" value=\"{$b['ten']}\" required>
													</div>
												</div>
											</div>
											<div class=\"form-group\">
												<label class=\"col-md-3 control-label\">Số Điện Thoại Khách Hàng</label>
												<div class=\"col-md-6\">
													<div class=\"input-group mb-md\">
														<input id=\"members\" name=\"sdtkhachhang\" type=\"text\" class=\"form-control\" value=\"{$b['sdt']}\" required>
														<span class=\"input-group-btn\">
															<button class=\"btn btn-danger\" type=\"button\" onclick =\"checkmembers()\">CHECK</button>
														</span>
													</div>

												</div>


											</div>

						<div class=\"form-group\">
												<label class=\"col-md-3 control-label\">Địa chỉ khách hàng</label>
												<div class=\"col-md-6\">
													<div class=\"input-group input-group-icon\">
														<span class=\"input-group-addon\">
															<span class=\"icon\"><i class=\"fa fa-home\"></i></span>
														</span>
														<input name=\"address\" type=\"text\" class=\"form-control\" value=\"{$b['address']}\" required>
													</div>
												</div>
											</div>
 	";
 }
 else echo "
<script>
swal({
  title: 'Dữ Liệu Trống !!',
  text: 'Số điện thoại này chưa có trong danh sách khách hàng ! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>";
}
if($_GET['sdt_khachhang'] == "")
echo "
<script>
swal({
  title: 'Dữ Liệu Trống !!',
  text: 'Số điện thoại này chưa có trong danh sách khách hàng ! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>";
?>