<?php
include("../config.php");
include("../check_access.php");
include("../api.php");

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
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG GIAO THÀNH CÔNG</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">


<div class="col-sm-12">
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

<div class="col-sm-2 form-group">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
	<a onclick="donthanhcongthangtruoc()" style="font-size: 17px;" class="btn btn-sm btn-danger">XEM THÁNG TRƯỚC</a>
</div>
</form>
</div>
<br /><br />
<hr />
						
								
								<div style="font-size: 12px;color:black" id="bangdulieu" >
								<table class="table table-bordered table-striped mb-none" id="table_donhang">
									<thead>
										<tr>
											<th>ThờiGian</th>
											<th>Mã Đơn</th>
											
											<th style="text-align: center">Khách Hàng</th>
											<th style="width:100px;text-align: center">Địa Chỉ</th>
											<th style="text-align: center">SDT</th>
											<th style="min-width: 150px;text-align: center">Mua Hàng</th>
											<th style="min-width: 80px;text-align: center">Tổng Tiền</th>
											<th style="min-width: 100px;;text-align: center">Ghi Chú</th>
											<th style="min-width: 100px;;text-align: center">Trạng Thái</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$thangnay = date("Y-m");
										$today = date("Y-m-d");
										$sql = mysql_query("select * from donhang where ( thoigian between '{$thangnay}-01 00:00:00' and '{$today} 23:59:59' ) and status_id in(5,6) and carebill='{$id_nhanvien}'");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$khachhang = $do['khachhang'];
											$id_nhanvien = $do['nhanvien'];
											$tennhanvien = getname($id_nhanvien);
											$diachi = $do['diachi'];
											$sdt = $do['sdt'];
											$sanpham = $do['sanpham'];
											//Duyệt đơn hàng
											$donhang = "";
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												$xuly_a = getNameProduct($key);
												$sanpham_a = $xuly_a." : ".$value." Cái <br />";
												$donhang.=$sanpham_a;

												
											}
											
											$phiship = $do['phiship'];
											$tongtien = number_format($do['tongtien']);
											$donvivanchuyen = $do['donvivanchuyen'];
											$thoigian = $do['thoigian'];
											$time = strtotime($thoigian);
											$ngaygio = date("d/m/Y H:i:s",$time);
											$goihang = $do['goihang'];
											$ghtk = $do['ghtk'];
											$status_id = $do['status_id'];
											$trangthaiapi = $api_status_id[$status_id];
											$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk({$id})\">{$trangthaiapi}</a><br />";
											$ghichu = $do['ghichu'];

											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}<br /><b><font color=\"red\">{$ghtk}</font></b></td>
											
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ghichu}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
							</div>
							</div>

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
					
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG GIAO THÀNH CÔNG</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">

<div class="col-sm-12">
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

<div class="col-sm-2 form-group">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
	<a onclick="donthanhcongthangtruoc()" style="font-size: 17px;" class="btn btn-sm btn-danger">XEM THÁNG TRƯỚC</a>
</div>
</form>
</div>
<br /><br />
<hr />

					
								
								<div style="font-size: 12px;color:black" id="bangdulieu" >
								<table class="table table-bordered table-striped mb-none" id="table_donhang">
									<thead>
										<tr>
											<th>ThờiGian</th>
											<th>Mã Đơn</th>
											
											<th style="text-align: center">Khách Hàng</th>
											<th style="width:100px;text-align: center">Địa Chỉ</th>
											<th style="text-align: center">SDT</th>
											<th style="min-width: 150px;text-align: center">Mua Hàng</th>
											<th style="min-width: 80px;text-align: center">Tổng Tiền</th>
											<th style="min-width: 100px;;text-align: center">Ghi Chú</th>
											<th style="min-width: 100px;;text-align: center">Trạng Thái</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										
										$sql = mysql_query("select * from donhang where ( thoigian between '{$fromdate} 00:00:00' and '{$todate} 23:59:59' ) and status_id in(5,6) and carebill='{$id_nhanvien}'");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$khachhang = $do['khachhang'];
											$id_nhanvien = $do['nhanvien'];
											$tennhanvien = getname($id_nhanvien);
											$diachi = $do['diachi'];
											$sdt = $do['sdt'];
											$sanpham = $do['sanpham'];
											//Duyệt đơn hàng
											$donhang = "";
											$tach_a = explode("|", $sanpham);
											foreach ($tach_a as $array) {
												$tach_b = explode("-", $array);
												$key = $tach_b[0];
												$value = $tach_b[1];
												$xuly_a = getNameProduct($key);
												$sanpham_a = $xuly_a." : ".$value." Cái <br />";
												$donhang.=$sanpham_a;

												
											}
											
											$phiship = $do['phiship'];
											$tongtien = number_format($do['tongtien']);
											$donvivanchuyen = $do['donvivanchuyen'];
											$thoigian = $do['thoigian'];
											$time = strtotime($thoigian);
											$ngaygio = date("d/m/Y H:i:s",$time);
											$goihang = $do['goihang'];
											$ghtk = $do['ghtk'];
											$status_id = $do['status_id'];
											$trangthaiapi = $api_status_id[$status_id];
											$button = "<a class=\"mb-xs mt-xs mr-xs btn btn-sm btn-primary\" onclick=\"info_ghtk({$id})\">{$trangthaiapi}</a><br />";
											$ghichu = $do['ghichu'];

											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}<br /><b><font color=\"red\">{$ghtk}</font></b></td>
											
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ghichu}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
							</div>
							</div>
<?php endif; ?>					






									

		


					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
										<div id='loadingmessage' style='display:none;position: absolute;top: 10%;left: 25%;z-index: 909999;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
</div>								
		<!-- Footer-->
<?php include("../template/footer.php");?>
		<!--End Footer-->

<?php include("../jquery_api.php");?>
		<div id="test_result" style="z-index: 999999">
														</div>

														</body>
</html>
