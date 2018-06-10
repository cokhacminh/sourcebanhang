<?php
include("../config.php");
include("../check_access.php");
include("../function/api.php");
include("../function/donhang_smod.php");
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

				<section role="main" class="content-body" id="donhangapi">
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
	<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG GIAO THẤT BẠI</h2>
	</header>
<div class="panel-body" style="font-size: 18px;">
<div class="row">
<div class="col-sm-12">
<form method="post" action="">
<div class="col-sm-5 form-group">
	<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">TỪ NGÀY</span>
	<input id="tungay" type="text" data-plugin-datepicker="" class="form-control" name="fromdate" data-date-format="yyyy-mm-dd" autocomplete="off">
	<span class="input-group-addon">ĐẾN NGÀY</span>
	<input id="denngay" type="text" data-plugin-datepicker="" class="form-control" name="todate" data-date-format="yyyy-mm-dd" autocomplete="off">
	</div>
</div>
<div class="col-sm-3 form-group">
	<button type="submit" style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
</div>
</form>
</div>
<div class="col-md-12" style="font-size: 13px;color:black;" id="bangdulieu" >
	<table class="table table-bordered table-striped mb-none" id="table_donhang">
		<thead>
			<tr>
				<th style="width: 50px;text-align: center">ThờiGian</th>
				<th style="width: 50px;text-align: center">Mã Đơn</th>
				<th style="width: 100px;text-align: center">Nhân Viên</th>
				<th style="min-width:150px;text-align: center">Khách Hàng</th>
				<th style="min-width: 150px;text-align: center">Mua Hàng</th>
				<th style="min-width: 100px;text-align: center">Tổng Tiền</th>
				<th style="min-width: 100px;text-align: center">Phí Ship</th>
				<th style="min-width: 100px;;text-align: center">Trạng Thái</th>
			</tr>
		</thead>
		<tbody id="list_products" style="vertical-align: middle;text-align: center">
<?php
$thismonth = date("Y-m");
$dauthang = $thismonth."-01";
$cuoithang = $thismonth."-31";
$danhsachdonhang = danhsachdonhang_thatbai($dauthang,$cuoithang);
?>
		</tbody>
	</table>
<script>
	var data = <?php echo $danhsachdonhang;?>;
</script>
	</div>

</div>
</div>
<?php elseif(isset($_POST['fromdate']) && isset($_POST['todate'])): ?>
	<?php 

if($_POST['fromdate'] =="")
{
	$month = date("m");
	$year = date("Y");
	$fromdate = $year."-".$month."-01";
}
else 
	$fromdate = $_POST['fromdate'];
if($_POST['todate'] =="")
{
	$date = date("Y-m-d");
	$todate = $date;
}
else
$todate = $_POST['todate'];
$danhsachdonhang = danhsachdonhang_thatbai($fromdate,$todate);
	?>
					
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG GIAO THẤT BẠI</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<div class="col-sm-12">
<form method="post" action="">
<div class="col-sm-5 form-group">
	<div style="width: 100%" class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">TỪ NGÀY</span>
	<input id="tungay" type="text" data-plugin-datepicker="" class="form-control" name="fromdate" data-date-format="yyyy-mm-dd" autocomplete="off">
	<span class="input-group-addon">ĐẾN NGÀY</span>
	<input id="denngay" type="text" data-plugin-datepicker="" class="form-control" name="todate" data-date-format="yyyy-mm-dd" autocomplete="off">
	</div>
</div>
<div class="col-sm-3 form-group">
	<button type="submit" style="font-size: 17px;" class="btn btn-sm btn-primary">XEM</button>
</div>
</form>
</div>
							
<div class="col-md-12" style="font-size: 13px;color:black;" id="bangdulieu" >
	<table class="table table-bordered table-striped mb-none" id="table_donhang">
		<thead>
			<tr>
				<th style="width: 50px;text-align: center">ThờiGian</th>
				<th style="width: 50px;text-align: center">Mã Đơn</th>
				<th style="width: 150px;text-align: center">Nhân Viên</th>
				<th style="min-width:150px;text-align: center">Khách Hàng</th>
				<th style="min-width: 150px;text-align: center">Mua Hàng</th>
				<th style="min-width: 100px;text-align: center">Tổng Tiền</th>
				<th style="min-width: 100px;text-align: center">Phí Ship</th>
				<th style="min-width: 100px;;text-align: center">Trạng Thái</th>
			</tr>
		</thead>
		<tbody id="list_products" style="vertical-align: middle;text-align: center">

		</tbody>	
	</table>
								
<script>
	var data = <?php echo $danhsachdonhang;?>;
</script>
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
		<div id="test_result" style="z-index: 999999">
														</div>
<?php include("../function/jquery_donhang.php");?>
								
<script>
$('#table_donhang').DataTable( {
    data: data,
    columns: [
        { data: 'ngaygio' },
        { data: 'madonhang' },
        { data: 'nhanvien' },
        { data: 'khachhang' },
        { data: 'showdonhang' },
        { data: 'tongtien' },
        { data: 'doisoat' },
        { data: 'thaotac' },

    ]
});
$('#tungay').datepicker();
$('#denngay').datepicker();
</script>
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
