<?php
include("check_access.php");
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Bán Hàng | <?php echo $cuahang['title'];?></title>
		<meta name="keywords" content="<?php echo $cuahang['keywords'];?>" />
		<meta name="description" content="<?php echo $cuahang['cuahang'];?>">
		<meta name="author" content="okler.net">

		<!--Header-->
<?php include("template/header.php");?>
		<!--End Header-->
		<!-- Xu Ly Dia Chi-->
<script type="text/javascript">
            function change_tinh(value){
                $.ajax({
                    url : "ajax_diachi.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         id_tinh : value,

                    },
                    success : function (result){
                        $('#address_huyen').html(result);
                    }
                });
            }
           
            function change_huyen(value){
                $.ajax({
                    url : "ajax_diachi.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         id_huyen : value,

                    },
                    success : function (result){
                        $('#address_xa').html(result);
                    }
                });
            }
function checkmembers(){
	                $.ajax({
                    url : "searchmembers.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         sdt_khachhang : $("#members").val(),

                    },
                    success : function (result){
                        $('#form_members').html(result);
                    }
                });
}
</script>

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
						<h2>Bán Hàng</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Bán Hàng</span></li>
								
							</ol>
					
							<i class="fa fa-chevron-left"></i>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-6">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Nhập thông tin khách hàng</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="kiemtradonhang" method="post">
										<div id="form_members">
											<div class="form-group">
												<label class="col-md-3 control-label">Tên Khách Hàng</label>
												<div class="col-md-6">
													<div class="input-group input-group-icon">
														<span class="input-group-addon">
															<span class="icon"><i class="fa fa-user"></i></span>
														</span>
														<input name="tenkhachhang" type="text" class="form-control" placeholder="Tên Khách Hàng" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Số Điện Thoại Khách Hàng</label>
												<div class="col-md-6">
													<div class="input-group mb-md">
														<input id="members" name="sdtkhachhang" type="text" class="form-control" placeholder="Số Điện Thoại" required>
														<span class="input-group-btn">
															<button class="btn btn-danger" type="button" onclick="checkmembers()">CHECK</button>
														</span>
													</div>

												</div>


											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Địa Chỉ Tỉnh</label>
												<div class="col-md-6">
													<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Vui lòng chọn xã/thị trấn", "allowClear": true }'  onchange="change_tinh(this.value)" name="add_tinh" id="address_tinh" required>
														
															<option value="0">Vui lòng chọn Tỉnh</option>
															<?php
																$sql = mysql_query("select * from add_tinh order by shortname");
																while($data_tinh = mysql_fetch_array($sql))
																{
																	echo "<option value=\"{$data_tinh['id']}\">{$data_tinh['ten']}</option> ";
																}

															?>
																					
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Địa Chỉ Huyện</label>
												<div class="col-md-6">
													<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Vui lòng chọn xã/thị trấn", "allowClear": true }' id="address_huyen" onchange="change_huyen(this.value)" name="add_huyen" required>
														
														<option value="0">Vui lòng chọn Huyện</option>
														
																					
													</select>
												</select>
											</div>
										</div>

												<div class="form-group">
												<label class="col-md-3 control-label">Số nhà / Tên Đường</label>
												<div class="col-md-6">
													<div class="input-group input-group-icon">
														<span class="input-group-addon">
															<span class="icon"><i class="fa fa-home"></i></span>
														</span>
														<input name="diachi" type="text" class="form-control" placeholder="Số Nhà / Tên Đường" required>
													</div>
												</div>
											</div>
										</div>
										<hr />
											<div class="form-group">
												<label class="col-md-3 control-label">Sản Phẩm</label>
												<div class="col-md-6">
													<div class="input-group btn-group">
														<span class="input-group-addon">
															<i class="fa fa-th-list"></i>
														</span>
															<select multiple data-plugin-selectTwo class="form-control populate" name="sanpham[]">
														
															<?php

																$query = mysql_query("select * from nhomsanpham");
																$form_select = "";							
																while($do = mysql_fetch_array($query))
																{
																	$cataloge = $do['id'];
																	$cataloge_name = $do['ten'];
																	$form_select.= "<optgroup label=\"{$cataloge_name}\">";
																	$query1 = mysql_query("select * from sanpham where IDnhomsanpham = '{$cataloge}'");
																	while($do1 = mysql_fetch_array($query1))
																	{
																		$id_nhomsanpham = $do1['id'];
																		$ten_nhomsanpham = $do1['masanpham'];
																		if($nhomsanpham == $id_nhomsanpham)$form_select.= "<option value=\"{$id_nhomsanpham}\" checked=\"checked\">{$ten_nhomsanpham}</option>";
																		else $form_select.= "<option value=\"{$id_nhomsanpham}\">{$ten_nhomsanpham}</option>";

																	}
																	$form_select.= "</optgroup>";
																}
																echo $form_select;



														

															?>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group" id="show_product">

											</div>
												
											
											<button class="col-md-12 mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> BÁN HÀNG</button>
						
										</form>
									</div>
								</section>
							</div>
						</div>
						
						
						
						
					<!-- end: page -->
				</section>
			</div>
<!-- Modal Form -->
									
			
		</section>

		<!--Footer-->
<?php include("template/footer.php");?>
		<!--Footer-->
<!--Xu ly dia chi-->

	</body>
</html>