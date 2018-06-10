<?php
include("../config.php");
include("../check_access.php");
//API
$api_status_id = array(
"0"=>"Chưa tiếp nhận",
"-1"=>"Đã Hủy",
"1"=>"Chưa tiếp nhận",
"2"=>"Đã tiếp nhận",
"3"=>"Đã lấy hàng/Đã nhập kho",
"4"=>"Đã điều phối giao hàng/Đang giao hàng",
"5"=>"Đã giao hàng/Chưa đối soát",
"6"=>"Đã Đối Soát",
"7"=>"Không lấy được hàng",
"8"=>"Hoãn lấy hàng",
"9"=>"Không giao được hàng",
"10"=>"Delay giao hàng",
"11"=>"Đã đối soát trả hàng",
"12"=>"Đang lấy hàng",
"20"=>"Đang trả hàng",
"21"=>"Đã trả hàng",
"123"=>"Shipper báo đã lấy hàng",
"127"=>"Shipber báo không lấy được hàng",
"128"=>"Shiper báo delay lấy hàng",
"45"=>"Shiper báo đã giao hàng",
"49"=>"Shiper báo không giao được hàng",
"410"=>"Shiper báo delay giao hàng",
"99"=>"Lạc Trôi"
);
//API
$thismonth = date("Y-m");
$a = mysql_query("select id from donhang where carebill='{$id_nhanvien}' and thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59'");
$tongdon = mysql_num_rows($a);
$a = mysql_query("select id from donhang where carebill='{$id_nhanvien}' and thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59' and status_id in (5,6)");
$tongdonthanhcong = mysql_num_rows($a);
$a = mysql_query("select id from donhang where carebill='{$id_nhanvien}' and thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59' and status_id in (9,11)");
$tongdonthatbai = mysql_num_rows($a);
$tongdondanggiao = $tongdon - $tongdonthatbai - $tongdonthanhcong;
$sql_status_id = mysql_query("select status_id,count(madonhang) as total from donhang where thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59' and carebill='{$id_nhanvien}' group by status_id");
$tilehoantoithieu = round($tongdonthatbai/$tongdon * 100,2);
$tilehoantoida = round(($tongdonthatbai + $tongdondanggiao)/$tongdon * 100,2);
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo $cuahang['title'];?></title>
		<meta name="keywords" content="<?php echo $cuahang['keywords'];?>">
		<meta name="author" content="<?php echo $cuahang['cuahang'];?>">
		<meta name="author" content="okler.net">

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
		<link rel="stylesheet" href="../assets/vendor/morris/morris.css" />
		<link rel="stylesheet" href="../assets/vendor/chartist/chartist.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">
		<!-- Sweetalert -->
		<script src="../assets/javascripts/sweetalert/sweetalert2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/javascripts/sweetalert/sweetalert2.min.css">
		<!-- Head Libs -->
		<script src="../assets/vendor/modernizr/modernizr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
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
						<h2>Thống Kê</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>UI Elements</span></li>
								<li><span>Thống Kê</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="col-lg-4">
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-danger">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-danger">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tổng Số Đơn Phải Chăm</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:red;font-size:30px"><?php echo $tongdon;?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-primary">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-primary">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tổng Số Đơn Thành Công</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:blue;font-size:30px"><?php echo $tongdonthanhcong;?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-success">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-success">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tổng Số Đơn Thất Bại</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:green;font-size:30px"><?php echo $tongdonthatbai;?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-warning">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-warning">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tổng Số Đơn Đang Giao</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:orange;font-size:30px"><?php echo $tongdondanggiao;?></strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-danger">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-danger">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tỉ Lệ Hoàn Tối Thiểu</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:red;font-size:30px"><?php echo $tilehoantoithieu;?>%</strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12" style="margin-bottom: 20px">	
					<div class="panel-body panel-featured-top panel-featured-success">
						<div class="widget-summary widget-summary-sm">
							<div class="widget-summary-col widget-summary-col-icon">
								<div class="summary-icon bg-success">
									<i class="fa fa-shopping-cart"></i>
								</div>
							</div>
							<div class="widget-summary-col">
								<div class="summary" style="text-align: center">
								<h4 class="title" style="font-size: 13px;font-weight: 600">Tỉ Lệ Hoàn Tối Đa</h4>
									<div class="info" style="margin-top: 5px">
										<strong class="amount" style="color:green;font-size:30px"><?php echo $tilehoantoida;?>%</strong>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					</div>
					<div class="col-lg-8">	
					<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">THỐNG KÊ CHUNG </h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row" style="padding-left: 20px">
								<?php
									while($array_status_id = mysql_fetch_array($sql_status_id))
									{
										$status_id = $array_status_id['status_id'];
										$total = $array_status_id['total'];
										$status = $api_status_id[$status_id];
										echo "<p><button type=\"button\" class=\"mb-xs mt-xs mr-xs btn btn-primary\">{$status}</button>  : <button type=\"button\" class=\"mb-xs mt-xs mr-xs btn btn-danger\">{$total} ĐƠN</button></p>";

									}
								?>
								</div>
							</div>	
					</section>

					</div>
						
						
						
						
						
					<!-- end: page -->



		<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../assets/vendor/jquery-appear/jquery.appear.js"></script>
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
		<script src="../assets/vendor/chartist/chartist.js"></script>

		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		
		
		<script type="text/javascript">
           
		</script>
		<div id="test_result" style="z-index: 999999">
		</div>
		
	</body>
</html>