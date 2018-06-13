<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo $site_url;?>/images/avatar/<?php echo $avatar_nhanvien;?>" alt="<?php echo $fullname?>" class="img-circle" data-lock-picture="<?php echo $site_url;?>/images/avatar/<?php echo $avatar_nhanvien;?>" />
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
								if($quyenhan['admin'] =="1")
								{
									echo "
								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/admin\"><i class=\"fa fa-user-md\"></i> Vào Trang ADMIN</a>
								</li>
									";
								}
								if($quyenhan['smod'] == "1")
								{
									echo "

								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/smod\"><i class=\"fa fa-cogs\"></i> Trang Quản Lý Cấp Cao</a>
								</li>
								
									";
								}
								if($quyenhan['mod'] == "1")
								{
									echo "

								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/mod\"><i class=\"fa fa-cog\"></i> Vào Trang Quản Lý</a>
								</li>
								
									";
								}
								if($quyenhan['banhang'] == "1")
								{
									echo "

								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}\"><i class=\"fa fa-sign-in\"></i> Vào Trang Bán Hàng</a>
								</li>
								
									";
																
								}
								if($quyenhan['carebill'] == "1")
								{
									echo "

								<li>
									<a role=\"menuitem\" tabindex=\"-1\" href=\"{$site_url}/carebill\"><i class=\"fa fa-cog\"></i> Vào Trang Chăm Đơn</a>
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
                    url : "../check_access.php",
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
                    url : "../check_access.php",
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