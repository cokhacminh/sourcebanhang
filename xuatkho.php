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

									<h2 class="panel-title">XUẤT KHO / GÓI HÀNG</h2>
								</header>
								<div class="panel-body">
									<div class="col-md-11">
										<form method="POST">
													<input type="text" class="form-control" name="inputxuatkho" id="input_xuatkho">
													
																						
										<button style="font-size: 17px;display: none" id="submit_xuatkho" class="btn btn-sm btn-danger">XUẤT KHO</button>
										</form>
												</div>
									<div class="col-md-1" id="result_xk">
																			<div id='loadingmessage' style='display:none;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
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
function focusOnInput() {
    document.getElementById("input_xuatkho").focus();
}

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
						  text: 'Mã đơn hàng {$madonhang} không tồn tại trong hệ thống ',
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
						  text: 'Mã đơn hàng {$madonhang} bị trùng với đơn hàng khác ',
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