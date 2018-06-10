<?php
include("../config.php");
include("../check_access.php");
$thismonth = date("Y-m");
$thismonths = date("m/Y");
?>


<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo $cuahang['title'];?></title>
		<meta name="keywords" content="<?php echo $cuahang['keywords'];?>">
		<meta name="author" content="<?php echo $cuahang['cuahang'];?>">

		<!--Header-->
<?php include("../template/header.php");?>
		<!--End Header-->
	</head>
	<body>

		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="" class="logo">
						<img src="<?php echo $site_url;?>/assets/images/logo.png" height="35" alt="Porto Admin" />
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
<?php if(!isset($_POST['fromdate'])): ?>

<div class="col-sm-12">
<section class="panel panel-primary">
<div class="panel-body">								
<form method="post" action="">
<div class="col-sm-6 form-group">
	<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
	</div>
</div>

<div class="col-sm-3 form-group">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
	
</div>
</form>
</div>
</section>
</div>					
<div class="col-md-12">
							

						
						<section class="panel panel-primary">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
										<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
									</div>

									<h2 class="panel-title">LỊCH SỬ HOÀN HÀNG TRONG THÁNG <?php echo $thismonths;?></h2>
								</header>
								<div class="panel-body" id="thongke">
<!--THỐNG KÊ-->		
<?php
$today = date("Y-m-d");
$sql_thongke1 = mysql_query("select id from donhang where (thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') and hoanhang ='1'");
$tongdonhanghoan = mysql_num_rows($sql_thongke1);
$sql_thongke2 = mysql_query("select sum(soluong) as tongsanpham,sanpham from hoanhang where (thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59') group by sanpham order by tongsanpham desc");
$sql_total_hh = mysql_query("select id from hoanhang where thoigian between '{$thismonth}-01 00:00:00' and '{$today} 23:59:59'");
$tongdoandahoan = mysql_num_rows($sql_total_hh);
$sql_thongke3 = mysql_query("select sum(soluong) as tonghangbanra from xuathang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
$kqhangbanra = mysql_fetch_array($sql_thongke3);
$tonghangbanra = $kqhangbanra['tonghangbanra'];
$sql_thongke4 = mysql_query("select idsanpham,soluong from xuathang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
$array_list_sanpham = array();
while($locdulieu = mysql_fetch_array($sql_thongke4))
{
	$idsanpham = $locdulieu['idsanpham'];
	$soluong = $locdulieu['soluong'];
	$array_list_sanpham[$idsanpham] += $soluong;
}
arsort($array_list_sanpham);
?>						
								<div class="col-md-12" style="margin-bottom: 20px;">
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Tổng đơn đã hoàn : <b><font color="red"><?php echo $tongdoandahoan;?></font></b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>
									<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Đơn tháng này hoàn về: <b><font color="red"><?php echo $tongdonhanghoan;?></font> đơn</b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>
								
													<?php
													while($thongkesanpham = mysql_fetch_array($sql_thongke2))
													{
														
														echo "<section class=\"panel panel-featured-left panel-featured-primary\">
									<div class=\"panel-body\" style=\"border:1px solid #00000036\">
										<div class=\"widget-summary widget-summary-xs\">
											<div class=\"widget-summary-col widget-summary-col-icon\">
												<div class=\"summary-icon bg-primary\">
													<i class=\"fa fa-life-ring\"></i>
												</div>
											</div>
											<div class=\"widget-summary-col\">
												<div class=\"summary\">
													<h4 class=\"title\" style=\"font-size:17px\"><b>{$thongkesanpham['sanpham']} hoàn : <font color=\"red\">{$thongkesanpham['tongsanpham']}</font> bộ</b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>";
													}
														?>
													
								
				</div>
				<div class="col-md-9">
				<div class="col-sm-12">
										<div class="col-sm-8 form-group">
											<div style="width: 100%" class="input-group" >
																								<span class="input-group-addon">
																									TRA CỨU MÃ ĐƠN HÀNG
																								</span>
																								<input type="text" class="form-control" id="searchdonhang">
																								
											</div>
										</div>
										<div class="col-sm-2 form-group">
											<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="searchdon()">KIỂM TRA</button>
										</div>
										</div>
				<div class="col-md-12">
<div class="tabs" id="topday">

								<div class="tab-content">
									<div id="popular1" class="tab-pane active">
									
									<div >
										
										<div class="scrollable-content" tabindex="0" style="right: -17px;">	
																			
										<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th style="width: 250px">Thời Gian</th>
											<th>Người kiểm duyệt</th>
											<th>Tổng Tiền</th>
											<th>Đã thu COD</th>
											<th>Mã Đơn Hàng</th>
											<th>Chi Tiết</th>
										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$sql = mysql_query("select * from hoanhang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$thoigian = $do['thoigian'];
											$madonhang = $do['madonhang'];
											$sql1 = mysql_query("select tongtien,cod from donhang where madonhang = '{$madonhang}'");
											$kq11 = mysql_fetch_array($sql1);
											$sanpham = $do['sanpham'];
											$tongtien = number_format($kq11['tongtien']);
											$cod = number_format($kq11['cod']);
											$soluong = $do['soluong'];
											$nhanvien = $do['nhanvien'];
											echo "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\">{$thoigian}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$nhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$cod}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\"><b>{$sanpham}</b> hoàn <b><font color=\"red\">{$soluong}</font></b> bộ</td>
											
											
											
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>								
										</div>
									<div class="scrollable-pane" style="opacity: 1; visibility: visible;"><div class="scrollable-slider" style="height: 41px; transform: translate(0px, 0px);"></div></div></div>
									</div>
									
									
								</div>
							</div>
				</div>				
					</div>

				</div>
				
<!--THỐNG KÊ-->				
									
									<div class="col-md-1" id="result_hoandon">
																			<div id='loadingmessage1' style='display:none;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
</div>												
								</div>
								</div>
							</section>

					



		

<?php elseif(isset($_POST['fromdate']) && isset($_POST['todate'])): ?>
	<?php 

if($_POST['fromdate'] =="")
{
	$month = date("m");
	$year = date("Y");
	$fromdate = $month."/01/".$year;
}
else 
	$fromdate = $_POST['fromdate'];
if($_POST['todate'] =="")
{
	$date = date("m/d/Y");
	$todate = $date;
}
else
$todate = $_POST['todate'];
	$fromdate = CreatFromDate($fromdate);
	$todate = CreatToDate($todate);
	
	?>
<div class="col-sm-12">
<section class="panel panel-primary">
<div class="panel-body">								
<form method="post" action="">
<div class="col-sm-6 form-group">
	<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
	</div>
</div>

<div class="col-sm-3 form-group">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
	
</div>
</form>
</div>
</section>
</div>
<div class="col-md-12">
							

						
						<section class="panel panel-primary">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
										<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
									</div>

									<h2 class="panel-title">LỊCH SỬ HOÀN HÀNG TỪ <?php echo $fromdate;?> ĐẾN <?php echo $todate;?></h2>
								</header>
								<div class="panel-body" id="thongke">
<!--THỐNG KÊ-->		
<?php
$today = date("Y-m-d");
$sql_thongke1 = mysql_query("select id from donhang where (thoigian between '{$fromdate}' and '{$todate}') and hoanhang ='1'");
$tongdonhanghoan = mysql_num_rows($sql_thongke1);
$sql_total_hh = mysql_query("select id from hoanhang where thoigian between '{$fromdate}' and '{$todate} 23:59:59'");
$tongdoandahoan = mysql_num_rows($sql_total_hh);
$sql_thongke2 = mysql_query("select sum(soluong) as tongsanpham,sanpham from hoanhang where (thoigian between '{$fromdate}' and '{$todate}') group by sanpham order by tongsanpham desc");

$sql_thongke3 = mysql_query("select sum(soluong) as tonghangbanra from xuathang where thoigian between '{$fromdate}' and '{$todate}'");
$kqhangbanra = mysql_fetch_array($sql_thongke3);
$tonghangbanra = $kqhangbanra['tonghangbanra'];
$sql_thongke4 = mysql_query("select idsanpham,soluong from xuathang where thoigian between '{$fromdate}' and '{$todate}'");
$array_list_sanpham = array();
while($locdulieu = mysql_fetch_array($sql_thongke4))
{
	$idsanpham = $locdulieu['idsanpham'];
	$soluong = $locdulieu['soluong'];
	$array_list_sanpham[$idsanpham] += $soluong;
}
arsort($array_list_sanpham);
?>						
								<div class="col-md-12" style="margin-bottom: 20px;">
								<div class="col-md-3">
								<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Tổng đơn đã hoàn : <b><font color="red"><?php echo $tongdoandahoan;?></font></b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>
									<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Đơn tháng này hoàn về: <b><font color="red"><?php echo $tongdonhanghoan;?></font> đơn</b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>
								
													<?php
													while($thongkesanpham = mysql_fetch_array($sql_thongke2))
													{
														
														echo "<section class=\"panel panel-featured-left panel-featured-primary\">
									<div class=\"panel-body\" style=\"border:1px solid #00000036\">
										<div class=\"widget-summary widget-summary-xs\">
											<div class=\"widget-summary-col widget-summary-col-icon\">
												<div class=\"summary-icon bg-primary\">
													<i class=\"fa fa-life-ring\"></i>
												</div>
											</div>
											<div class=\"widget-summary-col\">
												<div class=\"summary\">
													<h4 class=\"title\" style=\"font-size:17px\"><b>{$thongkesanpham['sanpham']} hoàn : <font color=\"red\">{$thongkesanpham['tongsanpham']}</font> bộ</b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>";
													}
														?>
													
								
				</div>
				<div class="col-md-9">
<div class="tabs" id="topday">

								<div class="tab-content">
									<div id="popular1" class="tab-pane active">
								
									<div >
										<div class="scrollable-content" tabindex="0" style="right: -17px;">	
										<div class="col-sm-12">
										<div class="col-sm-8 form-group">
											<div style="width: 100%" class="input-group" >
																								<span class="input-group-addon">
																									TRA CỨU MÃ ĐƠN HÀNG
																								</span>
																								<input type="text" class="form-control" id="searchdonhang">
																								
											</div>
										</div>
										<div class="col-sm-2 form-group">
											<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="searchdon()">KIỂM TRA</button>
										</div>
										</div>
										<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th style="width: 250px">Thời Gian</th>
											<th>Người kiểm duyệt</th>
											<th>Tổng Tiền</th>
											<th>Đã thu COD</th>
											<th>Mã Đơn Hàng</th>
											<th>Chi Tiết</th>
											
											
											
											

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$sql = mysql_query("select id,thoigian,madonhang,sanpham,soluong,nhanvien from hoanhang where thoigian between '{$fromdate}' and '{$todate} 23:59:59'");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$thoigian = $do['thoigian'];
											$madonhang = $do['madonhang'];
											$sql1 = mysql_query("select tongtien,cod from donhang where madonhang = '{$madonhang}'");
											$kq11 = mysql_fetch_array($sql1);
											$sanpham = $do['sanpham'];
											$tongtien = number_format($kq11['tongtien']);
											$cod = number_format($kq11['cod']);
											$soluong = $do['soluong'];
											$nhanvien = $do['nhanvien'];
											echo "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\">{$thoigian}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$nhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$cod}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\"><b>{$sanpham}</b> hoàn <b><font color=\"red\">{$soluong}</font></b> bộ</td>
											
											
											
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>								
										</div>
									<div class="scrollable-pane" style="opacity: 1; visibility: visible;"><div class="scrollable-slider" style="height: 41px; transform: translate(0px, 0px);"></div></div></div>
									</div>
									
									
								</div>
							</div>
				</div>				
					

				</div>
				<br /><br />
<!--THỐNG KÊ-->				
									
									<div class="col-md-1" id="result_hoandon">
																			<div id='loadingmessage1' style='display:none;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
</div>												
								</div>
								</div>
							</section>
<?php endif; ?>		
					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
								
		<!-- Footer-->
<?php include("../template/footer.php");?>
		<!--End Footer-->
		<script type="text/javascript">

//Search Đơn Hàng
function searchdon(){
	 $.ajax({
                    url : "ajax_donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	checkhoanhang:$('#searchdonhang').val(),

                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
} 
///
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