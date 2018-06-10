<?php
include("../config.php");
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
<?php include("template/header.php");?>
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
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG CHƯA ĐĂNG API GIAOHANGTIETKIEM </h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
								<div style="font-size: 12px;color:black" id="bangdulieu" >
									<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="apiall()">ĐĂNG API TOÀN BỘ ĐƠN HÀNG</button>
									<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="fixapi()">KIỂM TRA ĐƠN LỖI</button>
									<div style="font-size: 12px;color:black;display: none" id="bangcapnhat" >
									<p id="capnhat_note"></p> <p id="capnhat_page" data-id="0"></p>
								<table class="table table-bordered table-striped mb-none" id="table_dangapi">
									
									<thead>
										<tr>
											<th>MÃ ĐH</th>
											<th>Khách hàng</th>
											<th>Số ĐT</th>
											<th>Tình trạng</th>
											<th></th>
											

										</tr>
									</thead>
									<tbody id="list_dangapi">
									</tbody>
								</table>
								</div>
					<?php if(isset($_REQUEST['autorun'])){ ?>	
						<script type="text/javascript">	
							$(document).ready(function(){
								apiall();
							});
							
						</script>
							
					<?php } ?>
					<?php if(!isset($_REQUEST['autorun'])){ ?>		
							
								<div style="font-size: 12px;color:black;" id="bang_donhang" >
								<table class="table table-bordered table-striped mb-none" id="table_donhang">
									<thead>
										<tr>
											<th>ThờiGian</th>
											<th>MĐH</th>
											<th style="min-width: 80px;text-align: center">NV</th>
											<th style="min-width: 120px;text-align: center">Khách Hàng</th>
											<th style="min-width: 100px;text-align: center">Địa Chỉ</th>
											<th style="min-width: 80px;text-align: center">SDT</th>
											<th style="min-width: 100px;text-align: center">Mua Hàng</th>
											<th style="min-width: 80px;text-align: center">Tổng Tiền</th>
											
											<th style="min-width: 200px;text-align: center">Thao Tác</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$thangnay = date("Y-m");
										$today = date("Y-m-d");
										if($quyenhan['mod'] =="1")
		{
			$sql = mysql_query("select * from donhang where ghtk ='' and (thoigian between '{$thangnay}-01 00:00:00' and '{$today} 23:59:59') and id_nhanvien in ( select id from user where team_id='{$teamID}')");
			
		}
		if($quyenhan['smod'] =="1")
		{
			$sql = mysql_query("select * from donhang where ghtk ='' and (thoigian between '{$thangnay}-01 00:00:00' and '{$today} 23:59:59')");
		}
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
											$ghtk = $do['ghtk'];
											$button = "<a href=\"#\" class=\"hvr-float mb-xs mt-xs mr-xs btn btn-sm btn-danger\" onclick=\"api_id({$id})\">Đăng GHTK</a>";
											$ghichu = $do['ghichu'];
											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$ngaygio}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhanvien}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$khachhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$diachi}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$sdt}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tongtien}</td>
												<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
								</div>
								<?php } ?>
							</div>
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
<!-- Modal Form -->

		


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
<?php include("template/footer.php");?>
		<!--End Footer-->
<?php include("../jquery_api.php");?>
		<div id="test_result" style="z-index: 999999">
														</div>
	</body>
</html>