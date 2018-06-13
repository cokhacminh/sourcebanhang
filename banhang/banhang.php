<?php
include("../check_access.php");
include("../function/function.php");
$form_select_sp = taoformselectmasanpham();
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
<style type="text/css">
	.center {
 text-align: center;   
}

.merge-bottom-input {
  width: 67px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.merge-top-left-button {
  border-top-left-radius: 0;
}

.merge-top-right-button {
  border-top-right-radius: 0;
}
</style>
		<!--Header-->
<?php include("../template/header.php");?>
		<!--End Header-->
		<!-- Xu Ly Dia Chi-->
<script type="text/javascript">
	function sendproducts(sel){

	var valuesArray = $('select[name=optionsanpham]').val()
	$.ajax({
                    url : "../ajax/banhang.php",
                    type : "post",
                    
                    data : { selectsanpham : valuesArray },
                    success : function (result){
                        $('#show_product').html(result);
                      
                    }
                });
}  
            function change_tinh(value){
                $.ajax({
                     url : "../ajax/banhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         id_tinh : value,
                    },
                    success : function (result){
                        $('#address_huyen').html(result);
                        themthongtin_tinh(value);
                    }
                });
            }
            function themthongtin_tinh(value){
            	$.ajax({
                    url : "../ajax/banhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         themthongtin_tinh : value,
                    },
                    success : function (result){
                        $('#tinh').html(result);
                        
                    }
                });
            }
            function themthongtin_huyen(value){
            	$.ajax({
                     url : "../ajax/banhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         themthongtin_huyen : value,
                    },
                    success : function (result){
                        $('#huyen').html(result);
                    }
                });
            }

function checkmembers(){
	                $.ajax({
                    url : "../searchmembers.php",
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

function change_page(value){
$("#page").val(value);	
}
function change_ghichu(value){
$("#ghichu").val(value);	
}
function finish(){
	$('#info_donhang').attr('style','display: inline');
	$('#form_donhang').attr('style','display: none');
	$('#form_select_sp').remove();
}



</script>

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
						<h2>Bán Hàng</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li><span>Bán Hàng</span></li>
								
							</ol>
					
							<i class="fa fa-chevron-left"></i>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
						<div id="loadingdiv" class="col-md-12" style="z-index: 999;height: 650px;padding-top:150px;text-align: center;background: white;position: absolute;display: none">
						<img src="../images/loading.gif" />
						</div>
						<div class="col-lg-12" id="form_donhang">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Nhập thông tin đơn hàng</h2>
									</header>
									<div class="panel-body">
									
										<div class="form-group">
														<label class="col-sm-3 control-label" for="w4-username">Tên Khách Hàng</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" id="input_tenkhachhang" required autocomplete="off">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label" for="w4-password">Số Điện Thoại</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" id="input_sdtkhachhang" required>
														</div>
													</div>
													<div class="form-group">
													<label class="col-md-3 control-label">Địa Chỉ Tỉnh</label>
														<div class="col-md-9">
															<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Vui lòng chọn xã/thị trấn", "allowClear": true }'  onchange="change_tinh(this.value)" name="add_tinh" id="address_tinh" required>
																<option value="0">Tỉnh</option>
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
														<div class="col-md-9">
															<select data-plugin-selectTwo class="form-control" id="address_huyen" onchange="themthongtin_huyen(this.value)" required>
																<option value="0">Vui lòng chọn Huyện</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Số nhà / Tên Đường</label>
														<div class="col-md-9">
															<div class="input-group input-group-icon">
																<span class="input-group-addon">
																<span class="icon"><i class="fa fa-home"></i></span>
																</span>
															<input id="input_diachi" type="text" class="form-control" placeholder="Số Nhà / Tên Đường" required>
															</div>
														</div>
													</div>
													<div class="form-group" id="form_select_sp">
														<label class="col-md-3 control-label">Sản Phẩm</label>
														<div class="col-md-9">
															<div class="input-group btn-group">
																<span class="input-group-addon">
																	<i class="fa fa-th-list"></i>
																</span>
																
																	<select multiple data-plugin-selectTwo class="form-control populate" name="optionsanpham" onclick="sendproducts(this)">
																
																	<?php echo $form_select_sp; ?>
																</select>
																
															</div>
														</div>
													</div>
													<div class = "form-group">
														<label class="col-sm-3 control-label">Page Bán Hàng</label>
														<div class="col-sm-9">
															<div class="input-group btn-group">
																<span class="input-group-addon">
																	<i class="fa fa-th-list"></i>
																</span>
																<select data-plugin-selectTwo class="form-control populate" name="page" style="overflow: hidden;" onchange="change_page(this.value)">
																	<option>Lựa Chọn Page Bán Hàng</option>
																	<?php 
																	$a = mysql_query("select * from listpage");
																    $form_select = "";
																    while ($b = mysql_fetch_array($a)) {
																        $id = $b['id'];
																        $tenpage = $b['page'];
																        $form_select.= "<option value=\"{$tenpage}\">{$tenpage}</option>";
																    }
																    echo $form_select;
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="form-group" style="margin-bottom: 20px" >
														
															<label class="col-sm-3 control-label">Mẫu Ghi chú</label>
															<div class="col-sm-9">
																<div class="input-group btn-group">
																	<span class="input-group-addon">
																		<i class="fa fa-th-list"></i>
																	</span>
																	<select data-plugin-selectTwo class="form-control populate" name="page" onchange="change_ghichu(this.value)" style="overflow: hidden;">
																	<option>Lựa Chọn Mẫu Ghi Chú Có Sẵn</option>	
																		<?php 
																	$option = "";
																	   $a = mysql_query("select id,ghichu from ghichu");
																	    while ($b = mysql_fetch_array($a)) {
																	        $option.="<option value=\"{$b['ghichu']}\">{$b['ghichu']}</option>";
																	    }
																	   echo $option; 
																	?>
																	</select>
																</div>
															</div>
														
													</div>
														<button class="col-md-12 mb-xs mt-xs mr-xs btn btn-primary"onclick="finish()"><i class="fa fa-check"></i> BÁN HÀNG</button>
									</div>
								</section>
							</div>

							
							<div class="col-md-12" id="info_donhang" style="display: none">
							<section class="panel panel-primary">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">THÔNG TIN ĐƠN HÀNG</h2>
								</header>
								<div class="panel-body" id="thongtindonhang" style="color:black">
										<form id="hoantatdonhang" action="" method="post" enctype="multipart/form-data">
										<div class="panel-body">
										<div id="form_members">
											<div class="form-group">
												<label class="col-md-2 control-label">Tên</label>
												<div class="col-md-4">
													<div class="input-group input-group-icon">
													<input name="tenkhachhang" type="text" class="form-control" id='tenkhachhang' required>
													</div>
												</div>
												<label class="col-md-2 control-label">SDT</label>
												<div class="col-md-4">
													<div class="input-group input-group-icon">
													<input name="sdtkhachhang" type="text" class="form-control" id='sdtkhachhang' required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Địa chỉ : </label>
												<div class="col-md-10">
													<div class="input-group input-group-icon">
													<input id="diachi" name="diachi" type="text" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Huyện</label>
												<div class="col-md-4">
													<div class="input-group input-group-icon" id="huyen">
													<input name="add_huyen" type="text" class="form-control" required>
													</div>
												</div>
												<label class="col-md-2 control-label">Tỉnh</label>
												<div class="col-md-4">
													<div class="input-group input-group-icon" id="tinh">
													<input name="add_tinh" type="text" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Page : </label>
												<div class="col-md-10">
													<div class="input-group input-group-icon">
													<input id="page" name="page" type="text" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Khách Tạm Ứng</label>
												<div class="col-md-10">
													<div data-plugin-spinner data-plugin-options='{ "value":0, "step": 10000, "min": 0, "max": 2000000 }'>
														<div class="input-group">
															<div class="spinner-buttons input-group-btn">
																<button type="button" class="btn btn-default spinner-up">
																	<i class="fa fa-plus"></i>
																</button>
															</div>
															<input type="text" class="spinner-input form-control" maxlength="3" style="height: 38px;" name="tamung">
															<div class="spinner-buttons input-group-btn">
																<button type="button" class="btn btn-default spinner-down">
																	<i class="fa fa-minus"></i>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Ghi Chú : </label>
												<div class="col-md-10">
													<div class="input-group input-group-icon">
													<input id="ghichu" name="ghichu" type="text" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="form-group">
													<label class="col-md-2 control-label">Sản Phẩm</label>
													<div class="col-md-10">
														<div class="input-group btn-group">
															<span class="input-group-addon">
																<i class="fa fa-th-list"></i>
															</span>
															
																<select multiple data-plugin-selectTwo class="form-control populate" name="optionsanpham" onclick="sendproducts(this)">
															
																<?php echo $form_select_sp; ?>
															</select>
															
														</div>
													</div>
											</div>
											<div class="form-group" id="show_product" style="text-align: center">

											</div>
												
											
											<button class="col-md-12 mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check"></i> BÁN HÀNG</button>
						
										
									</div>
						
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
		
		<?php include("../template/footer.php");?>


		
		<!-- Specific Page Vendor -->
		<script src="../assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="../assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>

		<!--Footer-->
<!-- Examples -->
		<script src="../assets/javascripts/forms/examples.wizard.js"></script>

		<script type="text/javascript">
		    $(document).ready(function(){
		        $("#input_tenkhachhang").keyup(function(){
		          $("#tenkhachhang").val($(this).val());
		        });
		        $("#input_sdtkhachhang").keyup(function(){
		          $("#sdtkhachhang").val($(this).val());
		        });
		        $("#input_diachi").keyup(function(){
		          $("#diachi").val($(this).val());
		        });
})
$("form#hoantatdonhang").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: '../ajax/banhang.php?do=banhang',
        type: 'POST',
        data: formData,
        async: false,
                success: function (data) {
             $("#loadingdiv").hide();
             $('#thongtindonhang').html(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    $("#loadingdiv").show().delay(1000).fadeOut();
    return false;
});

	</script>

	</body>
</html>