<?php
include("db.php");
include("config.php");
	$username = $_COOKIE['username'];
	$sql = mysql_query("select * from user where username='{$username}'");
	$dataUser = mysql_fetch_array($sql);
	$fullname = $dataUser['fullname'];
	$usergroup = $dataUser['groupid'];
	switch ($usergroup) {
		case 1: $group = "Nhân Viên";$permission = "nhanvien";break;
		case 2: $group = "Quản Lý";$permission = "quanly";break;
		case 3: $group = "Giám Đốc";$permission = "admin";break;
		default: $group = "Nhân Viên";$permission = "nhanvien";break;
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
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<!-- Sweetalert -->
		<script src="assets/javascripts/sweetalert/sweetalert2.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/javascripts/sweetalert/sweetalert2.min.css">
		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign body-locked">
			<div class="center-sign">
				<div class="panel panel-sign">
					<div class="panel-body">
						
							<div class="current-user text-center">
								<img src="assets/images/!logged-user.jpg" alt="<?php echo $username;?>" class="img-circle user-image" />
								<h2 class="user-name text-dark m-none"><?php echo $fullname;?></h2>
								<p class="user-email m-none"><?php echo $group;?></p>
							</div>
							<div class="form-group mb-lg">
								<div class="input-group input-group-icon">
									<input id="pwd" type="password" class="form-control input-lg" placeholder="Password" />
									<input type="text" id="user" style="display: none" value="<?php echo $username;?>" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="mt-xs mb-none">
										<a href="login.php">Không phải <?php echo $username;?></a>
									</p>
								</div>
								<div class="col-xs-6 text-right">
									<button class="btn btn-primary" onclick="submit()">Mở Khóa Màn Hình</button>
								</div>
							</div>
						
					</div>
				</div>
			</div>
			<div id="result">
				
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
<script language="javascript">
            function submit(){
                $.ajax({
                    url : "unlock.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         dosomething : 'unlock',
                         user : $('#user').val(),
                         passwd : $('#pwd').val(),
                        
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
        </script>
	</body>
</html>