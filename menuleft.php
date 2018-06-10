
<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="index.php">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Bảng Điều Khiển</span>
										</a>
									</li>
									<li>
										<a href="hoso">
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Hồ Sơ Cá Nhân</span>
										</a>
									</li>
									<?php
									if($quyenhan['banhang'] =="1" and $quyenhan['mod'] =="0")
										echo "<li>
										<a href=\"bangluong\">
											<i class=\"fa fa-fax\" aria-hidden=\"true\"></i>
											<span>Bảng Lương</span>
										</a>
									</li>";
									?>
									<li>
										<a href="banhang">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i>
											<span>Bán Hàng</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>Đơn Hàng</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="donhang">
													 Danh sách đơn hàng
												</a>
											</li>
											<li>
												<a href="dangapi">
													Đăng API
												</a>
											</li>
											<li>
												<a href="dondanggiao">
													 Đơn Đang Giao
												</a>
											</li>
											<li>
												<a href="donthanhcong">
													 Đơn Thành Công
												</a>
											</li>
											<li>
												<a href="donthatbai">
													 Đơn Thất Bại
												</a>
											</li>
											
										</ul>
									</li>
									<?php
									include("check_access.php");
									if($quyenhan['xuatkho'] == "1")
										echo "
	<li class=\"nav-parent\">
	<a>
											<i class=\"fa fa-list-alt\" aria-hidden=\"true\"></i>
											<span>Xuất Kho</span>
										</a>
	<ul class=\"nav nav-children\">
	<li>
										<a href=\"xuatkho\">
											<i class=\"fa fa-suitcase\" aria-hidden=\"true\"></i>
											<span>Xuất Kho</span>
										</a>
									</li>
									<li>
										<a href=\"thongkekhohang\">
											<i class=\"fa fa-suitcase\" aria-hidden=\"true\"></i>
											<span>Lịch Sử Xuất Kho</span>
										</a>
									</li>
										<li>
										<a href=\"hoanhang\">
											<i class=\"fa fa-suitcase\" aria-hidden=\"true\"></i>
											<span>Hoàn Hàng</span>
										</a>
									</li>
									<li>
										<a href=\"thongkehanghoan\">
											<i class=\"fa fa-suitcase\" aria-hidden=\"true\"></i>
											<span>Thống Kê Hàng Hoàn</span>
										</a>
									</li>
									

	</ul>
</li>	
									";
									

									?>
									
								</ul>
							</nav>
				

				
				
				
							
						</div>
				
					</div>
										<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    var full_path = location.href.split("#")[0];

    $(".nav-main li a").each(function(){

        var $this = $(this);

        if($this.prop("href").split("#")[0] == full_path) {

            $(this).parent().addClass("nav-active");

        }

    });

});


					</script>