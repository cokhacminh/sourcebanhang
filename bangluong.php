<?php
include("check_access.php");
include("config.php");
include("function_tinhluong.php");
$thang = date("m");
$nam = date("Y");
if($thang == "1")
{
	$lastyear = $nam - 1;
	$lastmonth = $nam."-12";
	$lastmonth_html = "12/".$nam;
}
else
{
	$thangtruoc = $thang - 1;
	$lastmonth = $nam."-".$thangtruoc;
	$lastmonth_html = $thangtruoc."/".$nam;
}
 
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59')");
$tongdonhang_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id in(5,6)");
$tongdonhangthanhcong_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59' and status_id in (-1,7,9,11))");
$tongdonhangthatbai_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select sum(tongtien) as doanhso,sum(cod) as doanhsothucte from donhang where nhanvien='{$username}' and ( thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59')");
$data_thangnay = mysql_fetch_array($sql);
$doanhso_thangnay = $data_thangnay['doanhso'];
$doanhso_thucte = $data_thangnay['doanhsothucte'];
//
$tilehoan = round($tongdonhangthatbai_thangnay / $tongdonhang_thangnay * 100);
//
$sql = mysql_query("select luongcung,calamviec,chinhanh from user where username='{$username}'");
$kq = mysql_fetch_array($sql);
$luongcung = $kq['luongcung'];
$calamviec = $kq['calamviec'];
$chinhanh = $kq['chinhanh'];
$bachoahong = tinhhoahong($calamviec,$chinhanh,$doanhso_thucte);
$hoahong = round($doanhso_thucte * $bachoahong / 100);
$phathoan = $tongdonhangthatbai_thangnay*5000;
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
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
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
					<div class="row">
						<div class="col-md-2">
<div id="viewbydatepicker" data-plugin-datepicker data-plugin-skin="primary" data-date-format="yyyy-mm">     
	</div>
	<script type="text/javascript">
        $(document).ready(function () {
            $('#viewbydatepicker').datepicker({startView: "year" });
        })
</script>
						</div>	
						<div class = "col-md-5">
						<section class="panel">
						<div class="panel-body" style="color:black;">
						<center><h3>THỐNG KÊ THÁNG <?php echo $lastmonth_html;?></h2></center>
							<p>Tổng đơn hàng  : <b><font color="red"><?php echo $tongdonhang_thangnay;?></font> đơn</b></p>
							<p>Tổng đơn hàng thành công : <b><font color="red"><?php echo $tongdonhangthanhcong_thangnay;?></font> đơn</b></p>
							<p>Tổng đơn hàng thất bại : <b><font color="red"><?php echo $tongdonhangthatbai_thangnay;?></font> đơn</b></p>
							<p>Phạt hoàn  : <b><font color="red"><?php echo number_format($phathoan);?></font></b> ( Số đơn thất bại x 5.000 )</p>
							<p>Tỉ lệ hoàn : <b><font color="red"><?php echo $tilehoan;?>%</font></b></p>
							<hr />
							<p>Doanh số dự tính  : <b><font color="red"><?php echo number_format($doanhso_thangnay);?></font></b></p>
							<p>Doanh số thực thu  : <b><font color="red"><?php echo number_format($doanhso_thucte);?></font></b></p>
						</div>
					</section>
						</div>
						<div class = "col-md-5">
						<section class="panel">
						<div class="panel-body" style="color:black;">
						<center><h3>BẢNG LƯƠNG THÁNG <?php echo $lastmonth_html;?></h2></center>
							<center>BẢNG TÍNH HOA HỒNG</center>
							<table class="table table-bordered mb-none" style="color:black">
							<tr>
							<td>Doanh số thực thu</td><td><b><?php echo number_format($doanhso_thucte);?></b></td>
							</tr>
							<tr>
							<td>Mức hoa hồng</td><td><b><?php echo $bachoahong;?></b></td>
							</tr>
							<tr>
							<td>Hoa hồng nhận được</td><td><b><?php echo number_format($hoahong);?></b></td>
							</tr>
							</table>
							<center>BẢNG LƯƠNG</center>
							<table class="table table-bordered mb-none" style="color:black">
							<tr>
							<td>LƯƠNG CỨNG</td><td><b><?php echo number_format($luongcung);?></b></td>
							</tr>
							<tr>
							<td>HOA HỒNG</td><td><b><?php echo number_format($hoahong);?></b></td>
							</tr>
							<tr>
							<td>ĐÓNG PHẠT</td><td><b><?php echo number_format($phathoan);?></b></td>
							</tr>
							<tr>
							<td>TỔNG LƯƠNG</td><td><b><?php echo number_format($luongcung + $hoahong - $phathoan);?></b></td>
							</tr>
							</table>
						</div>
					</section>
						</div>
					</div>

					
					<!-- end: page -->
				</section>
			</div>

			
		</section>

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
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="assets/vendor/raphael/raphael.js"></script>
		<script src="assets/vendor/morris/morris.js"></script>
		<script src="assets/vendor/gauge/gauge.js"></script>
		<script src="assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
	</body>
</html>
