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
					<div class="col-md-12" style="margin-bottom: 20px;border: 1px solid #cecaca;border-radius: 15px;padding: 15px;">
<div class="col-md-4 form-group">
<a onclick="hangbanra('homnay')" style="font-size: 17px;" class="btn btn-sm btn-success">HÔM NAY</a>
<a onclick="hangbanra('homqua')" style="font-size: 17px;" class="btn btn-sm btn-warning">HÔM QUA</a>
<a onclick="hangbanra('thangnay')" style="font-size: 17px;" class="btn btn-sm btn-danger">THÁNG NÀY</a>
</div>		
<div class="col-md-7 form-group">
<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker="">
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="tungay" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="denngay" name="todate">
													</div>											
</div>
<div class="col-md-1 form-group">
<button onclick="xemtheothoigian()" style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
</div>
		</div>
		
		
					<div class="col-md-12">
							<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
										<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
									</div>

									<h2 class="panel-title">DANH SÁCH HÀNG BÁN RA HÔM NAY</h2>
								</header>
								<div class="panel-body">
									<div class="scrollable visible-slider colored-slider" data-plugin-scrollable="" style="height: 450px;text-align: center;">
										<div class="scrollable-content" tabindex="0" id="thongke">
									<?php 
						$today = date("Y-m-d");
						$newarray = array();
						$newarray = "";
						$tonghangxuat = 0;
						$a = mysql_query("select * from donhang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
						while($b = mysql_fetch_array($a))
						{
							$sanpham = $b['sanpham'];

							
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												if(isset($newarray[$key]) or $newarray[$key] != 0)
												{
													$oldval = $newarray[$key];
													$newval = $oldval + $value;
													$newarray[$key] = $newval;
												
												}
												else	
												$newarray[$key] = $value;
												$tonghangxuat += $value;
											
												
											}

						
						
						}
							
						if($newarray != "")
						{
						arsort($newarray);
						echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>Tổng Hàng : {$tonghangxuat} cái</p>
										<hr />
								";
						foreach ($newarray as $key => $value) {
							$xuly_a = getNameProduct($key);
							echo "
									<p style='font-size:30px;font-weight:600;color:black;margin-top:20px;margin-left:20px'>{$xuly_a} : {$value} cái</p>
										<hr />
								";
						}			
						}
						
						
					?>	
										</div>
									<div class="scrollable-pane" style="opacity: 1; visibility: visible;"><div class="scrollable-slider" style="height: 68px; transform: translate(0px, 0px);"></div></div></div>
								</div>
							</section>
						</div>
					
		
			</div>

			
		</section>

							<div id="result">

							</div>
	<script>
function hangbanra(thoigian){
	 $.ajax({
                    url : "../ajax/hangbanra.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	xemthongke:thoigian,

                    },
                    success : function (result){
                        $('#thongke').html(result);
                    }
                });
} 
function xemtheothoigian(){
                $.ajax({
                    url : "../ajax/hangbanra.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	 xemtheongay:"true",
                         tungay : $("#tungay").val(),
                         denngay : $("#denngay").val(),

                    },
                    success : function (result){
                        $('#thongke').html(result);
                    }
                });
            }
</script>	
									
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