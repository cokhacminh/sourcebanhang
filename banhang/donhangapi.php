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
	<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG</h2>
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

<div class="col-sm-12">
	<div class="col-sm-8 form-group">
		<div style="width: 100%" class="input-group" >
			<span class="input-group-addon">TÌM ĐƠN HÀNG THEO SDT KHÁCH HÀNG , MÃ ĐƠN HÀNG , MÃ GHTK</span>
			<input type="text" class="form-control" id="searchdonhang">
		</div>
	</div>
	<div class="col-sm-2 form-group">
		<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="searchdon()">KIỂM TRA</button>
	</div>
</div>

<div class="col-sm-12">
	<div class="col-sm-3 form-group">
		<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    <input type="text" class="form-control" value="<?php if(isset($_GET['autorun'])) echo $_GET['autorun']; ?>" id="chonngayupdate" autocomplete="off">
		    <input type="hidden" class="form-control" value="<?php if(isset($_GET['page'])) echo $_GET['page']; ?>" id="page">
		    <div class="input-group-addon">
		    	<span class="glyphicon glyphicon-th"></span>
	   		</div>
		</div>
	</div>
	<div class="col-sm-4 form-group">
		<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="update_status()">CẬP NHẬT TRẠNG THÁI GHTK</button>
	</div>
</div>
							
<div class="col-md-12" style="font-size: 12px;color:black;display: none" id="bangcapnhat" >
	<p id="capnhat_note"></p> <p id="capnhat_page" data-id="0"></p>
	<table class="table table-bordered table-striped mb-none" id="table_capnhat" >
		<thead>
			<tr>
			<th style="width: 100px">Mã Đơn</th>
			<th style="width: 400px">Tình trạng</th>
			<th style="width: 20px"></th>
			</tr>
		</thead>
		<tbody id="list_capnhat">
		</tbody>
	</table>	
</div>			
<?php if(!isset($_GET['autorun'])){	?>			
<div class="col-md-12" style="font-size: 13px;color:black;" id="bangdulieu" >
	<table class="table table-bordered table-striped mb-none" id="table_donhang">
		<thead>
			<tr>
				<th style="width: 50px;text-align: center">ThờiGian</th>
				<th style="width: 50px;text-align: center">Mã Đơn</th>
				<th style="width: 150px;text-align: center">Nhân Viên</th>
				<th style="min-width:150px;text-align: center">Khách Hàng</th>
				<th style="min-width: 100px;text-align: center">Mua Hàng</th>
				<th style="min-width: 150px;text-align: center">Tổng Tiền</th>
				<th style="min-width: 40px;text-align: center">Page/Trang</th>
				<th style="width: 150px;text-align: center">Ghi Chú</th>
				<th style="min-width: 150px;;text-align: center">Trạng Thái</th>
			</tr>
		</thead>
		<tbody id="list_products" style="vertical-align: middle;text-align: center">
<?php
$today = date("Y-m-d");
$danhsachdonhang = danhsachdonhang($today,$today);
?>
		</tbody>
	</table>
<script>
	var data = <?php echo $danhsachdonhang;?>;
</script>	
	</div>
<?php };	?>
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
$danhsachdonhang = danhsachdonhang($fromdate,$todate);
	?>
					
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG</h2>
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

<div class="col-sm-12">
	<div class="col-sm-8 form-group">
		<div style="width: 100%" class="input-group" >
			<span class="input-group-addon">TÌM ĐƠN HÀNG THEO SDT KHÁCH HÀNG , MÃ ĐƠN HÀNG , MÃ GHTK</span>
			<input type="text" class="form-control" id="searchdonhang">
		</div>
	</div>
	<div class="col-sm-2 form-group">
		<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="searchdon()">KIỂM TRA</button>
	</div>
</div>

<div class="col-sm-12">
	<div class="col-sm-3 form-group">
		<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
		    <input type="text" class="form-control" value="<?php if(isset($_GET['autorun'])) echo $_GET['autorun']; ?>" id="chonngayupdate" autocomplete="off">
		    <input type="hidden" class="form-control" value="<?php if(isset($_GET['page'])) echo $_GET['page']; ?>" id="page">
		    <div class="input-group-addon">
		    	<span class="glyphicon glyphicon-th"></span>
	   		</div>
		</div>
	</div>
	<div class="col-sm-4 form-group">
		<button style="font-size: 17px;" class="btn btn-sm btn-primary" onclick="update_status()">CẬP NHẬT TRẠNG THÁI GHTK</button>
	</div>
</div>
							
<div class="col-md-12" style="font-size: 12px;color:black;display: none" id="bangcapnhat" >
	<p id="capnhat_note"></p> <p id="capnhat_page" data-id="0"></p>
	<table class="table table-bordered table-striped mb-none" id="table_capnhat" >
		<thead>
			<tr>
				<th style="width: 100px">Mã Đơn</th>
				<th style="width: 400px">Tình trạng</th>
				<th style="width: 20px"></th>
			</tr>
		</thead>
		<tbody id="list_capnhat">
		</tbody>
	</table>	
</div>								
<div class="col-md-12" style="font-size: 13px;color:black;" id="bangdulieu" >
	<table class="table table-bordered table-striped mb-none" id="table_donhang">
		<thead>
			<tr>
				<th style="width: 50px;text-align: center">ThờiGian</th>
				<th style="width: 50px;text-align: center">Mã Đơn</th>
				<th style="width: 150px;text-align: center">Nhân Viên</th>
				<th style="min-width:150px;text-align: center">Khách Hàng</th>
				<th style="min-width: 100px;text-align: center">Mua Hàng</th>
				<th style="min-width: 150px;text-align: center">Tổng Tiền</th>
				<th style="min-width: 40px;text-align: center">Page/Trang</th>
				<th style="width: 150px;text-align: center">Ghi Chú</th>
				<th style="min-width: 150px;;text-align: center">Trạng Thái</th>
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
<!--Modal Edit Don Hang-->
<div id="Form_edit_donhang" class="modal fade" role="dialog">
	<form id="edit_donhang" action="" method="post" enctype="multipart/form-data">	
  <div class="modal-dialog">
    <div class="modal-content" id="div_edit_donhang" style="width: 900px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nhập Hàng</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</form>
</div>
    <!-- Kết Thúc Modal Edit Đơn Hàng-->

<!--Modal Gui Ho Tro-->
<div id="Form_guihotro" class="modal fade" role="dialog">
	<form id="sendticket" action="" method="post" enctype="multipart/form-data">	
  <div class="modal-dialog">
    <div class="modal-content" id="div_sendticket" style="">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">GỬI YÊU CẦU HỖ TRỢ</h4>
      </div>
      <div class="modal-body">
       <div class="form-group mt-lg">
				<label class="col-sm-3 control-label">Khách Hàng</label>
				<div class="col-sm-9">
					<input type="text" name="token" value="edit" style="display:none" />
					<input type="text" name="iddonhang" value="{$iddonhang}" style="display:none" />
					<input type="text" name="madonhang" class="form-control" value="{$madonhang}" style="display:none" disabled/>
					<input type="text" name="nhanvien" class="form-control" value="{$tennhanvien}" style="display:none" disabled>
					<input type="text" name="khachhang" class="form-control" value="{$khachhang}" >
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</form>
</div>
    <!-- Kết Thúc Modal Edit Đơn Hàng-->

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
		<div id="test_result" style="z-index: 999999">
														</div>

								
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
$('#tungay').datepicker();
$('#denngay').datepicker();
		$(document).ready(function(){
	var check = $('#chonngayupdate').val();
	if(check !='')
	{
		update_status();
	}	
	});
</script>

</body>
</html>
