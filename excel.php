<?php
 include("db.php");
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
 $today = date("Y-m-d");
// Bước 1: 
// Lấy dữ liệu từ database



    $a = mysql_query("select * from donhang where diachi LIKE '%Đà Lạt%'");
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
$PHPExcel->getActiveSheet()->setCellValue('B1', 'TÊN');
$PHPExcel->getActiveSheet()->setCellValue('C1', 'SDT');
$PHPExcel->getActiveSheet()->setCellValue('D1', 'ĐỊA CHỈ');





 
// Bước 7: Lặp data và gán vào file
// Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
$rowNumber = 2;
foreach ($data as $index => $item) 
{
	
	$diachi = $item[7];

    // A1, A2, A3, ...
    $PHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, ($index + 1));
    $PHPExcel->getActiveSheet()->setCellValue('B' . $rowNumber, $item[5]); 
	$PHPExcel->getActiveSheet()->setCellValue('C' . $rowNumber, $item[8]); 
        // C1, C2, C3, ...
    $PHPExcel->getActiveSheet()->setCellValue('D' . $rowNumber, $diachi);

        // C1, C2, C3, ...
    
        // C1, C2, C3, ...
    
     
    // Tăng row lên để khỏi bị lưu đè
    $rowNumber++;
}
 
// Bước 8: Khởi tạo đối tượng Writer
$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
 
// Bước 9: Trả file về cho client download
$date_excel = date("d-m-Y");
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="donhang.xls"');
header('Cache-Control: max-age=0');
if (isset($objWriter)) {
    $objWriter->save('php://output');
}