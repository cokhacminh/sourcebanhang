<?php
include("../config.php");
include("../check_access.php");
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
//Check tạo team hay chưa

$sql = mysql_query("select * from team where leader='{$id_nhanvien}'");
$count = mysql_num_rows($sql);

if($count<1)
{
	$button_team = "<a class=\"modal-with-form btn btn-primary\" href=\"#modalForm_addteam\">TẠO NHÓM <i class=\"fa fa-user-plus\"></i></a>";
}
else 
	{
		$button_team = "<a href=\"#modalForm_editteam\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-success\" ><i class=\"fa fa-pencil-square-o\"></i> CHỈNH SỬA NHÓM</a><a href=\"#modalForm_addmember\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-success\"><i class=\"fa fa-pencil-square-o\"></i>THÊM NHÂN VIÊN VÀO NHÓM</a>";
		$data = mysql_fetch_array($sql);
		$tennhom = $data['ten'];
		$mavandon_team = $data['mavandon'];
		if($data['hotline'] == "") $hotline = "";
		else
		$hotline = $data['hotline'];
		$idapi = $data['idapi'];
		$idnhom = $data['id'];
		
	}
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
<?php if(!isset($_GET['do'])): ?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">NHÓM SALES CỦA TÔI </h2>
							</header>
							<div class="panel-body" style="font-size: 16px;">
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<?php echo $button_team;?>
										</div>
									</div>
								</div>
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>ID</th>
											<th>Hình Ảnh</th>
											<th>Tài Khoản</th>
											<th>Tên Nhân Viên</th>
											
											<th class="hidden-phone">Chức Vụ</th>
											<th class="hidden-phone">Thao Tác</th>

										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($idnhom) and $idnhom !="")
										{
										$sql = mysql_query("select * from user where team_id ='{$idnhom}' and id !='1'");
										while($do = mysql_fetch_array($sql))
										{
											if($do['avatar'] =="")$avatar = "noavatar.png";
											else $avatar = $do['avatar'];
											$groupid = $do['groupid'];
											$data_group = getDataWhere("*","usergroup","id",$groupid);
											$nhom = $data_group['ten'];
											$username_nv = $do['username'];
											$id = $do['id'];
											$tendaydu = $do['fullname'];

											$quyenhan = $data_group['quanlynhanvien'];
											if($quyenhan ==1)
												$button = "";
											else $button = "<a class=\"mb-xs mt-xs mr-xs btn btn-danger\" onclick=\"kickout({$id})\">LOẠI NHÂN VIÊN NÀY RA KHỎI NHÓM</a>";
											echo "
											<tr class=\"gradeX\">
											<td style=\"vertical-align: middle;text-align:center\">{$id}</td>
											<td style=\"vertical-align: middle;text-align:center\"><img class=\"listavatar\" src=\"{$site_url}/images/avatar/{$avatar}\" /></td>
											<td style=\"vertical-align: middle;text-align:center\">{$username_nv}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$tendaydu}</td>
											
											<td style=\"vertical-align: middle;text-align:center\">{$nhom}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$button}</td>
										</tr>
											";

										}
								}
										?>
										

									</tbody>
								</table>
							</div>

						</section>
						<!--Thêm Tài Khoản-->
									<div id="modalForm_addteam" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm Nhóm Sales</h2>
											</header>
											<form id="add_team" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên nhóm</label>
														<div class="col-sm-9">
															<input type="text" name="ten" class="form-control" required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Mã Vận Đơn</label>
														<div class="col-sm-9">
															<input type="text" name="mavandon" class="form-control" required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Số Hotline</label>
														<div class="col-sm-9">
															<input type="text" name="hotline" class="form-control" required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Hệ thống GHTK</label>
														<div class="col-sm-9">
															<select data-plugin-selecttwo="" name="select_api" class="form-control populate">
																<?php
																	$a = mysql_query("select * from api");
																	while($b = mysql_fetch_array($a))
																	{
																		$ten = $b['ten'];
																		$maapi_db = $b['maapi'];
																		$id = $b['id'];
																		if($maapi == $maapi_db)
																		$select = "<option value=\"{$id}\" selected=\"selected\">{$maapi_db}</option>";
																	else $select = "<option value=\"{$id}\">{$maapi_db}</option>";
																		echo "
																	<optgroup label=\"{$ten}\">
																	{$select}
																		</optgroup>
																		";
																	}

																?>
														
														
													</select>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Tạo Nhóm</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>	
									<!--Addmember-->
									<div id="modalForm_addmember" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Thêm nhân viên vào nhóm</h2>
											</header>
											<form id="add_user" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<?php
															$sql_nv_empty_team = mysql_query("select id,fullname from user where team_id='0' and id!='1' and groupid in ( select id from usergroup where quanlynhanvien ='0' and banhang='1')");
															while($list_nv_empty_team = mysql_fetch_array($sql_nv_empty_team))
															{
																echo "
																		<div class=\"checkbox-custom checkbox-default col-md-6\">
																<input type=\"checkbox\" id=\"checkboxExample{$list_nv_empty_team['id']}\" name=\"nv_empty[]\" value=\"{$list_nv_empty_team['id']}\">
																<label for=\"checkboxExample{$list_nv_empty_team['id']}\">{$list_nv_empty_team['fullname']}</label>
															</div>
																";
															}
														?>
														

														
														</div>
															
													

													


													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Nhân Viên Này Vào Nhóm</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>	
						<!--Sửa tài khoản -->
						<div id="modalForm_editteam" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Chỉnh Sửa Thông Tin Nhóm</h2>
											</header>
											<form id="form_editteam" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Nhóm</label>
														<div class="col-sm-9">
															<input type="text" name="ten" class="form-control" value="<?php echo $tennhom;?>" required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Mã Vận Đơn</label>
														<div class="col-sm-9">
															<input type="text" name="mavandon" class="form-control" value="<?php echo $mavandon_team; ?>" required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Số Hotline</label>
														<div class="col-sm-9">
															<input type="text" name="hotline" class="form-control" value="<?php echo $hotline; ?>" required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Hệ thống GHTK</label>
														<div class="col-sm-9">
															<select data-plugin-selecttwo="" name="select_api" class="form-control populate">
																<?php
																	$a = mysql_query("select * from api");
																	while($b = mysql_fetch_array($a))
																	{
																		$ten = $b['ten'];
																		$maapi_db = $b['maapi'];
																		$id = $b['id'];
																		if($maapi == $maapi_db)
																		$select = "<option value=\"{$id}\" selected=\"selected\">{$maapi_db}</option>";
																	else $select = "<option value=\"{$id}\">{$maapi_db}</option>";
																		echo "
																	<optgroup label=\"{$ten}\">
																	{$select}
																		</optgroup>
																		";
																	}

																?>
														
														
													</select>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Chỉnh Sửa</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>	
<?php elseif(isset($_GET['do'])): ?>

    <!-- else -->
<?php endif; ?>

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


			 function kickout(value){
			 	
                $.ajax({
                    url : "ajax_team.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         kickout : value,
                        
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
$("form#add_team").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_team.php?dosomething=add_team',
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
$("form#form_editteam").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_team.php?dosomething=edit_team',
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
//Thêm nhân viên vào team
$("form#add_user").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_team.php?dosomething=add_user',
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