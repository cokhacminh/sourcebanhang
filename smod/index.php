<?php
include("../check_access.php");
include("statis.php");
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
	<div id="page_container">
		
				<div class="col-lg-4">
				<div class="col-md-12" style="margin-bottom: 10px">
									<div class="panel-body panel-featured-top panel-featured-danger">
										<div class="widget-summary widget-summary-md">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-danger">
													<i class="fa fa-shopping-cart"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size: 15px;font-weight: 600">Tổng Đơn Hôm Nay</h4>
													<div class="info">
														<strong class="amount"><font color="red"><?php echo $tongdon_homnay;?> đơn</font> </strong>
														
													</div>
												</div>

											</div>
										</div>
									</div>
				</div>
				<div class="col-md-12" style="margin-bottom: 10px">
									<div class="panel-body panel-featured-top panel-featured-success">
										<div class="widget-summary widget-summary-md">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-success">
													<i class="fa fa-shopping-cart"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size: 15px;font-weight: 600">Tổng đơn trong tháng</h4>
													<div class="info">
														<strong class="amount"><font color="red"><?php echo $tongdon_trongthang;?> đơn</font></strong>
														
													</div>
												</div>
												
											</div>
											
										</div>
									</div>
				</div>				
				<div class="col-md-12" style="margin-bottom: 10px">
									<div class="panel-body panel-featured-top panel-featured-primary">
										<div class="widget-summary widget-summary-md">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size: 15px;font-weight: 600">Tổng doanh thu trong tháng</h4>
													<div class="info">
														<strong class="amount" style="padding-left: 10px;"><font color="red"><?php echo number_format($tongdoanhthu_thang);?></font></strong>
														
													</div>
												</div>

											</div>
										</div>
									</div>
				</div>	
				<div class="col-md-12" style="margin-bottom: 10px">
									<div class="panel-body panel-featured-top panel-featured-danger">
										<div class="widget-summary widget-summary-md">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-danger">
													<i class="fa fa-shopping-cart"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size: 15px;font-weight: 600">Doanh Số Tháng Trước</h4>
													<div class="info">
														<strong class="amount"><font color="red"><?php echo number_format($tongdoanhthuthucthu_thang);?></font></strong>
														<span class="text-primary"></span>
													</div>
												</div>

											</div>
										</div>
									</div>
				</div>	

				</div>	

				<div class="col-lg-8">	

			<div class="col-md-6" id="accordion">
						<div class="tabs">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a href="#popular1" data-toggle="tab" class="text-center" aria-expanded="true"><i class="fa fa-star"></i> TOP ĐƠN HÀNG TRONG NGÀY</a>
									</li>
								</ul>
								<div class="tab-content" style="height: 400px;">
									<div id="popular1" class="tab-pane active">
								<center><strong>TOP ĐƠN HÀNG TRONG NGÀY</strong></center>	
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="height: 320px;">
										<div class="scrollable-content">	
															
										<?php echo $topdonhang_homnay;?>
										
										</div>
									</div>
									</div>
									
								</div>
							</div>

			</div>	
			<div class="col-md-6" id="accordion">
						
							<div class="tabs">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a href="#popular1" data-toggle="tab" class="text-center" aria-expanded="true"><i class="fa fa-star"></i>TOP NHÂN VIÊN TRONG THÁNG </a>
									</li>

								</ul>
								<div class="tab-content" style="height: 400px;">
									<center><strong>TOP ĐƠN HÀNG TRONG THÁNG</strong></center>	
									<div id="popular1" class="tab-pane active">
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="height: 320px;">
										<div class="scrollable-content">									
										<?php echo $topdonhang_thangnay;?>
										
										</div>
									</div>
									</div>
									<div id="recent1" class="tab-pane">
								<center><strong>TOP NHÂN VIÊN TRONG THÁNG</strong></center>	
									</div>
								</div>
							</div>

			</div>				

		
	</div>
						
						
						

						
						
						
						
						
						
					<!-- end: page -->
				</section>
			</div>

			
		</section>

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