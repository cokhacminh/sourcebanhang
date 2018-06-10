<?php
include("config.php");
include("check_access.php");

?>
<?php
$today = date("Y-m-d");
// Bước 1: 
// Lấy dữ liệu từ database

if(isset($_POST['chonngay']))
{
	$chonngay = $_POST['chonngay'];
	$tachngay_a = explode("/", $chonngay);
	$chonngay = $tachngay_a[2]."-".$tachngay_a[0]."-".$tachngay_a[1];
	$list_type = $_POST['list_type'];
	$excel_ext = "";
	if($list_type == "0")$excel_ext = "(chuagoi)";
	elseif($list_type ==1)$excel_ext = "(dagoi)";
	elseif($list_type =="all")$excel_ext = "";
	$id_nhanvien = $_POST['id_nhanvien'];
	$a = mysql_query("select username from user where id='{$id_nhanvien}'");
	$b = mysql_fetch_array($a);
	$c = $b['username'];
	if($id_nhanvien == "all")
	{
		if($list_type !="all")
		$wheretype = " and goihang = '{$list_type}'";
		else $wheretype ="";
		$where = "where id_nhanvien in ( select id from user where team_id='{$teamID}') and ( thoigian between '{$chonngay} 00:00:00' and '{$chonngay} 23:59:59' ){$wheretype}";
		$name_excel = "donhang";
	}
	else 
		{
			if($list_type !="all")
			$wheretype = " and goihang = '{$list_type}'";
			else $wheretype ="";
			$where = "where id_nhanvien='{$id_nhanvien}' and (thoigian between '{$chonngay} 00:00:00' and '{$chonngay} 23:59:59'){$wheretype}";
			$name_excel = $c;
		}
    $a = mysql_query("select * from donhang {$where}");
    $z = mysql_num_rows($a);
if(!isset($z) or $z == 0)
    	echo "<script>alert('Lựa chọn không hợp lệ - {$excel_ext}')</script>";
else
{


    while($b= mysql_fetch_array($a))
    {
        $data[] = $b;
    }







// Bước 2: Import thư viện phpexcel
include("PHPExcel.php");
 
// Bước 3: Khởi tạo đối tượng mới và xử lý
$PHPExcel = new PHPExcel();
 
// Bước 4: Chọn sheet - sheet bắt đầu từ 0
$PHPExcel->setActiveSheetIndex(0);
 
// Bước 5: Tạo tiêu đề cho sheet hiện tại
$PHPExcel->getActiveSheet()->setTitle('Đơn Hàng');
 
// Bước 6: Tạo tiêu đề cho từng cell excel, 
// Các cell của từng row bắt đầu từ A1 B1 C1 ...
$PHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
$PHPExcel->getActiveSheet()->setCellValue('B1', 'MÃ ĐƠN');
$PHPExcel->getActiveSheet()->setCellValue('C1', 'MÃ GHTK');
$PHPExcel->getActiveSheet()->setCellValue('D1', 'TÊN KH');
$PHPExcel->getActiveSheet()->setCellValue('E1', 'SDT');
$PHPExcel->getActiveSheet()->setCellValue('F1', 'ĐỊA CHỈ');
$PHPExcel->getActiveSheet()->setCellValue('G1', 'ĐƠN HÀNG');
$PHPExcel->getActiveSheet()->setCellValue('H1', 'COD');
$PHPExcel->getActiveSheet()->setCellValue('I1', 'GHI CHÚ');
$PHPExcel->getActiveSheet()->setCellValue('J1', 'TÌNH TRẠNG');
 
// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
$rowNumber = 2;
foreach ($data as $index => $item) 
{
	$sanpham = $item[9];
	//Duyệt đơn hàng
	$donhang = "";
	$tach_a = explode("|", $sanpham);
	foreach ($tach_a as $array) {
	$tach_b = explode("-", $array);
	$key = $tach_b[0];
	$value = $tach_b[1];
	$xuly_a = getNameProduct($key);
	$sanpham_a = $xuly_a." : ".$value." Cái . ";
	$donhang.=$sanpham_a;
	$tinhtrang = $item[15];
	if($tinhtrang == 0) $goihang = "CHƯA GÓI";
	elseif($tinhtrang ==1) $goihang ="ĐÃ GÓI";
												
	}
    // A1, A2, A3, ...
    $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, ($index + 1));
     
    // B1, B2, B3, ...
    $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $item[1]);
	$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $item[2]);
    // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $item[5]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $item[8]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $item[7]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $donhang);
    $PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $item[11]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $item[12]);
     $PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $goihang);
    // Tăng row lên để khỏi bị lưu đè
    $rowNumber++;
}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
// Bước 9: Trả file về cho client download
$date_excel = $tachngay_a[1]."-".$tachngay_a[0];
$ten_excel = $name_excel.$excel_ext."-".$date_excel;

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ten_excel.'.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}
}

}
?>
		<?php 
if(!isset($permission) or $permission =="nhanvien")
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
  window.location = \"{$site_url}/template/errors.php\"
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

		<!--Header-->
<?php include("template/header.php");?>
		<!--End Header-->
	</head>
	<body>

		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="" class="logo">
						<img src="<?php echo $site_url;?>/assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
			
					<?php include("template/userbox.php");?>
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
<?php if(!isset($_POST['fromdate'])): ?>
<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">DANH SÁCH ĐƠN HÀNG HÔM NAY</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<form name"form_excel" action="#" method="POST">
	<div class="col-sm-12">
<div class="col-sm-3 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															CHỌN NGÀY
														</span>
														<input type="text" class="form-control" id="fromdate" name="chonngay">
</div>														
</div>
<div class="col-sm-3 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="id_nhanvien" id="view_type">
													<option value="all">Toàn Bộ Nhân Viên</option>	
<?php
																$query = mysql_query("select * from user where id in ( select id from user where team_id='{$teamID}')");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['fullname'];

																		echo "<option value=\"{$id}\">{$fullname}</option>";


																}
																?>
																					
													</select>
</div>
<div class="col-sm-3 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="list_type">
													<option value="all">Toàn Bộ Đơn Hàng</option>

<option value="0">Đơn Chưa Gói</option>
<option value="1">Đơn Đã Gói</option>
																					
													</select>
</div>
<div class="col-sm-3 form-group">
<button type="submit" class="btn btn-sm btn-primary">XUẤT FILE EXCEL</button>
</div>
</div>
</div>



</form>


							</div>

					




   <!-- else -->
<?php endif; ?>







									<!-- Modal Form -->
									<div id="Form_edit_donhang" class="modal-block modal-block-primary mfp-hide" style="font-size: 18px;width: 900px">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">SỬA ĐƠN HÀNG</h2>
											</header>
											<form id="edit_donhang" action="" method="post" enctype="multipart/form-data">
											<div class="panel-body">
												
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Tên Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="text" id="suatensanpham" name="tensanpham" class="form-control" placeholder="Tên sản phẩm..." required/>
														</div>
													</div>
														<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Ảnh Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="file" name="anhsanpham" accept="image/*">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Mã Sản Phẩm</label>
														<div class="col-sm-9">
															<input type="text" name="masanpham"  class="form-control" placeholder="Mã sản phẩm..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Giá Bán</label>
														<div class="col-sm-9">
															<input type="number" name="giasanpham" class="form-control" placeholder="Giá Bán..." required="" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Nhóm</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate" name="nhomsanpham">
																<?php
																$query = mysql_query("select * from cataloge");
																while($do = mysql_fetch_array($query))
																{
																	$cataloge = $do['id'];
																	$cataloge_name = $do['ten'];
																	echo "<optgroup label=\"{$cataloge_name}\">";
																	$query1 = mysql_query("select * from nhomsanpham where catalogeid = '{$cataloge}'");
																	while($do1 = mysql_fetch_array($query1))
																	{
																		$id_nhomsanpham = $do1['id'];
																		$ten_nhomsanpham = $do1['ten'];
																		echo "<option value=\"{$id_nhomsanpham}\">{$ten_nhomsanpham}</option>";

																	}
																	echo "</optgroup>";
																}
																?>
																	
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Ghi chú</label>
														<div class="col-sm-9">
															<textarea name="ghichu" rows="5" class="form-control" placeholder="Thông tin về sản phẩm..."></textarea>
														</div>
													</div>
													<div class="form-group">
														
														<div class="col-sm-12" style="text-align: center">
															<button class="btn btn-primary">Thêm Sản Phẩm</button> <button class="btn btn-danger modal-dismiss">Hủy</button>
														</div>
													</div>
												
											</div>

										</form>
										</section>
									</div>
<!-- Modal Form -->

		


					<!-- end: page -->
				</section>
			</div>

			
		</section>

							<div id="result">

							</div>
		
										<div id='loadingmessage' style='display:none;position: absolute;top: 10%;left: 25%;z-index: 909999;width: 50%;'>
  <img src='<?php echo $site_url;?>/images/loadding.gif'/>
</div>								
		<!-- Footer-->
<?php include("template/footer.php");?>
		<!--End Footer-->
		<script type="text/javascript">

//Sửa
$("form#edit_donhang").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: 'ajax_donhang.php',
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
 function suadonhang(value){

                  $.ajax({
                    url : "ajax_donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	donhang : value,
                    	
                    },
                    success : function (result){
                    	$('#edit_donhang').html(result)
                    }
                });
}
             function xoadonhang(value){
					$('#loadingmessage').show();
                  $.ajax({
                    url : "ajax_donhang.php",
                    type : "post",
					
                    dataType:"text",
                    data : {
                    	token: 'xoadonhang',
                    	donhang : value,
                    	
                    },
                    success : function (result){
						 
                    	$('#test_result').html(result)
						$('#loadingmessage').hide();
                    },

                });
}
 function xacnhan(value){

                  $.ajax({
                    url : "ajax_donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	xacnhandonhang : value,
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}
            function change_view(value){
                $.ajax({
                    url : "ajax_product.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         view_type : value,

                    },
                    success : function (result){
                        $('#list_products').html(result);
                    }
                });
            }
removeDiv = function(el) {
    $(el).parents(".RemoveDiv").remove()       
}
 function addInput(){

                  $.ajax({
                    url : "ajax_donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	addinputid : $('#SelectToAdd').val(),
                    	
                    },
                    success : function (result){
						//(result).appendTo( "#toAddInput" );
                    	//$('#result').html(result)
							$("#toAddInput").append(result);
                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}
		</script>
		<div id="test_result" style="z-index: 999999">
														</div>
	</body>
</html>