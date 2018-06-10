<?php
include("../check_access.php");
include("../function/function.php");
if($quyenhan['mod'] != "1")
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

<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH NHÂN VIÊN </h2>
							</header>
							<div class="panel-body" style="font-size: 16px;">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
										
											<th>ID</th>
											<th>Hình Ảnh</th>
											<th>Tài Khoản</th>
											<th>Tên Nhân Viên</th>
											<th class="hidden-phone">Chức Vụ</th>
											<th>Thuộc Nhóm</th>
											<th>Chi Nhánh</th>
											<th>Ca Làm Việc </th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$sql = mysql_query("select * from user where id !='1'");
										while($do = mysql_fetch_array($sql))
										{
											if($do['avatar'] =="")$avatar = "noavatar.png";
											else $avatar = $do['avatar'];
											$groupid = $do['groupid'];
											$sql_group = mysql_query("select * from usergroup where id='{$groupid}'");
											$group = mysql_fetch_array($sql_group);
											$chucvu = $group['ten'];
											$username = $do['username'];
											$fullname = $do['fullname'];
											$team_id = $do['team_id'];
											$id = $do['id'];
											$chinhanh = $do['chinhanh'];
											$calamviec = $do['calamviec'];
											$tennhom = thuocnhom($team_id);
											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$id}</td>
											<td style=\"vertical-align: middle;text-align:center\"><img class=\"listavatar\" src=\"{$site_url}/images/avatar/{$avatar}\" /></td>
											<td style=\"vertical-align: middle;text-align:center\">{$username}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$fullname}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$chucvu}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tennhom}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$chinhanh}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$calamviec}</td>
											
										</tr>
											";

										}

										?>
										

									</tbody>
								</table>
							</div>

						</section>
						<!--Thêm Tài Khoản-->
									<div id="modalForm_adduser" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm tài khoản</h2>
											</header>
											<form id="add_user" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên tài khoản</label>
														<div class="col-sm-9">
															<input type="text" name="tentaikhoan" class="form-control" placeholder="Tên tài khoản đăng nhập..." required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Mật khẩu</label>
														<div class="col-sm-9">
															<input type="password" name="passwd" class="form-control" placeholder="Mật khẩu đăng nhập..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên đầy đủ</label>
														<div class="col-sm-9">
															<input type="text" name="tendaydu" class="form-control" placeholder="Tên đầy đủ nhân viên..." required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Mã Vận Đơn</label>
														<div class="col-sm-9">
															<input type="text" name="mavandon" class="form-control" placeholder="Chữ viết tắt để tạo mã đơn hàng..." required/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label">Chức Vụ</label>
														<div class="col-sm-9">
															<select class="form-control" name="chucvu" id="chucvu">
																<?php
														
															$sql = mysql_query("select * from usergroup where id!='1' and quanlynhanvien='0' and xuatkho='0' and nhapkho='0' and banhang='1'");
															
														
														while($kq = mysql_fetch_array($sql))
														{
														echo "<option value =\"{$kq['id']}\">{$kq['ten']}</option>";
														}
														

													?>
																
																
																	
															</select>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Tài Khoản</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>	
						<!--Sửa tài khoản -->
						<div id="modalForm_edituser" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Chỉnh Sửa Thông Tin Tài Khoản</h2>
											</header>
											<form id="form_edituser" action="" method="post" enctype="multipart/form-data">
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


					<!-- end: page -->
				</section>
			</div>

			
		</section>
							<div id="result">

							</div>
							<div id="test_result">

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


			 function xoataikhoan(value){
			 	
                $.ajax({
                    url : "ajax_users.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         userid : value,
                        
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
			 function deleteuser(value){
			 	
                $.ajax({
                    url : "ajax_users.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         deleteuser : value,
                        
                    },

                });
            }

//Thêm tài khoản
$("form#add_user").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_users.php?dosomething=add_user',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             
           $('.mfp-ready').remove();
             $('#test_result').html(data);

        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});	
//Sửa tài khoản
$("form#form_edituser").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_users.php?dosomething=edit_user',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             
           $('.mfp-ready').remove();
             $('#test_result').html(data);

        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});		
 function suataikhoan(value){

                  $.ajax({
                    url : "ajax_users.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	idtaikhoan : value,
                    	
                    },
                    success : function (result){
                    	$('#form_edituser').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}	

		</script>

	</body>
</html>