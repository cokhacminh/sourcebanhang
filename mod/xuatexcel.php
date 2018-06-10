<?php
include("../config.php");
include("../check_access.php");
$api_status_id = array(
"0"=>"Chưa tiếp nhận",
"-1"=>"Đã Hủy",
"1"=>"Chưa tiếp nhận",
"2"=>"Đã tiếp nhận",
"3"=>"Đã lấy hàng/Đã nhập kho",
"4"=>"Đã điều phối giao hàng/Đang giao hàng",
"5"=>"Đã giao hàng/Chưa đối soát",
"6"=>"Đã Đối Soát",
"7"=>"Không lấy được hàng",
"8"=>"Hoãn lấy hàng",
"9"=>"Không giao được hàng",
"10"=>"Delay giao hàng",
"11"=>"Đã đối soát trả hàng",
"12"=>"Đang lấy hàng",
"20"=>"Đang trả hàng",
"21"=>"Đã trả hàng",
"123"=>"Shipper báo đã lấy hàng",
"127"=>"Shipber báo không lấy được hàng",
"128"=>"Shiper báo delay lấy hàng",
"45"=>"Shiper báo đã giao hàng",
"49"=>"Shiper báo không giao được hàng",
"410"=>"Shiper báo delay giao hàng",
"99"=>"Lạc Trôi"
);
?>
<?php
if(isset($_POST['export_excel_idnhanvien']))
{
//XỬ LÝ CHỌN NGÀY
if($_POST['tungay'] =="")
{
	$month = date("m");
	$year = date("Y");
	$fromdate = $month."/01/".$year;
	$name_from_excel = "01_".$month;
}
else 
	$fromdate = $_POST['tungay'];
	$tachngay = explode("/",$fromdate);
	$name_from_excel = $tachngay[1]."_".$tachngay[0];
if($_POST['denngay'] =="")
{
	$date = date("m/d/Y");
	$todate = $date;
	$name_to_excel = date("d_m");
}
else
	$todate = $_POST['denngay'];
	$tachngay = explode("/",$todate);
	$name_to_excel = $tachngay[1]."_".$tachngay[0];
	$name_excel = "donhang-".$name_from_excel."-den-".$name_to_excel;
	$fromdate = CreatFromDate($fromdate);
	$todate = CreatToDate($todate);
//
$id_nhanvien = $_POST['id_nhanvien'];
$list_type = $_POST['list_type'];
if($id_nhanvien =="all")
{
	$where1 = "";
}
elseif($id_nhanvien !="")
{
	$where1 = "id_nhanvien = '{$id_nhanvien}'";
}
if($list_type =="all")
{
	$where2 = "";
}
elseif($list_type =="0")
{
	$where2 = "goihang='0'";
}
elseif($list_type =="1")
{
	$where2 = "goihang='1'";
}
if($where1 !="" && $where2 =="")
{
	$where = "and {$where1}";
}
if($where1 !="" && $where2 !="")
{
	$where = "and {$where1} and {$where2}";
}
elseif($where1 =="" && $where2 !="")
{
	$where = "and {$where2}";
}
elseif($where1 =="" && $where2 =="")
{
	$where = "";
}
$sql = "select * from donhang where (thoigian between '{$fromdate}' and '{$todate }') {$where} order by id_nhanvien";
$a = mysql_query($sql);
    while($b= mysql_fetch_array($a))
    {
        $data[] = $b;
    }
// Bước 2: Import thư viện phpexcel
include("../PHPExcel.php");
 
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
$PHPExcel->getActiveSheet()->setCellValue('D1', 'TÊN NHÂN VIÊN');
$PHPExcel->getActiveSheet()->setCellValue('E1', 'TÊN KH');
$PHPExcel->getActiveSheet()->setCellValue('F1', 'SDT');
$PHPExcel->getActiveSheet()->setCellValue('G1', 'ĐỊA CHỈ');
$PHPExcel->getActiveSheet()->setCellValue('H1', 'ĐƠN HÀNG');
$PHPExcel->getActiveSheet()->setCellValue('I1', 'TỔNG TIỀN');
$PHPExcel->getActiveSheet()->setCellValue('J1', 'GHI CHÚ');
$PHPExcel->getActiveSheet()->setCellValue('K1', 'TÌNH TRẠNG');
$PHPExcel->getActiveSheet()->setCellValue('L1', 'COD');
$PHPExcel->getActiveSheet()->setCellValue('M1', 'STATUS');
 
// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
$rowNumber = 2;
foreach ($data as $index => $item) 
{
	$sanpham = $item[10];
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
	$idnhanvien = $item[4];
	$j = getname($idnhanvien);
	$tinhtrang = $item[16];
	if($tinhtrang == 0) $guihang = "CHƯA GỬI";
	elseif($tinhtrang ==1) $guihang ="ĐÃ GỬI";
	$status_id = $item[16];
	$status = $api_status_id[$status_id];												
	}
    // A1, A2, A3, ...
    $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, ($index + 1));
     
    // B1, B2, B3, ...
    $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $item[1]);
	$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $item[2]);
	$PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $j);
    // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $item[6]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $item[9]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $item[8]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $donhang);
    $PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $item[12]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $item[13]);
	
     $PHPExcel->getActiveSheet()->setCellValue('K' . $rowNumber, $guihang);
	 $PHPExcel->getActiveSheet()->setCellValue('L' . $rowNumber, $item[18]);
	 $PHPExcel->getActiveSheet()->setCellValue('M' . $rowNumber, $status);
    // Tăng row lên để khỏi bị lưu đè
    $rowNumber++;
}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
// Bước 9: Trả file về cho client download
$ten_excel = "test";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name_excel.'.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}
echo "<script>alert('123')</script>";
}
?>
<?php
if(isset($_POST['export_excel_team']))
{
//XỬ LÝ CHỌN NGÀY
if($_POST['tungay'] =="")
{
	$month = date("m");
	$year = date("Y");
	$fromdate = $month."/01/".$year;
	$name_from_excel = "01_".$month;
}
else 
	$fromdate = $_POST['tungay'];
	$tachngay = explode("/",$fromdate);
	$name_from_excel = $tachngay[1]."_".$tachngay[0];
if($_POST['denngay'] =="")
{
	$date = date("m/d/Y");
	$todate = $date;
	$name_to_excel = date("d_m");
}
else
	$todate = $_POST['denngay'];
	$tachngay = explode("/",$todate);
	$name_to_excel = $tachngay[1]."_".$tachngay[0];
	$name_excel = "donhang-".$name_from_excel."-den-".$name_to_excel;
	$fromdate = CreatFromDate($fromdate);
	$todate = CreatToDate($todate);
//
$team_id = $_POST['team_id'];
$list_type = $_POST['list_type'];
if($team_id =="all")
{
	$where1 = "";
}
elseif($team_id !="")
{
	$where1 = "id_nhanvien in ( select id from user where team_id='{$team_id}')";
}
if($list_type =="all")
{
	$where2 = "";
}
elseif($list_type =="0")
{
	$where2 = "goihang='0'";
}
elseif($list_type =="1")
{
	$where2 = "goihang='1'";
}
if($where1 !="" && $where2 =="")
{
	$where = "and {$where1}";
}
if($where1 !="" && $where2 !="")
{
	$where = "and {$where1} and {$where2}";
}
elseif($where1 =="" && $where2 !="")
{
	$where = "and {$where2}";
}
elseif($where1 =="" && $where2 =="")
{
	$where = "";
}
$sql = "select * from donhang where (thoigian between '{$fromdate}' and '{$todate }') {$where} order by id_nhanvien";
$a = mysql_query($sql);
    while($b= mysql_fetch_array($a))
    {
        $data[] = $b;
    }
// Bước 2: Import thư viện phpexcel
include("../PHPExcel.php");
 
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
$PHPExcel->getActiveSheet()->setCellValue('D1', 'TÊN NHÂN VIÊN');
$PHPExcel->getActiveSheet()->setCellValue('E1', 'TÊN KH');
$PHPExcel->getActiveSheet()->setCellValue('F1', 'SDT');
$PHPExcel->getActiveSheet()->setCellValue('G1', 'ĐỊA CHỈ');
$PHPExcel->getActiveSheet()->setCellValue('H1', 'ĐƠN HÀNG');
$PHPExcel->getActiveSheet()->setCellValue('I1', 'TỔNG TIỀN');
$PHPExcel->getActiveSheet()->setCellValue('J1', 'GHI CHÚ');
$PHPExcel->getActiveSheet()->setCellValue('K1', 'TÌNH TRẠNG');
$PHPExcel->getActiveSheet()->setCellValue('L1', 'COD');
$PHPExcel->getActiveSheet()->setCellValue('M1', 'STATUS');
 
// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
$rowNumber = 2;
foreach ($data as $index => $item) 
{
	$sanpham = $item[10];
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
	$idnhanvien = $item[4];
	$j = getname($idnhanvien);
	$tinhtrang = $item[16];
	if($tinhtrang == 0) $guihang = "CHƯA GỬI";
	elseif($tinhtrang ==1) $guihang ="ĐÃ GỬI";
	$status_id = $item[16];
	$status = $api_status_id[$status_id];												
	}
    // A1, A2, A3, ...
    $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, ($index + 1));
     
    // B1, B2, B3, ...
    $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $item[1]);
	$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $item[2]);
	$PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $j);
    // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('E' . $rowNumber, $item[6]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('F' . $rowNumber, $item[9]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('G' . $rowNumber, $item[8]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('H' . $rowNumber, $donhang);
    $PHPExcel->getActiveSheet()->setCellValue('I' . $rowNumber, $item[12]);
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('J' . $rowNumber, $item[13]);
	
     $PHPExcel->getActiveSheet()->setCellValue('K' . $rowNumber, $guihang);
	 $PHPExcel->getActiveSheet()->setCellValue('L' . $rowNumber, $item[18]);
	 $PHPExcel->getActiveSheet()->setCellValue('M' . $rowNumber, $status);
    // Tăng row lên để khỏi bị lưu đè
    $rowNumber++;
}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
// Bước 9: Trả file về cho client download
$ten_excel = "test";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name_excel.'.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}
echo "<script>alert('123')</script>";
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

		<!--Header-->
<?php include("../template/header.php");?>
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

<section class="panel panel-primary">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">XUẤT FILE EXCEL THEO CÁ NHÂN</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<form action="#" method="POST">
	<div class="col-sm-12">
<div class="col-sm-4 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" name="tungay">
														<span class="input-group-addon">
															ĐẾN NGÀY
														</span>
														<input type="text" class="form-control" name="denngay">
</div>														
</div>
<div class="col-sm-3 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="id_nhanvien">
													<option value="all">Toàn Bộ Nhân Viên</option>	
<?php
																$query = mysql_query("select id,fullname from user where id != '1'");
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
<div class="col-sm-2 form-group">
<button type="submit" class="btn btn-sm btn-primary" name="export_excel_idnhanvien">XUẤT FILE EXCEL</button>
</div>
</div>
</div>



</form>


							</div>
</section>
<section class="panel panel-danger">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>
						
								<h2 class="panel-title">XUẤT FILE EXCEL THEO NHÓM</h2>
							</header>
							<div class="panel-body" style="font-size: 18px;">
								<div class="row">
<form action="#" method="POST">
	<div class="col-sm-12">
<div class="col-sm-4 form-group">
<div class="input-daterange input-group" data-plugin-datepicker>
	<span class="input-group-addon">
															TỪ NGÀY
														</span>
														<input type="text" class="form-control" name="tungay">
														<span class="input-group-addon">
															ĐẾN NGÀY
														</span>
														<input type="text" class="form-control" name="denngay">
</div>														
</div>
<div class="col-sm-3 form-group">
<select data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "", "allowClear": true }' name="team_id">
													<option value="all">Tất cả các nhóm</option>	
<?php
																$query = mysql_query("select id,ten from team");
																while($do = mysql_fetch_array($query))
																{
																	$id = $do['id'];
																	$fullname = $do['ten'];

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
<div class="col-sm-2 form-group">
<button type="submit" class="btn btn-sm btn-danger" name="export_excel_team">XUẤT FILE EXCEL</button>
</div>
</div>
</div>



</form>


							</div>
</section>
					<!-- end: page -->

			</div>

			
		</section>
					
		<!-- Footer-->
<?php include("../template/footer.php");?>
		<!--End Footer-->

	</body>
</html>