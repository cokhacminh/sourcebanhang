<?php
include("../db.php");
if(isset($_GET['array_product']))
{
	$array_product = $_GET['array_product'];
	$count_array = count($array_product);
	echo "
												<label class=\"col-md-3 control-label\">{$array_product}Số Điện Thoại Khách Hàng {$count_array}</label>
												<div class=\"col-md-6\">
													<div class=\"input-group input-group-icon\">
														<span class=\"input-group-addon\">
															<span class=\"icon\"><i class=\"fa fa-phone\"></i></span>
														</span>
														<input id=\"sdtkhachhang\" type=\"text\" class=\"form-control\" placeholder=\"Số Điện Thoại\" required>
													</div>
												</div>
	";
}
if(isset($_POST['payment_confirm']))
{
	$error = "";
	if(!isset($_POST['tenkhachhang']))
		$error = "Bạn chưa nhập tên khách hàng";
	elseif(!isset($_POST['sdtkhachhang']))
		$error = "Bạn chưa nhập số điện thoại khách hàng";
	elseif(!isset($_POST['add_tinh']))
		$error = "Bạn chưa nhập tên tỉnh";
	elseif(!isset($_POST['add_huyen']))
		$error .= " / Bạn chưa nhập tên huyện";
	elseif(!isset($_POST['add_xa']))
		$error .= " / Bạn chưa nhập tên xã / thị trấn";
	elseif(!isset($_POST['diachi']))
		$error .= " / Bạn chưa nhập địa chỉ chi tiết";
	elseif(!isset($_POST['sanpham']))
		$error = "Bạn chưa nhập sản phẩm khách mua hàng";
	elseif(!isset($_POST['dvgh']))
		$error = "Bạn chưa chọn đơn vị giao hàng";
	else
	{
		$tenkhachhang = $_POST['tenkhachhang'];
		$sdtkhachhang = $_POST['sdtkhachhang'];
		$add_tinh = $_POST['add_tinh'];
		$add_huyen = $_POST['add_huyen'];
		$add_xa = $_POST['add_xa'];
		$diachi = $_POST['diachi'];
		$sanpham = $_POST['sanpham'];
		$dvgh = $_POST['dvgh'];
		echo "<div id=\"modalForm\" class=\"modal-block modal-block-primary mfp-hide\">
										<section class=\"panel\">
											<header class=\"panel-heading\">
												<h2 class=\"panel-title\">Xác Thực Lại Thông Tin</h2>
											</header>
											<div class=\"panel-body\">
												<form id=\"demo-form\" class=\"form-horizontal mb-lg\" novalidate=\"novalidate\">
													<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Name</label>
														<div class=\"col-sm-9\">
															<input type=\"text\" name=\"name\" class=\"form-control\" placeholder=\"Type your name...\" required/>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Email</label>
														<div class=\"col-sm-9\">
															<input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Type your email...\" required/>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">URL</label>
														<div class=\"col-sm-9\">
															<input type=\"url\" name=\"url\" class=\"form-control\" placeholder=\"Type an URL...\" />
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">State</label>
														<div class=\"col-sm-9\">
															<select data-plugin-selectTwo class=\"form-control populate\">
																
																	<option value=\"CA\">California</option>
																	<option value=\"NV\">Nevada</option>
																	<option value=\"OR\">Oregon</option>
																	<option value=\"WA\">Washington</option>
																
															</select>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Comment</label>
														<div class=\"col-sm-9\">
															<textarea rows=\"5\" class=\"form-control\" placeholder=\"{$tenkhachhang} | {$sdtkhachhang} | {$diachi} - {$add_xa} - {$add_huyen} - {$add_tinh} | {$sanpham} | {$dvgh}\" required></textarea>
														</div>
													</div>
												</form>
											</div>
											<footer class=\"panel-footer\">
												<div class=\"row\">
													<div class=\"col-md-12 text-right\">
														<button class=\"btn btn-primary modal-confirm\">Submit</button>
														<button class=\"btn btn-default modal-dismiss\">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									
";
	}
	if($error != "")
		echo $error;

}






?>