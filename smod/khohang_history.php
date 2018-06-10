<?php
include("../function/function.php");
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
<?php if(!isset($_POST['chedoxem'])): ?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">LỊCH SỬ XUẤT / NHẬP KHO HÔM NAY</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<!--Action-->
<form method="post" action="#">
<div class="col-sm-12">
										<div class="mb-md col-sm-4">
																																							
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="chedoxem">
													<option value="all">Xem Toàn Bộ</option>	
														<option value="1">Chỉ Xem Xuất Kho</option>	
														<option value="2">Chỉ Xem Nhập Kho</option>	
																					
													</select>

											
											
										</div>


<div class="mb-md col-sm-5">
<div class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
													</div>
</div>	
<div class="col-sm-3">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM THỐNG KÊ</button>

</div>
</form>

										</div>
										<br /><br /><hr />

<!--End Action-->								
									
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th>Ngày</th>
											<th>Giờ</th>
											<th>Thao Tác</th>
											<th>Người Thực Hiện</th>
											<th>Mã Sản Phẩm</th>
											<th>Số Lượng</th>
											<th>Ghi Chú</th>
											<th>Thao tác</th>
											
											
											

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$ngay = date('Y-m-d');
										 $sql = mysql_query("select * from lichsukhohang where ngay ='{$ngay}'");
                    while($do = mysql_fetch_array($sql))
                    {
                      $ngay = $do['ngay'];
                      $gio = $do['gio'];
                      $thaotac = $do['thaotac'];
                      switch ($thaotac) 
                      {
                      	case 'nhapkho': $thaotac = "Nhập Kho";break;
                      		case 'xuatkho': $thaotac = "Xuất Kho";break;
                      	
                      	default:
                      		 $thaotac = "Nhập Kho";break;
                      		
                      }
                      $username = $do['username'];
                      $nguoiquanly = getnamebyusername($username);
                      $masanpham = $do['masanpham'];
                      $soluong = $do['soluong'];
                      $ghichu = $do['ghichu'];
                      $xacthuc = $do['xacthuc'];
                      $id = $do['id'];
                      switch ($xacthuc) 
                      {
                      	case 'yes': $xacthuc = "Đã xác thực";break;
                      		case 'no': $xacthuc = "Chưa xác thực";break;
                      	default:
                      		$xacthuc = "Chưa xác thực";break;
                      }

                      echo "
                      <tr class=\"gradeX\">
                      
                      <td style=\"vertical-align: middle;text-align:center\">{$ngay}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$gio}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$thaotac}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$nguoiquanly}</td>
                      <td style=\"vertical-align: middle;text-align:center\"><font color='red'>{$masanpham}</font></td>
                      <td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$soluong}</font></td>
                      <td style=\"vertical-align: middle;text-align:center;white-space:pre-wrap;\">{$ghichu}</td>
                      <td style=\"vertical-align: middle;text-align:center\"><a href=\"#modalForm_edit\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-primary\" title=\"Chỉnh Sửa\" onclick=\"edit({$id})\"><i class=\"fa fa fa-cart-plus\"></i> EDIT</a> <a class=\"mb-xs mt-xs mr-xs btn btn-danger\"  onclick=\"delete_history({$id})\"><i class=\"fa fa fa-cart-plus\"></i> DELETE</a> </td>
                      
                      ";

										}

										?>
										

									</tbody>
								</table>
							</div>




								
<!--Kết thúc ModalForm-->								
<?php elseif(isset($_POST['chedoxem'])): ?>
	<?php
if(isset($_POST['chedoxem']))
{

    $chedoxem = $_POST['chedoxem'];
    switch ($chedoxem) {
    	case 'all':$view_type="";break;
    	case 1:$view_type="thaotac = 'xuatkho'";break;
    	case 2:$view_type="thaotac = 'nhapkho'";break;
    	default:
    		$view_type="";
    		break;
    }
    $fromdate = $_POST['fromdate'];
    if($fromdate !="")
    $ngaybatdau = xulyngaythang($fromdate);
	$todate = $_POST['todate'];
	if($todate != "")
    $ngayketthuc = xulyngaythang($todate);
    $data_table ="";
    $today = date('Y-m-d');
    if($fromdate =="" and $todate =="")
    	$where = "where ngay = '{$today}'";
    elseif($fromdate =="")
  		$where = "where ngay = '{$ngayketthuc}'";
  	elseif($todate =="")
  		$where = "where ngay = '{$ngaybatdau}'";
  	else $where =" where ngay between '{$ngaybatdau}' and '{$ngayketthuc}'";
  	if($view_type !="")
  		$where.=" and ".$view_type;


    $newsql = mysql_query("select * from lichsukhohang {$where}");
                    while($do = mysql_fetch_array($newsql))
                    {
                      $ngay = $do['ngay'];
                      $gio = $do['gio'];
                      $thaotac = $do['thaotac'];
                      switch ($thaotac) 
                      {
                      	case 'nhapkho': $thaotac = "Nhập Kho";break;
                      		case 'xuatkho': $thaotac = "Xuất Kho";break;
                      	
                      	default:
                      		 $thaotac = "Nhập Kho";break;
                      		
                      }
                      $username = $do['username'];
                      $nguoiquanly = getnamebyusername($username);
                      $masanpham = $do['masanpham'];
                      $soluong = $do['soluong'];
                      $ghichu = $do['ghichu'];
                      $xacthuc = $do['xacthuc'];
                      switch ($xacthuc) 
                      {
                      	case 'yes': $xacthuc = "Đã xác thực";break;
                      		case 'no': $xacthuc = "Chưa xác thực";break;
                      	default:
                      		$xacthuc = "Chưa xác thực";break;
                      }

                      $data_table .=  "
                      <tr class=\"gradeX\">
                      
                      <td style=\"vertical-align: middle;text-align:center\">{$ngay}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$gio}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$thaotac}</td>
                      <td style=\"vertical-align: middle;text-align:center\">{$nguoiquanly}</td>
                      <td style=\"vertical-align: middle;text-align:center\"><font color='red'>{$masanpham}</font></td>
                      <td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$soluong}</font></td>
                      <td style=\"vertical-align: middle;text-align:center;white-space:pre-wrap;\">{$ghichu}</td>
                      <td style=\"vertical-align: middle;text-align:center\"><a href=\"#modalForm_edit\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-primary\" title=\"Chỉnh Sửa\" onclick=\"edit({$id})\"><i class=\"fa fa fa-cart-plus\"></i> EDIT</a> <a class=\"mb-xs mt-xs mr-xs btn btn-danger\"  onclick=\"delete_history({$id})\"><i class=\"fa fa fa-cart-plus\"></i> DELETE</a> </td>
                      
                      ";
  					

}

}
	?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">LỊCH SỬ XUẤT / NHẬP KHO CỦA NGÀY</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<!--Action-->
<form method="post" action="#">
<div class="col-sm-12">
										<div class="mb-md col-sm-4">
																																										
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="chedoxem">
													<option value="all">Toàn Bộ</option>	
														<option value="1">Xuất Kho</option>	
														<option value="2">Nhập Kho</option>	
																					
													</select>

											
											
										</div>

<div class="mb-md col-sm-5">
<div class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="fromdate">
														<span class="input-group-addon">ĐẾN NGÀY</span>
														<input type="text" class="form-control" id="todate" name="todate">
													</div>
</div>	
<div class="col-sm-3">
	<button style="font-size: 17px;" class="btn btn-sm btn-primary">XEM THỐNG KÊ</button>

</div>
</form>

										</div>
										<br /><br /><hr />

<!--End Action-->								
									
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th>Ngày</th>
											<th>Giờ</th>
											<th>Thao Tác</th>
											<th>Người Thực Hiện</th>
											<th>Mã Sản Phẩm</th>
											<th>Số Lượng</th>
											<th>Ghi Chú</th>
											<th>Thao tác</th>
											
											

										</tr>
									</thead>
									<tbody id="list_products">


									<?php echo $data_table;?>	
										

									</tbody>
								</table>
							</div>



    <!-- else -->
<?php endif; ?>

					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
										<!-- Modal Form -->
										
									<div id="modalForm_edit" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<form id="edit_history" action="" method="post" enctype="multipart/form-data">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm Đơn Vị Giao Hàng</h2>
											</header>
											<div id="form_edit">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên ĐVGH</label>
														<div class="col-sm-9">
															<input type="text" name="tendvgh" class="form-control" placeholder="Tên đơn vị giao hàng..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Logo ĐVGH</label>
														<div class="col-sm-9">
															<input type="file" name="logodvgh" accept="image/*">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Ghi chú</label>
														<div class="col-sm-9">
															<textarea name="ghichu" rows="5" class="form-control" placeholder="Thông tin về đơn vị giao hàng..."></textarea>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm ĐVGH</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>
										</form>
											</div>
										
										</section>
									</div>
<!-- Modal Form -->								
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

$("form#edit_history").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: '../ajax/thongkekhohang.php',
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
 function edit(value){

                  $.ajax({
                    url : "../ajax/thongkekhohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	id_history : value,
                    	
                    },
                    success : function (result){
                    	$('#form_edit').html(result)
                    }
                });
}
 function delete_history(value){

                  $.ajax({
                    url : "../ajax/thongkekhohang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	deleteid : value,
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
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
<?php

function xulyngaythang($a)
{
  $tach = explode("/", $a);
  $ngaythang = $tach[2]."-".$tach[0]."-".$tach[1];
  return $ngaythang;
}
?>