<?php
include("../check_access.php");
if(isset($_POST['luachon']))
{
	$get = "";
	foreach ($_POST as $newarray) {
		
		$count = count($newarray) - 1;
		
		unset($newarray[$count]);
		unset($newarray[0]);
		unset($newarray[1]);
		unset($newarray[2]);
		unset($newarray[3]);
		
	}
	
	foreach ($newarray as $array) {
		if($get =="")
			$get .= $array;
		elseif($get !="") $get .= ",{$array}";
		
	}
	echo "<script>
	window.open('{$site_url}/print.php?print={$get}','_blank')</script>";
	
	
}
if(isset($_POST['PrintDate']))
{
	if($_POST['PrintDate'] =="")
	{
		$chonngay = date("Y-m-d");
	}
	else
	{
		$date = $_POST['PrintDate'];	
		$tachngay_a = explode("/", $date);
		$chonngay = $tachngay_a[2]."-".$tachngay_a[0]."-".$tachngay_a[1];
	}
	
	$nv = $_POST['PrintNV'];
	$type = $_POST['PrintofType'];
	echo "<script>
	window.open('{$site_url}/print.php?printdate={$chonngay}&nhanvien={$nv}&type={$type}','_blank')</script>";
}
if(isset($_POST['PrintDateTeam']))
{
	if($_POST['PrintDateTeam'] =="")
	{
		$chonngay = date("Y-m-d");
	}
	else
	{
		$date = $_POST['PrintDateTeam'];	
		$tachngay_a = explode("/", $date);
		$chonngay = $tachngay_a[2]."-".$tachngay_a[0]."-".$tachngay_a[1];
	}
	
	$team = $_POST['PrintTeamID'];
	$type = $_POST['PrintofTypeTeam'];

	echo "<script>
	window.open('{$site_url}/print.php?printdateteam={$chonngay}&team={$team}&type={$type}','_blank')</script>";
}
?>