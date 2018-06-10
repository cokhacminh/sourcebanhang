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
												<a href="chiateam">
													 Chia Team Nhân Viên
												</a>
											</li>
											<li>
												<a href="listteam">
													 Danh Sách Team
												</a>
											</li>
											
										</ul>
									</li>

									<li>
										<a href="danhsachsanpham">
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Danh Sách Sản Phẩm</span>
										</a>
										
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
										<a href="xuatexcel">
											<i class="fa fa-file-excel-o" aria-hidden="true"></i>
											<span>Xuất File Excel</span>
										</a>
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