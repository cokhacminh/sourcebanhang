<?php
include("config.php");
include("check_access.php");
if(!isset($quyenhan['xuatkho']) or $quyenhan['xuatkho'] !="1")
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
	<body onload="focusOnInput()">

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
<div class="col-md-12">
							

						
						<section class="panel panel-primary">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
										<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
									</div>

									<h2 class="panel-title">LỊCH SỬ GÓI HÀNG</h2>
								</header>
								<div class="panel-body" id="thongke">
<!--THỐNG KÊ-->		
<?php
$today = date("Y-m-d");
$sql_thongke1 = mysql_query("select id from goihang where (thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");
$tongdondagoi = mysql_num_rows($sql_thongke1);
$sql_thongke2 = mysql_query("select id from goihang where donloi='1' and (thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");
$tongdonloi = mysql_num_rows($sql_thongke2);
$sql_thongke3 = mysql_query("select sum(soluong) as tonghangbanra from xuathang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
$kqhangbanra = mysql_fetch_array($sql_thongke3);
$tonghangbanra = $kqhangbanra['tonghangbanra'];
$sql_thongke4 = mysql_query("select idsanpham,soluong from xuathang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
$array_list_sanpham = array();
while($locdulieu = mysql_fetch_array($sql_thongke4))
{
	$idsanpham = $locdulieu['idsanpham'];
	$soluong = $locdulieu['soluong'];
	$array_list_sanpham[$idsanpham] += $soluong;
}
arsort($array_list_sanpham);
?>						
								<div class="col-md-12" style="margin-bottom: 20px;">
								<div class="col-md-3">
									<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Tổng đơn đã gói : <b><font color="red"><?php echo $tongdondagoi;?></font></b></h4>
												</div>
												
											</div>
										</div>
									</div>
								</section>
								<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Tổng đơn gói lỗi : <b><font color="red"><?php echo $tongdonloi;?></font></b></h4>
												</div>
											</div>
										</div>
									</div>
								</section>
								<section class="panel panel-featured-left panel-featured-primary">
									<div class="panel-body" style="border:1px solid #00000036">
										<div class="widget-summary widget-summary-xs">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-primary">
													<i class="fa fa-life-ring"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title" style="font-size:17px">Tổng hàng xuất đi : <b><font color="red"><?php echo $tonghangbanra;?></font></b></h4>
												</div>
											</div>
										</div>
									</div>
								</section>
				</div>
				<div class="col-md-9">
<div class="tabs" id="topday">

								<div class="tab-content" style="height: 255px;border:1px solid #00000036">
									<div id="popular1" class="tab-pane active">
								
									<div style="height: 230px;overflow-y:scroll;">
										<div class="scrollable-content" tabindex="0" style="right: -17px;">									
										<table style="width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px">
										<tbody>
										<?php 
											foreach($array_list_sanpham as $key=>$value)
											{
												$masanpham = getNameProduct($key);
												echo "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$masanpham}</td><td><font color='red'>{$value} </font> bộ</td></tr>";
											}
										?>
										</tbody>
										</table>										
										</div>
									<div class="scrollable-pane" style="opacity: 1; visibility: visible;"><div class="scrollable-slider" style="height: 41px; transform: translate(0px, 0px);"></div></div></div>
									</div>
									
									
								</div>
							</div>
				</div>				
					

				</div>
				<br /><br />
<!--THỐNG KÊ-->				
									<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											
											<th style="width: 150px">Thời Gian</th>
											<th>Mã Đơn Hàng</th>
											<th>Chi tiết Đơn Hàng</th>
											<th class="hidden-phone">Quá Trình Gói</th>
											<th>Kết Quả</th>
											
											
											

										</tr>
									</thead>
									<tbody id="list_products">


										<?php
										$sql = mysql_query("select * from goihang where thoigian between '{$today} 00:00:00' and '{$today} 23:59:59'");
										while($do = mysql_fetch_array($sql))
										{
											$id = $do['id'];
											$thoigian = $do['thoigian'];
											$madonhang = $do['madonhang'];
											if($do['donloi']=="0")
											$ketqua = "Gói Thành Công";
											elseif($do['donloi'] =="1")
											$ketqua = "<b><font color='red'>Đơn Gói Lỗi</font></b>";
											$showchitiet = "";
											$sqlchitiet = mysql_query("select * from xuathang where idgoihang='{$id}'");
											while($datachitiet = mysql_fetch_array($sqlchitiet))
											{
												$idsanpham = $datachitiet['idsanpham'];
												$soluong = $datachitiet['soluong'];
												$tensanpham = getNameProduct($idsanpham);
												$showchitiet .= $tensanpham." đã xuất ".$soluong." cái<br />";
											}
											$sql_donhang = mysql_query("select sanpham from donhang where madonhang='{$madonhang}'");
											$datadonhang = mysql_fetch_array($sql_donhang);
											$sanpham = $datadonhang['sanpham'];
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
											echo "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\">{$thoigian}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$madonhang}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$donhang}</td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='red'>{$showchitiet}</font></td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$ketqua}</font></td>
											
											
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
									<div class="col-md-1" id="result_hoandon">
																			<div id='loadingmessage1' style='display:none;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
</div>												
								</div>
								</div>
							</section>

					



		


					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
								
		<!-- Footer-->
<?php include("template/footer.php");?>
		<!--End Footer-->
		<script type="text/javascript">


            function xuatkho(){
            	$('#loadingmessage').show();
                $.ajax({
                    url : "ajax_xuatkho.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         madonhang_xk : $('#input_xuatkho').val(),
                    },
                    success : function (result){
                        $('#result_xk').html(result);
                        $('#loadingmessage').hide();
                    }
                });
            }
            function xuatkhohang(value){
            	
                $.ajax({
                    url : "ajax_xuatkho.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         madonhang_xuatkho : value
                    },
                    success : function (result){
                        $('#test_result').html(result);

                    }
                });
            }
            function reset_xuatkho() {
   document.getElementById("#input_xuatkho").reset();
}


            function hoandon(){
            	$('#loadingmessage1').show();
                $.ajax({
                    url : "ajax_xuatkho.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         madonhang_hoandon : $('#input_hoandon').val(),
                    },
                    success : function (result){
                        $('#result_hoandon').html(result);
                        $('#loadingmessage1').hide();
                    }
                });
            }

            function reset_hoandon() {
    document.getElementById("formhoandon").reset();
}
		</script>
		<div id="test_result" style="z-index: 999999">
<?php
if(isset($_POST['inputxuatkho']) && $_POST['inputxuatkho'] !="")
{
	$madonhang = $_POST['inputxuatkho'];
	$a = mysql_query("SELECT * FROM `donhang` WHERE `ghtk` LIKE '%{$madonhang}%'");
	$count = mysql_num_rows($a);
	if($count < 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_xk} không tồn tại trong hệ thống ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/xuatkho\")
							})
						</script>
	";
	elseif($count > 1)
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang_xk} bị trùng với đơn hàng khác ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/xuatkho\")
							})
						</script>
		";
	elseif ($count == 1) {
		$b = mysql_fetch_array($a);
		$check = $b['goihang'];
		if($check == 0)
	{
		$donhang = $b['sanpham'];
		$madonhang = $b['madonhang'];
		$tach = explode("|", $donhang);
		$html = "";
		$error = "";
		foreach($tach as $newarray)
		{
			$tach2 = explode("-", $newarray);
			$key = $tach2[0];
			$value = $tach2[1];
			$a = mysql_query("select masanpham,soluong from sanpham where id='{$key}'");
			$b = mysql_fetch_array($a);
			$masanpham = $b['masanpham'];
			$soluong = $b['soluong'];
			if($soluong < $value)
				$error .= $masanpham." đã hết hàng <br />"; 
			$html.=$masanpham." : ".$value." Cái <br />";
			
		}
		if($error =="")
		echo "
<script>
swal({
  title: '{$madonhang}',
   html:
    '{$html}',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Gói Hàng !!!',
  cancelButtonText: 'Để Xem Lại !!!'
}).then(function () {
	xuatkhohang('{$madonhang}');
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Kiểm tra kho hàng cho chắc chắn nhé',
      'error'
    )
  }
})
</script>
		";
	else
		echo "
						<script>
						swal({
						  title: '{$madonhang} LỖI !!',
						  html:
    '{$error}',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/xuatkho\")
							})
						</script>
						";
	}
	elseif($check == 1 )
		echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Đơn hàng {$madonhang_xk} đã được gói từ trước rồi',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
						  	window.location.assign(\"{$site_url}/xuatkho\")
							})
						</script>
	";
	}
}
?>														</div>
	</body>
</html>