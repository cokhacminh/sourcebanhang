<?php
include("check_access.php");
include("config.php");
include("function_tinhluong.php");
include("function/function.php");
    $weekday = date("l");
    $weekday = strtolower($weekday);
    function timthu($weekday){
    switch($weekday) {
        case 'monday':
            $array[0] = 'Mon';$array[1] = 0;
            break;
        case 'tuesday':
            $array[0] = 'Tue';$array[1] = 1;
            break;
        case 'wednesday':
            $array[0] = 'Wed';$array[1] = 2;
            break;
        case 'thursday':
            $array[0] = 'Thu';$array[1] = 3;
            break;
        case 'friday':
            $array[0] = 'Fri';$array[1] = 4;
            break;
        case 'saturday':
            $array[0] = 'Sat';$array[1] = 5;
            break;
        case 'sunday':
            $array[0] = 'Sun';$array[1] = 5;
            break;
    }
    return $array;
     }
    $weekday_func = timthu($weekday);
    $dautuan = $weekday_func[1];
    $today = date("Y-m-d");
	$thismonth = date("Y-m");
    $today_str = strtotime($today);
    $ngaydautuan = $today_str - ($dautuan*60*60*24);
    $html_ngaydautuan = date("d-m-Y",$ngaydautuan);
    $total_order_of_week = 0;
    for ($i=0; $i < 7; $i++) 
    { 
	  	$ngay = $ngaydautuan + ($i*60*60*24);
	  	$ngay_bd = date("Y-m-d 00:00:00",$ngay);
	  	$ngay_kt = date("Y-m-d 23:59:59",$ngay);
	  	$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$ngay_bd}' and '{$ngay_kt}')");
	  	$total_dh = mysql_num_rows($sql);
	  	$total_order_of_week+= $total_dh;
	  	$thu = strtolower(date("l",$ngay));
	  	$thu_func = timthu($thu);
	  	$thu_ht = $thu_func[0];
	  	$array_total[$thu_ht] = $total_dh;
    }    
    //$cuoituan = date("d-m-Y",$ngaycuoituan);
$sql_1 = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");
$tongdonhang_homnay = mysql_num_rows($sql_1);
$sql_2 = mysql_query("select sum(tongtien) as total from donhang where nhanvien='{$username}' and ( thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");
$sql_2_a = mysql_fetch_array($sql_2);
$doanhso_homnay = $sql_2_a['total'];

//Top 3 nhân viên Ca Sáng
$sql_bestseller = mysql_query("select id_nhanvien,sum(tongtien) as total from donhang WHERE (thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and id_nhanvien in ( select id from user where calamviec='Ca Sáng') GROUP BY id_nhanvien ORDER by total DESC limit 0,5");
$icon_bestseller_casang = 1;
$html_bestseller_casang = "";
while($list_bestseller = mysql_fetch_array($sql_bestseller))
{
	$tennhanvien = getname($list_bestseller['id_nhanvien']);
	$info2 = info2($list_bestseller['id_nhanvien']);
	$html_bestseller_casang.= "<img src='{$site_url}/images/top{$icon_bestseller_casang}.png' width=\"40px\"/> {$tennhanvien} - Nhóm : <b><font color='blue'>{$info2[2]}</font></b> <br/>";
	$icon_bestseller_casang++;
	
}
//Top 3 nhân viên tháng này
$sql_bestseller = mysql_query("select id_nhanvien,sum(tongtien) as total from donhang WHERE thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59' and id_nhanvien in ( select id from user where calamviec='Ca Tối') GROUP BY id_nhanvien ORDER by total DESC limit 0,5");
$icon_bestseller = 1;
$html_bestseller = "";
while($list_bestseller = mysql_fetch_array($sql_bestseller))
{
	$tennhanvien = getname($list_bestseller['id_nhanvien']);
	$info2 = info2($list_bestseller['id_nhanvien']);
	$html_bestseller.= "<img src='{$site_url}/images/top{$icon_bestseller}.png' width=\"40px\"/> {$tennhanvien} - Nhóm : <b><font color='blue'>{$info2[2]}</font></b> <br/>";
	$icon_bestseller++;
	
}
//
$time = time();
$lastdaytime = $time - (60*60*24);
$lastday = date("Y-m-d",$lastdaytime);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59')");
$tongdonhang_homqua = mysql_num_rows($sql);
$sql = mysql_query("select sum(tongtien) as doanhso from donhang where nhanvien='{$username}' and ( thoigian between '{$lastday} 00:00:00' and '{$lastday} 23:59:59')");
$data_homqua = mysql_fetch_array($sql);
$doanhso_homqua = $data_homqua['doanhso'];
//

$thismonth = date("Y-m");
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59')");
$tongdonhang_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and status_id in(5,6)");
$tongdonhangthanhcong_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59' and status_id in (-1,7,9,11))");
$tongdonhangthatbai_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select id from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and status_id not in (-1,5,6,7,9,11)");
$tongdonhangdanggiao_thangnay = mysql_num_rows($sql);
$sql = mysql_query("select sum(tongtien) as doanhso,sum(cod) as doanhsothucte from donhang where nhanvien='{$username}' and ( thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59')");
$data_thangnay = mysql_fetch_array($sql);
$doanhso_thangnay = $data_thangnay['doanhso'];
$doanhso_thucte = $data_thangnay['doanhsothucte'];
//
$donthatbai_dukien1 = round($tongdonhangdanggiao_thangnay * 30 / 100);
$donthatbai_dukien = $tongdonhangthatbai_thangnay + $donthatbai_dukien1;
//
$tilehoan = round($donthatbai_dukien1 / $tongdonhang_thangnay * 100);
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
						<div class="col-md-4">
							<section class="panel">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="chart-data-selector" id="salesSelectorWrapper">
												<h2>
													
													<strong>
													Thống kê đơn hàng bán ra trong tuần	này
													</strong>

												</h2>

												<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
													<!-- Flot: Sales Porto Admin -->
													<div class="chart chart-sm" data-sales-rel="Porto Admin" id="flotDashSales1" class="chart-active"></div>
													<script>

														var flotDashSales1Data = [{
														    data: [
														    <?php
														    	foreach ($array_total as $key=>$value) {
														    		echo "[\"{$key}\", $value],";
														    	}

														    ?>

														        
														    ],
														    color: "#0088cc"
														}];

														// See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

													</script>


												</div>

											</div>
										</div>
										</div>
								</div>
							</section>
							</div>
							
						<div class="col-md-4">
							<section class="panel">
								
								<div class="panel-body" style="padding-left:30px">
								<center><strong>TOP 5 NHÂN VIÊN XUẤT SẮC CA SÁNG</strong></center>
									<?php echo $html_bestseller_casang;?>
								</div>
							</section>
						</div>
						<div class="col-md-4">
							<section class="panel">
								
								<div class="panel-body" style="padding-left:30px">
								<center><strong>TOP 5 NHÂN VIÊN XUẤT SẮC CA TỐI</strong></center>
									<?php echo $html_bestseller;?>
								</div>
							</section>
						</div>	
										
									
						
								<div class="col-md-12">
							
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary widget-summary-sm">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary" style="padding-top:12px">
														<i class="fa fa-life-ring"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Tổng Đơn Hôm Nay</h4>
														<div class="info">
															<strong class="amount"><b><font color="red"><?php echo $tongdonhang_homnay;?></font></b> đơn</strong>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary widget-summary-sm">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary" style="padding-top:12px">
														<i class="fa fa-life-ring"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Doanh Số Hôm Nay</h4>
														<div class="info">
															<strong class="amount"><b><font color="red"><?php echo number_format($doanhso_homnay);?></font></b></strong>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary widget-summary-sm">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary" style="padding-top:12px">
														<i class="fa fa-life-ring"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Tổng Đơn Hôm Qua</h4>
														<div class="info">
															<strong class="amount"><b><font color="red"><?php echo $tongdonhang_homqua;?></font></b> đơn</strong>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary widget-summary-sm">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary" style="padding-top:12px">
														<i class="fa fa-life-ring"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Doanh Số Hôm Qua</h4>
														<div class="info">
															<strong class="amount"><b><font color="red"><?php echo number_format($doanhso_homqua);?></font></b></strong>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							
						</div>
						<div class = "col-md-6">
						<section class="panel">
						<div class="panel-body" style="color:black;">
						<center><h3>THỐNG KÊ THÁNG <?php $showmonth = date("m/Y"); echo $showmonth;?></h2></center>
							<p>Tổng đơn hàng  : <b><font color="red"><?php echo $tongdonhang_thangnay;?></font> đơn</b></p>
							<p>Tổng đơn hàng thành công : <b><font color="red"><?php echo $tongdonhangthanhcong_thangnay;?></font> đơn</b></p>
							<p>Tổng đơn hàng thất bại : <b><font color="red"><?php echo $tongdonhangthatbai_thangnay;?></font> đơn</b></p>
							<p>Phạt hoàn  : <b><font color="red"><?php echo number_format($phathoan);?></font></b> ( Số đơn thất bại x 5.000 )</p>
							<p>Tổng đơn hàng đang giao : <b><font color="red"><?php echo $tongdonhangdanggiao_thangnay;?></font> đơn</b></p>
							<p>Tổng đơn thất bại dự tính : <b><font color="red"><?php echo $donthatbai_dukien;?></font> đơn</b> ( Bằng 30% tổng đơn đang giao )</p> 
							<p>Tỉ lệ hoàn dự tính : <b><font color="red"><?php echo $tilehoan;?>%</font></b></p>
							<hr />
							<p>Doanh số dự tính  : <b><font color="red"><?php echo number_format($doanhso_thangnay);?></font></b></p>
							<p>Doanh số thực thu  : <b><font color="red"><?php echo number_format($doanhso_thucte);?></font></b></p>
						</div>
					</section>
						</div>
						<div class = "col-md-6">
						<section class="panel">
						<div class="panel-body" style="color:black;">
						<center><h3>BẢNG LƯƠNG DỰ KIẾN THÁNG <?php $showmonth = date("m/Y"); echo $showmonth;?></h2></center>
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
