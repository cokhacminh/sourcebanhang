<html class="fixed sidebar-left-collapsed">
<?php
include("statis.php");
?>
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
				
		
				<div class="row" style="margin-bottom:20px;">
				
				<div class="col-md-3" id="accordion">
						<div class="tabs">
							
								
							<ul class="nav nav-tabs">
									<li class="active">
										<a href="#today_all" data-toggle="tab"><i class="fa fa-star"></i> Tổng Công Ty</a>
									</li>
									<li>
										<a href="#today_sg" data-toggle="tab">Nhóm Sài Gòn</a>
									</li>
									<li>
										<a href="#today_nt" data-toggle="tab">Nhóm Nha Trang</a>
									</li>
									
								</ul>
							<div class="tab-content">
								<div id="today_all" class="tab-pane active">
										
										<center>THỐNG KÊ HÔM NAY </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
														<p>Tổng đơn : <font color="red"><?php echo $tongdon_homnay;?> đơn</font> </p>
														<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homnay);?></font> </p>
														
												</div>
								</div>
								<div id="today_sg" class="tab-pane">
									<center>THỐNG KÊ HÔM NAY </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
													<p>Tổng đơn : <font color="red"><?php echo $tongdon_homnay_sg;?> đơn</font> </p>
													<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homnay_sg);?></font> </p>
													
												</div>
								</div>
								<div id="today_nt" class="tab-pane">
									<center>THỐNG KÊ HÔM NAY </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
													<p>Tổng đơn : <font color="red"><?php echo $tongdon_homnay_nt;?> đơn</font> </p>
													<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homnay_nt);?></font> </p>
													
												</div>
								</div>
							</div>
						</div>
				</div>
				<div class="col-md-3" id="accordion">
						<div class="tabs">
							
								
							<ul class="nav nav-tabs">
									<li class="active">
										<a href="#lastday_all" data-toggle="tab"><i class="fa fa-star"></i> Tổng Công Ty</a>
									</li>
									<li>
										<a href="#lastday_sg" data-toggle="tab">Nhóm Sài Gòn</a>
									</li>
									<li>
										<a href="#lastday_nt" data-toggle="tab">Nhóm Nha Trang</a>
									</li>
									
								</ul>
							<div class="tab-content">
								<div id="lastday_all" class="tab-pane active">
										
										<center>THỐNG KÊ HÔM QUA </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
													<p>Tổng đơn : <font color="red"><?php echo $tongdon_homqua;?> đơn</font> </p>
													<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homqua);?></font> </p>
													
												</div>
								</div>
								<div id="lastday_sg" class="tab-pane">
									<center>THỐNG KÊ HÔM QUA </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
													<p>Tổng đơn : <font color="red"><?php echo $tongdon_homqua_sg;?> đơn</font> </p>
													<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homqua_sg);?></font> </p>
													
												</div>
								</div>
								<div id="lastday_nt" class="tab-pane">
									<center>THỐNG KÊ HÔM QUA </center>											
											<hr style="margin-bottom:15px;margin-top:5px" />
												<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;text-align: center;">
													<p>Tổng đơn : <font color="red"><?php echo $tongdon_homqua_nt;?> đơn</font> </p>
													<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_homqua_nt);?></font> </p>
													
												</div>
								</div>
							</div>
						</div>
				</div>		
			

				<div class="col-md-6">
									<div class="panel-body panel-featured-top panel-featured-success">
										<div class="widget-summary widget-summary-sm">
											<div class="widget-summary-col" style="text-align:center">
													<div class="summary">
														<h4 class="title" style="font-size: 20px;font-weight: 600;text-transform:uppercase;">thống kê tháng này</h4>
														<hr style="margin-bottom:15px;margin-top:5px" />
														<div class="info" style="font-size: 15px;font-weight: 600;text-transform:uppercase;">
															<p>Tổng đơn : <font color="red"><?php echo number_format($tongdon_trongthang);?> đơn</font> | <font color="blue"><b>Thất bại</b></font> : <font color="red"><?php echo number_format($tongdonthatbai_thangnay);?> đơn</font> | <font color="blue"><b>Tỉ lệ hoàn</b></font> : <font color="red"><?php echo number_format(($tongdonthatbai_thangnay/$tongdon_trongthang)*100);?>% </font></p>
															<p>Doanh số : <font color="red"><?php echo number_format($doanhthu_thangnay);?></font> | <font color="blue"><b>Đã đối soát</b></font> : <font color="red"><?php echo number_format($doanhthuthucte_thangnay);?></font></p>
														</div>
														
													</div>

												</div>
											
										</div>
									</div>
				</div>					
			</div>
			<div class="row">
					<div class="col-md-3" id="accordion">
						<div class="tabs">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#popular99" data-toggle="tab" class="text-center" aria-expanded="true"><i class="fa fa-star"></i>LỌC THỐNG KÊ</a>
								</li>
							</ul>
							<div class="tab-content" style="height: 250px;line-height: 45px;padding-top: 30px">
								<div id="popular99" class="tab-pane active" style="text-align:center">
									<p><a onclick="thongketonghop('today')" style="font-size: 17px;" class="btn btn-sm btn-success">XEM CHI TIẾT HÔM NAY</a></p>
									<p><a onclick="thongketonghop('lastday')" style="font-size: 17px;" class="btn btn-sm btn-warning">XEM CHI TIẾT HÔM QUA</a></p>
									<div style="width: 100%;margin-bottom:5px" class="input-daterange input-group" data-plugin-datepicker>
																													<span class="input-group-addon" style="width:100px">
																														TỪ NGÀY
																													</span>
																													<input type="text" class="form-control" id="tungay" name="fromdate">
									</div>
									<div style="width: 100%;margin-bottom:5px" class="input-daterange input-group" data-plugin-datepicker>									
																													<span class="input-group-addon" style="width:100px">ĐẾN NGÀY</span>
																													<input type="text" class="form-control" id="denngay" name="todate">
									</div>
									<button onclick="xemtheothoigian()" style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>							
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3" id="accordion">
						<div class="tabs">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#popular10" data-toggle="tab" class="text-center" aria-expanded="true"><i class="fa fa-star"></i> Xem theo nhóm</a>
								</li>
							</ul>
							<div class="tab-content" style="height: 250px;line-height: 45px;padding-top: 30px">
								<div id="popular10" class="tab-pane active">
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="height: 200px;">
										<div class="scrollable-content" id="listteam">
												<?php
												$listteam = listteam("today");	
												?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3" id="accordion">
						<div class="tabs" id="topday">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#popular1" data-toggle="tab" class="text-center" aria-expanded="true"><i class="fa fa-star"></i>TOP NHÂN VIÊN TRONG NGÀY </a>
								</li>
							</ul>
							<div class="tab-content" style="height: 250px;">
								<div id="popular1" class="tab-pane active">
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="height: 200px;">
										<div class="scrollable-content" id="blockB">									
											<?php echo $topdonhang_homnay;?>
												
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	
					<div class="col-md-3" id="accordion">
						<div class="tabs">
							
								
							<ul class="nav nav-tabs">
									<li class="active">
										<a href="#popular1" data-toggle="tab"><i class="fa fa-star"></i> Top Đơn</a>
									</li>
									<li>
										<a href="#popular2" data-toggle="tab">Top Doanh Số</a>
									</li>
									<li>
										<a href="#popular2" data-toggle="tab">Thực Thu</a>
									</li>
									<li>
										<a href="#popular4" data-toggle="tab">Top Hoàn</a>
									</li>
								</ul>
							<div class="tab-content" style="height: 250px;">
								<div id="popular1" class="tab-pane active">
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="height: 200px;">
										
										<div class="scrollable-content" id="blockC">	
										<center>TOP NHÂN VIÊN TRONG THÁNG </center>											
											<?php echo $topdonhang_thangnay;?>
													
										</div>
									</div>
								</div>
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


	
		
		<script type="text/javascript">
      
             function viewteam(value){

                  $.ajax({
                    url : "ajax_thongke.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	viewteam : value,
                    	
                    },
                    success : function (result){
                    	
                    	$('#blockB').html(result)

                    	
                        //$('#test_result').html(result);
                    }
                });
}
function thongketonghop(thoigian){
			$.ajax({
                    url : "ajax_thongke.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	xemthongke:thoigian,

                    },
                    success : function (result){
                        $('#blockB').html(result);
                    }
                });
			$.ajax({
                    url : "ajax_thongke.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	viewbybuttonteam:thoigian,

                    },
                    success : function (result){
                        $('#listteam').html(result);
                    }
                });	
} 
            function viewbydate(value){
                $.ajax({
                    url : "ajax_thongke.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         viewbydate : value,

                    },
                    success : function (result){
                        $('#result_viewbydate').html(result);
                    }
                });
            }  
            function statisbydate(value){
                $.ajax({
                    url : "ajax_thongke.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         timestatisbydate : value,

                    },
                    success : function (result){
                        $('#result_statisbydate').html(result);
                    }
                });
            } 
                        function xemtheothoigian(){
                $.ajax({
                    url : "ajax_thongke.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	 xemtheongay:"true",
                         tungay : $("#tungay").val(),
                         denngay : $("#denngay").val(),

                    },
                    success : function (result){
                        $('#status').html(result);
                    }
                });
            }
		</script>
		<div id="test_result" style="z-index: 999999">
	</body>
</html>
