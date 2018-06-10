<?php
include("../config.php");
include("../check_access.php");
$today = date("Y-m-d");
$formtoday = date("d/m/Y");
if(isset($_POST['chiphihangngay']))
{
	$kiem = "";
	$ngay = $_POST['ngay'];
	$b = explode("/", $ngay);
    $ngay = $b[2]."-".$b[1]."-".$b[0];
	//echo "<script>alert('{$ngay}')</script>";
	array_pop($_POST);
	array_pop($_POST);
	$a = mysql_query("select id from chiphihangngay where ngay='{$ngay}'");
	$rows = mysql_num_rows($a);
	if($rows == 0 )
	{
		foreach($_POST as $id=>$value)
		{
			@mysql_query("insert into chiphihangngay (idchiphi,sotien,ngay) values ('{$id}','{$value}','{$ngay}')");
		}
	}
	elseif($rows > 0 )
	{
		foreach($_POST as $id=>$value)
		{
		@mysql_query("update chiphihangngay set sotien='{$value}' where idchiphi ='{$id}' and ngay = '{$ngay}'");
		}
	}
	
}
if(isset($_POST['chiphicodinh']))
{
	$kiem = "";
	array_pop($_POST);
	foreach($_POST as $id=>$value)
	{
		@mysql_query("update chiphi set sotien='{$value}' where id='{$id}'");
	}
	
}
if(isset($_POST['chiphitheodon']))
{
	$kiem = "";
	array_pop($_POST);
	foreach($_POST as $id=>$value)
	{
		@mysql_query("update chiphi set sotien='{$value}' where id='{$id}'");
	}
	
}
$nums_day_of_month = date("t");


///
function tinhchiphi($ngay)
{
	global $nums_day_of_month;
	//Tiền lương nhân viên
	$a = mysql_query("select id from user where id!='1'");
	$tongsonhanvien = mysql_num_rows($a);
	$tongsonhanvien = 75;
	$luongnhanvien = round($tongsonhanvien * 5500000 / $nums_day_of_month);
//Bù lỗ ship
$a = mysql_query("select id from donhang where thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59'");
$tongsodon = mysql_num_rows($a);
//Function tổng tiền hàng
$sql = mysql_query("select sanpham from donhang where thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59'");
while($kq = mysql_fetch_array($sql))
{
	$donhang = $kq['sanpham'];
	$tachdonhang = explode("|",$donhang);
	foreach($tachdonhang as $donhang)
	{
		$tachsanpham = explode("-",$donhang);
		$idsanpham = $tachsanpham[0];
		$soluong = $tachsanpham[1];
		$sql_find_nhomsanpham = mysql_query("select IDnhomsanpham from sanpham where id='{$idsanpham}'");
		$find_nhomsanpham = mysql_fetch_array($sql_find_nhomsanpham);
		$idnhomsanpham = $find_nhomsanpham['IDnhomsanpham'];
		$tongsanpham_theonhom[$idnhomsanpham] += $soluong;
	}
}
$soluongdam = $tongsanpham_theonhom[1];
$soluongdobodai = $tongsanpham_theonhom[7];
$soluongdobongan = $tongsanpham_theonhom[8];

$tiendam = $soluongdam * (99000-31000);
$tiendobongan = $soluongdobongan * (99000-41000);
$tiendobodai = $soluongdobodai * (149000-61000);
$loinhuanthuan = ($tiendam + $tiendobodai + $tiendobongan);

$tiennhapdam = $soluongdam * 31000;
$tiennhapdobodai = $soluongdobodai * 61000;
$tiennhapdobongan = $soluongdobongan * 41000;
$tongtiennhap = $tiennhapdam + $tiennhapdobodai + $tiennhapdobongan;

$tienbandam = $soluongdam * 99000;
$tienbandobongan = $soluongdobongan * 99000;
$tienbandobodai = $soluongdobodai * 149000;
$tongtienban = $tienbandam + $tienbandobodai + $tienbandobongan;
$bulohoan = round(($tongtienban * 0.2)-($tongtiennhap*0.1));


	$chiphicodinh_moingay = 0;
	$html = "";
	$nums_day_of_month = date("t");
	$a = mysql_query("select * from chiphi where type='chiphicodinh'");
	while($b = mysql_fetch_array($a))
		{
			$ten = $b['ten'];
			$sotien = $b['sotien'];
			$chiphicodinh = round($sotien/$nums_day_of_month);
			$chiphicodinh_moingay += $chiphicodinh;
			$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($chiphicodinh)." </font></td></tr>
			";
		}
	$chiphihangngay_moingay = 0;
	$a = mysql_query("select * from chiphi where type = 'chiphihangngay'");
	while($b = mysql_fetch_array($a))
	{
		$ten = $b['ten'];
		$id = $b['id'];
		$check = mysql_query("select sotien from chiphihangngay where idchiphi='{$id}' and ngay = '{$ngay}'");
		$rows = mysql_num_rows($check);
		if($rows==0)
		$sotien = 0;
		elseif($rows > 0)
		{
			$result = mysql_fetch_array($check);
			$sotien = $result['sotien'];
		}
	$chiphihangngay_moingay += $sotien;
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($sotien)." </font></td></tr>
			";
	}
	$chiphitheodon_moingay = 0;
	$a = mysql_query("select * from chiphi where type='chiphitheodon'");
	while($b = mysql_fetch_array($a))
	{
		$ten = $b['ten'];
		$sotien = $b['sotien'];
		$chiphitheodon = round($sotien * $tongsodon);
		$chiphitheodon_moingay += $chiphicodinh;
		$html.= "
				<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($chiphitheodon)." </font></td></tr>
				";
	}
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng nhân viên</td><td><font color='red'>".number_format($tongsonhanvien)." </font></td></tr>
			";		
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Lương nhân viên</td><td><font color='red'>".number_format($luongnhanvien)." </font></td></tr>
			";
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Bù Lỗ Hoàn ( 20% )</td><td><font color='red'>".number_format($bulohoan)." </font></td></tr>
			";
	$chiphiphaitramoingay = $chiphicodinh_moingay + $chiphihangngay_moingay + $chiphitheodon_moingay + $luongnhanvien + $bulohoan;		
	$html.= "<tr style='border-top:1px solid black'><td>Tổng</td><td><font color='red'>".number_format($chiphiphaitramoingay)." </font></td></tr>";
	return $array = array("html"=>$html,"chiphi"=>$chiphiphaitramoingay,"loinhuanthuan"=>$loinhuanthuan);	
}
///							
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
		<link rel="stylesheet" href="../assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="../assets/vendor/morris/morris.css" />
		<link rel="stylesheet" href="../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="../assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="../assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="../assets/vendor/hover-css/hover.css" />

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
		<?php 
if(!isset($quyenhan['admin']) or $quyenhan['admin'] !="1")
          echo "<script>
swal({
  title: 'Bạn không có quyền truy cập trang này',
  type: 'warning',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Thoát Ra'
}).then(function () {
  window.location = \"{$site_url}/index.php\"
})
  
</script>";
		?>
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
<section class="panel col-md-4">
<div style="text-align:center;margin:10px auto">
									<a class="modal-with-form btn btn-danger col-md-12" href="#modalForm_adduser">Thêm Chi Phí </a>
								</div>
<section class="panel panel-primary col-md-12" style="margin-top:10px">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">CHI PHÍ HẰNG NGÀY</h2>
							</header>
							<div class="panel-body" style="font-size: 16px;">
								
								<div class="row">
								<form method="post" action="">
								<div id="forminputdate">
								<?php
									$a = mysql_query("select id,ten from chiphi where type='chiphihangngay'");
									while($b = mysql_fetch_array($a))
									{
										$c = mysql_query("select sotien from chiphihangngay where idchiphi='{$b['id']}' and ngay='{$today}'");
										$rows = mysql_num_rows($c);
										if( $rows == 0)
										$sotien = 0;
										elseif( $rows > 0 )
										{
											$result = mysql_fetch_array($c);
											$sotien = $result['sotien'];
										}
										echo "
										<div class=\"form-group\">
												<label class=\"col-md-6 control-label\">{$b['ten']}</label>
												<div class=\"col-md-6\">
													<input type=\"number\" class=\"form-control\" name=\"{$b['id']}\" value=\"{$sotien}\">
												</div>
											</div>
										";
									}
								?>
								</div>	
								<div class="form-group" style="margin-top:10px">
												<label class="col-md-6 control-label">Ngày</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input id="formdate" type="text" data-plugin-datepicker="" class="form-control" name="ngay" value='<?php echo $formtoday;?>' data-date-format="dd/mm/yyyy">
													</div>
												</div>
											</div>							
								</div>
								<input style="margin-top:10px" class="btn btn-default col-md-12" type="submit" name="chiphihangngay" value="Cập Nhật">
								</form>
							</div>
</section>
<section class="panel panel-primary col-md-12">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">CHI PHÍ CỐ ĐỊNH</h2>
							</header>
							<div class="panel-body" style="font-size: 16px;">
								<form method="post" action="">
								<div class="row">
								<?php
									$a = mysql_query("select * from chiphi where type='chiphicodinh'");
									while($b = mysql_fetch_array($a))
									{
										echo "
										<div class=\"form-group\">
												<label class=\"col-md-6 control-label\">{$b['ten']}</label>
												<div class=\"col-md-6\">
												
													<input type=\"number\" class=\"form-control\" name=\"{$b['id']}\" value=\"{$b['sotien']}\">
												</div>
											</div>
										";
									}
								?>
								</div>
								<input style="margin-top:10px" class="btn btn-default col-md-12" type="submit" name="chiphicodinh" value="Cập Nhật">
								</form>
							</div>
</section>
<section class="panel panel-primary col-md-12">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">CHI PHÍ THEO ĐƠN</h2>
							</header>
							<div class="panel-body" style="font-size: 16px;">
							<form action="" method="post">
								<div class="row">
								<?php
									$a = mysql_query("select * from chiphi where type='chiphitheodon'");
									while($b = mysql_fetch_array($a))
									{
										echo "
										<div class=\"form-group\">
												<label class=\"col-md-6 control-label\">{$b['ten']}</label>
												<div class=\"col-md-6\">
													<input type=\"number\" class=\"form-control\" name=\"{$b['id']}\" value=\"{$b['sotien']}\">
												</div>
												
											</div>
										";
									}
								?>
								</div>
								<input style="margin-top:10px" class="btn btn-default col-md-12" type="submit" name="chiphitheodon" value="Cập Nhật">
								</form>
							</div>
</section>
						</section>
<section class="col-md-5" id="ketquatheongay">						
<section class="panel panel-primary col-md-12">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">CHI PHÍ CỐ ĐỊNH</h2>
							</header>
							<div class="panel-body col-md-12" style="font-size: 16px;">
							<!--Chi phí cố định-->
								
								<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="min-height: 500px;">
										<div class="scrollable-content" id="blockB">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								<?php
									$chiphi = tinhchiphi($today);
									echo $chiphi['html'];
								?>
								
								</table>
								
								</div>
								</div>
							

						</section>
						<!--Lợi Nhuận-->
						<section class="panel panel-primary col-md-12">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">LỢI NHUẬN</h2>
							</header>
							<div class="panel-body col-md-12" style="font-size: 16px;">
							<!--Chi phí cố định-->
								
								<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="min-height: 150px;">
										<div class="scrollable-content" id="blockB">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								<?php
								$chiphicodinh_moingay = 0;
								$loinhuanthuan = $chiphi['loinhuanthuan'];
								$chiphiphaitramoingay = $chiphi['chiphi'];
								echo "
										<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Lợi Nhuận Thuần </td><td><font color='red'>".number_format($loinhuanthuan)." </font></td></tr>
										";
								echo "
										<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Chi Phí Mất </td><td><font color='red'>".number_format($chiphiphaitramoingay)." </font></td></tr>
										";
								$loinhuan = $loinhuanthuan - $chiphiphaitramoingay;
									echo "<tr style='border-top:1px solid black'><td>Lợi Nhuận : </td><td><font color='red'>".number_format($loinhuan)." </font></td></tr>";
								?>
								
								</table>
								
								</div>
								</div>
						</section>
</section>						
					<section class="panel col-md-3">
						<div class="panel-body">
							<div id="viewbydatepicker" data-plugin-datepicker data-plugin-skin="primary" data-date="<?php echo $today;?>" data-date-format="yyyy-mm-dd">
						</div>
					</section>						
							
						<!--Thêm Tài Khoản-->
									<div id="modalForm_adduser" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">THÊM CHI PHÍ</h2>
											</header>
											<form id="themchiphi" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Chi Phí</label>
														<div class="col-sm-9">
															<input type="text" name="ten" class="form-control" required/>
														</div>
													</div>
													
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Số Tiền</label>
														<div class="col-sm-9">
															<input type="number" name="sotien" class="form-control" required/>
														</div>
													</div>
													<div class="form-group">
												<label class="col-md-3 control-label">Thuộc Nhóm</label>
												<div class="col-md-6">
													<select data-plugin-selectTwo class="form-control populate" name="theloai">
														
															<option value="chiphicodinh">Chi Phí Cố Định</option>
															<option value="chiphihangngay">Chi Phí Hằng Ngày</option>
															<option value="chiphitheodon">Chi Phí Theo Đơn</option>
														
														
													</select>
												</div>
											</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Chi Phí</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>	
						<!--Sửa tài khoản -->
						<div id="modalForm_edituser" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Chỉnh Sửa Thông Tin Tài Khoản</h2>
											</header>
											<form id="form_edituser" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Ngành Hàng</label>
														<div class="col-sm-9">
															<input type="text" name="tencataloge" class="form-control" placeholder="Tên ngành hàng kinh doanh..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Ảnh Minh Họa</label>
														<div class="col-sm-9">
															<input type="file" name="anhcataloge" accept="image/*">
														</div>
													</div>


													<div class="form-group">
														<label class="col-sm-3 control-label">Ghi chú</label>
														<div class="col-sm-9">
															<textarea name="ghichu" rows="5" class="form-control" placeholder="Thông tin về ngành hàng..."></textarea>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Ngành Hàng</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
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
		<script src="../assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="../assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="../assets/vendor/flot/jquery.flot.js"></script>
		<script src="../assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="../assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="../assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="../assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="../assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="../assets/vendor/raphael/raphael.js"></script>
		<script src="../assets/vendor/morris/morris.js"></script>
		<script src="../assets/vendor/gauge/gauge.js"></script>
		<script src="../assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="../assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="../assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="../assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="../assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="../assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		<script src="../assets/vendor/select2/select2.js"></script>
		<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-appear/jquery.appear.js"></script>
		
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
		<script src="../assets/javascripts/ui-elements/examples.modals.js"></script>
		<script type="text/javascript">


			 function xoataikhoan(value){
			 	
                $.ajax({
                    url : "ajax_tinhloinhuan.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         userid : value,
                        
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
			 function deleteuser(value){
			 	
                $.ajax({
                    url : "ajax_tinhloinhuan.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         deleteuser : value,
                        
                    },

                });
            }

//Thêm chi phí
$("form#themchiphi").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_tinhloinhuan.php?action=themchiphi',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             
           $('.mfp-ready').remove();
             $('#test_result').html(data);

        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});	
//Sửa tài khoản
$("form#form_edituser").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_tinhloinhuan.php?dosomething=edit_user',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             
           $('.mfp-ready').remove();
             $('#test_result').html(data);

        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});		
 function suataikhoan(value){

                  $.ajax({
                    url : "ajax_tinhloinhuan.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	idtaikhoan : value,
                    	
                    },
                    success : function (result){
                    	$('#form_edituser').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}	
$('#viewbydatepicker').datepicker();
$('#viewbydatepicker').on('changeDate', function() {
     var xemtheongaythang = $('#viewbydatepicker').datepicker('getFormattedDate');
        $.ajax({
                    url : "ajax_tinhloinhuan.php",
                    type : "get",
                    dataType:"text",
                    data : {
                        viewbydate : xemtheongaythang,
                    },
                    success : function (result){
                        $('#ketquatheongay').html(result);
                    }
                });
		
});
$('#formdate').datepicker();
$('#formdate').on('changeDate', function() {
     var xemtheongaythang = $('#formdate').datepicker('getFormattedDate');
        $.ajax({
                    url : "ajax_tinhloinhuan.php",
                    type : "get",
                    dataType:"text",
                    data : {
                        changeinput : xemtheongaythang,
                    },
                    success : function (result){
                        $('#forminputdate').html(result);
                    }
                });
		
});
		</script>
	</body>
</html>