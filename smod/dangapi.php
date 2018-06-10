<?php
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
							
<div class="col-md-12" style="font-size: 13px;color:black;" id="bangdulieu" >
	<table class="table table-bordered table-striped mb-none" id="table_donhang">
		<thead>
			<tr>
				<th style="width: 50px;text-align: center">ThờiGian</th>
				<th style="width: 50px;text-align: center">Mã Đơn</th>
				<th style="width: 50px;text-align: center">Nhân Viên</th>
				<th style="min-width:150px;text-align: center">Khách Hàng</th>
				<th style="min-width: 150px;text-align: center">Mua Hàng</th>
				<th style="min-width: 40px;text-align: center">Tổng Tiền</th>
				<th style="min-width: 40px;text-align: center">Page/Trang</th>
				<th style="width: 150px;text-align: center">Ghi Chú</th>
				<th style="min-width: 100px;;text-align: center">Trạng Thái</th>
			</tr>
		</thead>
		<tbody id="list_products">
									

									</tbody>
								</table>
<?php
$today = date("Y-m-d");
$time = time();
$tendayago_time = $time - (10*60*60*24);
$tendayago = date("Y-m-d",$tendayago_time);
$danhsachdonhang = danhsachdonhang_dangapi($tendayago,$today);

?>
<script>
	var data = <?php echo $danhsachdonhang;?>;
</script>								
								</div>
								<?php } ?>
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
        { data: 'page' },
        { data: 'ghichu' },
        { data: 'thaotac' },

    ]
});

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