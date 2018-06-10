<?php
include("check_access.php");
$a = mysql_query("select * from user where id='{$id_nhanvien}'");
$data = mysql_fetch_array($a);
?>
<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo $site_url;?>/images/avatar/<?php echo $data['avatar'];?>" alt="<?php echo $data['fullname']?>" class="img-circle" data-lock-picture="<?php echo $site_url;?>/images/avatar/<?php echo $data['avatar'];?>" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $fullname; ?></span>
								<span class="role"><?php echo $group; ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<?php
								if($usergroup ==3)
								{
									echo "
								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/admin\"><i class=\"fa fa-cogs\"></i> Vào Trang ADMIN</a>
								</li>
								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/quanly\"><i class=\"fa fa-cog\"></i> Vào Trang Quản Lý</a>
								</li>
									";
								}	

								?>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo $site_url;?>/hoso"><i class="fa fa-user"></i> Hồ Sơ</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" onclick="lockscreen();"><i class="fa fa-lock"></i> Khóa Màn Hình</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" onclick="logout();"><i class="fa fa-power-off"></i> Đăng Xuất</a>
								</li>
							</ul>
						</div>
					</div>
					<div id="dosomething">
					</div>
<script type="text/javascript">
            function lockscreen(){
                $.ajax({
                    url : "<?php echo $site_url;?>/check_access.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         dosomething : 'lockscreen',

                    },
                    success : function (result){
                        $('#dosomething').html(result);
                    }
                });
            }
           
            function logout(){
                $.ajax({
                    url : "<?php echo $site_url;?>/check_access.php",
                    type : "get",
                    dataType:"text",
                    data : {
                         dosomething : 'logout',

                    },
                    success : function (result){
                        $('#dosomething').html(result);
                    }
                });
            }

</script>			
<?php
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