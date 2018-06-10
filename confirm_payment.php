<?php
include("check_access.php");
include("config.php");
function getaddress($a,$b)
{
	$sql = mysql_query("select * from {$a} where id = '{$b}'");
	$add = mysql_fetch_array($sql);
	$kq = $add['ten'];
	return $kq;
}

if(isset($_POST['tenkhachhang']))$tenkhachhang = $_POST['tenkhachhang'];else $tenkhachhang="CHƯA NHẬP TÊN KHÁCH HÀNG";
if(isset($_POST['sdtkhachhang']))$sdtkhachhang = $_POST['sdtkhachhang'];else $sdtkhachhang="CHƯA NHẬP SỐ ĐIỆN THOẠI KHÁCH HÀNG";
if(isset($_POST['add_tinh']))$add_tinh = $_POST['add_tinh'];else $add_tinh=0;
if(isset($_POST['add_huyen']))$add_huyen = $_POST['add_huyen'];else $add_huyen=0;
if(isset($_POST['add_xa']))$add_xa = $_POST['add_xa'];else $add_xa=0;
if(isset($_POST['diachi']))$diachi = $_POST['diachi'];else $diachi="CHƯA NHẬP ĐỊA CHỈ CỤ THỂ";
if(isset($_POST['sanpham']))$sanpham = $_POST['sanpham'];else $sanpham="CHƯA NHẬP SẢN PHẨM";
$count_sanpham = count($sanpham);
$diachi_tinh = getaddress('add_tinh',$add_tinh);
$diachi_huyen = getaddress('add_huyen',$add_huyen);
$diachi_xa = getaddress('add_xa',$add_xa);
$fulldiachi = $diachi." - ".$diachi_huyen."- ".$diachi_tinh;
if(isset($_POST['address']))$fulldiachi = $_POST['address'];
if($dvgh =="auto")
{
	$sql = mysql_query("select donvigiaohang from add_xa");
	$ketqua = mysql_fetch_array($sql);
	$dvgh = $ketqua['donvigiaohang'];
}
$ten_dvgh = getNamedvgh($dvgh);
$sql_checkkhachhang = mysql_query("select * from khachhang where sdt='{$sdtkhachhang}'");
if(mysql_num_rows($sql_checkkhachhang) < 1)
{
@mysql_query("insert into khachhang (ten,sdt,id_tinh,id_huyen,id_xa,address) values ('{$tenkhachhang}','{$sdtkhachhang}','{$add_tinh}','{$add_huyen}','{$add_xa}','{$fulldiachi}')");
}
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Bán Hàng | <?php echo $cuahang['title'];?></title>
		<meta name="keywords" content="<?php echo $cuahang['keywords'];?>" />
		<meta name="description" content="<?php echo $cuahang['cuahang'];?>">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<!-- Xu Ly Dia Chi-->
<script type="text/javascript">
            function change_tinh(value){
                $.ajax({
                    url : "ajax_diachi.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         id_tinh : value,

                    },
                    success : function (result){
                        $('#address_huyen').html(result);
                    }
                });
            }
           
            function change_huyen(value){
                $.ajax({
                    url : "ajax_diachi.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         id_huyen : value,

                    },
                    success : function (result){
                        $('#address_xa').html(result);
                    }
                });
            }

</script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="" class="logo">
						<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			<?php include("template/userbox.php");?>
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
						<h2>Bán Hàng</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Bán Hàng</span></li>
								
							</ol>
					
							<i class="fa fa-chevron-left"></i>
						</div>
					</header>

					<!-- start: page -->
						<div class="row" style="font-size: 16px;">
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Xác Nhận Lại Đơn Hàng</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="hoantatbanhang" method="post">

											<div class="form-group">
												<label class="col-md-3 control-label">Tên Khách Hàng</label>
												<div class="col-md-9">
													<input style="display:none;" type="text" name="token" value="confirm_sell">
													<input class="col-md-12 input_confirm" name="tenkhachhang" value="<?php echo $tenkhachhang;?>" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Số Điện Thoại Khách Hàng</label>
												<div class="col-md-9">
													<input class="col-md-12 input_confirm" name="sdtkhachhang" value="<?php echo $sdtkhachhang;?>" />
												</div>
											</div>

									
											<div class="form-group">
												<label class="col-md-3 control-label">Địa chỉ khách hàng</label>
												<div class="col-md-9">
												<input type="text" name="add_huyen" value="<?php echo $add_huyen;?>" style="display:none"/>
												<input type="text" name="add_tinh" value="<?php echo $add_tinh;?>" style="display:none"/>
													<input class="col-md-12 input_confirm" name="diachi" value="<?php echo $fulldiachi;?>" />
												</div>
											</div>
											
													<?php
													foreach ($sanpham as $key => $value) {
														$sql = mysql_query("select * from sanpham where id='{$value}'");
														$ten_sp = mysql_fetch_array($sql);
														$masanpham = $ten_sp['masanpham'];
														$soluong = $ten_sp['soluong'];
														echo "

												<div class=\"form-group\">
												<label class=\"col-md-3 control-label\">Sản Phẩm</label>
												<div class=\"col-md-9\">
													<div class=\"col-md-4\" style=\"display:inline\" >
												
													</div>
													<div class=\"col-md-4\" style=\"display:inline;text-align:right;\" >
													{$masanpham} ( Kho còn : <font color='red'>{$soluong} Cái</font> )
													</div>
													<div class=\"col-md-4\" style=\"float:right\" data-plugin-spinner data-plugin-options='{ \"value\":1, \"min\": 1, \"max\": 10 }'>
														<div class=\"input-group\" style=\"width:120px;float:right\">
															<input style=\"height:39px;\" name=\"{$value}\" type=\"text\" class=\"spinner-input form-control\" maxlength=\"3\">
															<div class=\"spinner-buttons input-group-btn\">
																<button type=\"button\" class=\"btn btn-success spinner-up\">
																	<i class=\"fa fa-plus\"></i>
																</button>
																<button type=\"button\" class=\"btn btn-danger spinner-down\">
																	<i class=\"fa fa-minus\"></i>
																</button> 
															</div>
														</div>
													</div>
													</div>
												</div>	";
													}
													
													?>
											<div class="form-group">
												<label class="col-md-3 control-label">Phí Vận Chuyển</label>
												<div class="col-md-9">
													<div class="col-md-4" style="display:inline" >
												
													</div>
													<div class="col-md-4" style="display:inline;text-align:right;" >
													
													</div>
													<div class="col-md-4" style="float:right" data-plugin-spinner data-plugin-options='{ "value":0, "step": 5000, "min": 0, "max": 200000 }'>
														<div class="input-group" style="width:170px;float:right">
															<?php
															if($count_sanpham < 5)
																echo "
																														<input style=\"height: 39px;\" value=\"30000\" name=\"phiship\" type=\"text\" class=\"spinner-input form-control\" maxlength=\"3\">
															<div class=\"spinner-buttons input-group-btn\">
																<button type=\"button\" class=\"btn btn-success spinner-up\">
																	<i class=\"fa fa-plus\"></i>
																</button>
																<button type=\"button\" class=\"btn btn-danger spinner-down\">
																	<i class=\"fa fa-minus\"></i>
																</button>
															</div>			
															";
															elseif($count_sanpham>=5) echo "
																	<input style=\"height: 39px;\" value=\"Free Ship\" type=\"text\" class=\"spinner-input form-control\" maxlength=\"3\" disabled>
																";
															?>

														</div>
													</div>
													</div>
												</div>

												<div class="form-group">
												<label class="col-md-3 control-label">Ghi Chú</label>
												<div class="col-md-9">
													<div class="" style="float: right;margin-right: 15px">
																<textarea style="width: 500px;height: 100px" name="ghichu"></textarea>

																
															</div>
														</div>
																																										
												</div>
											</div>
											<hr />
											<button class="col-md-12 mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> BÁN HÀNG</button>
											<a class="col-md-12 mb-xs mt-xs mr-xs btn btn-danger" href="banhang.php"><i class="fa fa-times"></i> HUỶ ĐƠN HÀNG</a>
										</form>
									</div>
								</section>
							</div>
						</div>
						
						
						
						
					<!-- end: page -->
				</section>
			</div>
<!-- Modal Form -->
									
			
		</section>
<div id="result">
</div>
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.advanced.form.js"></script>
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
<!--Xu ly dia chi-->

	</body>
</html>