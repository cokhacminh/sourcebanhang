<?php
include("check_access.php");
include("config.php");
if(!isset($nhanvienbanhang) or $nhanvienbanhang !="1")
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
  window.location = \"{$site_url}/template/errors.php\"
</script>";
function getaddress($a,$b)
{
	$sql = mysql_query("select * from {$a} where id = '{$b}'");
	$add = mysql_fetch_array($sql);
	$kq = $add['ten'];
	return $kq;
}

if(isset($_POST['tenkhachhang']))$tenkhachhang = $_POST['tenkhachhang'];else $tenkhachhang="CHƯA NHẬP TÊN KHÁCH HÀNG";
if(isset($_POST['sdtkhachhang']))$sdtkhachhang = $_POST['sdtkhachhang'];else $sdtkhachhang="CHƯA NHẬP SỐ ĐIỆN THOẠI KHÁCH HÀNG";
if(isset($_POST['add_tinh']))$add_tinh = $_POST['add_tinh'];else $add_tinh="CHƯA NHẬP TÊN TỈNH";
if(isset($_POST['add_huyen']))$add_huyen = $_POST['add_huyen'];else $add_huyen="CHƯA NHẬP TÊN HUYỆN";
if(isset($_POST['add_xa']))$add_xa = $_POST['add_xa'];else $add_xa="CHƯA NHẬP TÊN XÃ / THỊ TRẤN";
if(isset($_POST['diachi']))$diachi = $_POST['diachi'];else $diachi="CHƯA NHẬP ĐỊA CHỈ CỤ THỂ";
if(isset($_POST['sanpham']))$sanpham = $_POST['sanpham'];else $sanpham="CHƯA NHẬP SẢN PHẨM";
if(isset($_POST['ghichu']))$ghichu = $_POST['ghichu'];else $ghichu="";
$count_sanpham = count($sanpham);
$diachi_tinh = getaddress('add_tinh',$add_tinh);
$diachi_huyen = getaddress('add_huyen',$add_huyen);
$diachi_xa = getaddress('add_xa',$add_xa);
$fulldiachi = $diachi." - ".$diachi_xa." - ".$diachi_huyen."- Tỉnh ".$diachi_tinh;
if($dvgh =="auto")
{
	$sql = mysql_query("select donvigiaohang from add_xa");
	$ketqua = mysql_fetch_array($sql);
	$dvgh = $ketqua['donvigiaohang'];
}
$ten_dvgh = getNamedvgh($dvgh);
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
								<section class="panel" style="color:black">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Hoàn Tất Bán Đơn Hàng</h2>
									</header>
									<div class="panel-body">
										<?php
										if(isset($_POST['token']) && $_POST['token'] =="confirm_sell")
										{
											
											$today_sql = date('Y-m-d');
											

											$check_session_orderCode = mysql_query("select max(date) as max_date from session_donhang");

											if(mysql_num_rows($check_session_orderCode)>0)
											{
												$do_sql_check = mysql_fetch_array($check_session_orderCode);
												$max_date = strtotime($do_sql_check['max_date']);
												$max_date = date("Y-m-d",$max_date);
												if($max_date!=$today_sql or $max_date =="")
													{
														$sql_delete_session_date = 'delete from session_donhang where id >0';
														@mysql_query($sql_delete_session_date);
														@mysql_query("ALTER TABLE session_donhang AUTO_INCREMENT = 1");
														@mysql_query("insert into session_donhang (date) values ('{$today_sql}')");
													
														
													}

												
											}
											else echo "0";
											if($id_nhanvien <10)$id_nhanvien="0".$id_nhanvien;
											if(isset($_POST['tenkhachhang']))$tenkhachhang = $_POST['tenkhachhang'];else $tenkhachhang = "";
											unset($_POST['tenkhachhang']);
											if(isset($_POST['sdtkhachhang']))$sdtkhachhang = $_POST['sdtkhachhang'];else $sdtkhachhang = "";
											unset($_POST['sdtkhachhang']);
											if(isset($_POST['diachi']))$diachi = $_POST['diachi'];else $diachi = "";
											unset($_POST['diachi']);
											if(isset($_POST['phiship']))$phiship = $_POST['phiship'];else $phiship = 0;
											unset($_POST['phiship']);
											if(isset($_POST['ghichu']))$ghichu = $_POST['ghichu'];else $ghichu = "";
											if(isset($_POST['add_tinh']))$add_tinh = $_POST['add_tinh'];else $add_tinh="NULL";
											if(isset($_POST['add_huyen']))$add_huyen = $_POST['add_huyen'];else $add_huyen="NULL";
											if($add_tinh !="NULL"){$diachi_tinh = getaddress('add_tinh',$add_tinh);}else $diachi_tinh = "NULL";
											if($add_huyen !="NULL"){$diachi_huyen = getaddress('add_huyen',$add_huyen);}else $diachi_huyen = "NULL";
											unset($_POST['add_tinh']);
											unset($_POST['add_huyen']);
											unset($_POST['token']);
											unset($_POST['ghichu']);
											
											$madonhang[1] = "TK";
											$donhang = "";
											$tongtien = 0;
											$thanhtien = 0;
											$show_phiship = number_format($phiship);
											$donhang_html = "";
											$count_sp = count($_POST);
										
										if($count_sp > 1)
										{
											foreach ($_POST as $key => $value) 
											{
												$donhang .=$key."-".$value."|";
												$sql = mysql_query("select masanpham,gia from sanpham where id='{$key}'");
												$kq = mysql_fetch_array($sql);
												$gia = $kq['gia'];
												$tensanpham = $kq['masanpham'];
												$newarray[] = array("name"=>$tensanpham,"quantity"=>$value);
												$thanhtien = $value * $gia;
												$show_thanhtien = number_format($thanhtien);
												$tongtien += $thanhtien;
												$donhang_html_a= "<b><font color='black'>".$tensanpham."</font></b> : <b><font color='red'>".number_format($gia)." x ".$value." = ".$show_thanhtien." Đ</font></b><br /> ";
												$donhang_html.=$donhang_html_a;
											}
										}
										elseif($count_sp = 1)
										{
											foreach ($_POST as $key => $value) 
											{
												
												$donhang .=$key."-".$value."|";
												$sql = mysql_query("select masanpham,gia,giale from sanpham where id='{$key}'");
												$kq = mysql_fetch_array($sql);
												if($value >1 )
												$gia = $kq['gia'];
												else
												$gia = $kq['giale'];
												
												$tensanpham = $kq['masanpham'];
												$newarray[] = array("name"=>$tensanpham,"quantity"=>$value);
												$thanhtien = $value * $gia;
												$show_thanhtien = number_format($thanhtien);
												$tongtien += $thanhtien;
												$donhang_html_a= "<b><font color='black'>".$tensanpham."</font></b> : <b><font color='red'>".number_format($gia)." x ".$value." = ".$show_thanhtien." Đ</font></b><br /> ";
												$donhang_html.=$donhang_html_a;
											}
										}										
											$tongtien += $phiship;
											$show_tongtien = number_format($tongtien);
											$donhang = rtrim($donhang,"|");
											$madonhang[0] = $mavandon_team;
											$madonhang[2] = date('dm');
											$madonhang[3] = $mavandon_nhanvien;
											$sql_maxid = mysql_query("select max(id) as max_id from session_donhang");
											$maxid = mysql_fetch_array($sql_maxid);
											$madonhang[4] = $maxid['max_id'];
											@mysql_query("insert into session_donhang (date) values ('{$today_sql}')");
											if($madonhang[4] <10 ) $madonhang[4] = "0".$madonhang[4];
											$madonhang = $madonhang[0].$madonhang[1].$madonhang[2].$madonhang[3].$madonhang[4];
											$today_donhang = date("Y-m-d H:i:s");

											$insert_a = "madonhang,nhanvien,id_nhanvien,khachhang,thoigian,diachi,sdt,sanpham,phiship,tongtien,ghichu,donvivanchuyen";
$insert_b = "'{$madonhang}','{$username}','{$id_nhanvien}','{$tenkhachhang}','{$today_donhang}','{$diachi}','{$sdtkhachhang}','{$donhang}','{$phiship}','{$tongtien}','{$ghichu}','{$dvgh}'";
$do = mysql_query("insert into donhang ({$insert_a}) values ({$insert_b})");
											
											//Check members
											$sql_check_members = mysql_query("select * from khachhang where sdt = '{$sdtkhachhang}'");
											$num_rows = mysql_num_rows($sql_check_members);
											if(mysql_num_rows($sql_check_members) >0)
											{
												$kq_members = mysql_fetch_array($sql_check_members);
												$order_id_members = $kq_members['order_id'];
												if($order_id_members == "")
												
													$new_order_id_members = $madonhang;
												else $new_order_id_members = $order_id_members."-".$madonhang;											
												@mysql_query("update khachhang set order_id='{$new_order_id_members}' where sdt = '{$sdtkhachhang}'");

											}


if(isset($do)) {
	
echo "											

											
											 <div class='form-group'>
												<label class='col-md-3 control-label'>Mã đơn hàng</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$madonhang}' />
												</div>
											</div><hr />
											 <div class='form-group'>
												<label class='col-md-3 control-label'>Nhân viên bán hàng</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$fullname}' />
												</div>
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Tên Khách Hàng</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$tenkhachhang}' />
												</div>
											</div><hr />

											<div class='form-group'>
												<label class='col-md-3 control-label'>Địa chỉ Khách Hàng</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$diachi}' />
												</div>
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Số Điện Thoại Khách Hàng</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$sdtkhachhang}' />
												</div><hr />
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Đơn Hàng</label>
												<div class='col-md-9' style='text-align:right'>
													{$donhang_html}
												</div>
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Phí Ship</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$show_phiship} Đ' />
												</div>
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Tổng Tiền</label>
												<div class='col-md-9'>
													<input class='col-md-12 input_confirm' name='tenkhachhang' value='{$show_tongtien} Đ' />
												</div>
											</div><hr />
											<div class='form-group'>
												<label class='col-md-3 control-label'>Ghi Chú</label>
												<div class='col-md-9'>
													<input class='col-md-12' style='height: 100px;border: black 1px solid;color: black;font-weight: 600;font-size: 20px;' type='textarea' name='tenkhachhang' value='{$ghichu}' />
												</div>
											</div>
											<hr />
											<a class='col-md-12 mb-xs mt-xs mr-xs btn btn-danger' href='banhang.php'><i class='fa fa-home'></i> VỀ TRANG BÁN HÀNG</a>
											";
											

}
else {
echo "<script> alert('Lỗi : Không Đăng Đơn Được Lên GHTK - {$maloi_ghtk}');window.location.assign(\"{$site_url}/banhang\")</script>";}

										}
										
										?>
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