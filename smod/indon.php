g<?php
include("../check_access.php");
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
<?php if(!isset($_POST['chedoxem'])): ?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG </h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">

									<div class="col-sm-12">
<form action="" method="post">
<div class="mb-md col-sm-8">
<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
													</div>
</div>
<div class="col-sm-2">
	<select name="chedoxem" style="height: 35px;padding: 5px">
		<option value="all">Xem Toàn Bộ</option>
		<option value="0">Chưa Gói</option>
		<option value="1">Đã Gói</option>

	</select>

</div>	
<div class="col-sm-1">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>

</div>
</form>

									</div>
<br />
<hr />
<div class="col-md-2"></div>					
				<hr />
				<div class="col-md-12">
<!--In-->					
<div class="col-sm-12">

<div class="col-sm-2 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															CHỌN NGÀY
														</span>
														<input type="text" class="form-control" id="PrintDate" />
</div>
</div>
<div class="col-sm-2 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintNV">
													<option value="all">Toàn Bộ Nhân Viên</option>	
<?php
																$query = mysql_query("select * from user where groupid !=3");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['fullname'];

																		echo "<option value=\"{$id}\">{$fullname}</option>";


																}
																?>
																					
</select>	
</div>

<div class="col-sm-2 form-group">
	<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintofType">
	<option value="all">In Toàn Bộ</option>
	<option value="0">In Đơn Chưa Gói</option>
	<option value="1">In Đơn Đã Gói</option>
</select>

</div>
<div class="col-sm-4 form-group">
<button onclick="PrintOfOption()" style="font-size: 17px;" class="btn btn-sm btn-success">IN ĐƠN HÀNG</button>
</div>
</div>
<!--End In-->

<br />
<hr />
<!--In-->					
<div class="col-sm-12">

<div class="col-sm-2 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															CHỌN NGÀY
														</span>
														<input type="text" class="form-control" id="PrintDateTeam" />
</div>
</div>
<div class="col-sm-2 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintTeamID">

													<option value="all">Tất Cả Các Nhóm</option>	
<?php
																$query = mysql_query("select * from team");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['ten'];

																		echo "<option value=\"{$id}\">{$fullname}</option>";


																}
																?>
																					
</select>	
</div>

<div class="col-sm-2 form-group">
	<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintofTypeTeam">
	<option value="all">In Toàn Bộ</option>
	<option value="0">In Đơn Chưa Gói</option>
	<option value="1">In Đơn Đã Gói</option>
</select>

</div>
<div class="col-sm-4 form-group">
<button onclick="PrintOfTeam()" style="font-size: 17px;" class="btn btn-sm btn-success">IN ĐƠN HÀNG</button>
</div>
</div>
<!--End In-->
<br />
<hr />
</div>								

									<hr />
<div class="col-sm-12" style="margin-bottom: 10px">
	<button onclick="PrintofCheck()" style="font-size: 17px;" class="btn btn-sm btn-danger">IN THEO LỰA CHỌN</button>
	<button onclick="inlist(20)" style="font-size: 17px;" class="btn btn-sm btn-danger">IN 20 ĐƠN</button>
	<button onclick="inlist(50)" style="font-size: 17px;" class="btn btn-sm btn-danger">IN 50 ĐƠN</button>
	<button onclick="inlist('all')" style="font-size: 17px;" class="btn btn-sm btn-primary">IN TOÀN BỘ</button>
</div>							
								</div>
								<div style="font-size: 15px;color:black" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Chọn</th>
											<th>Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th style="min-width: 120px;text-align: center">Nhân Viên</th>
											<th style="min-width: 120px;text-align: center">Khách Hàng</th>
											<th>Địa Chỉ</th>
											<th style="min-width: 110px;text-align: center">Số Điện Thoại</th>
											<th style="min-width: 130px;text-align: center">Mua Hàng</th>
											<th style="min-width: 80px;text-align: center">Tổng Tiền</th>
											<th style="min-width: 110px;text-align: center">Thao Tác</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										
										$today = date("Y-m-d");
										$sql = mysql_query("select * from donhang where id_nhanvien in ( select id from user where team_id='{$teamID}') and (thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$madonhang = $do['madonhang'];
											$khachhang = $do['khachhang'];
											$nhanvien = $do['nhanvien'];
											$tennhanvien = getnamebyusername($nhanvien);
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
											$guihang = $do['guihang'];
											if($guihang == 0)
												$button = "<button class=\"hvr-float mb-xs mt-xs mr-xs btn btn-default\" title=\"Gửi Đơn Hàng Này\" >Chưa Gói</button>";
											else $button = " <button class=\"hvr-float mb-xs mt-xs mr-xs btn btn-success\" title=\"Gửi Đơn Hàng Này\" >Đã Gói</button>";									
											$ghichu = $do['ghichu'];

											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\"><div class=\"checkbox-custom checkbox-default\" style=\"text-align:center;margin-left:15px\">
																<input type=\"checkbox\" name=\"luachon[]\" value=\"{$id}\">
																<label></label>
															</div></td>
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											
												<td style=\"vertical-align: middle;text-align:center\">{$button}<br /><a class=\"hvr-float mb-xs mt-xs mr-xs btn btn-danger\" title=\"In Đơn Hàng Này\" href=\"{$site_url}/print.php?indon={$id}\" target=\"blank\">In Đơn</a></td>
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
							
							</div>
							</div>

					


<?php elseif(isset($_POST['fromdate'])): ?>
	<?php 
	$today = date("Y-m-d");
	$chedoxem = $_POST['chedoxem'];
	if($chedoxem != "all")
	{
		$where_1 = "where goihang = '{$chedoxem}'";
	}
	elseif($chedoxem =="all") 
		$where_1 = "where goihang != '9999'";
	//Xu ly todate va fromdate
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
		$where_2 = " and ( thoigian between '{$fromdate}' and '{$todate}' )";
	//ket thuc xu ly
	if($quyenhan['smod']=="1")
	$where = $where_1.$where_2;	
	else
	$where = $where_1.$where_2." and id_nhanvien in ( select id from user where team_id='{$teamID}') ";
	
	?>
	<form method="post" action="#">
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG </h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">

									<div class="col-sm-12">
<form action="" method="post">
<div class="mb-md col-sm-8">
<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
													</div>
</div>
<div class="col-sm-2">
	<select name="chedoxem" style="height: 35px;padding: 5px">
		<option value="all">Xem Toàn Bộ</option>
		<option value="0">Chưa Gói</option>
		<option value="1">Đã Gói</option>

	</select>

</div>	
<div class="col-sm-1">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>

</div>
</form>

									</div>
<br />
<hr />
<div class="col-md-2"></div>					
				<hr />
				<div class="col-md-12">
<!--In-->					
<div class="col-sm-12">

<div class="col-sm-2 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															CHỌN NGÀY
														</span>
														<input type="text" class="form-control" id="PrintDate" />
</div>
</div>
<div class="col-sm-2 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintNV">
													<option value="all">Toàn Bộ Nhân Viên</option>	
<?php
																$query = mysql_query("select * from user where groupid !=3");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['fullname'];

																		echo "<option value=\"{$id}\">{$fullname}</option>";


																}
																?>
																					
</select>	
</div>

<div class="col-sm-2 form-group">
	<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintofType">
	<option value="all">In Toàn Bộ</option>
	<option value="0">In Đơn Chưa Gói</option>
	<option value="1">In Đơn Đã Gói</option>
</select>

</div>
<div class="col-sm-4 form-group">
<button onclick="PrintOfOption()" style="font-size: 17px;" class="btn btn-sm btn-success">IN ĐƠN HÀNG</button>
</div>
</div>
<!--End In-->

<br />
<hr />
<!--In-->					
<div class="col-sm-12">

<div class="col-sm-2 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															CHỌN NGÀY
														</span>
														<input type="text" class="form-control" id="PrintDateTeam" />
</div>
</div>
<div class="col-sm-2 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintTeamID">

													<option value="all">Tất Cả Các Nhóm</option>	
<?php
																$query = mysql_query("select * from team");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['ten'];

																		echo "<option value=\"{$id}\">{$fullname}</option>";


																}
																?>
																					
</select>	
</div>

<div class="col-sm-2 form-group">
	<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' id="PrintofTypeTeam">
	<option value="all">In Toàn Bộ</option>
	<option value="0">In Đơn Chưa Gói</option>
	<option value="1">In Đơn Đã Gói</option>
</select>

</div>
<div class="col-sm-4 form-group">
<button onclick="PrintOfTeam()" style="font-size: 17px;" class="btn btn-sm btn-success">IN ĐƠN HÀNG</button>
</div>
</div>
<!--End In-->
<br />
<hr />
</div>								

									<hr />
<div class="col-sm-12" style="margin-bottom: 10px">
	<button onclick="PrintofCheck()" style="font-size: 17px;" class="btn btn-sm btn-danger">IN THEO LỰA CHỌN</button>
	<button onclick="inlist(20)" style="font-size: 17px;" class="btn btn-sm btn-danger">IN 20 ĐƠN</button>
	<button onclick="inlist(50)" style="font-size: 17px;" class="btn btn-sm btn-danger">IN 50 ĐƠN</button>
	<button onclick="inlist('all')" style="font-size: 17px;" class="btn btn-sm btn-primary">IN TOÀN BỘ</button>
</div>							
								</div>
								<div style="font-size: 15px;color:black" >
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Chọn</th>
											<th>Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th style="min-width: 120px;text-align: center">Nhân Viên</th>
											<th style="min-width: 120px;text-align: center">Khách Hàng</th>
											<th>Địa Chỉ</th>
											<th style="min-width: 110px;text-align: center">Số Điện Thoại</th>
											<th style="min-width: 130px;text-align: center">Mua Hàng</th>
											<th style="min-width: 80px;text-align: center">Tổng Tiền</th>
											<th style="min-width: 110px;text-align: center">Thao Tác</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php

										$showsql = "select * from donhang".$where;
										$sql = mysql_query("select * from donhang {$where}");
										
										while($do = mysql_fetch_array($sql))
										{
											$madonhang = $do['madonhang'];
											$id = $do['id'];
											
											$nhanvien = $do['nhanvien'];
											$tennhanvien = getnamebyusername($nhanvien);
											$khachhang = $do['khachhang'];
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
											if($goihang == 0)
												$button = "<button class=\"hvr-float mb-xs mt-xs mr-xs btn btn-default\" title=\"Gửi Đơn Hàng Này\" >Chưa Gói</button>";
											else $button = " <button class=\"hvr-float mb-xs mt-xs mr-xs btn btn-success\" title=\"Gửi Đơn Hàng Này\" >Đã Gói</button>";
											//$thoigian = str_replace("-", "/", $thoigian);
											$ghichu = $do['ghichu'];

											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\"><div class=\"checkbox-custom checkbox-default\" style=\"text-align:center;margin-left:15px\">
																<input type=\"checkbox\" name=\"luachon[]\" value=\"{$id}\">
																<label></label>
															</div></td>
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
											
																							<td style=\"vertical-align: middle;text-align:center\"> {$button} <br /><a class=\"hvr-float mb-xs mt-xs mr-xs btn btn-danger\" title=\"In Đơn Hàng Này\" href=\"{$site_url}/print.php?indon={$id}\" target=\"blank\">In Đơn</a></td>
										</tr>
											";

										}
										echo "<script>alert('{$showsql}')</script>";

										?>
										

									</tbody>
								</table>
							</div>
							</div>

					


   <!-- else -->
<?php endif; ?>







									<!-- Modal Form -->
									<div id="Form_edit_donhang" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;width: 900px">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">SỬA ĐƠN HÀNG</h2>
											</header>
											<form id="edit_donhang" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="text" id="suatensanpham" name="tensanpham" class="form-control" placeholder="Tên sản phẩm..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Ảnh Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="file" name="anhsanpham" accept="image/*">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Mã Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="text" name="masanpham"  class="form-control" placeholder="Mã sản phẩm..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Giá Bán</label>
														<div class="col-sm-9">
															<input type="number" name="giasanpham" class="form-control" placeholder="Giá Bán..." required="" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Nhóm</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate" name="nhomsanpham">
																<?php
																$query = mysql_query("select * from cataloge");
																while($do = mysql_fetch_array($query))
																{
																	$cataloge = $do['id'];
																	$cataloge_name = $do['ten'];
																	echo "<optgroup label=\"{$cataloge_name}\">";
																	$query1 = mysql_query("select * from nhomsanpham where catalogeid = '{$cataloge}'");
																	while($do1 = mysql_fetch_array($query1))
																	{
																		$id_nhomsanpham = $do1['id'];
																		$ten_nhomsanpham = $do1['ten'];
																		echo "<option value=\"{$id_nhomsanpham}\">{$ten_nhomsanpham}</option>";

																	}
																	echo "</optgroup>";
																}
																?>
																	
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Ghi chú</label>
														<div class="col-sm-9">
															<textarea name="ghichu" rows="5" class="form-control" placeholder="Thông tin về sản phẩm..."></textarea>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Sản Phẩm</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>
<!-- Modal Form -->

		


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

        function inlist(value){
var newurl = '<?php echo $site_url;?>/print.php?inhangloat='+value;
window.open(newurl,'_blank')
        }
        function indon(value){
        	       	$.ajax({
                    url : "../ajax/indon.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         indon : value,

                    },
                    success : function (result){
                        $('#test_result').html(result);
                    }
                });
        }
        function innhieudon(value){
        	var newurl = '<?php echo $site_url;?>/print.php?inhangloat='+value;
        	window.open(
  newurl,
  '_blank' // <- This is what makes it open in a new window.
);
        	
        		
        }
        function PrintofCheck(){
        	var luachon = { 'luachon[]' : []};
        	$(":checked").each(function() {
  luachon['luachon[]'].push($(this).val());
});
        	$.ajax({
                    url : "ajax_test.php",
                    type : "post",
                    dataType:"text",
                    data :  luachon,
                    
                    success : function (result){
                        $('#test_result').html(result);
                    }
                });
        }

        function PrintOfOption(value){
        	       	$.ajax({
                    url : "ajax_test.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         PrintDate : $('#PrintDate').val(),
                         PrintNV : $('#PrintNV').val(),
                         PrintofType : $('#PrintofType').val()

                    },
                    success : function (result){
                        $('#test_result').html(result);
                    }
                });
        }
	        function PrintOfTeam(value){
        	       	$.ajax({
                    url : "ajax_test.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         PrintDateTeam : $('#PrintDateTeam').val(),
                         PrintTeamID : $('#PrintTeamID').val(),
                         PrintofTypeTeam : $('#PrintofTypeTeam').val()

                    },
                    success : function (result){
                        $('#test_result').html(result);
                    }
                });
        }
        
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