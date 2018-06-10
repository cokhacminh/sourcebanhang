<?php
include("../check_access.php");
include("../function/function.php");
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo $cuahang['title'];?></title>
		<meta name="keywords" content="<?php echo $cuahang['keywords'];?>">
		<meta name="author" content="<?php echo $cuahang['cuahang'];?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="../assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="../assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="../assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="../assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="../assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="../assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="../assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../assets/vendor/modernizr/modernizr.js"></script>
		<!-- Sweetalert -->
		<script src="../assets/javascripts/sweetalert/sweetalert2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/javascripts/sweetalert/sweetalert2.min.css">
	</head>
	<body>

		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="" class="logo">
						<img src="../assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
			
					<?php include("../template/userbox.php");?>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<!--Menu leftbar-->
					<?php include("menuleft.php");?>
				
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Bảng Điều Khiển</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Bảng Điều Khiển</span></li>
							</ol>
					
							<i class="fa fa-chevron-left"></i>
						</div>
					</header>

					<!-- start: page -->
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">THÊM KHU VỰC</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
									<div class="form-group">
												<label class="col-md-2 control-label">Thêm tỉnh</label>
												<div class="col-md-3">
													<input class="col-md-12 form-control" type="text" id="tentinh" placeholder="Nhập tên tỉnh vào...">
												</div>
												<div class="col-md-2">
													<button class="btn btn-primary" onclick="themtinh()">Thêm</button>

												</div>
									</div>
									
									<div class="form-group">		
											<label class="col-md-2 control-label">Xoá tỉnh</label>	
												<div class="col-md-3">
												<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Vui lòng chọn xã/thị trấn", "allowClear": true }' id="delete_idtinh" required>
													<?php 
														$sql = mysql_query("select id,ten from add_tinh order by shortname");
														while($do = mysql_fetch_array($sql))
														{
															echo "<option value='{$do['id']}'>{$do['ten']}</option>";
														}

														?>									
													</select>
												</div>
													<div class="col-md-2">
													<button class="btn btn-primary" onclick="xoatinh()">Xóa Tỉnh</button>

												</div>
											</div>
											
									<div class="form-group">
												<label class="col-md-2 control-label">Thêm Huyện</label>
												<div class="col-md-3">
													<input class="col-md-12 form-control" type="text" id="tenhuyen" placeholder="Nhập tên Quận/Huyện vào...">
												</div>

												<div class="col-md-3">
													<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Vui lòng chọn xã/thị trấn", "allowClear": true }' id="idtinh" required>
													<?php 
														$sql = mysql_query("select id,ten from add_tinh order by shortname");
														while($do = mysql_fetch_array($sql))
														{
															echo "<option value='{$do['id']}'>{$do['ten']}</option>";
														}

														?>									
													</select>
												</div>
												<div class="">
													<button class="btn btn-primary" onclick="themhuyen()">Thêm</button>

												</div>
											</div>
											
									
					

</div>
</div>
</section>
<!--Phân loại đơn vị giao hàng theo khu vực -->
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">KHU VỰC GIAO HÀNG</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">

												<div class="row">
<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>ID</th>
											<th>Khu Vực</th>
											<th>Trực Thuộc</th>
											<th class="hidden-phone">Thao Tác</th>

										</tr>
									</thead>
									<div id="list_khuvuc">
									<tbody >


										<?php
										$sql = mysql_query("select * from add_huyen");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$tenhuyen = $do['ten'];
											$donvigiaohang = $do['donvigiaohang'];
											$id_tinh = $do['id_tinh'];
											$tentinh = getNameTinh($id_tinh);
											

																						echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$id}</td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='black'>{$tenhuyen}</font></td>
											<td style=\"vertical-align: middle;text-align:center;white-space:pre-wrap;\"><font color='blue'>Tỉnh {$tentinh}({$id_tinh})</font></td>
											<td style=\"vertical-align: middle;text-align:center\"> <a class=\"hvr-float mb-xs mt-xs mr-xs btn btn-danger\" title=\"Xóa đơn vị giao hàng này\" onclick=\"xoakhuvuc_huyen({$id})\"><i class=\"fa fa-user-times\"></i> XÓA</a></td>
										</tr>
											";

										}
										?>
										

									</tbody>
								</div>
								</table>
							</div>
								
									
	</div>				

					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
									
		<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="../assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="../assets/vendor/select2/select2.js"></script>
		<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="../assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="../assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="../assets/vendor/fuelux/js/spinner.js"></script>
		<script src="../assets/vendor/dropzone/dropzone.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="../assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="../assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="../assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="../assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="../assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="../assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="../assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="../assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="../assets/vendor/summernote/summernote.js"></script>
		<script src="../assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="../assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="../assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
		<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>
		<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="../assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		<script src="../assets/javascripts/forms/examples.advanced.form.js"></script>
		<script src="../assets/javascripts/ui-elements/examples.modals.js"></script>
		<script type="text/javascript">

//Chỉnh sửa Sản Phẩm
 function themtinh(){
 	var themdiachi = "tinh";
$.ajax({
					
                    url : "../ajax/khuvucgiaohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	themdiachi,
                         tentinh : $('#tentinh').val()
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
}
 function xoatinh(){
 	
$.ajax({
					
                    url : "../ajax/khuvucgiaohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	
                         delete_idtinh : $('#delete_idtinh').val()
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
}

 function themhuyen(){
 	var themdiachi = "huyen";
$.ajax({
					
                    url : "../ajax/khuvucgiaohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	themdiachi,
                         tenhuyen : $('#tenhuyen').val(),
                         id_tinh : $('#idtinh').val(),
                         
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
}



 function xoakhuvuc_huyen(value){

                  $.ajax({
                    url : "../ajax/khuvucgiaohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	delete_add_id : value,
                    	address : 'huyen',
                    	
                    },
                    success : function (result){
                    	$('#test_result').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}


		</script>
		<div id="test_result" style="z-index: 999999">
														</div>
<?php
if($quyenhan['smod'] != "1")
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
	</body>
</html>
<?php

function getNameTinh($idtinh)
{
	$a = mysql_query("select ten from add_tinh where id='{$idtinh}'");
	$b = mysql_fetch_array($a);
	return $b['ten'];
}
function getNameHuyenvaTinh($idhuyen)
{
	$a = mysql_query("select id,ten from add_huyen where id='{$idhuyen}'");
	$b = mysql_fetch_array($a);
	$c = $b['ten'];
	$d = $b['id'];
	$e = mysql_query("select ten from add_tinh where id='{$d}'");
	$f = mysql_fetch_array($e);
	$g = $f['ten'];
	$h['tenhuyen'] = $c;
	$h['tentinh'] = $g;
	return $h;
}

?>