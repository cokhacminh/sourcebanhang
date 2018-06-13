<?php
include("../check_access.php");
include("../function/function.php");
$tennhanvien = getnamebyusername($username);
$a = mysql_query("select * from user where id='{$id_nhanvien}'");
$data = mysql_fetch_array($a);
if(isset($_POST['token']))
{
    if($_POST['token'] == "thongtinchung")
    {

       
        $tennhanvien = $_POST['tennhanvien'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $ngaysinh = $_POST['ngaysinh'];
        $email = $_POST['email'];
        $facebook = $_POST['facebook'];
          if($_FILES['avatar']['name'] != NULL)
    { // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['avatar']['type'] == "image/jpeg"
        || $_FILES['avatar']['type'] == "image/png"
        || $_FILES['avatar']['type'] == "image/jpg"
        || $_FILES['avatar']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "images/avatar"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['avatar']['tmp_name'];
                $name = $_FILES['avatar']['name'];
                $type = $_FILES['avatar']['type']; 
                $size = $_FILES['avatar']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $username.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
               chmod($path, 0755);
        }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noavatar.png";
        $import = ",avatar='{$hinhanh}'";
    }

        $do = mysql_query("update user set fullname='{$tennhanvien}'{$import},sodienthoai='{$sodienthoai}',diachi='{$diachi}',ngaysinh='{$ngaysinh}',email='{$email}',facebook='{$facebook}' where id='{$id_nhanvien}'");
            if($do)echo "
<script>

  	window.location.assign('hoso');
</script>
    	";

}
}
if(isset($_POST['token']) && $_POST['token'] =="tugioithieu")
{
	$tugioithieu = $_POST['tugioithieu'];
	$do = mysql_query("update user set tugioithieu='{$tugioithieu}' where id='{$id_nhanvien}'");
	            if($do)echo "
<script>

  	window.location.assign('hoso');
</script>
    	";
}
if(isset($_POST['token']) && $_POST['token'] =="doimatkhau")
{
	$oldpass = md5($_POST['oldpass']);
	$newpass = md5($_POST['newpass']);
	$renewpass = md5($_POST['renewpass']);
	$a = mysql_query("select * from user where id='{$id_nhanvien}'");
	$b = mysql_fetch_array($a);
	$c = $b['passwd'];
	if($newpass != $renewpass)
	$err = "Mật khẩu mới không trùng nhau"	;
	elseif($oldpass == $newpass or $oldpass == $renewpass)
	$err = "Mật khẩu cũ giống mật khẩu mới"	;
else 
{
	if($c == $oldpass)
	{
		$do = mysql_query("update user set passwd='{$newpass}' where id='{$id_nhanvien}'");
		 if($do)echo "
<script>

  	window.location('profile.php');
</script>
    	";
	}
	else $err = "Mật khẩu cũ không chính xác";
}
	if($err !="")
	echo "
<script>
alert('{$err}')
  	window.location('profile.php');

</script>";
}
?>

<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Hồ Sơ Nhân Viên</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">
		<!-- Sweetalert -->
		<script src="../assets/javascripts/sweetalert/sweetalert2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/javascripts/sweetalert/sweetalert2.min.css">
		<!-- Head Libs -->
		<script src="../assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
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
						<h2>Hồ Sơ Nhân Viên</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Hồ Sơ</span></li>
							</ol>
					
							
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img style="border: 1px solid rgba(0, 0, 0, 0.4);width: 100%;box-shadow: 1px 1px 5px" src="<?php echo $site_url."/images/avatar/".$avatar_nhanvien;?>" class="rounded img-responsive" alt="">
										<div class="thumb-info-title" style="height:65px;">
											<span class="thumb-info-inner"><?php echo $tennhanvien;?></span>
											<span class="thumb-info-type"><?php echo $group;?></span>
										</div>
									</div>

									<div class="widget-toggle-expand mb-md">

										<div class="widget-content-expanded">
											<ul class="simple-todo-list">
												<li>Ngày Sinh : <b><?php echo $data['ngaysinh'];?></b></li>
												<li>Điện Thoại : <b><?php echo $data['sodienthoai'];?></b></li>
												<li>Địa Chỉ : <b><?php echo $data['diachi'];?></b></li>
												<li>Email : <b><?php echo $data['email'];?></b></li>
												<li>Facebook : <a href='<b><?php echo $data['facebook'];?>'><?php echo $data['facebook'];?></a></b></li>
												
											</ul>
										</div>
									</div>

									<hr class="dotted short">

									<h6 class="text-muted">Tự Giới Thiệu</h6>
									<p style="white-space: pre-wrap;"><?php echo $data['tugioithieu'];?></p>
								</div>
							</section>


							

							

						</div>
						<div class="col-md-8 col-lg-6">

							<div class="tabs">
								<ul class="nav nav-tabs nav-justified tabs-primary">

									<li class="active">
										<a href="#thongtinchung" data-toggle="tab">Thông Tin Chung</a>
									</li>

									<li>
										<a href="#loigioithieu" data-toggle="tab">Lời Giới Thiệu</a>
									</li>
									<li>
										<a href="#doimatkhau" data-toggle="tab">Đổi Mật Khẩu</a>
									</li>
								</ul>
								<div class="tab-content">
									
									<div id="thongtinchung" class="tab-pane active">

										
											<h4 class="mb-xlg">Chỉnh Sửa Hồ Sơ Cá Nhân</h4>
											<fieldset>
												<form action="" method="post" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-md-3 control-label" for="tennhanvien">Tên Nhân Viên</label>
													<div class="col-md-8">
														<input type="text" style="display: none" name="token" value="thongtinchung">
														<input type="text" class="form-control" id="tennhanvien" name="tennhanvien" value="<?php echo $data['fullname'];?>" placeholder="Nhập tên đầy đủ...">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="tennhanvien">Hình Đại Diện</label>
													<div class="col-md-8">
															<input type="file" name="avatar" accept="image/*">
													</div>
												</div>												
												<div class="form-group">
													<label class="col-md-3 control-label" for="sodienthoai">Số Điện Thoại</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="sodienthoai" name="sodienthoai" value="<?php echo $data['sodienthoai'];?>" placeholder="Nhập số điện thoại...">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="diachi">Địa Chỉ</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="diachi" name="diachi" value="<?php echo $data['diachi'];?>" placeholder="Nhập Địa Chỉ ...">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="ngaysinh">Ngày Sinh</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="ngaysinh" name="ngaysinh" value="<?php echo $data['ngaysinh'];?>" placeholder="Nhập ngày sinh...">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="email">Email</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email'];?>" placeholder="Nhập email...">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="facebook">Facebook</label>
													<div class="col-md-8">
														<input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $data['facebook'];?>" placeholder="Nhập link facebook...">
													</div>
												</div>
												
											</fieldset>
											<center><button type="submit" style="width: 30%" class="mb-xs mt-xs mr-xs btn btn-warning btn-block"><i class="fa fa-save"></i> Lưu </button></center>
											</form>
							
									</div>
										<div id="loigioithieu" class="tab-pane">
										<form action="" method="post">
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileBio">Sở thích hoặc tính cách hoặc châm ngôn yêu thích cá nhân</label>
													<div class="col-md-8">
														<input type="text" name="token" value="tugioithieu" style="display: none">
														<textarea class="form-control" rows="3" name="tugioithieu"><?php echo $data['tugioithieu'];?></textarea>
													</div>
												</div>

											</fieldset>
											<center><button style="width: 30%" class="mb-xs mt-xs mr-xs btn btn-warning btn-block"><i class="fa fa-save"></i> Lưu </button></center>
										</form>
										</div>
										<div id="doimatkhau" class="tab-pane">
										<form method="post" action="">
											<h4 class="mb-xlg">Đổi Mật Khẩu</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-md-3 control-label" for="old_pass">Mật Khẩu Cũ</label>
													<div class="col-md-8">
														<input type="text" name="token" value="doimatkhau" style="display: none">
														<input type="password" class="form-control" id="old_pass" name="oldpass" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="newpass">Mật Khẩu Mới</label>
													<div class="col-md-8">
														<input type="password" class="form-control" id="newpass" name="newpass" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="re_newpass">Nhập Lại Mật Khẩu Mới</label>
													<div class="col-md-8">
														<input type="password" class="form-control" id="re_newpass" name="renewpass" required>
													</div>
												</div>
											</fieldset>
											<center><button style="width: 30%" class="mb-xs mt-xs mr-xs btn btn-warning btn-block"><i class="fa fa-save"></i> Lưu </button></center>
										</div>
										</form>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">

							
							<ul class="simple-card-list mb-xlg">
								<li class="primary">
									<h3>100</h3>
									<p>Đơn hàng thành công.</p>
								</li>
								<li class="primary">
									<h3>$ 1,890,000</h3>
									<p>Hoa Hồng .</p>
								</li>
								<li class="primary">
									<h3>$ 1,890,000</h3>
									<p>Lương Tháng Này.</p>
								</li>
							</ul>

							<h4 class="mb-md">Projects</h4>
							<ul class="simple-bullet-list mb-xlg">
								<li class="red">
									<span class="title">Porto Template</span>
									<span class="description truncate">Lorem ipsom dolor sit.</span>
								</li>
								<li class="green">
									<span class="title">Tucson HTML5 Template</span>
									<span class="description truncate">Lorem ipsom dolor sit amet</span>
								</li>
								<li class="blue">
									<span class="title">Porto HTML5 Template</span>
									<span class="description truncate">Lorem ipsom dolor sit.</span>
								</li>
								<li class="orange">
									<span class="title">Tucson Template</span>
									<span class="description truncate">Lorem ipsom dolor sit.</span>
								</li>
							</ul>

							

					</div>
					<!-- end: page -->
				</section>
			</div>


		</section>

		<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>
<script type="text/javascript">

		function save_loigioithieu(value){
		            $.ajax({
                    url : "../ajax/profile.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	id_nhanvien : value,
                    	token : 'loigioithieu',
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    }
                });
	}
		function editpass(value){
		            $.ajax({
                    url : "../ajax/profile.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	id_nhanvien : value,
                    	token : 'editpass',
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    }
                });
	}

</script>
<div id="result"></div>
	</body>
</html>