?php
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
		<?php 
if(!isset($permission) or $permission !="admin")
          echo "<script>
swal({
  title: 'Bạn không có quyền truy cập trang này',
  type: 'warning',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Thoát Ra'
}).then(function () {
  window.location = \"{$site_url}/index.php\"
})
  window.location = \"{$site_url}/index.php\"
</script>";
		?>
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
<?php if(!isset($_GET['do'])): ?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH SẢN PHẨM</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
									
									
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th style="width: 150px">Hình Ảnh</th>
											<th>Mã Sản Phẩm</th>
											<th>Nhóm Sản Phẩm</th>
											<th class="hidden-phone">Giá Bán</th>
											<th>Tồn Kho</th>
											
											<th class="hidden-phone">Thao Tác</th>

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$sql = mysql_query("select * from sanpham");
										while($do = mysql_fetch_array($sql))
										{
											if($do['hinhanh'] =="")$hinhanh = "noimage.png";else $hinhanh = $do['hinhanh'];
											$id_nhomsanpham = $do['IDnhomsanpham'];
											$id = $do['id'];
											$giasanpham = number_format($do['gia']);
											$tensanpham = $do['ten'];
											$masanpham = $do['masanpham'];
											$ghichu = $do['ghichu'];
											$sql2 = mysql_query("select * from nhomsanpham where id='{$id_nhomsanpham}'");
											$kqnhomsanpham = mysql_fetch_array($sql2);
											$ten_nhomsanpham = $kqnhomsanpham['ten'];
											if(!isset($do['soluong']))$soluong = 0;
											else $soluong = $do['soluong'];

											echo "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\">
	<a href=\"{$site_url}/images/sanpham/{$hinhanh}\" data-plugin-lightbox data-plugin-options='{ \"type\":\"image\" }' title=\"{$tensanpham} \nMã sản phẩm : {$masanpham}\">
												<img class=\"img-responsive listproducts hvr-grow\" src=\"{$site_url}/images/sanpham/{$hinhanh}\">
											</a>
											</td>
											<td style=\"vertical-align: middle;text-align:center\">{$masanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ten_nhomsanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='red'>{$giasanpham}</font></td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$soluong}</font></td>
											
											<td style=\"vertical-align: middle;text-align:center\"><a href=\"#modalForm_nhapkho\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-primary\" title=\"Nhập Thêm Mặt Hàng Này\" onclick=\"nhapkho({$id})\"><i class=\"fa fa fa-cart-plus\"></i> Nhập Hàng</a> <a href=\"#modalForm_nhapkho\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-danger\" title=\"Xuất Kho\" onclick=\"xuatkho({$id})\"><i class=\"fa fa fa-cart-plus\"></i> Xuất Kho</a> </td>
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
							</div>

					
									<!-- Modal Form -->
									<div id="modalForm_nhapkho" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Quản Lý Kho</h2>
											</header>
											<form id="nhapkho" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
													
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Sản Phẩm</label>
														<div class="col-sm-9">
															
															<input type="text" name="tensanpham" class="form-control" placeholder="Tên sản phẩm..." required/>
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












<!--ABC-->
									<div id="modalForm_editproduct" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Sửa Sản Phẩm</h2>
											</header>
											<form id="edit_product" action="" method="post" enctype="multipart/form-data">
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
															<input type="text" style="text-transform: uppercase;" name="masanpham"  class="form-control" placeholder="Mã sản phẩm..." required/>
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
<!-- Thêm cataloge-->

<div id="modalForm_addnhomsanpham" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm Nhóm Sản Phẩm</h2>
											</header>
											<form id="add_nhomsanpham" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Nhóm Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="text" name="ten_nhomsanpham" class="form-control" placeholder="Tên nhóm sản phẩm..." required/>
														</div>
													</div>

														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Ảnh Nhóm Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="file" name="anhnhomsanpham" accept="image/*">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Nhóm Ngành Hàng</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate" name="cataloge">
																<?php
																$query = mysql_query("select * from cataloge");
																while($do = mysql_fetch_array($query))
																{
																	$cataloge = $do['id'];
																	$cataloge_name = $do['ten'];
																	echo "<option value=\"{$cataloge}\">{$cataloge_name}</option>";

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

<div id="modalForm_addcataloge" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm Ngành Hàng Kinh Doanh</h2>
											</header>
											<form id="add_cataloge" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Ngành Hàng</label>
														<div class="col-sm-9">
															<input type="text" name="tencataloge" class="form-control" placeholder="Tên ngành hàng kinh doanh..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Ảnh Minh Họa</label>
														<div class="col-sm-9">
															<input type="file" name="anhcataloge" accept="image/*">
														</div>
													</div>


													<div class="form-group">
														<label class="col-sm-3 control-label">Ghi chú</label>
														<div class="col-sm-9">
															<textarea name="ghichu" rows="5" class="form-control" placeholder="Thông tin về ngành hàng..."></textarea>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Ngành Hàng</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>									
<!--Kết thúc ModalForm-->								
<?php elseif(isset($_GET['do'])): ?>

    <!-- else -->
<?php endif; ?>

					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
									
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

$("form#nhapkho").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_khohang.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             $('#modalForm_product').remove();
             $('.mfp-ready').remove();
             $('#test_result').html(data);
//alert(data)
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
})

 function nhapkho(value){

                  $.ajax({
                    url : "ajax_khohang.php?thaotac=nhapkho",
                    type : "post",
                    dataType:"text",
                    data : {
                    	idsanpham : value,
                    	
                    },
                    success : function (result){
                    	$('#nhapkho').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}
 function xuatkho(value){

                  $.ajax({
                    url : "ajax_khohang.php?thaotac=xuatkho",
                    type : "post",
                    dataType:"text",
                    data : {
                    	idsanpham : value,
                    	
                    },
                    success : function (result){
                    	$('#nhapkho').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}
 function xoasanpham(value){

                  $.ajax({
                    url : "ajax_product.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	deleteproductid : value,
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}

            function change_view(value){
                $.ajax({
                    url : "ajax_product.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         view_type : value,

                    },
                    success : function (result){
                        $('#list_products').html(result);
                    }
                });
            }
		</script>
		<div id="test_result" style="z-index: 999999">
														</div>
	</body>
</html>