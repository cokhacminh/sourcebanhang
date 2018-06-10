<?php
include("../config.php");
include("../check_access.php");
///
function tinhchiphi($ngay)
{
	$nums_day_of_month = date("t");
	//Tiền lương nhân viên
	$a = mysql_query("select id from user where id!='1'");
	$tongsonhanvien = mysql_num_rows($a);
	$tongsonhanvien = 75;
	$luongnhanvien = round($tongsonhanvien * 5500000 / $nums_day_of_month);
//Bù lỗ ship
$a = mysql_query("select id from donhang where thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59'");
$tongsodon = mysql_num_rows($a);
//Function tổng tiền hàng
$sql = mysql_query("select sanpham from donhang where thoigian between '{$ngay} 00:00:00' and '{$ngay} 23:59:59'");
while($kq = mysql_fetch_array($sql))
{
	$donhang = $kq['sanpham'];
	$tachdonhang = explode("|",$donhang);
	foreach($tachdonhang as $donhang)
	{
		$tachsanpham = explode("-",$donhang);
		$idsanpham = $tachsanpham[0];
		$soluong = $tachsanpham[1];
		$sql_find_nhomsanpham = mysql_query("select IDnhomsanpham from sanpham where id='{$idsanpham}'");
		$find_nhomsanpham = mysql_fetch_array($sql_find_nhomsanpham);
		$idnhomsanpham = $find_nhomsanpham['IDnhomsanpham'];
		$tongsanpham_theonhom[$idnhomsanpham] += $soluong;
	}
}
$soluongdam = $tongsanpham_theonhom[1];
$soluongdobodai = $tongsanpham_theonhom[7];
$soluongdobongan = $tongsanpham_theonhom[8];
$tiendam = $soluongdam * (99000-31000);
$tiendobongan = $soluongdobongan * (99000-41000);
$tiendobodai = $soluongdobodai * (149000-61000);
$loinhuanthuan = ($tiendam + $tiendobodai + $tiendobongan);

$tiennhapdam = $soluongdam * 31000;
$tiennhapdobodai = $soluongdobodai * 61000;
$tiennhapdobongan = $soluongdobongan * 41000;
$tongtiennhap = $tiennhapdam + $tiennhapdobodai + $tiennhapdobongan;

$tienbandam = $soluongdam * 99000;
$tienbandobongan = $soluongdobongan * 99000;
$tienbandobodai = $soluongdobodai * 149000;
$tongtienban = $tienbandam + $tienbandobodai + $tienbandobongan;
$bulohoan = round(($tongtienban * 0.2)-($tongtiennhap*0.1));
	$chiphicodinh_moingay = 0;
	$html = "";
	$nums_day_of_month = date("t");
	$a = mysql_query("select * from chiphi where type='chiphicodinh'");
	while($b = mysql_fetch_array($a))
		{
			$ten = $b['ten'];
			$sotien = $b['sotien'];
			$chiphicodinh = round($sotien/$nums_day_of_month);
			$chiphicodinh_moingay += $chiphicodinh;
			$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($chiphicodinh)." </font></td></tr>
			";
		}
	$chiphihangngay_moingay = 0;
	$a = mysql_query("select * from chiphi where type = 'chiphihangngay'");
	while($b = mysql_fetch_array($a))
	{
		$ten = $b['ten'];
		$id = $b['id'];
		$check = mysql_query("select sotien from chiphihangngay where idchiphi='{$id}' and ngay = '{$ngay}'");
		$rows = mysql_num_rows($check);
		if($rows==0)
		$sotien = 0;
		elseif($rows > 0)
		{
			$result = mysql_fetch_array($check);
			$sotien = $result['sotien'];
		}
	$chiphihangngay_moingay += $sotien;
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($sotien)." </font></td></tr>
			";
	}
	$chiphitheodon_moingay = 0;
	$a = mysql_query("select * from chiphi where type='chiphitheodon'");
	while($b = mysql_fetch_array($a))
	{
		$ten = $b['ten'];
		$sotien = $b['sotien'];
		$chiphitheodon = round($sotien * $tongsodon);
		$chiphitheodon_moingay += $chiphicodinh;
		$html.= "
				<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$ten}</td><td><font color='red'>".number_format($chiphitheodon)." </font></td></tr>
				";
	}
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Tổng nhân viên</td><td><font color='red'>".number_format($tongsonhanvien)." </font></td></tr>
			";		
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Lương nhân viên</td><td><font color='red'>".number_format($luongnhanvien)." </font></td></tr>
			";
	$html.= "
			<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>Bù Lỗ hoàn</td><td><font color='red'>".number_format($bulohoan)." </font></td></tr>
			";
	$chiphiphaitramoingay = $chiphicodinh_moingay + $chiphihangngay_moingay + $chiphitheodon_moingay + $luongnhanvien + $bulohoan;		
	$html.= "<tr style='border-top:1px solid black'><td>Tổng</td><td><font color='red'>".number_format($chiphiphaitramoingay)." </font></td></tr>";
	return $array = array("html"=>$html,"chiphi"=>$chiphiphaitramoingay,"loinhuanthuan"=>$loinhuanthuan);	
}
///	
if(isset($_GET['action']) && $_GET['action']=='themchiphi')
{
	$error = "";
	if(!isset($_POST['ten']) or $_POST['ten'] == "") $error = "Bạn chưa nhập tên chi phí";
	if(!isset($_POST['sotien']) or $_POST['sotien'] == "") $error = "Bạn chưa nhập số tiền";
	if(isset($error) && $error !="")
	{
		echo "
<script>
swal({
  title: 'CÓ LỖI',
  text: '{$error} . ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
})
</script>
		";
	}
	else
	{
	$ten = $_POST['ten'];
	$sotien = $_POST['sotien'];
	$theloai = $_POST['theloai'];
	$do = mysql_query("insert into {$theloai} (ten,sotien) values ('{$ten}','{$sotien}')");

	if($do)
	echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Bạn đã thêm chi phí : {$ten} !',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
})
.then(function () {
location.reload();
})
</script>
	";
	else echo "
<script>
swal({
  title: 'CÓ LỖI',
  text: 'Vui lòng kiểm tra dữ lại dữ liệu nhập vào . ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
})
.then(function () {
location.reload();
})
</script>
		";
}
}
if(isset($_GET['viewbydate']))
{
	$ngay = $_GET['viewbydate'];
	$tachngay = explode("-", $ngay);
    $ngayhtml = $tachngay[2]."/".$tachngay[1]."/".$tachngay[0];
	$chiphi = tinhchiphi($ngay);
	$loinhuanthuan = $chiphi['loinhuanthuan'];
	$chiphiphaitramoingay = $chiphi['chiphi'];
	$loinhuan = $loinhuanthuan - $chiphiphaitramoingay;
	echo "
	<section class=\"panel panel-primary col-md-12\">
							<header class=\"panel-heading\">
								<div class=\"panel-actions\">
									<a href=\"#\" class=\"panel-action panel-action-toggle\" data-panel-toggle></a>
									<a href=\"#\" class=\"panel-action panel-action-dismiss\" data-panel-dismiss></a>
								</div>
						
								<h2 class=\"panel-title\">CHI PHÍ CỐ ĐỊNH NGÀY {$ngayhtml}</h2>
							</header>
							<div class=\"panel-body col-md-12\" style=\"font-size: 16px;\">
							<!--Chi phí cố định-->
								
								<div class=\"scrollable visible-slider colored-slider\" data-plugin-scrollable style=\"min-height: 500px;\">
										<div class=\"scrollable-content\" id=\"blockB\">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								
								{$chiphi['html']}
								
								</table>
								
								</div>
								</div>
							

						</section>
						<!--Lợi Nhuận-->
						<section class=\"panel panel-primary col-md-12\">
							<header class=\"panel-heading\">
								<div class=\"panel-actions\">
									<a href=\"#\" class=\"panel-action panel-action-toggle\" data-panel-toggle></a>
									<a href=\"#\" class=\"panel-action panel-action-dismiss\" data-panel-dismiss></a>
								</div>
						
								<h2 class=\"panel-title\">LỢI NHUẬN NGÀY {$ngayhtml}</h2>
							</header>
							<div class=\"panel-body col-md-12\" style=\"font-size: 16px;\">
							<!--Chi phí cố định-->
								
								<div class=\"scrollable visible-slider colored-slider\" data-plugin-scrollable style=\"min-height: 150px;\">
										<div class=\"scrollable-content\" id=\"blockB\">
								<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>
								<tr style=\"border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);\"><td>Lợi Nhuận Thuần </td><td><font color=\"red\">".number_format($loinhuanthuan)." </font></td></tr>
								<tr style=\"border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);\"><td>Chi Phí Mất </td><td><font color=\"red\">".number_format($chiphiphaitramoingay)." </font></td></tr>
								<tr style=\"border-top:1px solid black\"><td>Lợi Nhuận : </td><td><font color=\"red\">".number_format($loinhuan)." </font></td></tr>
								</table>
								
								</div>
								</div>
						</section>
	";
}
if(isset($_GET['changeinput']))
{
	$ngay = $_GET['changeinput'];
	$b = explode("/", $ngay);
    $ngay = $b[2]."-".$b[1]."-".$b[0];
	$a = mysql_query("select id,ten from chiphi where type='chiphihangngay'");
									while($b = mysql_fetch_array($a))
									{
										$c = mysql_query("select sotien from chiphihangngay where idchiphi='{$b['id']}' and ngay='{$ngay}'");
										$rows = mysql_num_rows($c);
										if( $rows == 0)
										$sotien = 0;
										elseif( $rows > 0 )
										{
											$result = mysql_fetch_array($c);
											$sotien = $result['sotien'];
										}
										echo "
										<div class=\"form-group\">
												<label class=\"col-md-6 control-label\">{$b['ten']}</label>
												<div class=\"col-md-6\">
													<input type=\"number\" class=\"form-control\" name=\"{$b['id']}\" value=\"{$sotien}\">
												</div>
											</div>
										";
									}
}
?>