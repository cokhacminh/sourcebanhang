<?php
include("../config.php");
include("../check_access.php");
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
//$lastmonth = "2018-05";
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

<section class="panel panel-primary col-md-6">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">THỐNG KÊ CƠ BẢN</h2>
							</header>
							<div class="panel-body col-md-12" style="font-size: 16px;">
							<!--Chi phí cố định-->
								
								<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="min-height: 250px;">
										<div class="scrollable-content" id="blockB">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								<?php
								$chiphicodinh_moingay = 0;
								$loinhuanthuan = 0;
								$chiphiphaitramoingay = 0;
								$a = mysql_query("select id from donhang where thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59'");
								$tongsodon = mysql_num_rows($a);
								$a = mysql_query("select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id in(-1,9,11)");
								$tongdonthatbai = mysql_num_rows($a);
								$a = mysql_query("select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id in(5,6)");
								$tongdonthanhcong = mysql_num_rows($a);
								$a = mysql_query("select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id not in(9,11,-1,5,6)");
								$s = "select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id not in(9,11,-1,5,6)";
								$tongdondanggiao = mysql_num_rows($a);
								$tinhtong = $tongdondanggiao + $tongdonthatbai + $tongdonthanhcong;
								
								$a = mysql_query("select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and cod='30000'");
								$tongdon30k = mysql_num_rows($a);
								$tilehoan_tamtinh = (($tongdonthatbai + $tongdon30k) / $tongsodon * 100);
								$tilehoan = round($tilehoan_tamtinh,2);
								echo "
										<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng số đơn </td><td><font color='red'>".number_format($tongsodon)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Thành công </td><td><font color='red'>".number_format($tongdonthanhcong)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Thất Bại </td><td><font color='red'>".number_format($tongdonthatbai)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Đang Giao </td><td><font color='red'>".number_format($tongdondanggiao)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Số Đơn Thu 30k </td><td><font color='red'>".number_format($tongdon30k)." </font></td></tr>
										";
								$loinhuan = $loinhuanthuan - $chiphiphaitramoingay;
									echo "
									<tr style='border-top:1px solid black'><td>Tỉ Lệ Hoàn Tạm Tính : </td><td><font color='red'>".$tilehoan." </font></td></tr>
									";
									
								?>
								
								</table>
								
								</div>
								</div>
			

							</div>
					<!-- end: page -->
</section>
<section class="panel panel-primary col-md-6">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">LỢI NHUẬN</h2>
							</header>
							<div class="panel-body col-md-12" style="font-size: 16px;">
							<!--Chi phí cố định-->
								
								<div class="scrollable visible-slider colored-slider" data-plugin-scrollable style="min-height: 350px;">
										<div class="scrollable-content" id="blockB">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								<?php
								$a = mysql_query("select id from donhang where (thoigian between '{$lastmonth}-01 00:00:00' and '{$lastmonth}-31 23:59:59') and status_id in(5,6) and cod = tongtien");
								$tongdonchacchanthanhcong = mysql_num_rows($a);
								$tilethanhcong = ($tongdonchacchanthanhcong / $tongsodon * 100) ;
								$tilegiao1phan = (($tongdonthanhcong - $tongdonchacchanthanhcong - $tongdon30k) / $tongsodon * 100);
								$tilehoan1phan = $tilegiao1phan * 0.6;
								$tiledondanggiao = $tongdondanggiao / $tongsodon *100;
								echo "
										<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng số đơn </td><td><font color='red'>".number_format($tongsodon)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Thành công </td><td><font color='red'>".number_format($tongdonthanhcong)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Thất Bại </td><td><font color='red'>".number_format($tongdonthatbai)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Đơn Đang Giao </td><td><font color='red'>".number_format($tongdondanggiao)." </font></td></tr>
								<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng Số Đơn Thu 30k </td><td><font color='red'>".number_format($tongdon30k)." </font></td></tr>
										";
								$loinhuan = $loinhuanthuan - $chiphiphaitramoingay;
								$tongtile = $tilethanhcong + $tilegiao1phan + $tiledondanggiao + $tilehoan1phan + $tilehoan ;
								$tilehoancuoicung = 100 - $tilethanhcong - $tilehoan1phan;
									echo "
									<tr style='border-top:1px solid black'><td>Tỉ Lệ Hoàn Thành 100% : </td><td><font color='red'>".round($tilethanhcong,2)." </font></td></tr>
									<tr><td>Tỉ Lệ Đơn Đang Giao : </td><td><font color='red'>".round($tiledondanggiao,2)." </font></td></tr>
									
									<tr><td>Tỉ Lệ Hoàn Giao 1 Phần : </td><td><font color='red'>".round($tilehoan1phan,2)." </font></td></tr>
									
									<tr style='border-top:1px solid black'><td>Tỉ Lệ Hoàn Cuối Cùng : </td><td><font color='red'>".round($tilehoancuoicung,2)." </font></td></tr>
									";
								?>
								
								</table>
								
								</div>
								</div>
			

							</div>
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
<script src="api.js"></script>
<?php include("../jquery_api.php");?>
		<div id="test_result" style="z-index: 999999">
														</div>
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
									<!--FORM 2-->
									<div id="Form_edit_donhang1" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Registration Form</h2>
											</header>
											<div class="panel-body">
												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate">
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Name</label>
														<div class="col-sm-9">
															<input type="text" name="name" class="form-control" placeholder="Type your name..." required="">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Email</label>
														<div class="col-sm-9">
															<input type="email" name="email" class="form-control" placeholder="Type your email..." required="">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">URL</label>
														<div class="col-sm-9">
															<input type="url" name="url" class="form-control" placeholder="Type an URL...">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Comment</label>
														<div class="col-sm-9">
															<textarea rows="5" class="form-control" placeholder="Type your comment..." required=""></textarea>
														</div>
													</div>
												</form>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary modal-confirm">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
<?php
if($quyenhan['mod'] != "1")
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
