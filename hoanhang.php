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

									<h2 class="panel-title">HOÀN HÀNG</h2>
								</header>
								<div class="panel-body">
									<div class="col-md-11">
										<form method="POST">
													<input type="text" class="form-control" name="inputhoandon" id="input_hoandon">
													
																						
										<button style="font-size: 17px;display: none" id="submit_hoandon" class="btn btn-sm btn-danger" onclick="hoandon()">HOÀN HÀNG</button>
										</form>										
										</div>
									<div class="col-md-1" id="result_hoandon">
																			<div id='loadingmessage1' style='display:none;width: 50%;'>
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
    document.getElementById("input_hoandon").focus();
}

            function xuatkho(){
            	$('#loadingmessage').show();
                $.ajax({
                    url : "ajax_hoanhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         madonhang_xk : $('#input_hoandon').val(),
                    },
                    success : function (result){
                        $('#test_result').html(result);
                        $('#loadingmessage').hide();
                    }
                });
            }
            function xuatkhohang(value){
            	
                $.ajax({
                    url : "ajax_hoanhang.php",
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
   document.getElementById("#input_hoandon").reset();
}



		</script>
		<div id="test_result" style="z-index: 999999">
<?php
if(isset($_POST['inputhoandon']) && $_POST['inputhoandon'] !="")
{
	$madonhang = $_POST['inputhoandon'];
	$a = mysql_query("SELECT madonhang,hoanhang FROM `donhang` WHERE `ghtk` LIKE '%{$madonhang}%'");
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
						  	window.location.assign(\"{$site_url}/hoanhang\")
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
	elseif ($count == 1)
	{
		$b = mysql_fetch_array($a);
		$mdh = $b['madonhang'];
		$hoanhang = $b['hoanhang'];
		if($hoanhang =="1")
		{
					echo "
<script>
						swal({
						  title: 'LỖI !!',
						  text: 'Mã đơn hàng {$madonhang} đã được kiểm hoàn từ trước ',
						  type: 'warning',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							reset_xuatkho();
						  	window.location.assign(\"{$site_url}/hoanhang\")
							})
						</script>
		";
		}
		elseif($hoanhang =="0")
		{

		echo "
		<script>
		var madonhang = \"{$mdh}\";
swal({
  title: '{$madonhang} - {$mdh}',
  html:
    'Số <font color=\"red\"> đồ bộ dài</font> hoàn về<input id=\"dobodai\" class=\"swal2-input\" value=\"0\" style=\"text-align:center\"> Số <font color=\"red\"> Váy Đầm</font> hoàn về<input id=\"vaydam\" class=\"swal2-input\" value=\"0\" style=\"text-align:center\">Số <font color=\"red\"> Đồ Bộ Ngắn</font> hoàn về<input id=\"dobongan\" class=\"swal2-input\" value=\"0\" style=\"text-align:center\">',
  preConfirm: function () {
    return new Promise(function (resolve) {
      resolve([
        $('#swal-input1').val(),
        $('#radioExample1').val()
      ])
    })
  },

}).then(function (result) {
  $.ajax({
                    url : \"ajax_hoanhang.php\",
                    type : \"post\",
                    dataType:\"text\",
                    data : {
                         madonhang_hoanhang : madonhang,
						 dobodai : $('#dobodai').val(),
						 vaydam : $('#vaydam').val(),
						 dobongan : $('#dobongan').val(),
                    },
                    success : function (result){
                        $('#test_result').html(result);

                    }
                });
})
</script>";
		}
	
	}

	
}
?>														</div>

	</body>
</html>