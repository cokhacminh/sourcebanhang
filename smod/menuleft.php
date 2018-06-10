<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="thongke">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Thống Kê Tình Hình</span>
										</a>
									</li>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-user" aria-hidden="true"></i>
											<span>Quản Lý Nhân Viên</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="nhanvien">
													 Danh Sách Nhân Viên
												</a>
											</li>
											<li>
												<a href="chamcong">
													 Chấm Công Nhân Viên
												</a>
											</li>
											<li>
												<a href="listteam">
													 Danh Sách Team
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-hospital-o" aria-hidden="true"></i>
											<span>Danh Sách Sản Phẩm</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="sanpham">
													 Toàn Bộ Sản Phẩm
												</a>
											</li>
											<?php
											$a = mysql_query("select id,ten from nhomsanpham");
											while($b = mysql_fetch_array($a))
											{
												$ten = $b['ten'];
												
												echo "<li>
												<a href=\"sanpham-{$b['id']}\">
													 Danh Sách {$ten}
												</a>
											</li>";
											}
											?>
											<li>
												<a href="thongkekhohang">
													 Lịch Sử Xuất/Nhập Kho
												</a>
											</li>
										</ul>
									</li>
									
									<li class="nav-parent">
										<a>
											<i class="fa fa-file-text-o" aria-hidden="true"></i>
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
											<li>
												<a href="chodoisoat">
													 Đơn Chờ Đối Soát
												</a>
											</li>
										
										</ul>
									</li>
									<li>
										<a href="khuvucgiaohang">
											<i class="fa fa-truck" aria-hidden="true"></i>
											<span>Khu Vực Giao Hàng</span>
										</a>
									</li>
									<li>
										<a href="indon">
											<i class="fa fa-print" aria-hidden="true"></i>
											<span>In Đơn Hàng</span>
										</a>
									</li>
									<li>
										<a href="xuatexcel">
											<i class="fa fa-file-excel-o" aria-hidden="true"></i>
											<span>Xuất File Excel</span>
										</a>
									</li>
									<li>
										<a href="hangbanra">
											<i class="fa fa-share-square-o" aria-hidden="true"></i>
											<span>Hàng Bán Ra</span>
										</a>
									</li>

									<li class="nav-parent">
										<a>
											<i class="fa fa-list-alt" aria-hidden="true"></i>
											<span>Xuất Kho</span>
												</a>
										<ul class="nav nav-children">
											<li>
												<a href="xuatkho">
													<i class="fa fa-suitcase" aria-hidden="true"></i>
													<span>Xuất Kho</span>
												</a>
											</li>
											<li>
												<a href="thongkekhohang">
													<i class="fa fa-suitcase" aria-hidden="true"></i>
													<span>Lịch Sử Xuất Kho</span>
												</a>
											</li>
												<li>
												<a href="hoanhang">
													<i class="fa fa-suitcase" aria-hidden="true"></i>
													<span>Hoàn Hàng</span>
												</a>
											</li>
											<li>
												<a href="thongkehanghoan">
													<i class="fa fa-suitcase" aria-hidden="true"></i>
													<span>Thống Kê Hàng Hoàn</span>
												</a>
											</li>
										</ul>
									</li>	
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