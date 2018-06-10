<?php
include("config.php");
include("check_access.php");
include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorJPG.php');
include('src/BarcodeGeneratorHTML.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>In Hóa Đơn</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			width: 400px;
			text-align: center;
			word-wrap: break-word;
		}
		.header{
	font-weight: 700;
	font-size: 45px;
	margin-bottom: 9px;
		}
		.donhang{
			font-size: 40px;
			font-weight: 500;
			line-height: 45px;
		}

	</style>
</head>
<body>

	
			
		<?php
if(isset($_GET['inhangloat']))
{
	$today = date("Y-m-d");
	$inhangloat = $_GET['inhangloat'];
	if($inhangloat == "all")
	$a = mysql_query("select * from donhang where goihang='0' and (thoigian between '{$today} 00:00:00' and '{$today} 23:59:59')");	
	else
	$a = mysql_query("select * from donhang where goihang='0' and ( thoigian between '{$today} 00:00:00' and '{$today} 23:59:59') limit 0,{$inhangloat}");

	
		while($b = mysql_fetch_array($a))
		{
				$check_ghtk = $b['ghtk'];
		if($check_ghtk != "" )
				
	{	
		$madonhang_cu = $b['madonhang'];
		$madonhang = $check_ghtk;
		$array_ma_ghtk = explode(".",$madonhang);
		$keys = array_keys($array_ma_ghtk);
		$last = end($keys);
		$end_maghtk = $array_ma_ghtk[$last];
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		$barcode =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($end_maghtk, $generator::TYPE_CODE_128)) . '" width="200px">';
		unset($array_ma_ghtk[$last]);
		$start_maghtk = implode(".",$array_ma_ghtk);
		$madonhang = $madonhang_cu."<br/>".$barcode."<br />".$start_maghtk."<br />".$end_maghtk;

	}
	else $madonhang = $b['madonhang'];
			$sanpham = $b['sanpham'];
			//Duyệt đơn hàng
			$donhang = "";
			$tach_a = explode("|", $sanpham);
			foreach ($tach_a as $array) {
			$tach_b = explode("-", $array);
			$key = $tach_b[0];
			$value = $tach_b[1];
			$xuly_a = getNameProduct($key);
			$sanpham_a = $xuly_a." : ".$value." cái <br />";
			$donhang.=$sanpham_a;
			}
			echo "
<div style=\"height:1680px;\">			
<div class =\"header\">
{$madonhang}
</div>
<div class =\"donhang\">
{$donhang}
	</div>
	
</div>
			";
			
		
	}
	echo "<script>window.print()</script>";
	
	
}
if(isset($_GET['indon']))
{
	$indon = $_GET['indon'];
	$a = mysql_query("select * from donhang where id='{$indon}'");
	$b = mysql_fetch_array($a);

				$check_ghtk = $b['ghtk'];
		if($check_ghtk != "" )
	{	
		$madonhang = $check_ghtk;
		$madonhang_cu = $b['madonhang'];
		$array_ma_ghtk = explode(".",$madonhang);
		$keys = array_keys($array_ma_ghtk);
		$last = end($keys);
		$end_maghtk = $array_ma_ghtk[$last];
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		$barcode =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($end_maghtk, $generator::TYPE_CODE_128)) . '" width="200px">';
		unset($array_ma_ghtk[$last]);
		$start_maghtk = implode(".",$array_ma_ghtk);
		$madonhang = $madonhang_cu."<br />".$barcode."<br />".$start_maghtk."<br />".$end_maghtk;

	}
	else $madonhang = $b['madonhang'];
			$sanpham = $b['sanpham'];
			//Duyệt đơn hàng
			$donhang = "";
			$tach_a = explode("|", $sanpham);
			foreach ($tach_a as $array) {
			$tach_b = explode("-", $array);
			$key = $tach_b[0];
			$value = $tach_b[1];
			$xuly_a = getNameProduct($key);
			$sanpham_a = $xuly_a." : ".$value." cái <br />";
			$donhang.=$sanpham_a;
}
			echo "
<div class =\"header\">
{$madonhang}
</div>
<div class =\"donhang\">
{$donhang}
	</div>
	

			";
	
	
	echo "<script>window.print()</script>";
	
	
}
if(isset($_GET['print']))
{
	$print = $_GET['print'];
	if(isset($_GET['guihang']))$guihang = $_GET['guihang'];
	$tach = explode(",", $print);
	
	foreach ($tach as $array) 
{	

	$a = mysql_query("select * from donhang where id='{$array}'");
	$b = mysql_fetch_array($a);
		$check_ghtk = $b['ghtk'];
		if($check_ghtk != "" )
	{	
		$madonhang = $check_ghtk;
		$madonhang_cu = $b['madonhang'];
		$array_ma_ghtk = explode(".",$madonhang);
		$keys = array_keys($array_ma_ghtk);
		$last = end($keys);
		$end_maghtk = $array_ma_ghtk[$last];
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		$barcode =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($end_maghtk, $generator::TYPE_CODE_128)) . '" width="200px">';
		unset($array_ma_ghtk[$last]);
		$start_maghtk = implode(".",$array_ma_ghtk);
		$madonhang = $madonhang_cu."<br />".$barcode."<br />".$start_maghtk."<br />".$end_maghtk;

	}
	else $madonhang = $b['madonhang'];
	$sanpham = $b['sanpham'];
	//Duyệt đơn hàng
			$donhang = "";
			$tach_a = explode("|", $sanpham);
			foreach ($tach_a as $array) 
	{
			$tach_b = explode("-", $array);
			$key = $tach_b[0];
			$value = $tach_b[1];
			$xuly_a = getNameProduct($key);
			$sanpham_a = $xuly_a." : ".$value." cái <br />";
			$donhang.=$sanpham_a;	


	}
		echo "<div style=\"height:1680px;\">			
<div class =\"header\">
{$madonhang}
</div>
<div class =\"donhang\">
{$donhang}
	</div>
	
</div>";	
	if(isset($guihang) && $guihang =="yes")
	{
	
	}
}


echo "<script>window.print()</script>";
}
if(isset($_GET['printdate']))
{
	$printdate = $_GET['printdate'];
	$printtype = $_GET['type'];
	$printnhanvien = $_GET['nhanvien'];
	if($printnhanvien == "all" or $printnhanvien =="")
		$where1 = "";
	else $where1 = " and id_nhanvien = '{$printnhanvien}'";

	if($printtype =="0" or $printtype =="all")
		$where2 = " and goihang='0'";
	else $where2 = " and goihang='1'";

		$a = mysql_query("select * from donhang where (thoigian between '{$printdate} 00:00:00' and '{$printdate} 23:59:59') {$where1} {$where2} order by id_nhanvien");
		
		while($b = mysql_fetch_array($a))
		{
				$check_ghtk = $b['ghtk'];
		if($check_ghtk != "" )
			{	
				$madonhang = $check_ghtk;
				$madonhang_cu = $b['madonhang'];
				$array_ma_ghtk = explode(".",$madonhang);
				$keys = array_keys($array_ma_ghtk);
				$last = end($keys);
				$end_maghtk = $array_ma_ghtk[$last];
				$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
				$barcode =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($end_maghtk, $generator::TYPE_CODE_128)) . '" width="200px">';
				unset($array_ma_ghtk[$last]);
				$start_maghtk = implode(".",$array_ma_ghtk);
				$madonhang = $madonhang_cu."<br />".$barcode."<br />".$start_maghtk."<br />".$end_maghtk;
			}
		else $madonhang = $b['madonhang'];
			$sanpham = $b['sanpham'];
			//Duyệt đơn hàng
			$donhang = "";
			$tach_a = explode("|", $sanpham);
			foreach ($tach_a as $array) 
			{
				$tach_b = explode("-", $array);
				$key = $tach_b[0];
				$value = $tach_b[1];
				$xuly_a = getNameProduct($key);
				$sanpham_a = $xuly_a." : ".$value." cái <br />";
				$donhang.=$sanpham_a;	
			}
		echo "<div style=\"height:1680px;\">			
<div class =\"header\">
{$madonhang}
</div>
<div class =\"donhang\">
{$donhang}
	</div>
	
</div>";

		}		

	echo "<script>window.print()</script>";
}
if(isset($_GET['printdateteam']))
{
	$printdate = $_GET['printdateteam'];
	$printtype = $_GET['type'];
	$printteam = $_GET['team'];
	if($printteam == "all" or $printteam =="")
		$where1 = "";
	else $where1 = " and id_nhanvien in ( select id from user where team_id='{$printteam}')";

	if($printtype =="0" or $printtype =="all")
		$where2 = " and goihang='0'";
	else $where2 = " and goihang='1'";

		$a = mysql_query("select * from donhang where (thoigian between '{$printdate} 00:00:00' and '{$printdate} 23:59:59') {$where1} {$where2} order by id_nhanvien");
		while($b = mysql_fetch_array($a))
		{
				$check_ghtk = $b['ghtk'];
		if($check_ghtk != "" )
			{	
				$madonhang = $check_ghtk;
				$madonhang_cu = $b['madonhang'];
				$array_ma_ghtk = explode(".",$madonhang);
				$keys = array_keys($array_ma_ghtk);
				$last = end($keys);
				$end_maghtk = $array_ma_ghtk[$last];
				$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
				$barcode =  '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($end_maghtk, $generator::TYPE_CODE_128)) . '" width="200px">';
				unset($array_ma_ghtk[$last]);
				$start_maghtk = implode(".",$array_ma_ghtk);
				$madonhang = $madonhang_cu."<br />".$barcode."<br />".$start_maghtk."<br />".$end_maghtk;
			}
		else $madonhang = $b['madonhang'];
			$sanpham = $b['sanpham'];
			//Duyệt đơn hàng
			$donhang = "";
			$tach_a = explode("|", $sanpham);
			foreach ($tach_a as $array) 
			{
				$tach_b = explode("-", $array);
				$key = $tach_b[0];
				$value = $tach_b[1];
				$xuly_a = getNameProduct($key);
				$sanpham_a = $xuly_a." : ".$value." cái <br />";
				$donhang.=$sanpham_a;	
			}
		echo "<div style=\"height:1680px;\">			
<div class =\"header\">
{$madonhang}
</div>
<div class =\"donhang\">
{$donhang}
	</div>
	
</div>";

		}		

	echo "<script>window.print()</script>";
}
?>

</body>
</html>